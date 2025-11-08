<?php

namespace App\Http\Controllers;

use App\Models\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class NameSearchController extends Controller
{
    public function index()
    {
        return view('name-search');
    }

    public function search(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100'
        ]);

        if (!Auth::check()) {
            session(['name_to_search' => $request->name]);
            return redirect()->route('register')->with('info', 'Regístrate para ver el significado completo del nombre.');
        }

        $name = $request->name;
        
        // Llamada a la API de DeepSeek
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('DEEPSEEK_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.deepseek.com/v1/chat/completions', [
            'model' => 'deepseek-chat',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Eres un experto en onomástica, etimología y simbología espiritual cristiana. Responde siempre en español con la estructura exacta que se te pide.'
                ],
                [
                    'role' => 'user',
                    'content' => "Analiza el nombre '$name' y proporciona una respuesta estructurada en español con exactamente estas 4 secciones separadas:

🌼 1. Significado etimológico del nombre 

✝️ 2. Conexión desde la fe bíblica cristiana católica 

🌷 3. Simbolismo espiritual 

💖 4. Interpretación espiritual completa.

Cada sección debe estar claramente separada por dos saltos de línea. Si es un nombre compuesto, analiza cada parte por separado y luego en conjunto."
                ]
            ],
            'max_tokens' => 2000,
            'temperature' => 0.7
        ]);

        if ($response->successful()) {
            $result = $response->json();
            $content = $result['choices'][0]['message']['content'];
            
            // Debug: Ver lo que devuelve la API
            // logger('API Response: ' . $content);
            
            $sections = $this->parseSections($content);
            
            // Guardar en la base de datos
            $search = Search::create([
                'user_id' => Auth::id(),
                'name' => $name,
                'etimologia' => $sections['etimologia'] ?? 'No disponible',
                'biblico' => $sections['biblico'] ?? 'No disponible',
                'simbolismo' => $sections['simbolismo'] ?? 'No disponible',
                'interpretacion' => $sections['interpretacion'] ?? 'No disponible',
            ]);

            // Incrementar contador de búsquedas
            Auth::user()->increment('search_count');

            // Cargar relaciones para la vista
            $search->load(['comments.user', 'comments.likes']);

            return view('search-result', compact('search'));
        }

        // Si hay error en la API, crear un resultado con datos de ejemplo
        $search = Search::create([
            'user_id' => Auth::id(),
            'name' => $name,
            'etimologia' => 'Error al obtener datos de la API. Intenta nuevamente.',
            'biblico' => 'Error al obtener datos de la API. Intenta nuevamente.',
            'simbolismo' => 'Error al obtener datos de la API. Intenta nuevamente.',
            'interpretacion' => 'Error al obtener datos de la API. Intenta nuevamente.',
        ]);

        Auth::user()->increment('search_count');
        $search->load(['comments.user', 'comments.likes']);

        return view('search-result', compact('search'));
    }

    private function parseSections($content)
    {
        $sections = [
            'etimologia' => '',
            'biblico' => '',
            'simbolismo' => '',
            'interpretacion' => ''
        ];

        // Método más robusto para parsear las secciones
        $sectionHeaders = [
            'etimologia' => ['🌼 1.', '🌼1.', '1. Significado etimológico'],
            'biblico' => ['✝️ 2.', '✝️2.', '2. Conexión bíblica'],
            'simbolismo' => ['🌷 3.', '🌷3.', '3. Simbolismo espiritual'],
            'interpretacion' => ['💖 4.', '💖4.', '4. Interpretación espiritual']
        ];

        $currentSection = null;
        $lines = explode("\n", $content);

        foreach ($lines as $line) {
            $line = trim($line);
            
            if (empty($line)) continue;

            // Verificar si es un encabezado de sección
            foreach ($sectionHeaders as $sectionKey => $headers) {
                foreach ($headers as $header) {
                    if (str_contains($line, $header)) {
                        $currentSection = $sectionKey;
                        // Remover el header de la línea
                        $line = str_replace($header, '', $line);
                        break 2;
                    }
                }
            }

            // Si estamos en una sección y la línea no está vacía, agregar al contenido
            if ($currentSection && !empty(trim($line))) {
                $sections[$currentSection] .= $line . "\n";
            }
        }

        // Limpiar y formatear cada sección
        foreach ($sections as $key => $content) {
            $sections[$key] = trim($content);
            if (empty($sections[$key])) {
                $sections[$key] = "Información no disponible para esta sección.";
            }
        }

        return $sections;
    }

    public function history()
    {
        $searches = Auth::user()->searches()->latest()->get();
        return view('search-history', compact('searches'));
    }
}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tú Significado - Descubre el significado de tu nombre')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --accent: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --light: #f8fafc;
            --dark: #1e293b;
            --text: #334155;
            --text-light: #64748b;
            --gradient-primary: linear-gradient(135deg, #6366f1 0%, #ec4899 100%);
            --gradient-secondary: linear-gradient(135deg, #06b6d4 0%, #10b981 100%);
            --gradient-warning: linear-gradient(135deg, #f59e0b 0%, #ec4899 100%);
            --shadow-soft: 0 4px 20px rgba(99, 102, 241, 0.1);
            --shadow-medium: 0 8px 30px rgba(99, 102, 241, 0.15);
            --shadow-strong: 0 12px 40px rgba(99, 102, 241, 0.2);
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
            color: var(--text);
        }

        .gradient-bg {
            background: var(--gradient-primary);
        }

        .gradient-secondary {
            background: var(--gradient-secondary);
        }

        .gradient-warning {
            background: var(--gradient-warning);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.8rem;
        }

        .hero-section {
            background: var(--gradient-primary);
            color: white;
            padding: 4rem 0;
            border-radius: 0 0 2rem 2rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="rgba(255,255,255,0.1)"><polygon points="1000,100 1000,0 0,100"></polygon></svg>');
            background-size: cover;
        }

        .search-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: var(--shadow-strong);
            border: none;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .search-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-strong);
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-medium);
        }

        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
            background: var(--gradient-primary);
        }

        .btn-secondary {
            background: var(--gradient-secondary);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            background: var(--gradient-primary);
            color: white;
        }

        .meaning-content {
            font-family: 'Poppins', sans-serif;
            font-size: 1.05rem;
            line-height: 1.7;
            text-align: justify;
            color: var(--text);
            white-space: pre-line;
            text-justify: inter-word;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 2rem;
        }

        .rating-stars {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .rating-stars input {
            display: none;
        }

        .rating-stars label {
            cursor: pointer;
            font-size: 1.5rem;
            color: #e2e8f0;
            transition: color 0.2s;
            margin-right: 5px;
        }

        .rating-stars input:checked ~ label,
        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: #f59e0b;
        }

        .rating-stars input:checked + label {
            color: #f59e0b;
        }

        .comment-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 1rem;
            border: 1px solid #e2e8f0;
        }

        .comment-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-soft);
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
            background: var(--gradient-primary);
        }

        .like-btn.liked {
            background: var(--gradient-primary);
            border-color: var(--primary);
            color: white;
        }

        .floating-shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 15%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Estilos para testimonios corregidos */
        .testimonial-item {
            border-left: 4px solid var(--primary);
            transition: all 0.3s ease;
            border: 1px solid rgba(99, 102, 241, 0.1);
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-soft);
        }

        .testimonial-item:hover {
            transform: translateX(5px);
            box-shadow: var(--shadow-medium);
            border-left-color: var(--secondary);
        }

        .testimonial-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .testimonial-text {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            line-height: 1.6;
            color: var(--text);
            margin-bottom: 0;
        }

        /* Colores específicos para cada testimonio */
        .testimonial-item:nth-child(1) {
            border-left-color: var(--primary);
        }

        .testimonial-item:nth-child(2) {
            border-left-color: var(--success);
        }

        .testimonial-item:nth-child(3) {
            border-left-color: var(--warning);
        }

        .testimonial-item:nth-child(4) {
            border-left-color: var(--info);
        }

        .testimonial-item:nth-child(5) {
            border-left-color: var(--danger);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark gradient-bg py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="fas fa-crystal-ball me-2"></i>Tú Significado 
            </a>
            
            <div class="navbar-nav ms-auto">
                @auth
                    <a class="nav-link" href="{{ route('history') }}">
                        <i class="fas fa-history me-1"></i>Mi Historial
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">
                            <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                        </button>
                    </form>
                @else
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt me-1"></i>Iniciar Sesión
                    </a>
                    <a class="nav-link" href="{{ route('register') }}">
                        <i class="fas fa-user-plus me-1"></i>Registrarse
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold mb-3">
                        <i class="fas fa-crystal-ball me-2"></i>Tú Significado
                    </h4>
                    <p class="text-light">Descubre el profundo significado de tu nombre. Una experiencia única de conocimiento.</p>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">Enlaces</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('name.search') }}" class="text-light text-decoration-none">Buscar Nombre</a></li>
                        <li><a href="{{ route('register') }}" class="text-light text-decoration-none">Registrarse</a></li>
                        <li><a href="{{ route('login') }}" class="text-light text-decoration-none">Iniciar Sesión</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">Contacto</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope me-2"></i>info@nombresignifica.com</li>
                        <li><i class="fas fa-phone me-2"></i>+1 (555) 123-4567</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 Tú Significado. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
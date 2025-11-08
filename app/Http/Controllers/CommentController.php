<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'search_id' => 'required|exists:searches,id',
            'comment' => 'required|string|min:10|max:1000',
            'rating' => 'required|integer|between:1,5'
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'search_id' => $request->search_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'is_approved' => true
        ]);

        return back()->with('success', '¡Comentario agregado exitosamente!');
    }

    public function update(Request $request, Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            return back()->with('error', 'No tienes permiso para editar este comentario.');
        }

        $request->validate([
            'comment' => 'required|string|min:10|max:1000',
            'rating' => 'required|integer|between:1,5'
        ]);

        $comment->update([
            'comment' => $request->comment,
            'rating' => $request->rating
        ]);

        return back()->with('success', '¡Comentario actualizado exitosamente!');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            return back()->with('error', 'No tienes permiso para eliminar este comentario.');
        }
        
        $comment->delete();
        return back()->with('success', '¡Comentario eliminado exitosamente!');
    }

    public function like(Comment $comment)
    {
        $like = CommentLike::firstOrCreate([
            'user_id' => Auth::id(),
            'comment_id' => $comment->id
        ]);

        if ($like->wasRecentlyCreated) {
            return response()->json(['success' => true, 'likes_count' => $comment->likes_count]);
        }

        return response()->json(['success' => false, 'message' => 'Ya has dado like a este comentario']);
    }

    public function unlike(Comment $comment)
    {
        $like = CommentLike::where('user_id', Auth::id())
            ->where('comment_id', $comment->id)
            ->first();

        if ($like) {
            $like->delete();
            return response()->json(['success' => true, 'likes_count' => $comment->likes_count]);
        }

        return response()->json(['success' => false, 'message' => 'No has dado like a este comentario']);
    }
}
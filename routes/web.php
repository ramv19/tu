<?php

use App\Http\Controllers\NameSearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

// Rutas Públicas
Route::get('/', [NameSearchController::class, 'index'])->name('home');
Route::get('/search', [NameSearchController::class, 'index'])->name('name.search');
Route::post('/search', [NameSearchController::class, 'search'])->name('name.search.post');

// Rutas de Autenticación
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas Protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::get('/history', [NameSearchController::class, 'history'])->name('history');
    
    // Rutas de Comentarios
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/{comment}/like', [CommentController::class, 'like'])->name('comments.like');
    Route::post('/comments/{comment}/unlike', [CommentController::class, 'unlike'])->name('comments.unlike');
});
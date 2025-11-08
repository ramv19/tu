@extends('layouts.app')

@section('title', "Resultados para {$search->name}")

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="display-4 fw-bold text-primary">
                    Resultados para: <span class="text-gradient">{{ $search->name }}</span>
                </h1>
                <a href="{{ route('name.search') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Nueva Búsqueda
                </a>
            </div>

            @if(str_contains($search->etimologia, 'Error al obtener datos'))
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Error de conexión:</strong> No se pudieron obtener los datos de la API. 
                    Por favor, intenta nuevamente en unos momentos.
                </div>
            @endif

            <!-- Estadísticas de Comentarios -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h4 class="text-primary">{{ $search->approvedComments()->count() }}</h4>
                            <p class="text-muted mb-0">Comentarios</p>
                        </div>
                        <div class="col-md-4">
                            <h4 class="text-success">
                                @php
                                    $avgRating = $search->approvedComments()->avg('rating');
                                @endphp
                                {{ number_format($avgRating, 1) }}/5
                            </h4>
                            <p class="text-muted mb-0">Calificación Promedio</p>
                        </div>
                        <div class="col-md-4">
                            <h4 class="text-info">{{ $search->approvedComments()->distinct('user_id')->count('user_id') }}</h4>
                            <p class="text-muted mb-0">Usuarios Opinaron</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resultados del Significado -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card card-hover h-100 border-primary">
                        <div class="card-header bg-primary text-white d-flex align-items-center">
                            <i class="fas fa-book me-2"></i>
                            <h4 class="mb-0">🌼 Significado Etimológico</h4>
                        </div>
                        <div class="card-body">
                            <div class="meaning-content">
                                {{ $search->etimologia }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card card-hover h-100 border-success">
                        <div class="card-header bg-success text-white d-flex align-items-center">
                            <i class="fas fa-cross me-2"></i>
                            <h4 class="mb-0">✝️ Conexión Bíblica</h4>
                        </div>
                        <div class="card-body">
                            <div class="meaning-content">
                                {{ $search->biblico }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card card-hover h-100 border-info">
                        <div class="card-header bg-info text-white d-flex align-items-center">
                            <i class="fas fa-feather me-2"></i>
                            <h4 class="mb-0">🌷 Simbolismo Espiritual</h4>
                        </div>
                        <div class="card-body">
                            <div class="meaning-content">
                                {{ $search->simbolismo }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card card-hover h-100 border-warning">
                        <div class="card-header bg-warning text-white d-flex align-items-center">
                            <i class="fas fa-heart me-2"></i>
                            <h4 class="mb-0">💖 Interpretación Espiritual</h4>
                        </div>
                        <div class="card-body">
                            <div class="meaning-content">
                                {{ $search->interpretacion }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN DE COMENTARIOS Y RESEÑAS -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">
                                <i class="fas fa-comments me-2"></i>Comentarios y Reseñas
                                <span class="badge bg-primary ms-2">{{ $search->approvedComments()->count() }}</span>
                            </h4>
                        </div>
                        <div class="card-body">
                            <!-- Formulario para Nuevo Comentario -->
                            @auth
                                <div class="mb-4 p-4 border rounded bg-light">
                                    <h5 class="mb-3">Deja tu comentario y reseña</h5>
                                    <form action="{{ route('comments.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="search_id" value="{{ $search->id }}">
                                        
                                        <!-- Sistema de Rating con Estrellas -->
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Calificación:</label>
                                            <div class="rating-stars">
                                                @for($i = 5; $i >= 1; $i--)
                                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ $i == 5 ? 'checked' : '' }}>
                                                    <label for="star{{ $i }}">
                                                        <i class="fas fa-star"></i>
                                                    </label>
                                                @endfor
                                            </div>
                                        </div>

                                        <!-- Comentario -->
                                        <div class="mb-3">
                                            <label for="comment" class="form-label fw-bold">Tu Comentario:</label>
                                            <textarea class="form-control" id="comment" name="comment" rows="4" 
                                                      placeholder="Comparte tu experiencia, opinión o reflexión sobre este nombre..." 
                                                      required></textarea>
                                            <div class="form-text">Mínimo 10 caracteres</div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-paper-plane me-2"></i>Publicar Comentario
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <a href="{{ route('login') }}" class="alert-link fw-bold">Inicia sesión</a> o 
                                    <a href="{{ route('register') }}" class="alert-link fw-bold">regístrate</a> 
                                    para dejar tu comentario y reseña.
                                </div>
                            @endauth

                            <!-- Lista de Comentarios -->
                            <h5 class="mb-4 fw-bold">Comentarios de la Comunidad:</h5>
                            
                            @if($search->approvedComments()->count() > 0)
                                @foreach($search->approvedComments()->with('user', 'likes')->latest()->get() as $comment)
                                    <div class="card mb-4 comment-card">
                                        <div class="card-body">
                                            <!-- Header del Comentario -->
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                         style="width: 40px; height: 40px;">
                                                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-bold">{{ $comment->user->name }}</h6>
                                                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                    </div>
                                                </div>
                                                <div class="rating-display">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $comment->rating ? 'text-warning' : 'text-light' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>

                                            <!-- Contenido del Comentario -->
                                            <p class="card-text comment-text">{{ $comment->comment }}</p>

                                            <!-- Acciones del Comentario -->
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="like-section">
                                                    @auth
                                                        <button class="btn btn-sm btn-outline-primary like-btn {{ $comment->isLikedByUser() ? 'liked' : '' }}" 
                                                                data-comment-id="{{ $comment->id }}">
                                                            <i class="fas fa-thumbs-up me-1"></i>
                                                            <span class="like-count">{{ $comment->likes_count }}</span>
                                                        </button>
                                                    @else
                                                        <span class="text-muted">
                                                            <i class="fas fa-thumbs-up me-1"></i>
                                                            {{ $comment->likes_count }}
                                                        </span>
                                                    @endauth
                                                </div>

                                                @auth
                                                    @if($comment->user_id === Auth::id())
                                                        <div class="comment-actions">
                                                            <button class="btn btn-sm btn-outline-secondary edit-comment" 
                                                                    data-comment-id="{{ $comment->id }}"
                                                                    data-comment-text="{{ $comment->comment }}"
                                                                    data-rating="{{ $comment->rating }}">
                                                                <i class="fas fa-edit me-1"></i>Editar
                                                            </button>
                                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                                        onclick="return confirm('¿Estás seguro de eliminar este comentario?')">
                                                                    <i class="fas fa-trash me-1"></i>Eliminar
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">No hay comentarios aún. Sé el primero en compartir tu opinión.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones Finales -->
            <div class="text-center mt-4">
                <a href="{{ route('history') }}" class="btn btn-outline-primary me-3">
                    <i class="fas fa-history me-2"></i>Ver Mi Historial
                </a>
                <a href="{{ route('name.search') }}" class="btn btn-primary gradient-bg border-0">
                    <i class="fas fa-search me-2"></i>Nueva Búsqueda
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar Comentario -->
@auth
<div class="modal fade" id="editCommentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Comentario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editCommentForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Calificación:</label>
                        <div class="rating-stars" id="editRatingStars">
                            @for($i = 5; $i >= 1; $i--)
                                <input type="radio" id="editStar{{ $i }}" name="rating" value="{{ $i }}">
                                <label for="editStar{{ $i }}">
                                    <i class="fas fa-star"></i>
                                </label>
                            @endfor
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editComment" class="form-label">Comentario:</label>
                        <textarea class="form-control" id="editComment" name="comment" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Comentario</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth
@endsection

@push('styles')
<style>
    .meaning-content {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 1.05rem;
        line-height: 1.7;
        text-align: justify;
        color: #2d3748;
        white-space: pre-line;
        text-justify: inter-word;
    }

    .comment-text {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 1rem;
        line-height: 1.6;
        color: #4a5568;
        text-align: left;
    }

    .card-header h4 {
        font-family: 'Georgia', serif;
        font-weight: 600;
    }

    .meaning-content::first-letter {
        font-size: 1.2em;
        font-weight: bold;
        color: #2c5282;
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: 2px solid rgba(255,255,255,0.2);
        padding: 1rem 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .avatar {
        font-weight: bold;
        font-size: 1.1rem;
    }

    .like-btn.liked {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
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
        color: #ddd;
        transition: color 0.2s;
        margin-right: 5px;
    }

    .rating-stars input:checked ~ label,
    .rating-stars label:hover,
    .rating-stars label:hover ~ label {
        color: #ffc107;
    }

    .rating-stars input:checked + label {
        color: #ffc107;
    }

    .rating-display .fa-star {
        font-size: 0.9rem;
    }

    .comment-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-radius: 8px;
    }

    .comment-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sistema de Likes
    document.querySelectorAll('.like-btn').forEach(button => {
        button.addEventListener('click', function() {
            const commentId = this.dataset.commentId;
            const isLiked = this.classList.contains('liked');
            
            fetch(`/comments/${commentId}/${isLiked ? 'unlike' : 'like'}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const likeCount = this.querySelector('.like-count');
                    likeCount.textContent = data.likes_count;
                    
                    if (isLiked) {
                        this.classList.remove('liked');
                        this.classList.remove('btn-primary');
                        this.classList.add('btn-outline-primary');
                    } else {
                        this.classList.add('liked');
                        this.classList.add('btn-primary');
                        this.classList.remove('btn-outline-primary');
                    }
                }
            });
        });
    });

    // Sistema de Edición de Comentarios
    document.querySelectorAll('.edit-comment').forEach(button => {
        button.addEventListener('click', function() {
            const commentId = this.dataset.commentId;
            const commentText = this.dataset.commentText;
            const rating = this.dataset.rating;
            
            document.getElementById('editComment').value = commentText;
            document.querySelector(`#editRatingStars input[value="${rating}"]`).checked = true;
            
            const form = document.getElementById('editCommentForm');
            form.action = `/comments/${commentId}`;
            
            new bootstrap.Modal(document.getElementById('editCommentModal')).show();
        });
    });
});
</script>
@endpush
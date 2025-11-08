@extends('layouts.app')

@section('title', 'Mi Historial de Búsquedas')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="display-4 fw-bold text-primary mb-4">
                <i class="fas fa-history me-2"></i>Mi Historial de Búsquedas
            </h1>

            @if($searches->count() > 0)
                <div class="row">
                    @foreach($searches as $search)
                        <div class="col-lg-6 mb-4">
                            <div class="card card-hover h-100">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">{{ $search->name }}</h5>
                                    <small class="text-muted">Buscado el {{ $search->created_at->format('d/m/Y H:i') }}</small>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong>Significado:</strong> 
                                        {{ Str::limit(strip_tags($search->etimologia), 150) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary">
                                            {{ $search->comments->count() }} Comentarios
                                        </span>
                                        <a href="{{ route('name.search') }}?name={{ urlencode($search->name) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            Ver Detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-search fa-4x text-muted mb-3"></i>
                    <h3 class="text-muted">No has realizado ninguna búsqueda</h3>
                    <p class="text-muted">Comienza a explorar los significados de los nombres</p>
                    <a href="{{ route('name.search') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-search me-2"></i>Realizar Primera Búsqueda
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
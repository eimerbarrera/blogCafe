@extends('layouts.base')

@section('title', 'Blog - Cosecha y Grano')

@section('content')

    <section class="banner">
        <div class="container-fluid">
            <div class="row align-items-center">

                <!-- Título y subtítulo a la izquierda -->
                <div class="col-lg-8">
                    <div class="banner__content">
                        <h3 class="banner__title mb-0">
                            Mis Publicaciones
                        </h3>
                        <p class="banner__subtitle mb-0">
                            Administra los artículos que has publicado en Cosecha y Grano.
                        </p>
                    </div>
                </div>

                <!-- Botón a la derecha alineado -->
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="#" class="btn-custom">
                        <i class="bi bi-plus-lg"></i> Crear Nuevo Post
                    </a>
                </div>

            </div>
        </div>
    </section>

    <section class="blog blog--list">
        <div class="container-fluid">
            <!-- Alerta de éxito si realiza una acción -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Lista de Posts -->
            <div class="row">
                <div class="col-lg-12">
                    @forelse($posts as $post)
                        <div
                            class="post-card post-card--list mb-4 p-3 border rounded shadow-sm d-flex flex-column flex-md-row align-items-center justify-content-between">

                            <!-- Imagen e Información Principal -->
                            <div class="d-flex align-items-center w-100">
                                <div class="post-card__image me-3"
                                    style="width: 120px; height: 80px; flex-shrink: 0; overflow: hidden; border-radius: 6px;">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="post-card__content w-100">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span
                                            class="badge {{ $post->status == 'published' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ ucfirst($post->status) }}
                                        </span>
                                        <small class="text-muted">
                                            <i class="bi bi-clock"></i>
                                            {{ $post->created_at->translatedFormat('d M, Y') }}
                                        </small>
                                    </div>
                                    <h5 class="post-card__title mb-1">
                                        <a href="{{ route('blog.show', ['id' => $post->id, 'slug' => $post->slug]) }}" class="text-decoration-none">
                                            {{ $post->title }}
                                        </a>
                                    </h5>
                                    <p class="text-muted small mb-0">
                                        {{ Str::limit(strip_tags($post->summary ?? $post->content), 100) }}
                                    </p>
                                </div>
                            </div>

                            <!-- Botones de Acción (Ver / Editar / Eliminar) -->
                            <div class="d-flex mt-3 mt-md-0 ms-md-3 flex-shrink-0 gap-2">
                                <a href="{{ route('blog.show', ['id' => $post->id, 'slug' => $post->slug]) }}" class="btn btn-sm btn-outline-primary" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-primary" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="#" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de eliminar este post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    @empty
                        <div class="text-center py-5 border rounded">
                            <h4>Aún no tienes publicaciones</h4>
                            <p class="text-muted mb-3">Empieza a compartir tu pasión por el café creando tu primer artículo.
                            </p>
                            <a href="#" class="btn-custom btn-sm">Crear mi primer post</a>
                        </div>
                    @endforelse

                    <!-- Paginación -->
                    <div class="row">
                        <div class="col-lg-12">
                            {{ $posts->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--newslettre-->
    @include('partials.newslettre')

@endsection

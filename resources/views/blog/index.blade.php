@extends('layouts.base')

@section('title', 'Blog - Cosecha y Grano')

@section('content')

    <!--Banner-->
    <section class="banner">
        <!--Resultado de busqueda-->
        @if ($search)
            <div class="alert alert-success text-center ">
                <p>Resultados de búsqueda para: <strong>"{{ $search }}"</strong>. Se han encontrado
                    {{ $posts->total() }} resultados.</p>
            </div>
        @endif
        <div class="row">
            <div class="container-fluid">
                <div class="col-lg-8">
                    <div class="banner__content">
                        <!-- Migas de pan dinámicas -->
                        <small class="banner__meta">
                            <a href="{{ url('/') }}" class="banner__link">Inicio</a>
                            <i class="bi bi-caret-right-fill banner__icon"></i> Blog
                        </small>

                        <!-- Título principal adaptado -->
                        <h3 class="banner__title">
                            @if (isset($category))
                                Categoría: <span class="banner__category-color">{{ $category->name }}</span>
                            @elseif(isset($tag))
                                Etiqueta: <span class="banner__category-color">#{{ $tag->name }}</span>
                            @else
                                Blog: <span class="banner__category-color">Café y Post</span>
                            @endif
                        </h3>

                        <!-- Subtítulo con la esencia de Cosecha y Grano -->
                        <p class="banner__subtitle">
                            Explora nuestras últimas publicaciones, guías de preparación, historias de caficultores
                            y todo lo que necesitas saber para vivir la auténtica cultura del café de especialidad
                            desde la semilla hasta tu taza.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--blog-grid-->
    <section class="blog-classic">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-9  side-content ">
                    <div class="theiaStickySidebar">
                        <div class="row">
                            <div class="col-lg-12 pl-45">
                                @forelse($posts as $post)
                                    <!-- Post Item -->
                                    <div class="post-card post-card--list">
                                        <!-- Imagen del Post -->
                                        <div class="post-card__image">
                                            <a href="{{ route('blog.show', ['id' => $post->id, 'slug' => $post->slug]) }}">
                                                <img src="{{ asset('storage/' . $post->featured_image) }}"
                                                    alt="{{ $post->title }}">
                                            </a>
                                        </div>

                                        <!-- Contenido del Post -->
                                        <div class="post-card__content">
                                            <!-- Categoría -->
                                            @foreach ($post->categories as $postCategory)
                                                <a href="{{ route('blog.category', $postCategory->slug) }}"
                                                    class="category">
                                                    {{ $postCategory->name }}
                                                </a>
                                            @endforeach

                                            <!-- Título -->
                                            <h4 class="post-card__title">
                                                <a href="{{ route('blog.show', ['id' => $post->id, 'slug' => $post->slug]) }}"
                                                    class="post-card__title-link">
                                                    {{ $post->title }}
                                                </a>
                                            </h4>

                                            <!-- Extracto -->
                                            <p class="post-card__exerpt">
                                                {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 130) }}
                                            </p>

                                            <!-- Meta datos: Autor, Fecha y Tiempo de lectura -->
                                            <ul class="post-card__meta list-inline">
                                                <!-- Foto de perfil del autor -->
                                                <li class="post-card__meta-item">
                                                    <a href="#" class="post-card__meta-link">
                                                        <img src="{{ asset($post->user->profile_photo_path ?? 'assets/img/author/admin.png') }}"
                                                            alt="{{ $post->user->name ?? 'Autor' }}"
                                                            class="post-card__meta-img">
                                                    </a>
                                                </li>

                                                <!-- Nombre del autor -->
                                                <li class="post-card__meta-item">
                                                    <a href="#" class="post-card__meta-link">
                                                        {{ $post->user->name ?? 'Cosecha y Grano' }}
                                                    </a>
                                                </li>

                                                <!-- Fecha de publicación -->
                                                <li class="post-card__meta-item">
                                                    <span class="dot"></span>
                                                    {{ $post->created_at->translatedFormat('d M, Y') }}
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                @empty
                                    <!-- Estado si no existen artículos aún -->
                                    <div class="alert alert-info text-center my-5 py-4">
                                        <h4>¡Pronto habrá café servido!</h4>
                                        <p class="mb-0">Aún no hay publicaciones disponibles en esta sección.
                                            Vuelve muy pronto para descubrir nuevas historias sobre café de
                                            especialidad.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!--pagination-->
                        <div class="row">
                            <div class="col-lg-12">
                                {{ $posts->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 max-width side-sidebar">
                    <div class="theiaStickySidebar">

                        <!--widget-Latest-Posts-->
                        <div class="widget">
                            <h5 class="widget__title">Últimos Posts</h5>
                            <ul class="widget__latest-posts">
                                @forelse($latestPosts as $index => $latestPost)
                                    <li class="widget__latest-posts__item">
                                        <div class="widget__latest-posts-image">
                                            <a href="{{ route('blog.show', ['id' => $latestPost->id, 'slug' => $latestPost->slug]) }}"
                                                class="widget__latest-posts-link">
                                                @if ($latestPost->featured_image)
                                                    <img src="{{ asset('storage/' . $latestPost->featured_image) }}"
                                                        alt="{{ $latestPost->title }}" class="widget__latest-posts-img">
                                                @else
                                                    <img src="{{ asset('assets/img/latest/' . ($index + 1) . '.jpg') }}"
                                                        alt="{{ $latestPost->title }}" class="widget__latest-posts-img">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="widget__latest-posts-count">{{ $index + 1 }}</div>
                                        <div class="widget__latest-posts__content">
                                            <p class="widget__latest-posts-title">
                                                <a href="{{ route('blog.show', ['id' => $latestPost->id, 'slug' => $latestPost->slug]) }}"
                                                    class="widget__latest-posts-link">
                                                    {{ $latestPost->title }}
                                                </a>
                                            </p>
                                            <small class="widget__latest-posts-date">
                                                <i class="bi bi-clock-fill widget__latest-posts-icon"></i>
                                                {{ $latestPost->published_at ? $latestPost->published_at->format('F d, Y') : $latestPost->created_at->format('F d, Y') }}
                                            </small>
                                        </div>
                                    </li>
                                @empty
                                    <p class="text-muted">No hay publicaciones recientes todavía.</p>
                                @endforelse
                            </ul>
                        </div>

                        <!--widget-categories-->
                        <div class="widget">
                            <h5 class="widget__title">Categorias</h5>
                            <ul class="widget__categories">
                                @forelse($categories as $category)
                                    <li class="widget__categories-item">
                                        <a href="{{ route('blog.category', $category->slug) }}" class="category">
                                            {{ $category->name }}
                                        </a>
                                        <span class="ml-auto widget__categories-number">
                                            {{ $category->posts_count }}
                                            {{ Str::plural('Post', $category->posts_count) }}
                                        </span>
                                    </li>
                                @empty
                                    <p class="text-muted">No hay categorías registradas todavía.</p>
                                @endforelse
                            </ul>
                        </div>

                        <!--widget-tags-->
                        @if ($tags->isNotEmpty())
                            <div class="widget">
                                <h5 class="widget__title">Etiquetas</h5>
                                <ul class="list-inline widget__tags">
                                    @foreach ($tags as $tag)
                                        <li class="widget__tags-item">
                                            <a href="{{ route('blog.tag', $tag->slug) }}"
                                                class="widget__tags-link">#{{ $tag->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!--widget-ads-->
                        <div class="widget">
                            <h5 class="widget__title">ads</h5>
                            <div class="widget__ads">
                                <a href="#" class="widget__ads-link">
                                    <img src="assets/img/ads/ads3.jpg" alt="" class="widget__ads-img">
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section><!--/-->

    <!--newslettre-->
    @include('partials.newslettre')

@endsection

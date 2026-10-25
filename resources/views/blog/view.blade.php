@extends('layouts.base')

@section('title', 'Blog - Cosecha y Grano')

@section('content')

    <!--post-individual-->
    <section class="mt-130 mb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-9 side-content">
                    <div class="theiaStickySidebar">
                        <!--Post-single-->
                        <div class="post-single">
                            <!-- Imagen destacada del post -->
                            <div class="post-single__image">
                                @if ($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                        class="post-single__image-img">
                                @else
                                    <img src="{{ asset('assets/img/blog/2.jpg') }}" alt="{{ $post->title }}"
                                        class="post-single__image-img">
                                @endif
                            </div>

                            <div class="post-single__content">
                                <!-- Categoría dinámica -->
                                @if ($post->categories->isNotEmpty())
                                    <a href="#" class="category">{{ $post->categories->first()->name }}</a>
                                @else
                                    <a href="#" class="category">Café de Especialidad</a>
                                @endif

                                <!-- Título dinámico -->
                                <h2 class="post-single__title">{{ $post->title }}</h2>

                                <ul class="post-single__meta list-inline">
                                    <li class="post-single__meta-item">
                                        <a href="#">
                                            <img src="{{ asset('assets/img/author/admin.png') }}" alt="Imagen equipo"
                                                class="post-single__meta-img">
                                        </a>
                                    </li>
                                    <li class="post-single__meta-item">
                                        <a href="#"
                                            class="post-single__meta-link">{{ $post->user->name ?? 'Caficultor' }}</a>
                                    </li>
                                    <li class="post-single__meta-item">
                                        <span class="dot"></span>
                                        {{ $post->published_at ? $post->published_at->format('F d, Y') : $post->created_at->format('F d, Y') }}
                                    </li>
                                </ul>
                            </div>

                            <!-- Cuerpo del post (Contenido enriquecido) -->
                            <div class="post-single__body">
                                {!! $post->content !!}
                            </div>

                            <!-- Footer con las etiquetas (Tags) dinámicas -->
                            <div class="post-single__footer">
                                @if ($post->tags->isNotEmpty())
                                    <ul class="list-inline widget__tags">
                                        @foreach ($post->tags as $tag)
                                            <li class="widget__tags-item">
                                                <a href="{{ route('blog.tag', $tag->slug) }}"
                                                    class="widget__tags-link">{{ $tag->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>

                        <!--Related-posts (Navegación Anterior y Siguiente) -->
                        <div class="row">
                            <!-- Post Anterior -->
                            <div class="col-md-6">
                                @if ($previousPost)
                                    <div class="widget">
                                        <div class="widget__related-post">
                                            <div class="widget__related-post__image">
                                                <a
                                                    href="{{ route('blog.show', ['id' => $previousPost->id, 'slug' => $previousPost->slug]) }}">
                                                    @if ($previousPost->featured_image)
                                                        <img src="{{ asset('storage/' . $previousPost->featured_image) }}"
                                                            alt="{{ $previousPost->title }}"
                                                            class="widget__related-post__img">
                                                    @else
                                                        <img src="{{ asset('assets/img/latest/1.jpg') }}"
                                                            alt="{{ $previousPost->title }}"
                                                            class="widget__related-post__img">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="widget__related-post__content">
                                                <a class="btn-link"
                                                    href="{{ route('blog.show', ['id' => $previousPost->id, 'slug' => $previousPost->slug]) }}">
                                                    <i class="bi bi-arrow-left"></i> Post Previo
                                                </a>
                                                <p class="widget__related-post__title">
                                                    <a href="{{ route('blog.show', ['id' => $previousPost->id, 'slug' => $previousPost->slug]) }}"
                                                        class="widget__related-post__link">
                                                        {{ $previousPost->title }}
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Post Siguiente -->
                            <div class="col-md-6">
                                @if ($nextPost)
                                    <div class="widget">
                                        <div class="widget__related-post">
                                            <div class="widget__related-post__image">
                                                <a
                                                    href="{{ route('blog.show', ['id' => $nextPost->id, 'slug' => $nextPost->slug]) }}">
                                                    @if ($nextPost->featured_image)
                                                        <img src="{{ asset('storage/' . $nextPost->featured_image) }}"
                                                            alt="{{ $nextPost->title }}" class="widget__related-post__img">
                                                    @else
                                                        <img src="{{ asset('assets/img/latest/2.jpg') }}"
                                                            alt="{{ $nextPost->title }}" class="widget__related-post__img">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="widget__related-post__content">
                                                <a class="btn-link"
                                                    href="{{ route('blog.show', ['id' => $nextPost->id, 'slug' => $nextPost->slug]) }}">
                                                    Siguiente Post <i class="bi bi-arrow-right"></i>
                                                </a>
                                                <p class="widget__related-post__title">
                                                    <a href="{{ route('blog.show', ['id' => $nextPost->id, 'slug' => $nextPost->slug]) }}"
                                                        class="widget__related-post__link">
                                                        {{ $nextPost->title }}
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 max-width side-sidebar">
                    <div class="theiaStickySidebar">
                        <!--widget-author-->
                        <div class="widget">
                            <div class="widget__author">
                                <div class="widget__author-top">
                                    <a href="#" class="widget__author-link">
                                        <img src="{{ asset('assets/img/author/admin.png') }}"
                                            alt="{{ $post->user->name ?? 'Autor' }}" class="widget__author-img">
                                    </a>
                                </div>
                                <div class="widget__author-content">
                                    <h6 class="widget__author-name">Hola, soy
                                        {{ $post->user->name ?? 'Caficultor' }}</h6>
                                    <p class="widget__author-bio">
                                        {{ $post->user->description ?? 'Apasionado por el café de especialidad y las historias de nuestra tierra.' }}
                                    </p>

                                    <ul class="list-inline social-media social-media--layout-two">
                                        @if ($post->user && $post->user->urlfacebook)
                                            <li class="social-media__item">
                                                <a href="{{ $post->user->urlfacebook }}" target="_blank"
                                                    class="social-media__link color-facebook">
                                                    <i class="bi bi-facebook"></i>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($post->user && $post->user->urlinstagram)
                                            <li class="social-media__item">
                                                <a href="{{ $post->user->urlinstagram }}" target="_blank"
                                                    class="social-media__link color-instagram">
                                                    <i class="bi bi-instagram"></i>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($post->user && $post->user->urlyoutube)
                                            <li class="social-media__item">
                                                <a href="{{ $post->user->urlyoutube }}" target="_blank"
                                                    class="social-media__link color-youtube">
                                                    <i class="bi bi-youtube"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>

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
                        @if ($post->tags->isNotEmpty())
                            <div class="widget">
                                <h5 class="widget__title">Etiquetas</h5>
                                <ul class="list-inline widget__tags">
                                    @foreach ($post->tags as $tag)
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

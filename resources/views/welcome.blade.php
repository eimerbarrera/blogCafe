<!doctype html>
<html lang="es">

<head>
    @include('partials.head')
</head>

<body>
    <!--loading -->
    @include('partials.loading')
    <!--/-->

    <!-- Header -->
    @include('partials.header')
    <!--/-->

    <main class="main">

        <!--slider-two-->
        <div class="slider slider--two">
            <div class="swiper slider__top">
                <div class="swiper-wrapper">
                    @foreach ($sliderPosts as $index => $post)
                        <!--slider item {{ $index + 1 }}-->
                        <div class="slider__item swiper-slide"
                            style="background-image: url({{ asset('storage/' . $post->featured_image) }});">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xl-7 col-lg-9 col-md-12">
                                        <div class="slider__item-content">
                                            @if ($post->categories->isNotEmpty())
                                                <a href="#"
                                                    class="category">{{ $post->categories->first()->name }}</a>
                                            @endif

                                            <h1 class="slider__title">
                                                <a href="{{ route('blog.show', ['id' => $post->id, 'slug' => $post->slug]) }}" class="slider__title-link">{{ $post->title }}</a>
                                            </h1>

                                            <p class="slider__exerpt">{{ $post->summary }}</p>

                                            <ul class="slider__meta list-inline">
                                                <li class="slider__meta-item">
                                                    <a href="#" class="slider__meta-link">
                                                        <img src="{{ asset('assets/img/author/admin.png') }}" alt=""
                                                            class="slider__meta-img">
                                                    </a>
                                                </li>
                                                <li class="slider__meta-item">
                                                    <a href="#"
                                                        class="slider__meta-link">{{ $post->user->name ?? 'Caficultor' }}</a>
                                                </li>
                                                <li class="slider__meta-item">
                                                    <span class="dot"></span>
                                                    {{ $post->published_at ? $post->published_at->translatedFormat('d M Y') : $post->created_at->translatedFormat('d M Y') }}
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Miniaturas del Slider (Thumbs Slider) -->
            <div thumbsSlider="" class="swiper slider__bottom container-fluid">
                <div class="swiper-wrapper">
                    @foreach ($sliderPosts as $index => $post)
                        <div class="swiper-slide">
                            <div class="post-slider">
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="" class="post-slider__img">
                                <div class="post-slider__content">
                                    <p class="post-slider__title">
                                        <span>{{ Str::limit($post->title, 55) }}</span>
                                    </p>
                                    <ul class="post-slider__meta list-inline">
                                        <li class="post-slider__meta-link">
                                            <i class="bi bi-clock-fill"></i> {{ $post->created_at->translatedFormat('d M Y') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!--/-->


        <!--blog-Home-2-->
        <section class="mt-90">
            <div class="container-fluid">
                <div class="row">
                    @forelse($allPosts as $post)
                        <!-- Post Item Dynamic -->
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                            <div class="post-card post-card--default">
                                <div class="post-card__image">
                                    <a href="{{ route('blog.show', ['id' => $post->id, 'slug' => $post->slug]) }}">
                                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                                    </a>
                                </div>

                                <div class="post-card__content">
                                    @if ($post->categories->isNotEmpty())
                                        <a href="#" class="category">{{ $post->categories->first()->name }}</a>
                                    @else
                                        <a href="#" class="category">Café de Especialidad</a>
                                    @endif

                                    <h5 class="post-card__title">
                                        <a href="{{ route('blog.show', ['id' => $post->id, 'slug' => $post->slug]) }}" class="post-card__title-link">{{ $post->title }}</a>
                                    </h5>

                                    <p class="post-card__exerpt">{{ $post->summary }}</p>

                                    <ul class="post-card__meta list-inline">
                                        <li class="post-card__meta-item">
                                            <a href="#" class="post-card__meta-link">
                                                <img src="{{ asset('assets/img/author/admin.png') }}" alt=""
                                                    class="post-card__meta-img">
                                            </a>
                                        </li>
                                        <li class="post-card__meta-item">
                                            <a href="#"
                                                class="post-card__meta-link">{{ $post->user->name ?? 'Caficultor' }}</a>
                                        </li>
                                        <li class="post-card__meta-item">
                                            <span class="dot"></span>
                                            {{ $post->published_at ? $post->published_at->translatedFormat('d M Y') : $post->created_at->translatedFormat('d M Y') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No hay publicaciones disponibles en este momento.</p>
                        </div>
                    @endforelse
                </div>

                <!--pagination-->
                <div class="row">
                    <div class="col-lg-12">
                        {{ $posts->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </section>

        <!--/-->

        <!--newslettre-->
        @include('partials.newslettre')

    </main>

    <!--footer-->
    @include('partials.footer')

    <!--Search-form-->
    <div class="search__box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 m-auto col-md-8 col-sm-11">
                    <div class="search__content ">
                        <button type="button" class="search__box-btn-close">
                            <i class="bi bi-x-lg"></i>
                        </button>
                        <form class="search__form" action="search-page.html">
                            <input type="search" class="search__form-input" value=""
                                placeholder="What are you looking for?">
                            <button type="submit" class="search__form-btn-search">search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.js')

</body>

</html>

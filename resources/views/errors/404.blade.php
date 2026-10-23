<!doctype html>
<html lang="es">

<head>
    @include('partials.head')
</head>

<body>
    <!--loading -->
    @include('partials.loading')

    <!-- Header -->
    @include('partials.header')

    <main class="main">
        <!--error 404-->
        <section class="page404">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="page404__content">
                            <div class="page404__image">
                                <img src="{{ asset('assets/img/pic/error404.jpeg') }}" alt="Página no encontrada"
                                    class="page404__img rounded">
                            </div>
                            <div class="page404__info">
                                <h2 class="page404__title">¡Vaya! Este grano se nos perdió</h2>
                                <p class="page404__desc">
                                    Parece que la página que buscas se pasó de tostión o no existío en nuestra cosecha. Pero
                                    no te preocupes, puedes volver al inicio y seguir disfrutando de las mejores
                                    historias de café.
                                </p>
                                <a href="{{ url('/') }}" class="btn-custom">Volver al Inicio</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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

    <!--plugins -->
    @include('partials.js')
</body>

</html>

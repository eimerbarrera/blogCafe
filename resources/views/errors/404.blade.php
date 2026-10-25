@extends('layouts.base')

@section('title', 'Blog - Cosecha y Grano')

@section('content')

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

@endsection

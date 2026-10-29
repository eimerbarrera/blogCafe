@extends('layouts.base')

@section('title', 'Blog - Cosecha y Grano')

@section('content')
    <section class="banner">
        <div class="row">
            <div class="container-fluid">
                <div class="col-lg-8">
                    <div class="banner__content">
                        <!-- Título principal adaptado -->
                        <h3 class="banner__title">
                            Bienvenido: <span class="banner__category-color">{{ auth()->user()->name }}</span>
                        </h3>

                        <p class="banner__subtitle">
                            <strong>Rol:</strong><span class="banner__category-color"> {{ auth()->user()->role }} </span>
                        </p>
                        <p class="banner__subtitle">
                            <strong>Descripción:</strong><span class="banner__category-color"> {{ auth()->user()->description }} </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--newslettre-->
    @include('partials.newslettre')

@endsection

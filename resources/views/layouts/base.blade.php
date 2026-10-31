<!doctype html>
<html lang="es">

<head>
    @include('partials.head')
</head>

<body>

    @include('partials.loading')

    @include('partials.header')

    <main class="main">

        @yield('content')

    </main>

    @include('partials.footer')

    @include('partials.search')

    @include('partials.js')

    @stack('scripts')

</body>

</html>

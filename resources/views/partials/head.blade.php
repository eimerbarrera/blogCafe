<!-- Meta -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="@yield('meta_description', 'Cultura cafetera, métodos de preparación, origen y tueste en Café Cosecha y Grano.')">
<link rel="canonical" href="{{ url()->current() }}">

<!-- Open Graph -->
<meta property="og:site_name" content="Café Cosecha y Grano">
<meta property="og:type" content="@yield('og_type', 'website')">
<meta property="og:title" content="@yield('title', 'Café Cosecha y Grano - Blog')">
<meta property="og:description" content="@yield('meta_description', 'Cultura cafetera, métodos de preparación, origen y tueste en Café Cosecha y Grano.')">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="@yield('og_image', asset('assets/img/logo/Favicon_CyG.png'))">

<!-- favicon -->
<link rel="icon" sizes="40x40" href="{{ asset('assets/img/logo/Favicon_CyG.png') }}" type="image/png">

<!-- Title -->
<title>@yield('title', 'Café Cosecha y Grano - Blog')</title>

<!-- Stylesheets -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font/bootstrap-icons.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/swiper-bundle.min.css') }}">

<!-- main style -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">

@stack('head')

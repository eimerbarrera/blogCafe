<header class="header fixed-top navbar-expand-xl overflow-visible">
    <div class="container-fluid overflow-visible">
        <!-- Contenedor Flex principal alineado de extremo a extremo -->
        <div class="header__main position-relative overflow-visible d-flex align-items-center justify-content-between">

            <!-- 1. LOGO FLOTANTE (Posición absoluta para que desborde libremente) -->
            <div class="logo position-absolute top-50 translate-middle-y" style="left: 15px; z-index: 1050;">
                <a class="logo__link logo--dark" href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/logo/logo_light2.png') }}" alt="Cosecha y Grano" class="logo__img"
                        style="max-height: 100px; width: auto;">
                </a>
                <a class="logo__link logo--light" href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/logo/logo_dark2.png') }}" alt="Cosecha y Grano" class="logo__img"
                        style="max-height: 100px; width: auto;">
                </a>
            </div><!--/logo-->

            <!-- 2. MENÚ CENTRADO (mx-auto empuja el menú exactamente al centro de la pantalla) -->
            <div class="header__navbar mx-auto">
                <nav class="navbar">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <!-- Inicio -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                            </li>

                            <!-- Blogs -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('blog.index') }}">Blogs</a>
                            </li>

                            <!-- Contacto -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact.index') }}">Contacto</a>
                            </li>

                            <!-- Acceder -->
                            <li class="nav-item">
                                <a class="nav-link" href="#">Acceder</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div><!--/header__navbar-->

            <!-- 3. ACCIONES DEL HEADER (Alineadas automáticamente a la derecha) -->
            <div class="header__action-items d-flex align-items-center gap-3">
                <!-- Redes Sociales -->
                <ul class="list-inline social-media social-media--layout-one m-0 d-flex align-items-center">
                    <li class="social-media__item">
                        <a href="{{ config('services.social.facebook') }}" target="_blank" rel="noopener noreferrer"
                            class="social-media__link">
                            <i class="bi bi-facebook"></i>
                        </a>
                    </li>

                    <li class="social-media__item">
                        <a href="{{ config('services.social.instagram') }}" target="_blank" rel="noopener noreferrer"
                            class="social-media__link">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </li>

                    <li class="social-media__item">
                        <a href="{{ config('services.social.youtube') }}" target="_blank" rel="noopener noreferrer"
                            class="social-media__link">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </li>
                </ul>

                <!-- Switch Modo Oscuro/Claro -->
                <div class="theme-switch d-flex align-items-center">
                    <label class="theme-switch__label" for="checkbox">
                        <input type="checkbox" id="checkbox" class="theme-switch__checkbox">
                        <span class="theme-switch__slider round">
                            <i class="bi bi-sun icon-light theme-switch__icon theme-switch__icon--light"></i>
                            <i class="bi bi-moon icon-dark theme-switch__icon theme-switch__icon--dark"></i>
                        </span>
                    </label>
                </div>

                <!-- Buscador -->
                <div class="search-icon d-flex align-items-center">
                    <a href="#search" class="search-icon__link">
                        <i class="bi bi-search search-icon__icon"></i>
                    </a>
                </div>

                <!-- Toggler Menú Móvil -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler__icon"></span>
                </button>
            </div><!--/header__action-items-->

        </div>
    </div>
</header>

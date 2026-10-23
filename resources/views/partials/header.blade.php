<header class="header navbar-expand-xl">
    <div class="container-fluid">
        <div class="header__main">
            <!-- logo -->
            <div class="logo">
                <a class="logo__link logo--dark" href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/logo/logo_light2.png') }}" alt="Logo Dark" class="logo__img" style="max-width: 100px;">
                </a>
                <a class="logo__link logo--light" href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/logo/logo_dark2.png') }}" alt="Logo White" class="logo__img" style="max-width: 100px;">
                </a>
            </div><!--/-->

            <div class="header__navbar">
                <nav class="navbar">
                    <!--navbar-collapse-->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ">
                            <!--Homes -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                            </li>

                            <!--Blogs-->
                            <li class="nav-item">
                                <a class="nav-link" href="#"> blogs </a>
                            </li>

                            <!--contact -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact.index') }}"> contacto </a>
                            </li>

                            <!--Inicio sesión -->
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Acceder </a>
                            </li>
                        </ul>
                    </div>
                    <!--/-->
                </nav>
            </div>

            <!-- header actions -->
            <div class=" header__action-items">
                <!--header-social-->
                <ul class="list-inline social-media social-media--layout-one">
                    <li class="social-media__item">
                        <a href="{{ config('services.social.facebook') }}" target="_blank" class="social-media__link">
                            <i class="bi bi-facebook"></i>
                        </a>
                    </li>

                    <li class="social-media__item">
                        <a href="{{ config('services.social.instagram') }}" target="_blank" class="social-media__link">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </li>

                    <li class="social-media__item">
                        <a href="{{ config('services.social.youtube') }}" target="_blank" class="social-media__link">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </li>
                </ul>

                <!--theme-switch-->
                <div class="theme-switch">
                    <label class="theme-switch__label" for="checkbox">
                        <input type="checkbox" id="checkbox" class="theme-switch__checkbox">
                        <span class="theme-switch__slider round ">
                            <i class="bi bi-sun icon-light theme-switch__icon theme-switch__icon--light"></i>
                            <i class="bi bi-moon icon-dark theme-switch__icon theme-switch__icon--dark"></i>
                        </span>
                    </label>
                </div>

                <!--search-icon-->
                <div class="search-icon">
                    <a href="#search" class="search-icon__link">
                        <i class="bi bi-search search-icon__icon"></i>
                    </a>
                </div>

                <!--navbar-toggler-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler__icon"></span>
                </button>
            </div>
        </div>
    </div>
</header>

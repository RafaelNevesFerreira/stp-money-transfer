<header id="header">
    <div class="container">
        <div class="header-row">
            <div class="header-column justify-content-start">
                <!-- Logo  ============================= -->
                <div class="logo me-3">
                    <a class="d-flex" href="{{ route('home') }}" title="Payyed - HTML Template"><img
                                src="{{ asset('images/logo.png') }}" alt="Payyed" /></a>
                </div>
                <!-- Logo end -->
                <!-- Collapse Button     ============================== -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-nav">
                    <span></span> <span></span> <span></span> </button>
                <!-- Collapse Button end -->

                <!-- Primary Navigation        ============================== -->
                <nav class="primary-menu navbar navbar-expand-lg">
                    <div id="header-nav" class="collapse navbar-collapse">
                        <ul class="navbar-nav me-auto">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('send') }}">Enviar</a> </li>
                            <li><a href="{{ route('about') }}">Sobre Nós</a></li>
                            <li><a href="{{ route('help') }}">Ajuda</a></li>
                            <li><a href="{{ route('blog') }}">Blog</a></li>
                            <li><a href="{{ route('contact') }}">Contato</a></li>

                        </ul>
                    </div>
                </nav>
                <!-- Primary Navigation end -->
            </div>

            <div class="header-column justify-content-end">
                <!-- Login & Signup Link   ============================== -->
                <nav class="login-signup navbar navbar-expand">
                    <ul class="navbar-nav">
                        @guest
                            <li><a href="{{ route('login') }}">Login</a> </li>
                            <li class="align-items-center h-auto ms-sm-3"><a class="btn btn-primary"
                                    href="{{ route('register') }}">Registrar</a></li>
                        @endguest
                        @auth
                            <li>
                                <a href="#" id="logout">
                                    Sair
                                </a>
                            </li>

                            <li class="align-items-center h-auto ms-sm-3">
                                <a class="btn btn-primary" href="{{ route('login') }}">
                                    DashBoard
                                </a>
                            </li>
                        @endauth
                    </ul>
                </nav>
                <!-- Login & Signup Link end -->
            </div>




        </div>
    </div>
</header>

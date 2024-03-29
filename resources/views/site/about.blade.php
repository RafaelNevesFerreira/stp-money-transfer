@extends("layouts.app")
@section('content')
    <!-- Page Header
                  ============================================= -->
    <section class="page-header page-header-text-light py-0 mb-0">
        <section class="hero-wrap section">
            <div class="hero-mask opacity-7 bg-dark"></div>
            <div class="hero-bg hero-bg-scroll" style="background-image:url('{{ asset('assets/images/image-2.jpg') }}');">
            </div>
            <div class="hero-content">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1 class="text-11 fw-500 text-white mb-3">Sobre {{ env('APP_NAME') }}</h1>
                            <p class="text-5 text-white lh-base mb-4">Nossa missão é de garantir que o seu dinheiro chegue ao
                                destinatário de forma segura!</p>
                            <a href="{{route("register")}}" class="btn btn-primary m-2">Crie uma conta</a> <a
                                class="btn btn-outline-light video-btn m-2" href="#"
                                data-src="https://player.vimeo.com/video/714360049?h=9a4af99e60" data-bs-toggle="modal"
                                data-bs-target="#videoModal"><span class="me-2"><i
                                        class="fas fa-play-circle"></i></span>Veja como funciona</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!-- Page Header end -->

    <!-- Content
                  ============================================= -->
    <div id="content">

        <!-- Who we are
                    ============================================= -->
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex">
                        <div class="my-auto px-0 px-lg-5 mx-2">
                            <h2 class="text-9 mb-4">Quem somos nós</h2>
                            <p class="text-4">{{env("APP_NAME")}} é uma plataforma de envio de dinheiro focada para o  mercado
                                São Tomése, nós visamos qualidade, segurança, e eficacia. A nossa plataforma
                                foi criada no ambito de facilitar a vida das pessoas que queiram enviar dinheior
                                de ou para São Tomé
                                .</p>
                        </div>
                    </div>
                    <div class="col-lg-6 my-auto text-center"> <img class="img-fluid shadow-lg rounded-3"
                            src="{{ asset('assets/images/who-we-are.jpg') }}" alt=""> </div>
                </div>
            </div>
        </section>
        <!-- Who we are end -->

        <!-- Our Values
                    ============================================= -->
        <section class="section bg-white">
            <div class="container">
                <div class="row g-0">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <div class="row">
                            <div class="col-6 col-lg-7 ms-auto mb-lg-n5"> <img class="img-fluid rounded-3 shadow-lg"
                                    src="{{ asset('assets/images/our-values-vision.jpg') }}" alt="banner"> </div>
                            <div class="col-6 col-lg-8 mt-lg-n5"> <img class="img-fluid rounded-3 shadow-lg"
                                    src="{{ asset('assets/images/our-values-mission.jpg') }}" alt="banner"> </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex order-1 order-lg-2">
                        <div class="my-auto px-0 px-lg-5">
                            <h2 class="text-9 mb-4">{{env("APP_NAME")}}</h2>
                            <h4 class="text-4 fw-500">Nossa Missão</h4>
                            <p class="tex-3">Nossa missão é proporcionar as pessoas que queiram enviar dinheiro de ou para são
                                tomé uma experiência unica e eficaz.</p>
                            <h4 class="text-4 fw-500 mb-2">Nossa Visão</h4>
                            <p class="tex-3">Ser reconhecida como líder em soluções para envio de dinheiro
                                com colaboradores de médias e grandes empresas através serviços de excelência.</p>
                            <h4 class="text-4 fw-500 mb-2">Nosso Valores</h4>
                            <p class="tex-3">Só é bom para a gente, se for bom para o cliente; Simples. Sempre;
                                Fanáticos por performance; Pensamos e agimos como donos;
                                 Gente é tudo para a gente;
                                Ética é inegociável; O melhor argumento é o que vale.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Our Values end -->

        <!-- Testimonial
                    ============================================= -->
        <section class="section">
            <div class="container">
                <h2 class="text-9 text-center">O que as pessoas acham de nós?</h2>
                <p class="lead text-center mb-4">Uma experiência de Envio de dinheiro sobre a qual as pessoas adoram falar
                <div class="owl-carousel owl-theme" data-autoplay="true" data-nav="true" data-loop="true" data-margin="30"
                    data-slideby="2" data-stagepadding="5" data-items-xs="1" data-items-sm="1" data-items-md="2"
                    data-items-lg="2">
                    @foreach ($reviews as $review)
                        <div class="item">
                            <div class="testimonial rounded text-center p-4">
                                <p class="text-9 text-muted opacity-2 mb-2"><i class="fa fa-quote-left"></i></p>
                                <p class="text-4">{{ $review->content }}</p>
                                <strong class="d-block fw-500">{{ $review->name }}</strong> <span
                                    class="text-muted">{{ $review->country }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Testimonial end -->

    </div>
    <!-- Content end -->
@endsection

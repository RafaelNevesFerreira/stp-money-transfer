@extends("layouts.app")
@section('content')
    <!-- Page Header
        ============================================= -->
    <section class="page-header page-header-text-light bg-dark-3 py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <ul class="breadcrumb mb-0">
                        <li><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="active">Contato</li>
                    </ul>
                </div>
                <div class="col-12">
                    <h1>Contate-nos</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Header End -->

    <!-- Content
            ============================================= -->
    <div id="content">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="bg-white shadow-md rounded h-100 p-3">
                        <div class="featured-box text-center">
                            <div class="featured-box-icon text-primary mt-4"> <i class="fas fa-map-marker-alt"></i></div>
                            <h3>{{env("APP_NAME")}}.</h3>
                            <p>{{ $contact->addres }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-white shadow-md rounded h-100 p-3">
                        <div class="featured-box text-center">
                            <div class="featured-box-icon text-primary mt-4"> <i class="fas fa-phone"></i> </div>
                            <h3>Telephone</h3>
                            <p class="mb-0">{{ $contact->phone_1 }}</p>
                            <p>{{ $contact->phone_2 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-white shadow-md rounded h-100 p-3">
                        <div class="featured-box text-center">
                            <div class="featured-box-icon text-primary mt-4"> <i class="fas fa-envelope"></i> </div>
                            <h3>Business Inquiries</h3>
                            <p>{{ $contact->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center py-5">
                <h2 class="text-8">Entre em contato</h2>
                <p class="lead">Estamos presetes nas mais populares redes e meios de comunicaçã.</p>
                <div class="d-flex flex-column">
                    <ul class="social-icons social-icons-lg social-icons-colored justify-content-center">
                        <li class="social-icons-facebook"><a data-bs-toggle="tooltip" href="http://www.facebook.com/"
                                target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="social-icons-linkedin"><a data-bs-toggle="tooltip" href="http://www.linkedin.com/"
                                target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                        <li class="social-icons-youtube"><a data-bs-toggle="tooltip" href="http://www.youtube.com/"
                                target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                        <li class="social-icons-instagram"><a data-bs-toggle="tooltip" href="http://www.instagram.com/"
                                target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <section class="hero-wrap section shadow-md">
            <div class="hero-mask opacity-9 bg-primary"></div>
            <div class="hero-bg" style="background-image:url('{{ asset('assets/images/image-2.jpg') }}');"></div>
            <div class="hero-content">
                <div class="container text-center">
                    <h2 class="text-9 text-white">Incrível Suporte Ao Cliente</h2>
                    <p class="text-4 text-white mb-4">Você tem alguma pergunta? Não se preocupe.
                        Temos ótimas pessoas prontas para ajudá-lo sempre que precisar.</p>
                    <a href="{{ route('help') }}" class="btn btn-light">Perguntas frequentes</a>
                </div>
            </div>
        </section>
        <!-- Content end -->

    </div>
@endsection

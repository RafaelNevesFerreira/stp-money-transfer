@extends("layouts.app")
@section('content')
    <!-- Page Header
                  ============================================= -->
    <section class="hero-wrap section">
        <div class="hero-mask opacity-9 bg-primary"></div>
        <div class="hero-bg" style="background-image:url('{{ asset('assets/images/image-2.jpg') }}');"></div>
        <div class="hero-content">
            <div class="container">
                <div class="row align-items-center text-center">
                    <div class="col-12">
                        <h1 class="text-11 text-white mb-4">Como podemos ajuda-lo?</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Header end -->

    <!-- Content
                  ============================================= -->
    <div id="content">

        <!-- Main Topics
                    ============================================= -->
        <section class="section py-3 my-3 py-sm-5 my-sm-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-sm-6 col-lg-3">
                        <div class="bg-white shadow-sm rounded p-4 text-center"> <span
                                class="d-block text-17 text-primary mt-2 mb-3"><i class="fas fa-user-circle"></i></span>
                            <h3 class="text-body text-4">Minha Conta</h3>
                            <p class="mb-0"><a class="text-muted btn-link" href="#">ver artigos<span
                                        class="text-1 ms-1"><i class="fas fa-chevron-right"></i></span></a></p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="bg-white shadow-sm rounded p-4 text-center"> <span
                                class="d-block text-17 text-primary mt-2 mb-3"><i class="fas fa-money-check-alt"></i></span>
                            <h3 class="text-body text-4">Pagamentos</h3>
                            <p class="mb-0"><a class="text-muted btn-link" href="#">ver artigos<span
                                        class="text-1 ms-1"><i class="fas fa-chevron-right"></i></span></a></p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="bg-white shadow-sm rounded p-4 text-center"> <span
                                class="d-block text-17 text-primary mt-2 mb-3"><i class="fas fa-shield-alt"></i></span>
                            <h3 class="text-body text-4">Segurança</h3>
                            <p class="mb-0"><a class="text-muted btn-link" href="#">ver artigos<span
                                        class="text-1 ms-1"><i class="fas fa-chevron-right"></i></span></a></p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="bg-white shadow-sm rounded p-4 text-center"> <span
                                class="d-block text-17 text-primary mt-2 mb-3"><i class="fas fa-credit-card"></i></span>
                            <h3 class="text-body text-4">Métodos de Pagamento</h3>
                            <p class="mb-0"><a class="text-muted btn-link" href="#">ver artigos<span
                                        class="text-1 ms-1"><i class="fas fa-chevron-right"></i></span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main Topics end -->

        <!-- Popular Topics
                    ============================================= -->
        <section class="section bg-white">
            <div class="container">
                <h2 class="text-9 text-center">Tópicos Populares</h2>
                <p class="text-4 text-center mb-5">Algumas das perguntas que mais recebemos.</p>
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="row gx-5">
                            <div class="col-md-6">
                                <div class="accordion accordion-flush" id="popularTopics">
                                    @foreach ($first_faq as $faq_1)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{ $faq_1->id }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne{{ $faq_1->id }}" aria-expanded="true"
                                                    aria-controls="collapseOne{{ $faq_1->id }}">
                                                    {{ $faq_1->title }}
                                                </button>
                                            </h2>
                                            <div id="collapseOne{{ $faq_1->id }}" class="accordion-collapse collapse"
                                                aria-labelledby="heading{{ $faq_1->id }}"
                                                data-bs-parent="#popularTopics">
                                                <div class="accordion-body">{{ $faq_1->content }}</div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="accordion accordion-flush" id="popularTopics2">
                                    @foreach ($second_faq as $faq_2)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{ $faq_2->id }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne{{ $faq_2->id }}" aria-expanded="true"
                                                    aria-controls="collapseOne{{ $faq_2->id }}">
                                                    {{ $faq_2->title }}
                                                </button>
                                            </h2>
                                            <div id="collapseOne{{ $faq_2->id }}" class="accordion-collapse collapse"
                                                aria-labelledby="heading{{ $faq_2->id }}"
                                                data-bs-parent="#popularTopics">
                                                <div class="accordion-body">{{ $faq_2->content }}</div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Popular Topics end -->

        <!-- Can't find
                    ============================================= -->
        <section class="section py-4 my-4 py-sm-5 my-sm-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="bg-white shadow-sm rounded ps-4 ps-sm-0 pe-4 py-4">
                            <div class="row g-0">
                                <div
                                    class="col-12 col-sm-auto text-13 text-light d-flex align-items-center justify-content-center">
                                    <span class="px-4 ms-3 me-2 mb-4 mb-sm-0"><i class="far fa-envelope"></i></span>
                                </div>
                                <div class="col text-center text-sm-start">
                                    <div class="">
                                        <h5 class="text-3 text-body">Não consegue encontrar o que procura?</h5>
                                        <p class="text-muted mb-0">Queremos responder a todas as suas dúvidas. Entre em
                                            contato e retornaremos o mais breve possível.
                                            <a class="btn-link" href="#">
                                                Contate-no
                                                <span class="text-1 ms-1">
                                                    <i class="fas fa-chevron-right"></i>
                                                </span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bg-white shadow-sm rounded ps-4 ps-sm-0 pe-4 py-4">
                            <div class="row g-0">
                                <div
                                    class="col-12 col-sm-auto text-13 text-light d-flex align-items-center justify-content-center">
                                    <span class="px-4 ms-3 me-2 mb-4 mb-sm-0"><i class="far fa-comment-alt"></i></span>
                                </div>
                                <div class="col text-center text-sm-start">
                                    <div class="">
                                        <h5 class="text-3 text-body">Perguntas técnicas</h5>
                                        <p class="text-muted mb-0">
                                            Tem algumas dúvidas técnicas? Fale conosco.
                                            <a class="btn-link" href="#">
                                                Clique aqui
                                                <span class="text-1 ms-1">
                                                    <i class="fas fa-chevron-right"></i>
                                                </span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Can't find end -->

    </div>
    <!-- Content end -->
@endsection

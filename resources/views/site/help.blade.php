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
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                O que é a {{ env('APP_NAME') }}?
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#popularTopics">
                                            <div class="accordion-body">{{ env('APP_NAME') }} é simplesmente a maneira
                                                mais
                                                facil,
                                                repida, e segura de enviar dinheiro para são tomé.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Posso fazer um envio e pagar em prestações?
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#popularTopics">
                                            <div class="accordion-body">
                                                <p>Sim! Essa é a grande diferença da {{ env('APP_NAME') }} em relação aos
                                                    outros
                                                    meios de envio de dinheiro para são tomé, pode enviar até 1.000,00 EUR e
                                                    pagar
                                                    em três vezes, MAS o seu receptor receberà o valor completo na hora,
                                                    mesmo que
                                                    você ainda não tenha pagado todas as prestações, Maravilhoso não é?
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                Posso recuperar o meu dinheiro?
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#popularTopics">
                                            <div class="accordion-body">
                                                Sim! se a pessoa ainda não levantou o seu dinheiro, então você poderà pedir
                                                uma
                                                devolução do seu dinheiro.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                aria-expanded="false" aria-controls="collapseFour">
                                                Em quanto tempo o dinheiro chega em são tomé?
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse"
                                            aria-labelledby="headingFour" data-bs-parent="#popularTopics">
                                            <div class="accordion-body">
                                                O Dinheiro poderà ser levantado em são tomé 20 minutos depois de ser enviado
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFive">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                aria-expanded="false" aria-controls="collapseFive">
                                                Como não pagar taxas na hora do envio do seu dinheiro?
                                            </button>
                                        </h2>
                                        <div id="collapseFive" class="accordion-collapse collapse"
                                            aria-labelledby="headingFive" data-bs-parent="#popularTopics">
                                            <div class="accordion-body">
                                                Se você quiser enviar dinheiro sem pagar as taxas, temos um post que fala
                                                especialmente sobre isso, leia e siga as etapas

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="accordion accordion-flush" id="popularTopics2">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading6">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false"
                                                aria-controls="collapse6">Perdi o código de recepção do dinheiro</button>
                                        </h2>
                                        <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6"
                                            data-bs-parent="#popularTopics2">
                                            <div class="accordion-body">Se você perdeu o seu código de recepção do dinheiro
                                                a única coisa que pode fazer é nos enviar uma mensagem com os seus dados e
                                                etraremos em contacto consigo. </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading7">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false"
                                                aria-controls="collapse7">Não recebi o email com o código de recepção do
                                                dinheiro?</button>
                                        </h2>
                                        <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7"
                                            data-bs-parent="#popularTopics2">
                                            <div class="accordion-body"> Se não recebeu o código de recepção do dinheiro por
                                                email provavelmente é porque digitou o seu email com erros, desse jeito a
                                                unica forma de pegar o seu código seria ao entrat em contacto conosco.
                                            </div>
                                        </div>
                                    </div>
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
                                        <h5 class="text-3 text-body">Technical questions</h5>
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

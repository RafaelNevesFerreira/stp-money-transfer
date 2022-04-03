@extends("layouts.app")
@section('content')
    <!-- Content
                                              ============================================= -->
    <div id="content">

        <!-- Send Money
                                            ============================================= -->
        <section class="hero-wrap">
            <div class="hero-mask opacity-7 bg-dark"></div>
            <div class="hero-bg" style="background-image:url('{{ asset('assets/images/image-6.jpg') }}');"></div>
            <div class="hero-content d-flex flex-column fullscreen-with-header">
                <div class="container my-auto py-5">
                    <div class="row">
                        <div class="col-lg-6 col-xl-7 my-auto text-center text-lg-start pb-5 pb-lg-0">
                            <h2 class="text-17 text-white"><span class="fw-400 text-15">A Melor Forma De</span> <br> Enviar
                                Dinheiro
                            </h2>
                            <p class="text-4 text-white mb-4"> Envie dinheiro de forma segura, rapida, eficaz e com as
                                melhores taxas.</p>
                            <a class="btn btn-outline-light video-btn" href="#"
                                data-src="https://www.youtube.com/embed/7e90gBu4pas" data-bs-toggle="modal"
                                data-bs-target="#videoModal"><span class="text-2 me-3"><i
                                        class="fas fa-play"></i></span>Veja como Isso Funciona</a>
                        </div>
                        <div class="col-lg-6 col-xl-5 my-auto">
                            <div class="bg-white rounded shadow-md p-4">
                                <h3 class="text-5 mb-4 text-center">Enviar Dinheiro</h3>
                                <hr class="mb-4 mx-n4">
                                <form id="form-send-money" method="post" action="{{ route('details') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nomedoreceptor" class="form-label">Nome do Receptor</label>
                                        @if (session('receptor'))
                                            <input type="text" class="form-control" id="nomedoreceptor" required
                                                value="{{ session('receptor') }}" name="nomedoreceptor">
                                        @else
                                            <input type="text" class="form-control" id="nomedoreceptor" required
                                                placeholder="Digite o nome completo do receptor" name="nomedoreceptor">
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="youSend" class="form-label">Valor a ser enviado</label>
                                        <div class="input-group">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <input type="text" data-thousands="." data-decimal="," class="form-control"
                                                data-bv-field="youSend" name="valor_enviado" id="youSend" value="25,00"
                                                placeholder="">
                                            <span class="input-group-text p-0">
                                                <select id="youSendCurrency" data-style="form-select bg-transparent border-0"
                                                    data-container="body" data-live-search="true" name="moeda"
                                                    class="selectpicker form-control bg-transparent" required="">
                                                    <optgroup label="Popular Currency">
                                                        @if (session('moeda') == '€')
                                                            <option data-icon="currency-flag currency-flag-usd me-1"
                                                                data-subtext="Dolar" value="usd">USD</option>
                                                            <option data-icon="currency-flag currency-flag-gbp me-1"
                                                                data-subtext="Libras" value="gbp">GBP</option>
                                                            <option data-icon="currency-flag currency-flag-eur me-1"
                                                                data-subtext="Euro" selected="selected" value="eur">EUR
                                                            @elseif (session('moeda' == "$"))
                                                            <option data-icon="currency-flag currency-flag-usd me-1"
                                                                data-subtext="Dolar" selected="selected" value="usd">USD</option>
                                                            <option data-icon="currency-flag currency-flag-gbp me-1"
                                                                data-subtext="Libras" value="gbp">GBP</option>
                                                            <option data-icon="currency-flag currency-flag-eur me-1"
                                                                data-subtext="Euro" value="eur">EUR
                                                            @elseif (session('moeda') == '£')
                                                            <option data-icon="currency-flag currency-flag-usd me-1"
                                                                data-subtext="Dolar" selected="selected" value="usd">USD</option>
                                                            <option data-icon="currency-flag currency-flag-gbp me-1"
                                                                data-subtext="Libras" value="gbp">GBP</option>
                                                            <option data-icon="currency-flag currency-flag-eur me-1"
                                                                data-subtext="Euro" value="eur">EUR
                                                            @else
                                                            <option data-icon="currency-flag currency-flag-usd me-1"
                                                                data-subtext="Dolar" value="usd">USD</option>
                                                            <option data-icon="currency-flag currency-flag-gbp me-1"
                                                                data-subtext="Libras" value="gbp">GBP</option>
                                                            <option data-icon="currency-flag currency-flag-eur me-1"
                                                                data-subtext="Euro" selected="selected" value="eur">EUR
                                                        @endif
                                                        </option>
                                                    </optgroup>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipientGets" class="form-label">Valor a ser recebido</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Dbs</span>
                                            <input type="text" disabled class="form-control" id="recipientGets" value="625,00">
                                            <span class="input-group-text p-0">
                                                <select id="recipientCurrency" disabled
                                                    data-style="form-select bg-transparent border-0" data-container="body"
                                                    class="selectpicker form-control bg-transparent" required="">
                                                    <option data-icon="currency-flag currency-flag-stp me-1"
                                                        data-subtext="Stp dobras" value="">SPT</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <hr>
                                    <p>Total Taxas<span class="float-end" id="taxas">6.05 <span
                                                class="moeda_mudar">€</span></span></p>
                                    <hr>
                                    <p class="text-4 fw-500">Total a Pagar<span class="float-end" id="total">31.05 <span
                                                class="moeda_mudar">€</span>
                                        </span></p>
                                    <div class="d-grid"><button class="btn btn-primary">Continuar</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Send Money End -->

        <!-- How it works
                                            ============================================= -->
        <section class="section bg-white">
            <div class="container">
                <h2 class="text-9 text-center"> A Maneira Mais Simple De Enviar Dinheiro

                </h2>
                <p class="lead text-center mb-5">Envie Dinheiro De Forma Segura e Rapida Em 3 Etapas Simples
                </p>
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="featured-box style-3">
                            <div class="featured-box-icon text-light"><span class="w-100 text-20 fw-500">1</span></div>
                            <h3>Faça o Login Ou Crie Uma Conta</h3>
                            <p class="text-3">Essas etapas não sõ obrigatórias para o envio do dinheiro, mas tornará
                                muito mais rapido o
                                seu processo de envio</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="featured-box style-3">
                            <div class="featured-box-icon text-light"><span class="w-100 text-20 fw-500">2</span></div>
                            <h3>Selecione o Receptor</h3>
                            <p class="text-3">Prencha os campos do formulario com os dados pessoais do receptor.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="featured-box style-3">
                            <div class="featured-box-icon text-light"><span class="w-100 text-20 fw-500">3</span></div>
                            <h3>Envie dinheiro</h3>
                            <p class="text-3">Depois de enviar o dinheiro, o destinatário será notificado por
                                e-mail, menssagem ou chalada telefonica quando
                                o dinheiro for transferido para São Tomé, menos de 30min.</p>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3"><a href="{{route("register")}}" class="btn btn-outline-primary shadow-none text-uppercase">Criar
                        Uma Conta</a></div>
            </div>
        </section>
        <!-- How it works End -->

        <!-- Why choose us
                                            ============================================= -->
        <section class="section">
            <div class="container">
                <h2 class="text-9 text-center">Porquê nos escolher?</h2>
                <p class="lead text-center mb-5">A baixo alguns dos motivos do porquê nos escolher.</p>
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="hero-wrap section h-100 p-5 rounded">
                            <div class="hero-mask rounded opacity-6 bg-dark"></div>
                            <div class="hero-bg rounded"
                                style="background-image:url('{{ asset('assets/images/image-6.jpg') }}');">
                            </div>
                            <div class="hero-content">
                                <h2 class="text-6 text-white mb-3">Porquê {{ env('APP_NAME') }}?</h2>
                                <p class="text-light mb-5">{{ env('APP_NAME') }} visa qualidade, segurança e rapidez,
                                    estamos no mercado trabalhando
                                    com as mais diversas e melhores tecnologias
                                    para garantir que os envios do dinheiros dos nossos clientes seja feito da forma mais
                                    segura possivel.</p>
                                <h2 class="text-6 text-white mb-3">Enviar dinheiro com {{ env('APP_NAME') }}</h2>
                                <p class="text-light">Enviar dinheiro pela internet sempre foi algo um pouco duvidos,
                                    pois ao longo do tempo mais têm sido os ataque ciberneticos.</p>
                                <p class="text-light mb-0">Por esse motivo {{env("APP_NAME")}} investiu em uma plataforma segura e facil de ser usada, para facilitar a
                                     vida das pessoas que queiram enviar dinheiro para são tomé.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="featured-box style-1">
                            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
                            <h3>Taxas Baixas</h3>
                            <p>Envie seu dinheiro com as taxas mais baixas posiveis.</p>
                        </div>
                        <div class="featured-box style-1">
                            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
                            <h3>Facil de usar</h3>
                            <p>Com Apenas alguns cliques conseguirà enviar o seu dinheiro.</p>
                        </div>
                        <div class="featured-box style-1">
                            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
                            <h3>Entraga Rapida</h3>
                            <p>Em Menos de 30 minutos o seu receptor poderà levantar o dinheiro.</p>
                        </div>
                        <div class="featured-box style-1">
                            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
                            <h3>100% seguro</h3>
                            <p>Focamos na facil usabilidade, mas também na segurança dos nossos clientes.</p>
                        </div>
                        <div class="featured-box style-1">
                            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
                            <h3>24/7 serviço cliente</h3>
                            <p>O Nosso suporte està disponivel 24/7 para o ajudar da melhor forma possivel.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Why choose us End -->

        <!-- How work
                                            ============================================= -->
        <section class="hero-wrap section shadow-md">
            <div class="hero-mask opacity-9 bg-primary"></div>
            <div class="hero-bg" style="background-image:url('{{ asset('assets/images/image-1.jpg') }}');"></div>
            <div class="hero-content my-3 my-lg-5">
                <div class="container text-center">
                    <h2 class="text-10 text-white mb-4 mb-lg-5">Como funciona o envio de dinheiro?</h2>
                    <a class="video-btn d-inline-flex" href="#" data-src="https://www.youtube.com/embed/7e90gBu4pas"
                        data-bs-toggle="modal" data-bs-target="#videoModal"> <span
                            class="playButton playButton-pulsing bg-white m-auto"><i class="fas fa-play"></i></span>
                    </a>
                </div>
            </div>
        </section>
        <!-- How work End -->

        <!-- Testimonial
                                            ============================================= -->
        <section class="section">
            <div class="container">
                <h2 class="text-9 text-center">O que as pessoas acham de nós?</h2>
                <p class="lead text-center mb-4">Uma experiência de Envio de dinheiro sobre a qual as pessoas adoram falar
                </p>
                <div class="row">
                    <div class="col-lg-10 col-xl-8 mx-auto">
                        <div class="owl-carousel owl-theme" data-autoplay="true" data-nav="true" data-loop="true"
                            data-margin="30" data-stagepadding="5" data-items-xs="1" data-items-sm="1" data-items-md="1"
                            data-items-lg="1">
                            <div class="item">
                                <div class="testimonial rounded text-center p-4">
                                    <p class="text-9 text-muted opacity-2 mb-2"><i class="fa fa-quote-left"></i></p>
                                    <p class="text-4">“Facil de usar, e o dinheiro chega bem na hora, o que mais
                                        gostei é que posso pagar em 3x mas o
                                        meu receptor recebe o dinheiro na hora”</p>
                                    <strong class="d-block fw-500">Paula Pereira</strong> <span
                                        class="text-muted">França</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial rounded text-center p-4">
                                    <p class="text-9 text-muted opacity-2 mb-2"><i class="fa fa-quote-left"></i></p>
                                    <p class="text-4">“Estou Feliz Enviando dinheiro com a {{ env('APP_NAME') }},
                                        ganhei 20% de desconto no segundo envio, fantastico”</p>
                                    <strong class="d-block fw-500">Alves Sousa</strong> <span
                                        class="text-muted">Londres</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial rounded text-center p-4">
                                    <p class="text-9 text-muted opacity-2 mb-2"><i class="fa fa-quote-left"></i></p>
                                    <p class="text-4">"Envios rápidos e fáceis, disponivel para muitas moedas
                                        diferentes. Muito
                                        melhor que as transferências bancarias.”</p>
                                    <strong class="d-block fw-500">Garcia Neves</strong> <span
                                        class="text-muted">Portugal</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonial end -->

        <!-- Frequently asked questions
                                            ============================================= -->
        <section class="section bg-white">
            <div class="container">
                <h2 class="text-9 text-center">Dúvidas Frequentes</h2>
                <p class="lead text-center mb-4 mb-sm-5">Não encontrou nada relacionado as suas duvidas? Envie-nos uma
                    menssagem <a class="btn-link" href="help.html">Centro de Ajuda</a></p>
                <div class="row">
                    <div class="col-md-10 col-lg-8 mx-auto">
                        <hr class="mb-0">
                        <div class="accordion accordion-flush arrow-end" id="popularTopics">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        O que é a {{ env('APP_NAME') }}?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#popularTopics">
                                    <div class="accordion-body">{{ env('APP_NAME') }} é simplesmente a maneira mais
                                        facil,
                                        repida, e segura de enviar dinheiro para são tomé.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Posso fazer um envio e pagar em prestações?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#popularTopics">
                                    <div class="accordion-body">
                                        <p>Sim! Essa é a grande diferença da {{ env('APP_NAME') }} em relação aos outros
                                            meios de envio de dinheiro para são tomé, pode enviar até 1.000,00 EUR e pagar
                                            em três vezes, MAS o seu receptor receberà o valor completo na hora, mesmo que
                                            você ainda não tenha pagado todas as prestações, Maravilhoso não é?
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Posso recuperar o meu dinheiro?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                    data-bs-parent="#popularTopics">
                                    <div class="accordion-body">
                                        Sim! se a pessoa ainda não levantou o seu dinheiro, então você poderà pedir uma
                                        devolução do seu dinheiro.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Em quanto tempo o dinheiro chega em são tomé?
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                    data-bs-parent="#popularTopics">
                                    <div class="accordion-body">
                                        O Dinheiro poderà ser levantado em são tomé 20 minutos depois de ser enviado
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Como não pagar taxas na hora do envio do seu dinheiro?
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                    data-bs-parent="#popularTopics">
                                    <div class="accordion-body">
                                        Se você quiser enviar dinheiro sem pagar as taxas, temos um post que fala especialmente sobre isso, leia e siga as etapas

                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                </div>
                <div class="text-center mt-4"><a href="{{route("help")}}" class="btn-link text-4">Mais Duvidas<i
                            class="fas fa-chevron-right text-2 ms-2"></i></a></div>
            </div>
        </section>
        <!-- Frequently asked questions end -->

        <!-- Special Offer
                                            ============================================= -->
        <section class="hero-wrap py-5">
            <div class="hero-mask opacity-8 bg-dark"></div>
            <div class="hero-bg" style="background-image:url('{{ asset('assets/images/image-2.jpg') }}');"></div>
            <div class="hero-content">
                <div class="container d-md-flex text-center text-md-start align-items-center justify-content-center">
                    <h2 class="text-6 fw-400 text-white mb-3 mb-md-0">Cadastre-se hoje e receba sua primeira taxa de
                        transação grátis!</h2>
                    <a href="{{route("register")}}" class="btn btn-outline-light text-nowrap ms-0 ms-md-4">Criar Conta</a>
                </div>
            </div>
        </section>
        <!-- Special Offer end -->
    </div>
    <!-- Content end -->
@endsection

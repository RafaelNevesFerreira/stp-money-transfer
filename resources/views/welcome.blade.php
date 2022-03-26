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
                            <h2 class="text-17 text-white"><span class="fw-400 text-15">A Melor Forma De</span> <br> Enviar Dinheiro
                            </h2>
                            <p class="text-4 text-white mb-4"> Envie dinheiro de forma segura, rapida, eficaz e com as melhores taxas.</p>
                            <a class="btn btn-outline-light video-btn" href="#"
                                data-src="https://www.youtube.com/embed/7e90gBu4pas" data-bs-toggle="modal"
                                data-bs-target="#videoModal"><span class="text-2 me-3"><i
                                        class="fas fa-play"></i></span>Veja como Isso Funciona</a>
                        </div>
                        <div class="col-lg-6 col-xl-5 my-auto">
                            <div class="bg-white rounded shadow-md p-4">
                                <h3 class="text-5 mb-4 text-center">Enviar Dinheiro</h3>
                                <hr class="mb-4 mx-n4">
                                <form id="form-send-money" method="post">
                                    <div class="mb-3">
                                        <label for="youSend" class="form-label">Você Envia</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="text" class="form-control" data-bv-field="youSend" id="youSend"
                                                value="1,000" placeholder="">
                                            <span class="input-group-text p-0">
                                                <select id="youSendCurrency"
                                                    data-style="form-select bg-transparent border-0" data-container="body"
                                                    data-live-search="true" class="selectpicker form-control bg-transparent"
                                                    required="">
                                                    <optgroup label="Popular Currency">
                                                        <option data-icon="currency-flag currency-flag-usd me-1"
                                                            data-subtext="United States dollar"
                                                            value="">USD</option>
                                                        <option data-icon="currency-flag currency-flag-aud me-1"
                                                            data-subtext="Australian dollar" value="">AUD</option>
                                                        <option data-icon="currency-flag currency-flag-eur me-1"
                                                            data-subtext="European euro" selected="selected" value="">EUR</option>
                                                    </optgroup>
                                                    <option data-divider="true"></option>
                                                    <optgroup label="Other Currency">
                                                        <option data-icon="currency-flag currency-flag-brl me-1"
                                                            data-subtext="Brazilian real" value="">BRL</option>
                                                        <option data-icon="currency-flag currency-flag-cad me-1"
                                                            data-subtext="Canadian dollar" value="">CAD</option>
                                                        <option data-icon="currency-flag currency-flag-chf me-1"
                                                            data-subtext="Swiss franc" value="">CHF</option>
                                                    </optgroup>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipientGets" class="form-label">A Pessoa Recebe</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="text" class="form-control" data-bv-field="recipientGets"
                                                id="recipientGets" value="1,410.06" placeholder="">
                                            <span class="input-group-text p-0">
                                                <select id="recipientCurrency"
                                                    data-style="form-select bg-transparent border-0" data-container="body"
                                                    class="selectpicker form-control bg-transparent"
                                                    required="">
                                                        <option data-icon="currency-flag currency-flag-stp me-1"
                                                            data-subtext="Stp dobras" value="">SPT</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-muted">A Taxa Atual é  <span class="fw-500">1,00
                                            EUR = 24,00 DBS</span></p>
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
                            <p class="text-3">Essas etapas não sõ obrigatórias para o envio do dinheiro, mas tornará muito mais rapido o
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
                            <h3>Send Money</h3>
                            <p class="text-3">Depois de enviar o dinheiro, o destinatário será notificado por e-mail, menssagem ou chalada telefonica quando
                                o dinheiro for transferido para São Tomé, menos de 30min.</p>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3"><a href="#" class="btn btn-outline-primary shadow-none text-uppercase">Criar Uma Conta</a></div>
            </div>
        </section>
        <!-- How it works End -->

        <!-- Why choose us
                    ============================================= -->
        <section class="section">
            <div class="container">
                <h2 class="text-9 text-center">Why choose payyed?</h2>
                <p class="lead text-center mb-5">Here’s Top 4 reasons why using a Payyed account for manage your money.</p>
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="hero-wrap section h-100 p-5 rounded">
                            <div class="hero-mask rounded opacity-6 bg-dark"></div>
                            <div class="hero-bg rounded"
                                style="background-image:url('{{ asset('assets/images/image-6.jpg') }}');">
                            </div>
                            <div class="hero-content">
                                <h2 class="text-6 text-white mb-3">Why Payyed?</h2>
                                <p class="text-light mb-5">Lisque persius interesset his et, in quot quidam persequeris vim,
                                    ad mea essent possim iriure. Mutat tacimates id sit. Ridens mediocritatem ius an, eu nec
                                    magna imperdiet.</p>
                                <h2 class="text-6 text-white mb-3">Send Money with Payyed</h2>
                                <p class="text-light">Lisque persius interesset his et, in quot quidam persequeris vim,
                                    ad mea essent possim iriure. Mutat tacimates id sit. Ridens mediocritatem ius an, eu nec
                                    magna imperdiet.</p>
                                <p class="text-light mb-0">Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                    tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                    shoreditch et.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="featured-box style-1">
                            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
                            <h3>Over 180 countries</h3>
                            <p>Essent lisque persius interesset his et, in quot quidam.</p>
                        </div>
                        <div class="featured-box style-1">
                            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
                            <h3>Lower Fees</h3>
                            <p>Lisque persius interesset his et, in quot quidam persequeris.</p>
                        </div>
                        <div class="featured-box style-1">
                            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
                            <h3>Easy to Use</h3>
                            <p>Essent lisque persius interesset his et, in quot quidam.</p>
                        </div>
                        <div class="featured-box style-1">
                            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
                            <h3>Faster Payments</h3>
                            <p>Quidam lisque persius interesset his et, in quot quidam.</p>
                        </div>
                        <div class="featured-box style-1">
                            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
                            <h3>100% secure</h3>
                            <p>Essent lisque persius interesset his et, in quot quidam.</p>
                        </div>
                        <div class="featured-box style-1">
                            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
                            <h3>24/7 customer service</h3>
                            <p>Quidam lisque persius interesset his et, in quot quidam.</p>
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
                    <h2 class="text-10 text-white mb-4 mb-lg-5">How does send money work?</h2>
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
                <h2 class="text-9 text-center">What people say about Payyed</h2>
                <p class="lead text-center mb-4">A payments experience people love to talk about</p>
                <div class="row">
                    <div class="col-lg-10 col-xl-8 mx-auto">
                        <div class="owl-carousel owl-theme" data-autoplay="true" data-nav="true" data-loop="true"
                            data-margin="30" data-stagepadding="5" data-items-xs="1" data-items-sm="1" data-items-md="1"
                            data-items-lg="1">
                            <div class="item">
                                <div class="testimonial rounded text-center p-4">
                                    <p class="text-9 text-muted opacity-2 mb-2"><i class="fa fa-quote-left"></i></p>
                                    <p class="text-4">“Easy to use, reasonably priced simply dummy text of the
                                        printing and typesetting industry. Quidam lisque persius interesset his et, in quot
                                        quidam possim iriure.”</p>
                                    <strong class="d-block fw-500">Jay Shah</strong> <span class="text-muted">Founder
                                        at Icomatic Pvt Ltd</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial rounded text-center p-4">
                                    <p class="text-9 text-muted opacity-2 mb-2"><i class="fa fa-quote-left"></i></p>
                                    <p class="text-4">“I am happy Working with printing and typesetting industry.
                                        Quidam lisque persius interesset his et, in quot quidam persequeris essent possim
                                        iriure.”</p>
                                    <strong class="d-block fw-500">Patrick Cary</strong> <span
                                        class="text-muted">Freelancer from USA</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial rounded text-center p-4">
                                    <p class="text-9 text-muted opacity-2 mb-2"><i class="fa fa-quote-left"></i></p>
                                    <p class="text-4">“Fast easy to use transfers to a different currency. Much
                                        better value that the banks.”</p>
                                    <strong class="d-block fw-500">De Mortel</strong> <span class="text-muted">Online
                                        Retail</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial rounded text-center p-4">
                                    <p class="text-9 text-muted opacity-2 mb-2"><i class="fa fa-quote-left"></i></p>
                                    <p class="text-4">“I have used them twice now. Good rates, very efficient
                                        service and it denies high street banks an undeserved windfall. Excellent.”</p>
                                    <strong class="d-block fw-500">Chris Tom</strong> <span class="text-muted">User
                                        from UK</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial rounded text-center p-4">
                                    <p class="text-9 text-muted opacity-2 mb-2"><i class="fa fa-quote-left"></i></p>
                                    <p class="text-4">“It's a real good idea to manage your money by payyed. The
                                        rates are fair and you can carry out the transactions without worrying!”</p>
                                    <strong class="d-block fw-500">Mauri Lindberg</strong> <span
                                        class="text-muted">Freelancer from Australia</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial rounded text-center p-4">
                                    <p class="text-9 text-muted opacity-2 mb-2"><i class="fa fa-quote-left"></i></p>
                                    <p class="text-4">“Only trying it out since a few days. But up to now
                                        excellent. Seems to work flawlessly. I'm only using it for sending money to friends
                                        at the moment.”</p>
                                    <strong class="d-block fw-500">Dennis Jacques</strong> <span
                                        class="text-muted">User from USA</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4"><a href="#" class="btn-link text-4">See more people review<i
                                    class="fas fa-chevron-right text-2 ms-2"></i></a></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonial end -->

        <!-- Frequently asked questions
                    ============================================= -->
        <section class="section bg-white">
            <div class="container">
                <h2 class="text-9 text-center">Frequently Asked Questions</h2>
                <p class="lead text-center mb-4 mb-sm-5">Can't find it here? Check out our <a class="btn-link"
                        href="help.html">Help center</a></p>
                <div class="row">
                    <div class="col-md-10 col-lg-8 mx-auto">
                        <hr class="mb-0">
                        <div class="accordion accordion-flush arrow-end" id="popularTopics">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        What is Payyed?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#popularTopics">
                                    <div class="accordion-body">Lisque persius interesset his et, in quot quidam
                                        persequeris vim, ad mea essent possim iriure. Mutat tacimates id sit. Ridens
                                        mediocritatem ius an, eu nec magna imperdiet.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        How to send money online?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#popularTopics">
                                    <div class="accordion-body">
                                        <p>Pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson
                                            ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                                            Lisque persius interesset his et, in quot quidam persequeris
                                            vim, ad mea essent possim iriure. Ad vegan excepteur butcher vice lomo.</p>
                                        Mutat tacimates id sit. Ridens mediocritatem ius an, eu nec magna imperdiet. Lisque
                                        persius interesset his et, in quot quidam persequeris vim, ad mea essent possim
                                        iriure. Ad vegan excepteur butcher vice lomo.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Is my money safe with Payyed?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                    data-bs-parent="#popularTopics">
                                    <div class="accordion-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                        richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                        brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                        aliqua put a bird
                                        on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        How much fees does Payyed charge?
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                    data-bs-parent="#popularTopics">
                                    <div class="accordion-body">
                                        Pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                        squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                                        on
                                        it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        What is the fastest way to send money abroad?
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                    data-bs-parent="#popularTopics">
                                    <div class="accordion-body">
                                        Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                        ea proident. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                        terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                        brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSix">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseFive">
                                        Can I open an Payyed account for business?
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                    data-bs-parent="#popularTopics">
                                    <div class="accordion-body">
                                        Enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                        eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                        coffee
                                        nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes
                                        anderson cred nesciunt sapiente ea proident.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                </div>
                <div class="text-center mt-4"><a href="#" class="btn-link text-4">See more FAQ<i
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
                    <h2 class="text-6 fw-400 text-white mb-3 mb-md-0">Sign up today and get your first transaction fee
                        free!</h2>
                    <a href="#" class="btn btn-outline-light text-nowrap ms-0 ms-md-4">Sign up Now</a>
                </div>
            </div>
        </section>
        <!-- Special Offer end -->
    </div>
    <!-- Content end -->
@endsection

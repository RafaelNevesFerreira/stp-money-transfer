@extends("layouts.app")
@section('content')
    <!-- Page Header
      ============================================= -->
    <section class="page-header page-header-text-light py-0 mb-0">
        <section class="hero-wrap section">
            <div class="hero-mask opacity-7 bg-dark"></div>
            <div class="hero-bg hero-bg-scroll"
                style="background-image:url('{{asset("assets/images/image-2.jpg")}}');"></div>
            <div class="hero-content">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1 class="text-11 fw-500 text-white mb-3">About Payyed</h1>
                            <p class="text-5 text-white lh-base mb-4">Our mission is to help you save on transfer fees and
                                exchange rates!</p>
                            <a href="#" class="btn btn-primary m-2">Open a Free Account</a> <a
                                class="btn btn-outline-light video-btn m-2" href="#"
                                data-src="https://www.youtube.com/embed/7e90gBu4pas" data-bs-toggle="modal"
                                data-bs-target="#videoModal"><span class="me-2"><i
                                        class="fas fa-play-circle"></i></span>See How it Works</a>
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
                            <h2 class="text-9 mb-4">Who we are</h2>
                            <p class="text-4">Quidam lisque persius interesset his et, in quot quidam persequeris
                                vim, ad mea essent possim iriure. Lisque persius interesset his et, in quot quidam
                                persequeris vim, ad mea essent possim iriure. lisque persius interesset his et, in quot
                                quidam mea essent possim iriure.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 my-auto text-center"> <img class="img-fluid shadow-lg rounded-3"
                            src="http://demo.harnishdesign.net/html/payyed/images/who-we-are.jpg" alt=""> </div>
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
                                    src="http://demo.harnishdesign.net/html/payyed/images/our-values-vision.jpg"
                                    alt="banner"> </div>
                            <div class="col-6 col-lg-8 mt-lg-n5"> <img class="img-fluid rounded-3 shadow-lg"
                                    src="http://demo.harnishdesign.net/html/payyed/images/our-values-mission.jpg"
                                    alt="banner"> </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex order-1 order-lg-2">
                        <div class="my-auto px-0 px-lg-5">
                            <h2 class="text-9 mb-4">Our Values</h2>
                            <h4 class="text-4 fw-500">Our Mission</h4>
                            <p class="tex-3">Quidam lisque persius interesset his et, in quot quidam persequeris
                                vim, ad mea essent possim iriure. Lisque persius interesset his et, in quot quidam
                                persequeris vim, ad mea essent possim iriure. lisque persius interesset his et, in quot
                                quidam mea essent possim iriure.</p>
                            <h4 class="text-4 fw-500 mb-2">Our Vision</h4>
                            <p class="tex-3">Persequeris quidam lisque persius interesset his et, in quot quidam
                                vim, ad mea essent possim iriure. Lisque persius interesset his et, in quot quidam
                                persequeris vim, ad mea essent possim iriure. lisque persius interesset his et, in quot
                                quidam.</p>
                            <h4 class="text-4 fw-500 mb-2">Our Goal</h4>
                            <p class="tex-3">Lisque persius interesset his et, in quot quidam persequeris vim, ad
                                mea essent possim iriure. Lisque persius interesset his et, in quot quidam persequeris vim,
                                ad mea essent possim iriure. lisque persius interesset his et, in quot quidam mea essent
                                possim iriure.</p>
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
                <h2 class="text-9 text-center">What people are saying about Payyed</h2>
                <p class="lead text-center mb-4">A payments experience people love to talk about</p>
                <div class="owl-carousel owl-theme" data-autoplay="true" data-nav="true" data-loop="true" data-margin="30"
                    data-slideby="2" data-stagepadding="5" data-items-xs="1" data-items-sm="1" data-items-md="2"
                    data-items-lg="2">
                    <div class="item">
                        <div class="testimonial rounded text-center p-4">
                            <p class="text-9 text-muted opacity-2 mb-0"><i class="fa fa-quote-left"></i></p>
                            <p class="text-4">“Easy to use, reasonably priced simply dummy text of the printing and
                                typesetting industry. Quidam lisque persius interesset his et, in quot quidam possim
                                iriure.”</p>
                            <strong class="d-block fw-500">Jay Shah</strong> <span class="text-muted">Founder at
                                Icomatic Pvt Ltd</span>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial rounded text-center p-4">
                            <p class="text-9 text-muted opacity-2 mb-0"><i class="fa fa-quote-left"></i></p>
                            <p class="text-4">“I am happy Working with printing and typesetting industry. Quidam
                                lisque persius interesset his et, in quot quidam persequeris essent possim iriure.”</p>
                            <strong class="d-block fw-500">Patrick Cary</strong> <span class="text-muted">Freelancer
                                from USA</span>
                        </div>
                    </div>
                    <div class="item mh-100">
                        <div class="testimonial rounded text-center p-4">
                            <p class="text-9 text-muted opacity-2 mb-0"><i class="fa fa-quote-left"></i></p>
                            <p class="text-4">“Fast easy to use transfers to a different currency. Much better
                                value that the banks.”</p>
                            <strong class="d-block fw-500">De Mortel</strong> <span class="text-muted">Online
                                Retail</span>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial rounded text-center p-4">
                            <p class="text-9 text-muted opacity-2 mb-0"><i class="fa fa-quote-left"></i></p>
                            <p class="text-4">“I have used them twice now. Good rates, very efficient service and
                                it denies high street banks an undeserved windfall. Excellent.”</p>
                            <strong class="d-block fw-500">Chris Tom</strong> <span class="text-muted">User from
                                UK</span>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial rounded text-center p-4">
                            <p class="text-9 text-muted opacity-2 mb-0"><i class="fa fa-quote-left"></i></p>
                            <p class="text-4">“It's a real good idea to manage your money by payyed. The rates are
                                fair and you can carry out the transactions without worrying!”</p>
                            <strong class="d-block fw-500">Mauri Lindberg</strong> <span class="text-muted">Freelancer
                                from Australia</span>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial rounded text-center p-4">
                            <p class="text-9 text-muted opacity-2 mb-0"><i class="fa fa-quote-left"></i></p>
                            <p class="text-4">“Only trying it out since a few days. But up to now excellent. Seems
                                to work flawlessly. I'm only using it for sending money to friends at the moment.”</p>
                            <strong class="d-block fw-500">Dennis Jacques</strong> <span class="text-muted">User from
                                USA</span>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4"><a href="#" class="btn-link text-4">See more people review<i
                            class="fas fa-chevron-right text-2 ms-2"></i></a></div>
            </div>
        </section>
        <!-- Testimonial end -->

    </div>
    <!-- Content end -->
@endsection

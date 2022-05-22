    <!DOCTYPE html>
    <html lang="pt">

    <head>
        <meta charset="UTF-8" />
        <meta name="_token" content="{{ csrf_token() }}" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('assets/images/site.webmanifest') }}">
        <title>STP Money Transfer</title>
        <meta name="description"
            content="This professional design html template is for build a Money Transfer and online payments website.">
        <meta name="author" content="Rafael Ferreira">

        <!-- Web Fonts
    ============================================= -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

        <!-- Stylesheet
    ============================================= -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/all.min.css') }}" />

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-select.min.css') }}" />
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/currency-flags.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/stylesheet.css') }}" />
        <!-- Colors Css -->
        <link id="color-switcher" type="text/css" rel="stylesheet" href="#" />
    </head>

    <body>

        <!-- Preloader -->
        <div id="preloader">
            <div data-loader="dual-ring"></div>
        </div>
        <!-- Preloader End -->

        <!-- Document Wrapper
    ============================================= -->
        <div id="main-wrapper">

            <!-- Header
    ============================================= -->

            @include('layouts.navigation')
            <!-- Header End -->
            @yield('content')

            <!-- Footer
    ============================================= -->
            @include('layouts.footer')
            <!-- Footer end -->

        </div>
        <!-- Document Wrapper end -->

        <!-- Back to Top
    ============================================= -->
        <a id="back-to-top" data-bs-toggle="tooltip" title="Voltar ao topo" href="javascript:void(0)"><i
                class="fa fa-chevron-up"></i></a>

        <!-- Video Modal
    ============================================= -->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content bg-transparent border-0">
                    <button type="button" class="btn-close btn-close-white ms-auto me-n3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="modal-body p-0">
                        <div class="ratio ratio-16x9">
                            <iframe id="video" src="#" allow="autoplay;" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video Modal end -->

        <!-- Script -->
        <script src="{{ asset('assets/js/maskmoney.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('assets/js/owl-carousel.min.js') }}"></script>
        <!-- Style Switcher -->
        <script src="{{ asset('assets/js/theme.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>

        @yield('scripts')

        <script>
            $("#logout").click(function() {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='_token']").attr("content")
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('logout') }}",
                    success: function(data) {
                        location.reload(true);
                    }
                });
            })

        </script>

    </body>

    </html>

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
    <title>{{ env('APP_NAME') }} - Money Transfer and Online Payments HTML Template</title>
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
    <link rel="stylesheet" href="{{ asset('plugins/ijaboCropTool.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-select.min.css') }}" />
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/currency-flags.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/stylesheet.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/daterangepicker.css') }}" />

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
        <!-- Secondary Menu============================================= -->
        @include('layouts.profile.secondary_menu')
        <!-- Secondary Menu end -->
        @yield('content')

        @include('layouts.footer')
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
    <script src="{{ asset('plugins/ijaboCropTool.min.js') }}"></script>

    <script src="{{ asset('assets/js/maskmoney.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl-carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>

    <script>
        $(function() {
            'use strict';

            // Date Range Picker
            $(function() {
                var start = moment().subtract(29, 'days');
                var end = moment();

                function cb(start, end) {
                    $('#dateRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                        'MMMM D, YYYY'));
                }
                $('#dateRange').daterangepicker({
                    locale: {
                        format: 'DD/MM/YYYY'
                    },
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Hoje': [moment(), moment()],
                        'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
                        'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
                        'Este Mês': [moment().startOf('month'), moment().endOf('month')],
                        'Mês Pasado': [moment().subtract(1, 'month').startOf('month'), moment()
                            .subtract(1, 'month').endOf('month')
                        ]
                    }
                }, cb);
                cb(start, end);
            });
        });
    </script>
    <!-- Style Switcher -->
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        //User Photo change
        $('#file').ijaboCropTool({
            preview: '.user-image',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: '{{ route('profile.change.photo') }}',
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function(message, element, status) {},
            onError: function(message, element, status) {}
        });

        /////////////////////////////////////////////////////////////////////////////////


        $(".transfer-id").click(function() {
            var id;
            id = $(this).attr("id")
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='_token']").attr("content")
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('profille.transfer_details') }}",
                data: {
                    "id": id
                },
                success: function(data) {

                    var today = new Date(data["created_at"]);
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();
                    today = dd + '/' + mm + '/' + yyyy;

                    switch (data["currency"]) {
                        case "eur":
                            var currency = "€"
                            break;
                        case "usd":
                            var currency = "$"
                            break;
                        case "gbp":
                            var currency = "£"
                            break;
                    }

                    number_format = function(number, decimals, dec_point, thousands_sep) {
                        number = Number(number).toFixed(decimals);

                        var nstr = number.toString();
                        nstr += '';
                        x = nstr.split('.');
                        x1 = x[0];
                        x2 = x.length > 1 ? dec_point + x[1] : '';
                        var rgx = /(\d+)(\d{3})/;

                        while (rgx.test(x1))
                            x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

                        return x1 + x2;
                    }
                    switch (data["plan"]) {
                        case 1:

                            var plan = "A Pagar em prestações " + number_format(((data["value_sended"] +
                                    data[
                                        "tax"]) / 100 * 20 + (data["value_sended"] + data[
                                    "tax"])) / 2, 2, ",", ".") +
                                currency + " por mês"
                            break;
                        case 0:
                            var plan = "Pago por cartão bancário"
                            break;
                    }

                    switch (data["status"]) {
                        case "sended":
                            var status = "O Valor está  disponível e jà pode ser levantado"
                            break;
                        case "received":
                            var status = "O Valor foi Recebido"
                            break;
                        case "reimbursed":
                            var status = "O Valor Foi Reembolsado"
                            break;

                    }

                    var total = data["value_sended"] + data["tax"];

                    console.log(typeof total, Number(parseFloat(total)));
                    $("#transfer_value").text(number_format(total, 2, ",",
                        ".") + currency)
                    $("#transfer_date").text(today)
                    $("#transfer_valor_sem_taxa").text(number_format(data["value_sended"], 2, ",",
                        ".") + currency)
                    $("#transfer_tax").text(number_format(data["tax"], 2, ",", ".") + currency)
                    $("#transfer_total").text(number_format(total, 2, ",",
                        ".") + currency)
                    $("#transfer_receptor").text(data["destinatary_name"])
                    $("#transfer_id").text(data["transfer_code"])
                    $("#transfer_status").text(status)
                    $("#description").text(plan)

                }
            });
            $("#transaction-detail").modal('show');
        })

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

    @yield('scripts')

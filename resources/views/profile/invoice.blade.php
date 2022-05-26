<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/images/site.webmanifest') }}">
    <title>{{ env('APP_NAME') }} - Money Transfer and Online Payments </title>
    <meta name="description"
        content="This professional design html template is for build a Money Transfer and online payments website.">
    <meta name="author" content="Rafael Ferreira">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/invoice/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="{{ asset('assets/invoice/css/style.css') }}" rel="stylesheet">
</head>

<body class="bg-light " id="fatura">
    <!-- Container -->
    <div class="container-fluid Billig-container shadow-sm ">
        <!-- Header -->
        <header>
            <div class="row align-items-center">
                <div class="col-7 text-start mb-3 mb-sm-0">
                    <img id="logo" src="{{ asset('images/logo.png') }}" title="Billig" alt="Billig">

                </div>
                <div class="col-5 text-end">
                    <h4 class="mb-0 text-uppercase">Recibo</h4>
                    <p class="mb-0">Número do recibo -
                        {{ $details->id }}{{ $details->created_at->format('dmY') }}</p>
                </div>
            </div>
            <hr>
        </header>
        <!-- Main Content -->
        <main>
            <div class="row ">
                <div class="col-6 text-end order-sm-1">
                    <strong>Pago a:</strong>
                    <address>
                        {{ env('APP_NAME') }}<br>
                        1348 Columbia Road, Denver<br>
                        Pin : 80265
                    </address>
                </div>
                <div class="col-6 order-sm-0">
                    <strong>Faturado a:</strong>
                    <address>
                        {{ $details->name }}<br>
                        {{ $details->address }}<br>
                        {{ $details->country }}
                        {{ $details->email }}
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-6"> <strong>Método de pagamento:</strong><br>
                    <span> Cartão bancário </span> <br>
                    <br>
                </div>
                <div class="col-6 text-end"> <strong>Data da transação:</strong><br>
                    <span> {{ $details->created_at->format('d/m/Y') }}<br>
                        <br>
                    </span>
                </div>
            </div>
            <div class="card">
                <div class="card-header px-2 bf-light"> <span class="font-weight-600 text-4">Resumo transação</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <td class="col-6 border-top-0"><strong>Descrição</strong></td>
                                    <td class="col-6 border-top-0 "><strong>Receptor</strong></td>
                                    <td class="col-4 border-top-0 "><strong>Valor(eur)</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="text-2">Envio de dinheiro</td>
                                    <td class="">{{ $details->destinatary_name }}</td>
                                    <td class="text-end">{{ $details->value_sended }}€</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="bg-light-2 text-end"><strong>Sub Total</strong></td>
                                    <td class="bg-light-2 text-end">{{ $details->value_sended }}€</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="bg-light-2 text-end"><strong>Tax</strong></td>
                                    <td class="bg-light-2 text-end">{{ number_format($details->tax, 2, ',', '.') }}€</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="bg-light-2 text-end border-0"><strong>Total</strong></td>
                                    <td class="bg-light-2 text-end border-0">
                                        {{ number_format($details->value_sended + $details->tax, 2, ',', '.') }}€</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="table-responsive d-print-none">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-start"><strong>Data da transação</strong></td>
                            <td class="text-start"><strong>Código de transação</strong></td>
                            <td class="text-start"><strong>Valor pago</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-start">{{ $details->created_at->format('d/m/Y') }}</td>
                            <td class="text-start">{{ $details->transfer_code }}</td>
                            <td class="text-start">
                                {{ number_format($details->value_sended + $details->tax, 2, ',', '.') }}€</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
        <!-- Footer -->
        <footer class="text-center">
            <p class="text-1"><strong>Nota :</strong> Este é um recibo gerado por computador e não
                requer assinatura física.
            </p>
        </footer>
    </div>
</body>
<script src="{{ asset('assets/invoice/js/jspdf.debug.js') }}"></script>
<script src="{{ asset('assets/invoice/js/html2canvas.min.js') }}"></script>
<script src="{{ asset('assets/invoice/js/html2pdf.min.js') }}"></script>
<script>
    const options = {
        margin: 0.5,
        filename: "recibo_{{ $details->id }}{{ $details->created_at->format('dmY') }}.pdf",
        image: {
            type: 'jpeg',
            quality: 500
        },
        html2canvas: {
            scale: 5
        },
        jsPDF: {
            unit: 'in',
            format: 'letter',
            orientation: 'portrait'
        }
    }

    $(document).ready(function() {
        const element = document.getElementById('fatura');
        html2pdf().from(element).set(options).save();
        const myTimeout = setTimeout(myGreeting, 2000);

        function myGreeting() {
            window.history.back()
        }
    });
</script>

</html>

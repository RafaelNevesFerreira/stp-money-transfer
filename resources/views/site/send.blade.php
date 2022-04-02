@extends("layouts.app")
@section('content')
    <script src="{{ asset('assets/js/maskmoney.min.js') }}"></script>

    <!-- Content
                                                                                  ============================================= -->
    <div id="content" class="py-4">
        <div class="container">

            <!-- Steps Progress bar -->
            <div class="row mt-4 mb-5">
                <div class="col-lg-11 mx-auto">
                    <div class="row widget-steps">
                        <div class="col-4 step active">
                            <div class="step-name">Details</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="#" class="step-dot"></a>
                        </div>
                        <div class="col-4 step disabled">
                            <div class="step-name">Identificação</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="#" class="step-dot"></a>
                        </div>
                        <div class="col-4 step disabled">
                            <div class="step-name">Pagamento</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="#" class="step-dot"></a>
                        </div>

                    </div>
                </div>
            </div>
            <h2 class="fw-400 text-center mt-3">Enviar Dinheiro</h2>
            <p class="lead text-center mb-4">Envie seu dinheiro a qualquer momento e em qualquer lugar.</p>
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
                    <div class="bg-white shadow-sm rounded p-3 pt-sm-4 pb-sm-5 px-sm-5 mb-4">
                        <h3 class="text-5 fw-400 mb-3 mb-sm-4">Detalhes</h3>
                        <hr class="mx-n3 mx-sm-n5 mb-4">
                        <!-- Send Money Form
                                                                                            ============================ -->
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
                                            class="selectpicker form-control bg-transparent"  required="">
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
                            <p>Total Taxas<span class="float-end" id="taxas">6.05</span></p>
                            <hr>
                            <p class="text-4 fw-500">Total a Pagar<span class="float-end" id="total">31.05 <span id="moeda_mudar">€</span>
                                </span></p>
                            <div class="d-grid"><button class="btn btn-primary">Continue</button></div>
                        </form>
                        <!-- Send Money Form end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#youSend").keyup(function() {
                if ($("#youSend").val() < 1) {
                    $("#recipientGets").val(0);
                } else {
                    var valor = $(this).val()

                    var formater = new Intl.NumberFormat("fr-FR", {
                        style: "currency",
                        currency: "snt"
                    });
                    valor = parseFloat(valor.replace(".", ''))

                    if (valor >= 100 && valor <= 400) {
                        var minha_tax = 27
                    } else if (valor > 400 && valor <= 800) {
                        minha_tax = 50
                    } else if (valor > 800 && valor <= 1000) {
                        minha_tax = 150
                    } else if (valor == 25) {
                        minha_tax = 5;
                    } else if (valor < 25) {
                        minha_tax = 3;
                    } else {
                        minha_tax = 10;
                    }
                    var tax = valor * 0.030 + 0.3 + minha_tax

                    var total = valor + tax;
                    $("#taxas").text(tax.toFixed(2));
                    $("#total").text(total);

                    $("#recipientGets").val(formater.format(valor * 25));

                }
            });

            $('#youSend').maskMoney()
            $("#youSendCurrency").change(function() {
                if ($(this).val() == "eur") {

                    $("#moeda_mudar").val("€")
                }else if($(this).val() == "usd"){
                    $("#moeda_mudar").val("$")
                }else{
                    $("#moeda_mudar").val("£")

                }
            })
        })
    </script>
    <!-- Content end -->
@endsection

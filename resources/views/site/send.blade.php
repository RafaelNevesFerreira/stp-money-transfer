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
                            <div class="step-name">Confirm</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="#" class="step-dot"></a>
                        </div>
                        <div class="col-4 step disabled">
                            <div class="step-name">Success</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="#" class="step-dot"></a>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="fw-400 text-center mt-3">Send Money</h2>
            <p class="lead text-center mb-4">Envie seu dinheiro a qualquer momento e em qualquer lugar.</p>
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
                    <div class="bg-white shadow-sm rounded p-3 pt-sm-4 pb-sm-5 px-sm-5 mb-4">
                        <h3 class="text-5 fw-400 mb-3 mb-sm-4">Detalhes</h3>
                        <hr class="mx-n3 mx-sm-n5 mb-4">
                        <!-- Send Money Form
                                                    ============================ -->
                        <form id="form-send-money" method="post">
                            <div class="mb-3">
                                <label for="nomedoreceptor" class="form-label">Nome do Receptor</label>
                                <input type="text" class="form-control" id="nomedoreceptor" required
                                    placeholder="Digite o nome completo do receptor">
                            </div>
                            <div class="mb-3">
                                <label for="youSend" class="form-label">Valor a ser enviado</label>
                                <div class="input-group">
                                    {{-- <span class="input-group-text">$</span> --}}
                                    <input type="text" data-thousands="." data-decimal="," class="form-control" data-bv-field="youSend" id="youSend"
                                        value="25" placeholder="">
                                    <span class="input-group-text p-0">
                                        <select id="youSendCurrency" data-style="form-select bg-transparent border-0"
                                            data-container="body" data-live-search="true"
                                            class="selectpicker form-control bg-transparent" required="">
                                            <optgroup label="Popular Currency">
                                                <option data-icon="currency-flag currency-flag-usd me-1"
                                                    data-subtext="Dolar Norte Americano" value="usd">USD</option>
                                                <option data-icon="currency-flag currency-flag-aud me-1"
                                                    data-subtext="Dolar Australiano" value="aud">AUD</option>
                                                <option data-icon="currency-flag currency-flag-eur me-1" data-subtext="Euro"
                                                    selected="selected" value="eur">EUR
                                                </option>
                                            </optgroup>
                                            <option data-divider="true"></option>
                                            <optgroup label="Other Currency">
                                                <option data-icon="currency-flag currency-flag-brl me-1"
                                                    data-subtext="Real Brazileiro" value="brl">BRL</option>
                                                <option data-icon="currency-flag currency-flag-cad me-1"
                                                    data-subtext="Dolar canadiano" value="cad">CAD</option>
                                                <option data-icon="currency-flag currency-flag-chf me-1"
                                                    data-subtext="Franco Suiço" value="chf">CHF</option>
                                            </optgroup>
                                        </select>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="recipientGets" class="form-label">Valor a ser recebido</label>
                                <div class="input-group">
                                    <span class="input-group-text">Dbs</span>
                                    <input type="text" disabled class="form-control" id="recipientGets" value="625">
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
                            <p>Total Fees<span class="float-end" id="taxas">7.21 USD</span></p>
                            <hr>
                            <p class="text-4 fw-500">Total To Pay<span class="float-end" id="total">1,000.00
                                    USD</span></p>
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
                    var valor = parseFloat($(this).val());
                    var formater = new Intl.NumberFormat("fr-FR",{
                        style: "currency",
                        currency: "EUR"
                    });
                    console.log(formater.format(valor+10));
                    // $("#recipientGets").val(valor + 10);

                }
            });

            $('#youSend').maskMoney()

        })
    </script>
    <!-- Content end -->
@endsection

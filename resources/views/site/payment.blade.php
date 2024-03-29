@extends('layouts.app')
@section('content')
    <!-- Steps Progress bar -->
    <div class="row mt-4 mb-5">
        <div class="col-lg-11 mx-auto">
            <div class="row widget-steps">
                <div class="col-4 step complete">
                    <div class="step-name">Detalhes</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="{{ route('send') }}" class="step-dot"></a>
                </div>
                <div class="col-4 step complete">
                    <div class="step-name">Identificação</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="{{ route('identification') }}" class="step-dot"></a>
                </div>
                <div class="col-4 step active">
                    <div class="step-name">Pagamento</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <span class="step-dot"></span>
                </div>
            </div>
        </div>
    </div>
    <h2 class="fw-400 text-center mt-3">Enviar Dinheiro</h2>
    <p class="lead text-center mb-4">você està enviando dinheiro para <span
            class="fw-500">{{ session('receptor') }}</span></p>
    <div class="row">
        <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
            <div class="bg-white shadow-sm rounded p-3 pt-sm-4 pb-sm-5 px-sm-5 mb-4">
                <h3 class="text-5 fw-400 mb-3 mb-sm-4">Pagamento</h3>
                <hr class="mx-n3 mx-sm-n5 mb-4">
                <!-- Send Money Confirm ============================================= -->
                <form id="form-send-money" method="POST" action="{{ route('payment.post') }}">
                    @csrf
                    <div class="col-md-12">
                        <div class='form-row row'>

                            <div class='col-md-6 col-md-4 form-group '>
                                <label for="card_no" class="control-label mt-3">N. Cartão</label>
                                <input type="number" id="card_no" required class="form-control" name="card_no">
                            </div>
                            <div class='col-md-6 col-md-4 form-group '>
                                <label class='control-label mt-3'>CVC</label>
                                <input type="number" id="cvc" required value="{{ old('cvc') }}" class="form-control" name="cvc">
                            </div>
                            <div class='col-md-6 col-md-4 form-group '>
                                <label class='control-label mt-3'>Mês de expiração</label>
                                <input type="number" id="exp_month" required value="{{ old('exp_month') }}" class="form-control"
                                    name="exp_month">
                            </div>
                            <div class='col-md-6 col-md-4 form-group ' style="margin-bottom: 20px;">
                                <label class='control-label mt-3'>Ano de expiração</label>
                                <input type="number" id="exp_year" required class="form-control" value="{{ old('exp_year') }}"
                                    name="exp_year">

                            </div>
                        </div>
                        @if ($errors->any())
                            <div class='form-row row'>
                                <div class='col-md-12 error form-group'>
                                    <div class='alert-danger alert'>
                                        @foreach ($errors->all() as $error)
                                            <p>{!! $error !!}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="d-grid"><button class="btn btn-primary" id="pay">Enviar</button>
                        </div>

                    </div>
                </form>
                <!-- Send Money Confirm end -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#form-send-money").submit(function() {
            $('#preloader').css("display", "block").delay(800).fadeIn(
                400); // will fade out the white DIV that covers the website.
        })
    </script>
@endsection

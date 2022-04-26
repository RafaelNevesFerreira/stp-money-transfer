@extends("layouts.app")
@section('content')
    <div id="content" class="py-4">
        <div class="container">

            <!-- Steps Progress bar -->
            <div class="row mt-4 mb-5">
                <div class="col-lg-11 mx-auto">
                    <div class="row widget-steps">
                        <div class="col-4 step complete">
                            <div class="step-name">Detalhes</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <span class="step-dot"></span>
                        </div>
                        <div class="col-4 step complete">
                            <div class="step-name">Identificação</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <span class="step-dot"></span>
                        </div>
                        <div class="col-4 step complete">
                            <div class="step-name">Pagamento</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <span class="step-dot"></span>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="fw-400 text-center mt-3 mb-4">Enviar Dinheiro</h2>
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
                    <!-- Send Money Success
              ============================================= -->
                    <div class="bg-white text-center shadow-sm rounded p-3 pt-sm-4 pb-sm-5 px-sm-5 mb-4">
                        <div class="my-4">
                            <p class="text-success text-20 lh-1"><i class="fas fa-check-circle"></i></p>
                            <p class="text-success text-8 fw-500 lh-1">Sucesso!</p>
                            <p class="lead">Sua Transição Foi Feita Com Sucesso</p>
                        </div>
                        <p class="text-3 mb-4">Você enviou <span class="text-4 fw-500">{{$valor}} {{$moeda }}</span> para <span
                                class="fw-500">{{$receptor}}</span>, See transaction details under <a
                                class="btn-link" href="{{route("profile.transactions")}}">Detalhes</a>.</p>
                        <div class="d-grid"><a href="{{ route("send") }}" class="btn btn-primary">Novo Envio</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

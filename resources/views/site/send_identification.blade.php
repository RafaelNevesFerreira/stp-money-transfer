@extends("layouts.app")
@section('content')
    <!-- Content
                                              ============================================= -->
    <div id="content" class="py-4">
        <div class="container">

            <!-- Steps Progress bar -->
            <div class="row mt-4 mb-5">
                <div class="col-lg-11 mx-auto">
                    <div class="row widget-steps">
                        <div class="col-4 step complete">
                            <div class="step-name">Details</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="send-money.html" class="step-dot"></a>
                        </div>
                        <div class="col-4 step active">
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
            <h2 class="fw-400 text-center mt-3">Enviar Dinheiro</h2>
            <p class="lead text-center mb-4">você està enviando dinheiro para <span
                    class="fw-500">{{ session('receptor') }}</span></p>
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
                    <div class="bg-white shadow-sm rounded p-3 pt-sm-4 pb-sm-5 px-sm-5 mb-4">
                        <h3 class="text-5 fw-400 mb-3 mb-sm-4">Identificação</h3>
                        <hr class="mx-n3 mx-sm-n5 mb-4">
                        <!-- Send Money Confirm ============================================= -->
                        <form id="form-send-money" method="post">
                            <div class="mb-4">
                                @auth
                                    <label for="name" class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control" id="name" required
                                        placeholder="Digite o seu nome completo" value="{{ auth()->user()->name }}"
                                        name="name">
                                    <label for="address" class="form-label">Morada</label>
                                    <input type="text" class="form-control" id="address" required
                                        placeholder="Digite a sua morada" value="{{ auth()->user()->address }}" name="address">

                                    <label for="phone_number" class="form-label">Número de Telemóvel</label>
                                    <input type="number" class="form-control" value="{{ auth()->user()->phone_number }}" id="phone_number" required
                                        placeholder="Digite o seu Número de Telemóvel" name="phone_number">

                                    <label for="country" class="form-label">País</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->country }}" id="country" required
                                        placeholder="Digite o seu país de residência" name="country">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->email }}" id="email" required
                                        placeholder="Digite o seu email" name="email">

                                @endauth

                                @guest
                                    <label for="name" class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control" id="name" required
                                        placeholder="Digite o seu nome completo" name="name">
                                    <label for="address" class="form-label">Morada</label>
                                    <input type="text" class="form-control" id="address" required
                                        placeholder="Digite a sua morada" name="address">

                                    <label for="phone_number" class="form-label">Número de Telemóvel</label>
                                    <input type="number" class="form-control" id="phone_number" required
                                        placeholder="Digite o seu Número de Telemóvel" name="phone_number">

                                    <label for="country" class="form-label">País</label>
                                    <input type="text" class="form-control" id="country" required
                                        placeholder="Digite o seu país de residência" name="country">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" required
                                        placeholder="Digite o seu email" name="email">
                                    <br>
                                    <p>Deseja Cadastrarse:</p>
                                    <input type="radio" id="sim" name="cadastro" value="{{true}}">
                                    <label for="sim">Sim</label><br>
                                    <input type="radio" id="nao" name="cadastro" value="{{false}}">
                                    <label for="nao">Não</label><br>
                                @endguest


                            </div>
                            <hr class="mx-n3 mx-sm-n5 mb-3 mb-sm-4">
                            <h3 class="text-5 fw-400 mb-3 mb-sm-4">Confirmar Detalhes</h3>
                            <hr class="mx-n3 mx-sm-n5 mb-4">
                            <p class="mb-1">Valor à Enviar <span
                                    class="text-3 float-end">{{ session('valor_a_ser_enviado') }}
                                    {{ session('moeda') }}</span></p>
                            <p class="mb-1">Total Tax <span class="text-3 float-end">{{ session('tax') }}
                                    {{ session('moeda') }}</span></p>
                            <hr>
                            <p class="text-4 fw-500">Total<span class="float-end">{{ session('total') }}
                                    {{ session('moeda') }}</span></p>
                            <div class="d-grid"><button class="btn btn-primary">Enviar</button></div>
                        </form>
                        <!-- Send Money Confirm end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content end -->
@endsection

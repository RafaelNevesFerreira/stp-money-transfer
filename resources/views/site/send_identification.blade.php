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
                            <div class="step-name">Detalhess</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="{{ route('send') }}" class="step-dot"></a>
                        </div>
                        <div class="col-4 step active">
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
            <p class="lead text-center mb-4">você està enviando dinheiro para <span
                    class="fw-500">{{ session('receptor') }}</span></p>
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
                    <div class="bg-white shadow-sm rounded p-3 pt-sm-4 pb-sm-5 px-sm-5 mb-4">
                        <h3 class="text-5 fw-400 mb-3 mb-sm-4">Identificação</h3>
                        <hr class="mx-n3 mx-sm-n5 mb-4">
                        <!-- Send Money Confirm ============================================= -->
                        <form id="form-send-money" method="post" action="{{ route('identification.submit') }}">
                            <div class="mb-4">
                                @csrf
                                @if (!session('name') && Auth::check())
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Nome Completo</label>
                                            <input type="text" class="form-control c" id="name" required
                                                placeholder="Digite o seu nome completo" value="{{ auth()->user()->name }}"
                                                name="name">
                                        </div>
                                        <div class="col-md-6">

                                            <label for="address" class="form-label">Morada</label>
                                            <input type="text" class="form-control" id="address" required
                                                placeholder="Digite a sua morada" value="{{ auth()->user()->address }}"
                                                name="address">
                                        </div>
                                        <div class="col-md-6">


                                            <label for="phone_number" class="form-label">Número de Telemóvel</label>
                                            <input type="number" class="form-control" id="phone_number" required
                                                placeholder="Digite o seu Número de Telemóvel"
                                                value="{{ auth()->user()->phone_number }}" name="phone_number">
                                        </div>
                                        <div class="col-md-6">


                                            <label for="country" class="form-label">País</label>
                                            <input type="text" class="form-control" id="country" required
                                                placeholder="Digite o seu país de residência"
                                                value="{{ auth()->user()->country }}" name="country">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" required
                                                placeholder="Digite o seu email" value="{{ auth()->user()->email }}"
                                                name="email">
                                        </div>

                                    </div>
                                @endif
                                @if (session('name'))
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Nome Completo</label>
                                            <input type="text" class="form-control c" id="name" required
                                                placeholder="Digite o seu nome completo" value="{{ session('name') }}"
                                                name="name">
                                        </div>
                                        <div class="col-md-6">

                                            <label for="address" class="form-label">Morada</label>
                                            <input type="text" class="form-control" id="address" required
                                                placeholder="Digite a sua morada" value="{{ session('address') }}"
                                                name="address">
                                        </div>
                                        <div class="col-md-6">


                                            <label for="phone_number" class="form-label">Número de Telemóvel</label>
                                            <input type="number" class="form-control" id="phone_number" required
                                                placeholder="Digite o seu Número de Telemóvel"
                                                value="{{ session('phone_number') }}" name="phone_number">
                                        </div>
                                        <div class="col-md-6">


                                            <label for="country" class="form-label">País</label>
                                            <input type="text" class="form-control" id="country" required
                                                placeholder="Digite o seu país de residência"
                                                value="{{ session('country') }}" name="country">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" required
                                                placeholder="Digite o seu email" value="{{ session('email') }}"
                                                name="email">
                                        </div>

                                    </div>
                                    <br>
                                    @unless(Auth::check())
                                        <p>Deseja Cadastrar-se?</p>
                                        <p><small>Uma vez cadastrado o seu processo de envio será mais rapido, e no seu
                                                primeiro envio como cliente cadastrado não pagará as mesmas
                                                taxas</small></p>
                                        <div class="d-grid "><a href="{{ route('register') }}"
                                                class="btn btn-warning">Cadastrar-se</a></div>
                                        <br>
                                        <p>Já tem uma conta?</p>
                                        <p><small>Faça o login e pule as outras etapas!</small></p>
                                        <div class="d-grid "><a href="{{ route('login') }}"
                                                class="btn btn-info">Login</a>
                                        </div>
                                    @endunless
                                @elseif (!session('name') && !Auth::check())
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Nome Completo</label>
                                            <input type="text" class="form-control c" id="name" required
                                                placeholder="Digite o seu nome completo" name="name">
                                        </div>


                                        <div class="col-md-6">

                                            <label for="address" class="form-label">Morada</label>
                                            <input type="text" class="form-control" id="address" required
                                                placeholder="Digite a sua morada" name="address">
                                        </div>
                                        <div class="col-md-6">


                                            <label for="phone_number" class="form-label">Número de Telemóvel</label>
                                            <input type="number" class="form-control" id="phone_number" required
                                                placeholder="Digite o seu Número de Telemóvel" name="phone_number">
                                        </div>
                                        <div class="col-md-6">


                                            <label for="country" class="form-label">País</label>
                                            <input type="text" class="form-control" id="country" required
                                                placeholder="Digite o seu país de residência" name="country">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" required
                                                placeholder="Digite o seu email" name="email">
                                        </div>

                                    </div>
                                    <br>
                                    <p>Deseja Cadastrar-se?</p>
                                    <p><small>Uma vez cadastrado o seu processo de envio será mais rapido, e no seu
                                            primeiro envio como cliente cadastrado não pagará as mesmas
                                            taxas</small></p>
                                    <div class="d-grid "><a href="{{ route('register') }}"
                                            class="btn btn-warning">Cadastrar-se</a></div>
                                    <br>
                                    <p>Já tem uma conta?</p>
                                    <p><small>Faça o login e pule as outras etapas!</small></p>
                                    <div class="d-grid "><a href="{{ route('login') }}"
                                            class="btn btn-info">Login</a></div>
                                @endif


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

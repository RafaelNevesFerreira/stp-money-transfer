@extends('layouts.app')
@section('content')
    <!-- Content  ============================================= -->
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
                                                placeholder="Digite o seu nome completo"
                                                value="{{ auth()->user()->name }}" name="name">
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
                                                placeholder="Digite o seu email" disabled
                                                value="{{ auth()->user()->email }}" name="email">
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
                                            @if (Auth::check())
                                                <input type="text" class="form-control" id="email" required
                                                    placeholder="Digite o seu email" disabled
                                                    value="{{ Auth::user()->email }}" name="email">
                                            @else
                                                <input type="text" class="form-control" id="email" required
                                                    placeholder="Digite o seu email" value="{{ session('email') }}"
                                                    name="email">
                                            @endif
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
                                            <select id="country" class="form-control " required name="country">
                                                <option value="Portugal">Portugal</option>
                                                <option value="Angola">Angola</option>
                                                <option value="França">França</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Australia">Austrália</option>
                                                <option value="Austria">Áustria</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Bélgica">Bélgica</option>
                                                <option value="Brasil">Brasil</option>
                                                <option value="Bulgaria">Bulgária</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Camarões">Camarões</option>
                                                <option value="Canada">Canadá</option>
                                                <option value="cabo Verde">cabo Verde</option>
                                                <option value="China">China</option>
                                                <option value="Colombia">Colômbia</option>
                                                <option value="Comoros">Comores</option>
                                                <option value="Congo">Congo</option>
                                                <option value="Cote D'Ivoire">Cote D'Ivoire</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Ecuador">Equador</option>
                                                <option value="Guiné Equatorial">Guiné Equatorial</option>
                                                <option value="Finlândia">Finlândia</option>
                                                <option value="Gabão">Gabão</option>
                                                <option value="Alemanha">Alemanha</option>
                                                <option value="Guiné">Guiné</option>
                                                <option value="Guine-Bissau">Guine-bissau</option>
                                                <option value="Hong Kong">Hong Kong</option>
                                                <option value="Hungria">Hungria</option>
                                                <option value="Islândia">Islândia</option>
                                                <option value="India">Índia</option>
                                                <option value="Itália">Itália</option>
                                                <option value="Japão">Japão</option>
                                                <option value="Quênia">Quênia</option>
                                                <option value="Líbano">Líbano</option>
                                                <option value="Luxemburgo">Luxemburgo</option>
                                                <option value="Macau">Macau</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Mexico">México</option>
                                                <option value="Monaco">Mônaco</option>
                                                <option value="Mongolia">Mongólia</option>
                                                <option value="Marrocos">Marrocos</option>
                                                <option value="Moçambique">Moçambique</option>
                                                <option value="Países Baixos">Países Baixos</option>
                                                <option value="Nova Zelândia">Nova Zelândia</option>
                                                <option value="Nigeria">Nigéria</option>
                                                <option value="Polônia">Polônia</option>
                                                <option value="Catar">Catar</option>
                                                <option value="Ruanda">Ruanda</option>
                                                <option value="Senegal">Senegal</option>
                                                <option value="Espanha">Espanha</option>
                                                <option value="Suíça">Suíça</option>
                                                <option value="Taiwan">Taiwan</option>
                                                <option value="Timor-Leste">Timor-Leste</option>
                                                <option value="Reino Unido">Reino Unido</option>
                                                <option value="Estados Unidos">Estados Unidos</option>
                                            </select>                                        </div>
                                        <div class="col-md-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" required
                                                placeholder="Digite o seu email" name="email">
                                        </div>

                                    </div>
                                    <br>
                                    <p>Automatize o processo</p>
                                    <p><small>Uma vez cadastrado o seu processo de envio será mais rapido, sem falar que
                                            poderà pedir reembolso apenas se for cliente.</small></p>

                                    <div class="d-grid "><a href="{{ route('register') }}"
                                            class="btn btn-warning">Cadastre-se</a></div>
                                    <br>
                                    <p class="text-center">Ou</p>
                                    <div class="d-grid "><a href="{{ route('login') }}"
                                            class="btn btn-info">Login</a></div>
                                @endif


                            </div>
                            <hr class="mx-n3 mx-sm-n5 mb-3 mb-sm-4">
                            <h3 class="text-5 fw-400 mb-3 mb-sm-4">Confirmar Detalhes</h3>
                            <hr class="mx-n3 mx-sm-n5 mb-4">
                            <p class="mb-1">Valor à Enviar <span
                                    class="text-3 float-end">{{ number_format(session('valor_a_ser_enviado'), 2, ',', '.') }}
                                    {{ session('moeda') }}</span></p>
                            <p class="mb-1">Total Tax <span
                                    class="text-3 float-end">{{ number_format(session('tax'), 2, ',', '.') }}
                                    {{ session('moeda') }}</span></p>
                            <hr>
                            <p class="text-4 fw-500">Total<span
                                    class="float-end">{{ number_format(session('total'), 2, ',', '.') }}
                                    {{ session('moeda') }}</span></p>
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

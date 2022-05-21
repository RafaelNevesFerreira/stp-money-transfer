@extends("layouts.app")
@section('content')
    <div id="content">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-8 mx-auto">
                    <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
                        <h3 class="fw-400 text-center mb-4">Criar Uma Conta</h3>
                        <hr class="mx-n3 mx-sm-n5">
                        <p class="lead text-center">Todos os dias, Nós deixamos milhares de clientes satisfeitos!</p>
                        <form id="loginForm" method="post" action="{{ route('register') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="mb-3 col">
                                    <label for="name" class="form-label">Nome Completo</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                        id="name" required placeholder="Digite seu nome">
                                </div>
                                <div class="mb-3 col">
                                    <label for="phone_number" class="form-label">Telemóvel</label>
                                    <input type="number" name="phone_number" value="{{ old('phone_number') }}"
                                        class="form-control" id="phone_number" required
                                        placeholder="Digite seu número de Telemóvel">
                                </div>
                            </div>

                            <div class="mb-3 col">
                                <label for="address" class="form-label">Morada</label>
                                <input type="text" name="address" value="{{ old('address') }}" class="form-control"
                                    id="address" required placeholder="Digite a sua morada">
                            </div>
                            <div class="row g-3">
                                <div class="mb-3 col">
                                    <label for="country" class="form-label">País</label>
                                    <!-- All countries -->
                                    <select id="country" class="form-control " required name="country">
                                        <option>Selecione Seu País De Residência</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Australia">Austrália</option>
                                        <option value="Austria">Áustria</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belgium">Bélgica</option>
                                        <option value="Brazil">Brasil</option>
                                        <option value="Bulgaria">Bulgária</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Cameroon">Camarões</option>
                                        <option value="Canada">Canadá</option>
                                        <option value="Cape Verde">cabo Verde</option>
                                        <option value="China">China</option>
                                        <option value="Colombia">Colômbia</option>
                                        <option value="Comoros">Comores</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Cote D'Ivoire">Cote D'Ivoire</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Ecuador">Equador</option>
                                        <option value="Equatorial Guinea">Guiné Equatorial</option>
                                        <option value="Finland">Finlândia</option>
                                        <option value="France">França</option>
                                        <option value="Gabon">Gabão</option>
                                        <option value="Germany">Alemanha</option>
                                        <option value="Guinea">Guiné</option>
                                        <option value="Guinea-Bissau">Guinea-bissau</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungria</option>
                                        <option value="Iceland">Islândia</option>
                                        <option value="India">Índia</option>
                                        <option value="Italy">Itália</option>
                                        <option value="Japan">Japão</option>
                                        <option value="Kenya">Quênia</option>
                                        <option value="Lebanon">Líbano</option>
                                        <option value="Luxembourg">Luxemburgo</option>
                                        <option value="Macao">Macau</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Mexico">México</option>
                                        <option value="Monaco">Mônaco</option>
                                        <option value="Mongolia">Mongólia</option>
                                        <option value="Morocco">Marrocos</option>
                                        <option value="Mozambique">Moçambique</option>
                                        <option value="Netherlands">Países Baixos</option>
                                        <option value="New Zealand">Nova Zelândia</option>
                                        <option value="Nigeria">Nigéria</option>
                                        <option value="Poland">Polônia</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Qatar">Catar</option>
                                        <option value="Rwanda">Ruanda</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Spain">Espanha</option>
                                        <option value="Switzerland">Suíça</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Timor-Leste">Timor-Leste</option>
                                        <option value="United Kingdom">Reino Unido</option>
                                        <option value="United States">Estados Unidos</option>
                                    </select>
                                </div>
                                <div class="mb-3 col">
                                    <label for="emailAddress" class="form-label">Email </label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                        id="emailAddress" required placeholder="Digite Seu Email">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="mb-3 col">
                                    <label for="emailAddress" class="form-label">Senha</label>
                                    <input type="password" name="password" class="form-control" id="emailAddress" required
                                        placeholder="Digite Sua Senha">
                                </div>
                                <div class="mb-3 col">
                                    <label for="emailAddress" class="form-label">Confirmar Senha</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        id="emailAddress" required placeholder="Confirme Sua Senha">
                                </div>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            <div class="d-grid mb-3"><button class="btn btn-primary" type="submit">Criar Conta</button>
                            </div>
                        </form>
                        <p class="text-3 text-muted text-center mb-0">Ja tem uma conta? <a class="btn-link"
                                href="{{ route('login') }}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

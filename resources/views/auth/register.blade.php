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
                                    @include("layouts.select_country")
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

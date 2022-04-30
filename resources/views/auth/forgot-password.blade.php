@extends("layouts.app")
@section('content')
    <div id="content">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
                    <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
                        <h3 class="fw-400 text-center mb-4">Sign In</h3>
                        <hr class="mx-n3 mx-sm-n5">
                        <p class=" text-center">Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de
                            e-mail e nós lhe enviaremos um link de redefinição de senha que permitirá que você escolha uma
                            nova.</p>
                        <form id="loginForm" method="post" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="emailAddress" class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                    id="emailAddress" required placeholder="Digite seu email">
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            @if (session('status'))
                                <div class="alert alert-success">
                                    <p>{{ session('status') }}</p>
                                </div>
                            @endif


                            <div class="d-grid mb-3"><button class="btn btn-primary" type="submit">Enviar</button></div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

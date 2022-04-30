@extends("layouts.app")
@section('content')
    <div id="content">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
                    <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
                        <h3 class="fw-400 text-center mb-4">Definir Nova Senha</h3>
                        <hr class="mx-n3 mx-sm-n5">
                        <p class=" text-center">Reedefina a sua nova senha.</p>
                        <form id="loginForm" method="post" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="mb-3">
                                <label for="emailAddress" class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                    id="emailAddress" required placeholder="Digite seu email">
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Nova Senha</label>
                                <input type="password" name="password" class="form-control"
                                    id="senha" required placeholder="Digite sua Nova">
                            </div>
                            <div class="mb-3">
                                <label for="confimar_senha" class="form-label">Confirmar     Senha</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="confimar_senha" required placeholder="Confrime Sua Nova Senha">
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            @if (session('status'))
                                <div class="alert alert-primary">
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

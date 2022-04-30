@extends("layouts.app")
@section('content')
    <div id="content">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
                    <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
                        <h3 class="fw-400 text-center mb-4">Verificar Email</h3>
                        <hr class="mx-n3 mx-sm-n5">
                        <p class=" text-center">Obrigado por inscrever-se! Antes de começar, você poderia verificar seu
                            endereço de e-mail clicando no link que acabamos de enviar para você? Se você não recebeu o
                            e-mail, teremos o prazer de lhe enviar outro.</p>
                        <form id="loginForm" method="post" action="{{ route('verification.send') }}">
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
                                <div class="alert alert-primary">
                                    <p>A new verification link has been sent to the email address you provided during
                                        registration.</p>
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

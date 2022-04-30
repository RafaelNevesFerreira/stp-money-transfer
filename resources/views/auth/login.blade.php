@extends("layouts.app")
@section('content')
    <div id="content">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
                    <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
                        <h3 class="fw-400 text-center mb-4">Sign In</h3>
                        <hr class="mx-n3 mx-sm-n5">
                        <p class="lead text-center">We are glad to see you again!</p>
                        <form id="loginForm" method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="emailAddress" class="form-label">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                    id="emailAddress" required placeholder="Enter Your Email">
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">Password</label>
                                <input type="password" name="password" required autocomplete="current-password"
                                    class="form-control" id="loginPassword" required placeholder="Enter Password">
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            <div class="row mb-3">
                                <div class="col-sm">
                                    <div class="form-check form-check-inline">
                                        <label for="remember_me" class="inline-flex items-center">
                                            <input id="remember_me" type="checkbox"
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                name="remember">
                                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                        </label>
                                    </div>
                                </div>
                                @if (Route::has('password.request'))
                                    <div class="col-sm text-end">
                                        <a class="btn-link" href="{{ route('password.request') }}">
                                            Forgot Password ?
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="d-grid mb-3"><button class="btn btn-primary" type="submit">Sign In</button></div>
                        </form>
                        <p class="text-3 text-muted text-center mb-0">Don't have an account? <a class="btn-link"
                                href="signup-3.html">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

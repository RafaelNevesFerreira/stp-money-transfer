@extends("layouts.profile.app")
@section('content')
    <!-- Content
                                  ============================================= -->
    <div id="content" class="py-4">
        <div class="container">
            <div class="row">

                <!-- Left Panel
                                        ============================================= -->
                @include('layouts.profile.left-painel')

                <!-- Left Panel End -->

                <!-- Middle Panel
                                        ============================================= -->
                <div class="col-lg-9">

                    <!-- Personal Details
                                          ============================================= -->
                    <div class="bg-white shadow-sm rounded p-4 mb-4">
                        <h3 class="text-5 fw-400 d-flex align-items-center mb-4">Detalhes Pessoais<a
                                href="#edit-personal-details" data-bs-toggle="modal"
                                class="ms-auto text-2 text-uppercase btn-link"><span class="me-1"><i
                                        class="fas fa-edit"></i></span>Editar</a></h3>
                        <hr class="mx-n4 mb-4">
                        <div class="row gx-3 align-items-center">
                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Nome:</p>
                            <p class="col-sm-9 text-3">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="row gx-3 align-items-center">
                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Data de Registro:</p>
                            <p class="col-sm-9 text-3">{{ Auth::user()->created_at }}</p>
                        </div>
                        <div class="row gx-3 align-items-center">
                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Telemovel:</p>
                            <p class="col-sm-9 text-3">{{ Auth::user()->phone_number }}</p>
                        </div>
                        <div class="row gx-3 align-items-baseline">
                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Morada:</p>
                            <p class="col-sm-9 text-3">{{ Auth::user()->address }},<br>
                                {{ Auth::user()->country }}<br>
                        </div>
                    </div>
                    <!-- Edit Details Modal
                                          ================================== -->
                    <div id="edit-personal-details" class="modal fade " role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-400">Personal Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <form id="personaldetails" method="post" action="{{route("profille.change.data")}}">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-12 col-sm-6">
                                                <label for="name" class="form-label">Nome</label>
                                                <input type="text" value="{{ Auth::user()->name }}" class="form-control"
                                                    data-bv-field="name" name="name" id="name" required placeholder="Nome">
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label for="phone_number" class="form-label">Telemovel</label>
                                                <input type="number" value="{{ Auth::user()->phone_number }}"
                                                    class="form-control" name="phone_number" data-bv-field="phone_number" id="phone_number"
                                                    required placeholder="Telemovel">
                                            </div>
                                        </div>

                                        <h3 class="text-5 fw-400 mt-4">Morada</h3>
                                        <hr>
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <label for="address" class="form-label">Morada</label>
                                                <input type="text" value="{{ Auth::user()->address }}"
                                                    class="form-control" name="address" data-bv-field="address" id="address" required
                                                    placeholder="Morada">
                                            </div>
                                            <div class="col-6">
                                                <label for="country" class="form-label">Pais</label>
                                                <input type="text" value="{{ Auth::user()->country }}"
                                                    class="form-control" name="country" data-bv-field="country" id="country" required
                                                    placeholder="Pais">
                                            </div>
                                            <div class="col-12 mt-4 d-grid"><button class="btn btn-primary"
                                                    type="submit">Salvar Mudanças</button></div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Personal Details End -->


                    <!-- Email Addresses               ============================================= -->
                    <div class="bg-white shadow-sm rounded p-4 mb-4">
                        <h3 class="text-5 fw-400 d-flex align-items-center mb-4">Email<a href="#edit-email"
                                data-bs-toggle="modal" class="ms-auto text-2 text-uppercase btn-link"><span
                                    class="me-1"><i class="fas fa-edit"></i></span>Editar</a></h3>
                        <hr class="mx-n4 mb-4">
                        <div class="row gx-3 align-items-center">
                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email :</p>
                            <p class="col-sm-9 text-3 d-sm-inline-flex d-md-flex align-items-center">
                                {{ Auth::user()->email }}
                            </p>
                        </div>

                    </div>
                    <!-- Edit Details Modal     ================================== -->
                    <div id="edit-email" class="modal fade" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-400">Endereço Eletornico</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <form id="emailAddresses" method="post">
                                        <div class="mb-3">
                                            <label for="email" class="form-label d-inline-flex align-items-center">
                                                Email
                                            </label>
                                            <input type="text" value="smithrhodes1982@gmail.com" class="form-control"
                                                data-bv-field="email" id="email" required placeholder="Email">
                                        </div>
                                        <div class="alert alert-warning">
                                            <p>Atenção</p>
                                            <p>Uma vez que trocar esse email, ele ja não sera valido na hora de entrar na sua conta.
                                                sera enviado um email de confirmação para o novo email, e se não confirmar , tambem não tera acesso aos seu dados</p>
                                        </div>
                                        <div class="d-grid w-100"><button class="btn btn-primary" type="submit">Salvar
                                                Mudanças</button></div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Email Addresses End -->

                </div>
                <!-- Middle Panel End -->
            </div>
        </div>
    </div>
    <!-- Content end -->
@endsection

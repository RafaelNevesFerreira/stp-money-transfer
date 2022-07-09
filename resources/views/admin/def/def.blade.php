@extends("layouts.admin.app")
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Topbar Start -->
            @include('layouts.admin.topbar')
            <!-- end Topbar -->

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ env('APP_NAME') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Site</a></li>
                                    <li class="breadcrumb-item active">Definições</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Definições do Sistema</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">Dados Sobre o contato</h4>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="input-sizes-preview">
                                        <form action="{{ route('admin.contact.submit') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <div class="row ">
                                                    <div class="col-sm-6">
                                                        <label for="email_1" class="form-label mt-3">Email 1</label>

                                                        <input type="email" name="email_1" value="{{ $contact->email_1 }}"
                                                            id="email_1" class="form-control" placeholder="Email 1">
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <label for="email_2" class="form-label mt-3">Email 2</label>

                                                        <input type="email" name="email_2" value="{{ $contact->email_2 }}"
                                                            id="email_2" class="form-control" placeholder="Email 2">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="row ">
                                                    <div class="col-sm-6 ">
                                                        <label for="telefone_1" class="form-label mt-3">Telefone 1</label>

                                                        <input type="text" name="phone_1" id="telefone_1"
                                                            value="{{ $contact->phone_1 }}" class="form-control"
                                                            placeholder="Telefone 1">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="telefone2" class="form-label mt-3">Telefone 2</label>

                                                        <input type="text" name="phone_2" id="telefone2"
                                                            value="{{ $contact->phone_2 }}" class="form-control"
                                                            placeholder="Telefone 2">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row ">
                                                    <div class="col-sm-12">
                                                        <label class="form-label">Endereço</label>
                                                        <p class="text-muted font-13">
                                                            A Baixo fica o endereço onde os receptores irão levantar o
                                                            dinheiro
                                                        </p>
                                                        <textarea data-toggle="maxlength" name="address" class="form-control" maxlength="225" rows="3"
                                                            placeholder="Esta area de texto é limitada a 225 caracteres.">{{ $contact->address }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary rounded-pill">Atualizar</button>
                                        </form>
                                    </div> <!-- end preview-->
                                </div> <!-- end tab-content-->

                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        @include('layouts.admin.footer')
        <!-- end Footer -->

    </div>
@endsection

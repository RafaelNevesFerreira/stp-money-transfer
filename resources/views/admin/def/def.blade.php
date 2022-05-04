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
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">Definições sobre pagamento em Prestações</h4>
                                <p class="text-muted font-14">
                                    Set heights using classes like <code>.input-lg</code>, and set widths using grid column
                                    classes like <code>.col-lg-*</code>.
                                </p>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="input-sizes-preview">
                                        <form>
                                            <div class="mb-3">
                                                <div class="row ">
                                                    <div class="col-sm-6">
                                                        <label for="valor_minimo_prestacoes" class="form-label mt-3">Valor
                                                            minimo aceitavel</label>

                                                        <input type="number" id="valor_minimo_prestacoes"
                                                            class="form-control" value="{{ $defs->min_val }}" placeholder="Valor minimo">
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <label for="valor_maximo_prestacoes" class="form-label mt-3">Valor
                                                            maximo aceitavel</label>

                                                        <input type="number" value="{{ $defs->max_val }}" id="valor_maximo_prestacoes"
                                                            class="form-control" placeholder="Valor maximo">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="row ">
                                                    <div class="col-sm-6  mt-3">
                                                        <label for="precentagem_cobrada" class="form-label mb-3 center">Opção pagar
                                                            em prestações</label>
                                                        <input type="checkbox" id="switch1" checked data-switch="bool" />
                                                        <label for="switch1" data-on-label="Sim"
                                                            data-off-label="Não"></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="precentagem_cobrada" class="form-label mt-3">Percentagem
                                                            Cobrada</label>

                                                        <input type="number" value="{{ $defs->percentage }}" id="precentagem_cobrada" class="form-control"
                                                            placeholder="Percentagem Cobrada">
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="row ">
                                                    <div class="col-sm-6">
                                                        <label for="valor_minimo_trasacoes" class="form-label mt-3">Numero
                                                            de Transações Minimas</label>
                                                        <input type="number"value="{{ $defs->min_transactions }}" id="valor_minimo_trasacoes"
                                                            class="form-control" placeholder="Valor minimo">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary rounded-pill">Atualizar</button>
                                        </form>
                                    </div> <!-- end preview-->
                                </div> <!-- end tab-content-->
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">Dados Sobre o contato</h4>
                                <p class="text-muted font-14">
                                    Easily extend form controls by adding text, buttons, or button groups on either side of
                                    textual inputs, custom selects, and custom file inputs
                                </p>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="input-sizes-preview">
                                        <form>
                                            <div class="mb-3">
                                                <div class="row ">
                                                    <div class="col-sm-6">
                                                        <label for="email_1" class="form-label mt-3">Email 1</label>

                                                        <input type="email" id="email_1" class="form-control"
                                                            placeholder="Email 1">
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <label for="email_2" class="form-label mt-3">Email 2</label>

                                                        <input type="email" id="email_2" class="form-control"
                                                            placeholder="Email 2">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="row ">
                                                    <div class="col-sm-6 ">
                                                        <label for="telefone_1" class="form-label mt-3">Telefone 1</label>

                                                        <input type="number" id="telefone_1" class="form-control"
                                                            placeholder="Telefone 1">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="telefone2" class="form-label mt-3">Telefone 2</label>

                                                        <input type="number" id="telefone2" class="form-control"
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
                                                        <textarea data-toggle="maxlength" class="form-control" maxlength="225" rows="3"
                                                            placeholder="Esta area de texto é limitada a 225 caracteres."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary rounded-pill">Atualizar</button>
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

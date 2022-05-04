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
                                                            class="form-control" placeholder="Valor minimo">
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <label for="valor_maximo_prestacoes" class="form-label mt-3">Valor
                                                            maximo aceitavel</label>

                                                        <input type="number" id="valor_maximo_prestacoes"
                                                            class="form-control" placeholder="Valor maximo">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="row ">
                                                    <div class="col-sm-6 mt-3">
                                                        <label for="precentagem_cobrada" class="form-label ">Percentagem
                                                            Cobrada</label>
                                                        <br>
                                                        <input type="checkbox" id="switch1" checked data-switch="bool" />
                                                        <label for="switch1" data-on-label="Sim"
                                                            data-off-label="Não"></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="precentagem_cobrada" class="form-label mt-3">Percentagem
                                                            Cobrada</label>

                                                        <input type="number" id="precentagem_cobrada" class="form-control"
                                                            placeholder="Percentagem Cobrada">
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="row ">
                                                    <div class="col-sm-6">
                                                        <label for="valor_minimo_trasacoes" class="form-label mt-3">Numero
                                                            de Transações Minimas</label>
                                                        <input type="number" id="valor_minimo_trasacoes"
                                                            class="form-control" placeholder="Valor minimo">
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <label for="valor_maximo_prestacoes" class="form-label mt-3">Valor
                                                            maximo aceitavel</label>

                                                        <input type="number" id="valor_maximo_prestacoes"
                                                            class="form-control" placeholder="Valor maximo">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div> <!-- end preview-->
                                </div> <!-- end tab-content-->
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">Input Group</h4>
                                <p class="text-muted font-14">
                                    Easily extend form controls by adding text, buttons, or button groups on either side of
                                    textual inputs, custom selects, and custom file inputs
                                </p>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="input-group-preview">
                                        <form>
                                            <div class="mb-3">
                                                <label class="form-label">Static</label>
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text" id="basic-addon1">@</span>
                                                    <input type="text" class="form-control" placeholder="Username"
                                                        aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Dropdowns</label>
                                                <div class="input-group">
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">Dropdown</button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="" aria-label=""
                                                        aria-describedby="basic-addon1">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Buttons</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        placeholder="Recipient's username"
                                                        aria-label="Recipient's username">
                                                    <button class="btn btn-dark" type="button">Button</button>
                                                </div>
                                            </div>

                                            <div class="row g-2">
                                                <div class="col-sm-6">
                                                    <label class="form-label">File input</label>
                                                    <input class="form-control" type="file" id="inputGroupFile04">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="formFileMultiple01" class="form-label">Multiple files
                                                        input</label>
                                                    <input class="form-control" type="file" id="formFileMultiple01"
                                                        multiple>
                                                </div>
                                            </div>
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

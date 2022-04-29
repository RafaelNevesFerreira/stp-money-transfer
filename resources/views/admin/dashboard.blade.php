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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">CRM</li>
                                </ol>
                            </div>
                            <h4 class="page-title">CRM</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h5 class="text-muted fw-normal mt-0" title="N⁰. Transações da semana">
                                            N⁰. Transações da semana</h5>
                                        <h3 class="my-2 py-1">{{ $transfers_esta_semana }}</h3>
                                        <p class="mb-0 text-muted">
                                            @switch($aumento_em_relacao_a_semana_passada)
                                                @case($aumento_em_relacao_a_semana_passada < 0)
                                                    <span class="text-danger me-2">
                                                        <i class="mdi mdi-arrow-down-bold"></i>
                                                        {{ number_format($aumento_em_relacao_a_semana_passada, 1, ',', '.') }}%
                                                    </span>Semana passada
                                                @break

                                                @case($aumento_em_relacao_a_semana_passada >= 0)
                                                    <span class="text-success me-2">
                                                        <i class="mdi mdi-arrow-up-bold"></i>
                                                        {{ number_format($aumento_em_relacao_a_semana_passada, 2, ',', '.') }}%
                                                    </span>Semana passada
                                                @break
                                            @endswitch
                                        </p>
                                    </div>

                                </div> <!-- end row-->
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h5 class="text-muted fw-normal mt-0 " title="Novos Usuarios este mês">Novos
                                            Usuarios este mês
                                        </h5>
                                        <h3 class="my-2 py-1">{{ $novos_usuarios_esse_mes }}</h3>
                                        <p class="mb-0 text-muted">
                                            @switch($aumento_de_usuarios_em_relacao_aom_mes_passado)
                                                @case($aumento_de_usuarios_em_relacao_aom_mes_passado < 0)
                                                    <span class="text-danger me-2">
                                                        <i class="mdi mdi-arrow-down-bold"></i>
                                                        {{ number_format($aumento_de_usuarios_em_relacao_aom_mes_passado, 1, ',', '.') }}%
                                                    </span>Mês passado
                                                @break

                                                @case($aumento_de_usuarios_em_relacao_aom_mes_passado >= 0)
                                                    <span class="text-success me-2">
                                                        <i class="mdi mdi-arrow-up-bold"></i>
                                                        {{ number_format($aumento_de_usuarios_em_relacao_aom_mes_passado, 2, ',', '.') }}%
                                                    </span>Mês passado
                                                @break
                                            @endswitch
                                        </p>
                                    </div>

                                </div> <!-- end row-->
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h5 class="text-muted fw-normal mt-0 " title="Prestações da semana">N⁰. Prestações
                                            da semana</h5>
                                        <h3 class="my-2 py-1">{{ $numero_de_prestações_da_semana }}</h3>
                                        <br>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h5 class="text-muted fw-normal mt-0" title="Saldo Semanal">
                                            Saldo Semanal</h5>
                                        <h3 class="my-2 py-1">{{ number_format($saldo_semanal, 2, ',', '.') }}</h3>
                                        <p class="mb-0 text-muted">
                                            @switch($saldo_semana_passada)
                                                @case($saldo_semana_passada < 0)
                                                    <span class="text-danger me-2">
                                                        <i class="mdi mdi-arrow-down-bold"></i>
                                                        {{ number_format($saldo_semana_passada, 1, ',', '.') }}%
                                                    </span>Semana passada
                                                @break

                                                @case($saldo_semana_passada >= 0)
                                                    <span class="text-success me-2">
                                                        <i class="mdi mdi-arrow-up-bold"></i>
                                                        {{ number_format($saldo_semana_passada, 2, ',', '.') }}%
                                                    </span>Semana passada
                                                @break
                                            @endswitch
                                        </p>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-1">Receita do Mês</h4>

                                <div id="dash-campaigns-chart" class="apex-charts" data-colors="#dc3545,#727cf5,#0acf97">
                                </div>

                                <div class="row text-center mt-2">
                                    <div class="col-sm-6">
                                        <i class="mdi mdi-send widget-icon rounded-circle bg-light-lighten text-muted"></i>
                                        <h3 class="fw-normal mt-4">
                                            <span>{{ number_format($pago_emprestacoes, 2, ',', '.') }} €</span>
                                        </h3>
                                        <p class="text-muted  mb-3">
                                            <i class="mdi mdi-checkbox-blank-circle text-danger"></i> Pago em Prestações
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <i
                                            class="mdi mdi-flag-variant widget-icon rounded-circle bg-light-lighten text-muted"></i>
                                        <h3 class="fw-normal mt-4">
                                            <span>{{ number_format($pago_em_cash, 2, ',', '.') }} €</span>
                                        </h3>
                                        <p class="text-muted  mb-3">
                                            <i class="mdi mdi-checkbox-blank-circle text-primary"></i>
                                            Pago na Totalidade
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body-->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col-->

                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Receita</h4>

                                <div class="chart-content-bg">
                                    <div class="row text-center">
                                        <div class="col-sm-6">
                                            <p class="text-muted mb-0 mt-3">Mês Corrente</p>
                                            <h2 class="fw-normal mb-3" id="esse_ano"
                                                data-meses="{{ json_encode($lucros_desse_ano) }}">
                                                <span>{{ number_format($lucros_desse_ano[(int) date('m') - 1], 2, ',', '.') }}
                                                    €</span>
                                            </h2>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="text-muted mb-0 mt-3">Mês Passado</p>
                                            <h2 class="fw-normal mb-3" id="ano_passado"
                                                data-meses="{{ json_encode($lucros_ano_passado) }}">
                                                <span>{{ number_format($lucros_desse_ano[(int) date('m') - 2], 2, ',', '.') }}
                                                    €</span>
                                            </h2>
                                        </div>
                                    </div>
                                </div>

                                <div dir="ltr">
                                    <div id="dash-revenue-chart" class="apex-charts" data-colors="#0acf97,#fa5c7c">
                                    </div>
                                </div>

                            </div>
                            <!-- end card body-->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col-->
                </div>
                <!-- end row-->


                <div class="row">
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Transações Recentes
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm table-nowrap table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Leads</th>
                                                <th>Deals</th>
                                                <th>Tasks</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h5 class="font-15 mb-1 fw-normal">Jeremy Young</h5>
                                                    <span class="text-muted font-13">Senior Sales Executive</span>
                                                </td>
                                                <td>187</td>
                                                <td>154</td>
                                                <td>49</td>
                                                <td class="table-action">
                                                    <a href="javascript: void(0);" class="action-icon"> <i
                                                            class="mdi mdi-eye"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5 class="font-15 mb-1 fw-normal">Thomas Krueger</h5>
                                                    <span class="text-muted font-13">Senior Sales Executive</span>
                                                </td>
                                                <td>235</td>
                                                <td>127</td>
                                                <td>83</td>
                                                <td class="table-action">
                                                    <a href="javascript: void(0);" class="action-icon"> <i
                                                            class="mdi mdi-eye"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5 class="font-15 mb-1 fw-normal">Pete Burdine</h5>
                                                    <span class="text-muted font-13">Senior Sales Executive</span>
                                                </td>
                                                <td>365</td>
                                                <td>148</td>
                                                <td>62</td>
                                                <td class="table-action">
                                                    <a href="javascript: void(0);" class="action-icon"> <i
                                                            class="mdi mdi-eye"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5 class="font-15 mb-1 fw-normal">Mary Nelson</h5>
                                                    <span class="text-muted font-13">Senior Sales Executive</span>
                                                </td>
                                                <td>753</td>
                                                <td>159</td>
                                                <td>258</td>
                                                <td class="table-action">
                                                    <a href="javascript: void(0);" class="action-icon"> <i
                                                            class="mdi mdi-eye"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5 class="font-15 mb-1 fw-normal">Kevin Grove</h5>
                                                    <span class="text-muted font-13">Senior Sales Executive</span>
                                                </td>
                                                <td>458</td>
                                                <td>126</td>
                                                <td>73</td>
                                                <td class="table-action">
                                                    <a href="javascript: void(0);" class="action-icon"> <i
                                                            class="mdi mdi-eye"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div>
                    <!-- end col-->

                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-4">Novos Usuarios</h4>

                                @forelse ($usuarios_desse_mes as $user)
                                    <div class="d-flex align-items-start">
                                        <img class="me-3 rounded-circle" src="{{asset("images/profile") . "/" . $user->avatar}}" width="40"
                                        alt="Generic placeholder image">
                                        <div class="w-100 overflow-hidden">
                                            <h5 class="mt-0 mb-1">{{$user->name}}</h5>
                                            <span class="font-13">{{$user->email}}</span>
                                        </div>
                                    </div>
                                @empty
                                <div class="alert alert-warning">
                                    <p>Nenhum Usuario registrado este mês</p>
                                </div>
                                @endforelse
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card-->
                    </div>
                    <!-- end col -->

                    <div class="col-xl-4 col-lg-6">
                        <div class="card cta-box bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-center">
                                    <div class="w-100 overflow-hidden">
                                        <h2 class="mt-0">
                                            <h3 class="m-0 fw-normal cta-box-title">Enhance your <b>Campaign</b> for
                                                better
                                                outreach <i class="mdi mdi-arrow-right"></i></h3>
                                    </div>
                                    {{-- <img class="ms-3" src="assets/images/email-campaign.svg" width="120"
                                        alt="Generic placeholder image"> --}}
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card-->

                        <!-- Todo-->
                        <div class="card">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                    </div>
                                </div>
                                <h4 class="header-title mb-2">Todo</h4>

                                <div class="todoapp">
                                    <div data-simplebar style="max-height: 224px">
                                        <ul class="list-group list-group-flush todo-list" id="todo-list"></ul>
                                    </div>
                                </div> <!-- end .todoapp-->

                            </div> <!-- end card-body -->
                        </div> <!-- end card-->

                    </div>
                    <!-- end col -->
                </div>
                <!-- end row-->

            </div> <!-- container -->

        </div> <!-- content -->

        @include('layouts.admin.footer')

    </div>
@endsection

@section('scripts')
    <script>
        var esse_ano = jQuery.parseJSON($("#esse_ano").attr("data-meses"))
        var ano_passado = jQuery.parseJSON($("#ano_passado").attr("data-meses"))

        var pago_em_prestacoes_percentagem =
            {{ number_format(($pago_emprestacoes * 100) / ($pago_emprestacoes + $pago_em_cash)) }}
        var pago_em_cash_percentagem = {{ number_format(($pago_em_cash * 100) / ($pago_emprestacoes + $pago_em_cash)) }}

        $(document).ready(function() {
            $(".apexcharts-yaxis-texts-g").children("text").children("tspan").each(function(index) {
                $(this).text(parseFloat($(this).text().substr(0, 7)).toLocaleString('pt-Pt') + " €");
            });

        })
    </script>

    <!-- Apex js -->
    <script src="{{ asset('assets/dashboard/js/vendor/apexcharts.min.js') }}"></script>

    <!-- Todo js -->
    <script src="{{ asset('assets/dashboard/js/ui/component.todo.js') }}"></script>

    <!-- demo app -->
    <script src="{{ asset('assets/dashboard/js/pages/demo.dashboard-crm.js') }}"></script>
    <!-- end demo js-->
@endsection

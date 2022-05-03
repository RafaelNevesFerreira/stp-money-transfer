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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{env("APP_NAME")}}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Dashboard 2</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Dashboard 2</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-5 col-lg-6">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-account-multiple widget-icon"></i>
                                        </div>
                                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Prestações
                                        </h5>
                                        <h3 class="mt-3 mb-3">{{ number_format($sem_prestacoes, 2, ',', '.') }} €
                                        </h3>

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-sm-6">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-cart-plus widget-icon"></i>
                                        </div>
                                        <h5 class="text-muted fw-normal mt-0" title="Number of Orders"> Sem Prestações</h5>
                                        <h3 class="mt-3 mb-3">{{ number_format($prestacoes, 2, ',', '.') }} €</h3>

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-currency-usd widget-icon"></i>
                                        </div>
                                        <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Total</h5>
                                        <h3 class="mt-3 mb-3">{{ number_format($prestacoes + $sem_prestacoes, 2, ',', '.') }} €</h3>

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-sm-6">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-pulse widget-icon"></i>
                                        </div>
                                        <h5 class="text-muted fw-normal mt-0" title="Growth">Atenção</h5>
                                        <h6 class="mt-3 mb-3">Valores Referentes ao mês corrente</h6>

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div> <!-- end row -->

                    </div> <!-- end col -->

                    <div class="col-xl-7 col-lg-6">
                        <div class="card card-h-100">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                </div>
                                <h4 class="header-title mb-3">receita anual</h4>

                                <div dir="ltr">
                                    <div id="high-performing-product" class="apex-charts" data-colors="#fa5c7c,#727cf5">
                                    </div>
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Receita Diaria</h4>

                                <div class="chart-content-bg">
                                    <div class="row text-center">
                                        <div class="col-sm-6">
                                            <p class="text-muted mb-0 mt-3">Esta Semana</p>
                                            <h2 class="fw-normal mb-3">
                                                <small
                                                    class="mdi mdi-checkbox-blank-circle text-primary align-middle me-1"></small>
                                                <span>{{ number_format($saldo_semanal, 2, ',', '.') }} €</span>
                                            </h2>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="text-muted mb-0 mt-3">Semana Passada</p>
                                            <h2 class="fw-normal mb-3">
                                                <small
                                                    class="mdi mdi-checkbox-blank-circle text-success align-middle me-1"></small>
                                                <span>{{ number_format($saldo_semana_passada, 2, ',', '.') }} €</span>
                                            </h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="dash-item-overlay d-none d-md-block" dir="ltr">
                                    <h5>Esta Semana: {{ number_format($saldo_semanal, 2, ',', '.') }} €</h5>

                                </div>
                                <div dir="ltr">
                                    <div id="revenue-chart" class="apex-charts mt-3" data-colors="#727cf5,#0acf97"></div>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">RECEITA POR LOCAL</h4>
                                <div class="mb-4 mt-4">
                                    <div id="world-map-markers" style="height: 224px"></div>
                                </div>
                                @foreach ($paises as $pais)
                                    <h5 class="mb-1 mt-0 fw-normal">{{ $pais['name'] }}</h5>
                                    <div class="progress-w-percent">
                                        <span class="progress-value fw-bold">{{ number_format($pais['value']) }} €</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ number_format($pais['value']) / 100 }}%;"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @endforeach

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-xl-12 col-lg-12 order-lg-2 order-xl-1">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mt-2 mb-3">Top 5 transações</h4>

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap table-hover mb-0">
                                        <tbody>
                                            @forelse ($top_5 as $transactions)
                                                <tr>
                                                    <td>
                                                        <h5 class="font-14 my-1 fw-normal">{{ $transactions->name }}</h5>
                                                        <span
                                                            class="text-muted font-13">{{ $transactions->created_at->format('l d F Y') }}</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 fw-normal">
                                                            {{ $transactions->value_sended }} €</h5>
                                                        <span class="text-muted font-13">Valor</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 fw-normal">{{ $transactions->tax }} €</h5>
                                                        <span class="text-muted font-13">Tax</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 fw-normal">
                                                            {{ $transactions->value_sended + $transactions->tax }} €</h5>
                                                        <span class="text-muted font-13">Total</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <div class="alert alert-warning">
                                                    <p>Nenhuma Transação alta este mês</p>
                                                </div>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <!-- end col -->

                </div>
                <!-- end row -->

            </div>
            <!-- container -->

        </div>
        <!-- content -->

        @include('layouts.admin.footer')

    </div>
@endsection

@section('scripts')
    <script>
        var sem_prestacoes = {{ $sem_prestacoes_grafico }}
        var prestacoes = {{ $prestacoes_grafico }}
        var saldo_esta_semana = {{ $saldo }}
        var semana_passada = {{ $saldo_semana_passada_grafico }}
    </script>
    <!-- third party js -->
    <script src="{{ asset('assets/dashboard/js/vendor/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/vendor/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- third party js ends -->

    <script src="{{ asset('assets/dashboard/js/vendor/apexcharts.min.js') }}"></script>


    <!-- demo app -->
    <script src="{{ asset('assets/dashboard/js/pages/demo.dashboard.js') }}"></script>

    <!-- end demo js-->
@endsection

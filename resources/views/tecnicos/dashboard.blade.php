@extends("tecnicos.app")
@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            @include('tecnicos.topbar')

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Home</li>
                                </ol>
                            </div>
                            <h4 class="page-title">{{ env('APP_NAME') }}</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card widget-inline">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card shadow-none m-0">
                                            <div class="card-body text-center">
                                                <i class="dripicons-calendar text-muted" style="font-size: 24px;"></i>
                                                <h3><span>{{ $abonement_this_month }}</span></h3>
                                                <p class="text-muted font-15 mb-0">Prestações</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card shadow-none m-0 border-start">
                                            <div class="card-body text-center">
                                                <i class=" dripicons-warning text-muted" style="font-size: 24px;"></i>
                                                <h3><span>{{ $reimbursed_this_month }}</span></h3>
                                                <p class="text-muted font-15 mb-0">Canceladas</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card shadow-none m-0 border-start">
                                            <div class="card-body text-center">
                                                <i class="dripicons-broadcast text-muted" style="font-size: 24px;"></i>
                                                <h3><span>{{ $received_this_month }}</span></h3>
                                                <p class="text-muted font-15 mb-0">Recebido</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card shadow-none m-0 border-start">
                                            <div class="card-body text-center">
                                                <i class="dripicons-graph-line text-muted" style="font-size: 24px;"></i>
                                                <h3><span>{{ $to_received_this_month }}</span> <i
                                                        class="mdi mdi-arrow-up text-success"></i></h3>
                                                <p class="text-muted font-15 mb-0">A Receber</p>
                                            </div>
                                        </div>
                                    </div>

                                </div> <!-- end row -->
                            </div>
                        </div> <!-- end card-box-->
                    </div> <!-- end col-->
                </div>
                <!-- end row-->


                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Weekly Report</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Monthly Report</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                    </div>
                                </div>
                                <h4 class="header-title mb-4">Project Status</h4>

                                <div class="my-4 chartjs-chart" style="height: 202px;">
                                    <canvas id="project-status-chart" data-colors="#0acf97,#727cf5,#fa5c7c"></canvas>
                                </div>

                                <div class="row text-center mt-2 py-2">
                                    <div class="col-sm-4">
                                        <div class="my-2 my-sm-0">
                                            <i class="mdi mdi-trending-up text-success mt-3 h3"></i>
                                            <h3 class="fw-normal">
                                                <span>64%</span>
                                            </h3>
                                            <p class="text-muted mb-0">Completed</p>
                                        </div>

                                    </div>
                                    <div class="col-sm-4">
                                        <div class="my-2 my-sm-0">
                                            <i class="mdi mdi-trending-down text-primary mt-3 h3"></i>
                                            <h3 class="fw-normal">
                                                <span>26%</span>
                                            </h3>
                                            <p class="text-muted mb-0"> In-progress</p>
                                        </div>

                                    </div>
                                    <div class="col-sm-4">
                                        <div class="my-2 my-sm-0">
                                            <i class="mdi mdi-trending-down text-danger mt-3 h3"></i>
                                            <h3 class="fw-normal">
                                                <span>10%</span>
                                            </h3>
                                            <p class="text-muted mb-0"> Behind</p>
                                        </div>

                                    </div>
                                </div>
                                <!-- end row-->

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Transações do dia</h4>

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap table-hover mb-0">
                                        <tbody>
                                            @forelse ($transfers_today as $transfer)
                                                <tr>
                                                    <td>
                                                        <h5 class="font-14 my-1"><a href="javascript:void(0);"
                                                                class="text-body">{{ $transfer->name }}</a></h5>
                                                        @if ($transfer->plan === 1)
                                                            <span class="text-muted font-13">A pagar em prestções</span>
                                                        @else
                                                            <span class="text-muted font-13">Pago em cartão de
                                                                credito</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="text-muted font-13">Status</span> <br />
                                                        @if ($transfer->status === 'received')
                                                            <span class="badge badge-success-lighten">Recebido</span>
                                                        @elseif ($transfer->status === 'sended')
                                                            <span class="badge badge-warning-lighten">A receber</span>
                                                        @else
                                                            <span class="badge badge-danger-lighten">Reemborsado</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="text-muted font-13">Receptor</span>
                                                        <h5 class="font-14 mt-1 fw-normal">{{ $transfer->destinatary_name }}
                                                        </h5>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted font-13">Enviado</span>
                                                        <h5 class="font-14 mt-1 fw-normal">
                                                            {{ $transfer->created_at->diffForHumans() }}</h5>
                                                    </td>
                                                    <td class="table-action" style="width: 90px;">
                                                        <a href="#" title="Detalhes" class="action-icon"> <i
                                                                class="mdi mdi-pencil" ></i></a>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse


                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->

            </div> <!-- container -->

        </div> <!-- content -->

        @include('tecnicos.footer')

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
@endsection

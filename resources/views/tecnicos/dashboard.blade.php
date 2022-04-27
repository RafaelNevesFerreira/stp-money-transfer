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


                <div class="row">
                    <div class="col-12">
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
                                <h4 class="header-title mb-4">Tasks Overview</h4>

                                <div dir="ltr">
                                    <div class="mt-3 chartjs-chart" style="height: 320px;">
                                        <canvas id="task-area-chart" data-bgColor="#727cf5"
                                            data-borderColor="#727cf5"></canvas>
                                    </div>
                                </div>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->


                <div class="row">
                    <div class="col-xl-5">
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
                                <h4 class="header-title mb-3">Recent Activities</h4>

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap table-hover mb-0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-start">
                                                        <img class="me-2 rounded-circle"
                                                            src="assets/images/users/avatar-2.jpg" width="40"
                                                            alt="Generic placeholder image">
                                                        <div>
                                                            <h5 class="mt-0 mb-1">Soren Drouin<small
                                                                    class="fw-normal ms-3">18 Jan 2019 11:28 pm</small>
                                                            </h5>
                                                            <span class="font-13">Completed "Design new
                                                                idea"...</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted font-13">Project</span> <br />
                                                    <p class="mb-0">Hyper Mockup</p>
                                                </td>
                                                <td class="table-action" style="width: 50px;">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <!-- item-->
                                                            <a href="javascript:void(0);"
                                                                class="dropdown-item">Settings</a>
                                                            <!-- item-->
                                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-start">
                                                        <img class="me-2 rounded-circle"
                                                            src="assets/images/users/avatar-6.jpg" width="40"
                                                            alt="Generic placeholder image">
                                                        <div>
                                                            <h5 class="mt-0 mb-1">Anne Simard<small
                                                                    class="fw-normal ms-3">18 Jan 2019 11:09 pm</small>
                                                            </h5>
                                                            <span class="font-13">Assigned task "Poster illustation
                                                                design"...</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted font-13">Project</span> <br />
                                                    <p class="mb-0">Hyper Mockup</p>
                                                </td>
                                                <td class="table-action" style="width: 50px;">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <!-- item-->
                                                            <a href="javascript:void(0);"
                                                                class="dropdown-item">Settings</a>
                                                            <!-- item-->
                                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-start">
                                                        <img class="me-2 rounded-circle"
                                                            src="assets/images/users/avatar-3.jpg" width="40"
                                                            alt="Generic placeholder image">
                                                        <div>
                                                            <h5 class="mt-0 mb-1">Nicolas Chartier<small
                                                                    class="fw-normal ms-3">15 Jan 2019 09:29 pm</small>
                                                            </h5>
                                                            <span class="font-13">Completed "Drinking bottle
                                                                graphics"...</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted font-13">Project</span> <br />
                                                    <p class="mb-0">Web UI Design</p>
                                                </td>
                                                <td class="table-action" style="width: 50px;">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <!-- item-->
                                                            <a href="javascript:void(0);"
                                                                class="dropdown-item">Settings</a>
                                                            <!-- item-->
                                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-start">
                                                        <img class="me-2 rounded-circle"
                                                            src="assets/images/users/avatar-4.jpg" width="40"
                                                            alt="Generic placeholder image">
                                                        <div>
                                                            <h5 class="mt-0 mb-1">Gano Cloutier<small
                                                                    class="fw-normal ms-3">10 Jan 2019 08:36 pm</small>
                                                            </h5>
                                                            <span class="font-13">Completed "Design new
                                                                idea"...</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted font-13">Project</span> <br />
                                                    <p class="mb-0">UBold Admin</p>
                                                </td>
                                                <td class="table-action" style="width: 50px;">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <!-- item-->
                                                            <a href="javascript:void(0);"
                                                                class="dropdown-item">Settings</a>
                                                            <!-- item-->
                                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-start">
                                                        <img class="me-2 rounded-circle"
                                                            src="assets/images/users/avatar-5.jpg" width="40"
                                                            alt="Generic placeholder image">
                                                        <div>
                                                            <h5 class="mt-0 mb-1">Francis Achin<small
                                                                    class="fw-normal ms-3">08 Jan 2019 12:28 pm</small>
                                                            </h5>
                                                            <span class="font-13">Assigned task "Hyper app
                                                                design"...</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted font-13">Project</span> <br />
                                                    <p class="mb-0">Website Mockup</p>
                                                </td>
                                                <td class="table-action" style="width: 50px;">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <!-- item-->
                                                            <a href="javascript:void(0);"
                                                                class="dropdown-item">Settings</a>
                                                            <!-- item-->
                                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->

                    <div class="col-xl-7">
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
                                <h4 class="header-title mb-3">Your Calendar</h4>

                                <div class="row">
                                    <div class="col-md-7">
                                        <div data-provide="datepicker-inline" data-date-today-highlight="true"
                                            class="calendar-widget"></div>
                                    </div> <!-- end col-->
                                    <div class="col-md-5">
                                        <ul class="list-unstyled">
                                            <li class="mb-4">
                                                <p class="text-muted mb-1 font-13">
                                                    <i class="mdi mdi-calendar"></i> 7:30 AM - 10:00 AM
                                                </p>
                                                <h5>Meeting with BD Team</h5>
                                            </li>
                                            <li class="mb-4">
                                                <p class="text-muted mb-1 font-13">
                                                    <i class="mdi mdi-calendar"></i> 10:30 AM - 11:45 AM
                                                </p>
                                                <h5>Design Review - Hyper Admin</h5>
                                            </li>
                                            <li class="mb-4">
                                                <p class="text-muted mb-1 font-13">
                                                    <i class="mdi mdi-calendar"></i> 12:15 PM - 02:00 PM
                                                </p>
                                                <h5>Setup Github Repository</h5>
                                            </li>
                                            <li>
                                                <p class="text-muted mb-1 font-13">
                                                    <i class="mdi mdi-calendar"></i> 5:30 PM - 07:00 PM
                                                </p>
                                                <h5>Meeting with Design Studio</h5>
                                            </li>
                                        </ul>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->

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

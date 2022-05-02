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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Usuarios</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Detalhes</a></li>
                                    <li class="breadcrumb-item active">{{ $user->name }}</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Detalhes {{ $user->name }}</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <div class="col-sm-12">
                        <!-- Profile -->
                        <div class="card bg-primary">
                            <div class="card-body profile-user-box">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar-lg">
                                                    <img src="{{ asset('images/profile') . '/' . $user->avatar }}"
                                                        alt="{{ $user->name }} avatar"
                                                        class="rounded-circle img-thumbnail">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <h4 class="mt-1 mb-1 text-white">{{ $user->name }}</h4>
                                                    <p class="font-13 text-white-50">Usuario Convencional</p>

                                                    <ul class="mb-0 list-inline text-light">
                                                        <li class="list-inline-item me-3">
                                                            <h5 class="mb-1">$ 25,184</h5>
                                                            <p class="mb-0 font-13 text-white-50">Total Transações</p>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <h5 class="mb-1">5482</h5>
                                                            <p class="mb-0 font-13 text-white-50">Total Prestações</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col-->

                                    <div class="col-sm-4">
                                        <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                            <button type="button" class="btn btn-light">
                                                <i class="mdi mdi-account-edit me-1"></i> Desativar Usuario
                                            </button>
                                        </div>
                                    </div> <!-- end col-->
                                </div> <!-- end row -->

                            </div> <!-- end card-body/ profile-user-box-->
                        </div>
                        <!--end profile/ card -->
                    </div> <!-- end col-->
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-xl-4">
                        <!-- Personal-Information -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-3">Informações do Usuario</h4>
                                <p class="text-muted font-13">
                                    Ola, este é {{ $user->name }} residente em {{ $user->country }} com morada em
                                    {{ $user->address }}.
                                    {{ $user->name }} se registrou na plataforma {{ env('APP_NAME') }} no dia
                                    {{ $user->created_at->format('d') }} do {{ $user->created_at->format('m') }} de
                                    {{ $user->created_at->format('Y') }}

                                    Des do seu registro, {{ $user->name }} fez {{ $user_total_transactions }}
                                    Transações.
                                    Das {{ $user_total_transactions }} Transações feitas por {{ $user->name }},
                                    {{ $user_total_transactions_sem_prestacoes }} foram em pretações e
                                    {{ $user_total_transactions_prestacoes }} foram pagos na totalidade
                                </p>

                                <hr />

                                <div class="text-start">
                                    <p class="text-muted"><strong>Nome :</strong> <span
                                            class="ms-2">{{ $user->name }}</span></p>

                                    <p class="text-muted"><strong>Telemovel :</strong><span
                                            class="ms-2">{{ $user->phone_number }}</span></p>

                                    <p class="text-muted"><strong>Email :</strong> <span
                                            class="ms-2">{{ $user->email }}</span></p>

                                    <p class="text-muted"><strong>Pais :</strong> <span
                                            class="ms-2">{{ $user->country }}</span></p>

                                    <p class="text-muted"><strong>Ultima Atualização :</strong>
                                        <span class="ms-2"> {{ $user->updated_at->format("d-m-Y") }} </span>
                                    </p>
                                    <p class="text-muted"><strong>Morada :</strong>
                                        <span class="ms-2"> {{ $user->address }} </span>
                                    </p>
                                    <p class="text-muted mb-0" id="tooltip-container">
                                        <strong>Estado :</strong>
                                        @if ($user->status === 1 && $user->email_verified_at)
                                            <span>O Usuario Esta Ativo</span>
                                        @elseif ($user->status === 1 && $user->email_verified_at)
                                            <span>O Usuario Esta Inativo</span>
                                        @else
                                            <span>O Usuario Inativo Pois Ainda Nõ confirmou o seu email</span>
                                        @endif
                                    </p>

                                </div>
                            </div>
                        </div>
                        <!-- Personal-Information -->

                    </div> <!-- end col-->

                    <div class="col-xl-8">

                        <!-- Chart-->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Receita sem prestações</h4>
                                <div dir="ltr">
                                    <div style="height: 260px;" class="chartjs-chart">
                                        <canvas id="high-performing-product"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Chart-->

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card tilebox-one">
                                    <div class="card-body">
                                        <i class="dripicons-basket float-end text-muted"></i>
                                        <h6 class="text-muted text-uppercase mt-0">Prestações a pagar</h6>
                                        <h2 class="m-b-20">€<span>{{number_format($prestacoes_a_pagas,2,",",".")}}</span></h2>
                                        <span class="text-muted">O valor a pagar</span>
                                    </div> <!-- end card-body-->
                                </div>
                                <!--end card-->
                            </div><!-- end col -->

                            <div class="col-sm-4">
                                <div class="card tilebox-one">
                                    <div class="card-body">
                                        <i class="dripicons-box float-end text-muted"></i>
                                        <h6 class="text-muted text-uppercase mt-0">Prestações Pagas</h6>
                                        <h2 class="m-b-20">€<span>{{number_format($prestacoes_pagas,2,",",".")}}</span></h2>
                                        <span class="text-muted">Total Pago</span>
                                    </div> <!-- end card-body-->
                                </div>
                                <!--end card-->
                            </div><!-- end col -->

                            <div class="col-sm-4">
                                <div class="card tilebox-one">
                                    <div class="card-body">
                                        <i class="dripicons-jewel float-end text-muted"></i>
                                        <h6 class="text-muted text-uppercase mt-0">Product Sold</h6>
                                        <h2 class="m-b-20">1,890</h2>
                                        <span class="badge bg-primary"> +89% </span> <span class="text-muted">Last
                                            year</span>
                                    </div> <!-- end card-body-->
                                </div>
                                <!--end card-->
                            </div><!-- end col -->

                        </div>
                        <!-- end row -->




                    </div>
                    <!-- end col -->


                </div>
                <div class="row">
                    <div class="card col-sm-12">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Transações do usuario {{ $user->name }}</h4>

                            <div class="table-responsive">
                                <table id="products-datatable"
                                    class="table table-centered table-borderless table-hover w-100 dt-responsive nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 20px;">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck1">
                                                    <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>De</th>
                                            <th>Para</th>
                                            <th>Valor enviado</th>
                                            <th>Codigo</th>
                                            <th>Status</th>
                                            <th>Enviado</th>
                                            <th style="width: 75px;">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transfers as $transfer)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheck2">

                                                    </div>
                                                </td>
                                                <td class="table-user">
                                                    <a href="javascript:void(0);" class="text-body fw-semibold">
                                                        {{ $transfer->name }}
                                                    </a>
                                                </td>

                                                <td>
                                                    <span
                                                        class="fw-semibold">{{ $transfer->destinatary_name }}</span>
                                                </td>
                                                <td>
                                                    @if ($transfer->currency === 'eur')
                                                        {{ number_format($transfer->value_sended * (int)env('EUR_CAMBIO_VALUE'),2,",",".") }}
                                                    @elseif ($transfer->currency === 'usd')
                                                        {{ number_format($transfer->value_sended * (int)env("USD_CAMBIO_VALUE"),2,",",".") }}
                                                    @else
                                                        {{ number_format($transfer->value_sended * (int)env("GBP_CAMBIO_VALUE"),2,",",".") }}
                                                    @endif

                                                </td>
                                                <td>
                                                    {{ $transfer->transfer_code }}
                                                </td>

                                                <td>
                                                    @if ($transfer->status === 'received')
                                                        <span class="badge badge-success-lighten">Recebido</span>
                                                    @elseif ($transfer->status === 'sended')
                                                        <span class="badge badge-warning-lighten">A receber</span>
                                                    @else
                                                        <span class="badge badge-danger-lighten">Reemborsado</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $transfer->created_at }}
                                                </td>

                                                <td>
                                                    <a href="{{ route("admin.transaction.details",$transfer->id)}}" class="action-icon"> <i
                                                            class="mdi mdi-square-edit-outline"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse

                                    </tbody>
                                </table>
                            </div> <!-- end table responsive-->
                        </div> <!-- end col-->
                    </div> <!-- end row-->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        @include('layouts.admin.footer')
        <!-- end Footer -->

    </div>
@endsection

@section('scripts')
    <script>
        var ano_passado = {{ $ano_passado }}
        var este_ano = {{ $este_ano }}
    </script>
    <!-- third party js -->
    <script src="{{ asset('assets/dashboard/js/vendor/Chart.bundle.min.js') }}"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script src="{{ asset('assets/dashboard/js/pages/demo.profile.js') }}"></script>
@endsection

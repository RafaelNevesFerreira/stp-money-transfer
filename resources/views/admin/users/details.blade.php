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
                                            class="ms-2">{{$user->name}}</span></p>

                                    <p class="text-muted"><strong>Telemovel :</strong><span class="ms-2">{{$user->phone_number}}</span></p>

                                    <p class="text-muted"><strong>Email :</strong> <span
                                            class="ms-2">{{$user->email}}</span></p>

                                    <p class="text-muted"><strong>Pais :</strong> <span
                                            class="ms-2">{{$user->country}}</span></p>

                                    <p class="text-muted"><strong>Morada :</strong>
                                        <span class="ms-2"> {{$user->address}} </span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <!-- Personal-Information -->

                        <!-- Toll free number box-->
                        <div class="card text-white bg-info overflow-hidden">
                            <div class="card-body">
                                <div class="toll-free-box text-center">
                                    <h4> <i class="mdi mdi-deskphone"></i> Toll Free : 1-234-567-8901</h4>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                        <!-- End Toll free number box-->

                        <!-- Messages-->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Messages</h4>

                                <div class="inbox-widget">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg"
                                                class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Tomaslau</p>
                                        <p class="inbox-item-text">I've finished it! See you so...</p>
                                        <p class="inbox-item-date">
                                            <a href="#" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                                        </p>
                                    </div>
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets/images/users/avatar-3.jpg"
                                                class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Stillnotdavid</p>
                                        <p class="inbox-item-text">This theme is awesome!</p>
                                        <p class="inbox-item-date">
                                            <a href="#" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                                        </p>
                                    </div>
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets/images/users/avatar-4.jpg"
                                                class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Kurafire</p>
                                        <p class="inbox-item-text">Nice to meet you</p>
                                        <p class="inbox-item-date">
                                            <a href="#" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                                        </p>
                                    </div>

                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets/images/users/avatar-5.jpg"
                                                class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Shahedk</p>
                                        <p class="inbox-item-text">Hey! there I'm available...</p>
                                        <p class="inbox-item-date">
                                            <a href="#" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                                        </p>
                                    </div>
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets/images/users/avatar-6.jpg"
                                                class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Adhamdannaway</p>
                                        <p class="inbox-item-text">This theme is awesome!</p>
                                        <p class="inbox-item-date">
                                            <a href="#" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                                        </p>
                                    </div>
                                </div> <!-- end inbox-widget -->
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->

                    </div> <!-- end col-->

                    <div class="col-xl-8">

                        <!-- Chart-->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Orders & Revenue</h4>
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
                                        <h6 class="text-muted text-uppercase mt-0">Orders</h6>
                                        <h2 class="m-b-20">1,587</h2>
                                        <span class="badge bg-primary"> +11% </span> <span class="text-muted">From
                                            previous period</span>
                                    </div> <!-- end card-body-->
                                </div>
                                <!--end card-->
                            </div><!-- end col -->

                            <div class="col-sm-4">
                                <div class="card tilebox-one">
                                    <div class="card-body">
                                        <i class="dripicons-box float-end text-muted"></i>
                                        <h6 class="text-muted text-uppercase mt-0">Revenue</h6>
                                        <h2 class="m-b-20">$<span>46,782</span></h2>
                                        <span class="badge bg-danger"> -29% </span> <span class="text-muted">From
                                            previous period</span>
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


                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">My Products</h4>

                                <div class="table-responsive">
                                    <table class="table table-hover table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>ASOS Ridley High Waist</td>
                                                <td>$79.49</td>
                                                <td><span class="badge bg-primary">82 Pcs</span></td>
                                                <td>$6,518.18</td>
                                            </tr>
                                            <tr>
                                                <td>Marco Lightweight Shirt</td>
                                                <td>$128.50</td>
                                                <td><span class="badge bg-primary">37 Pcs</span></td>
                                                <td>$4,754.50</td>
                                            </tr>
                                            <tr>
                                                <td>Half Sleeve Shirt</td>
                                                <td>$39.99</td>
                                                <td><span class="badge bg-primary">64 Pcs</span></td>
                                                <td>$2,559.36</td>
                                            </tr>
                                            <tr>
                                                <td>Lightweight Jacket</td>
                                                <td>$20.00</td>
                                                <td><span class="badge bg-primary">184 Pcs</span></td>
                                                <td>$3,680.00</td>
                                            </tr>
                                            <tr>
                                                <td>Marco Shoes</td>
                                                <td>$28.49</td>
                                                <td><span class="badge bg-primary">69 Pcs</span></td>
                                                <td>$1,965.81</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end table responsive-->
                            </div> <!-- end col-->
                        </div> <!-- end row-->

                    </div>
                    <!-- end col -->

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

@extends("tecnicos.app")
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Topbar Start -->
            @include('tecnicos.topbar')
            <!-- end Topbar -->

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Transações</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Detalhes</a></li>
                                    <li class="breadcrumb-item active">Detalhes </li>
                                </ol>
                            </div>
                            <h4 class="page-title">Detalhes</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-10 col-sm-11">

                        <div class="horizontal-steps mt-4 mb-4 pb-5" id="tooltip-container">
                            <div class="horizontal-steps-content">
                                <div class="step-item">
                                    <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="{{$transfer->created_at}}">Processado</span>
                                </div>
                                <div class="step-item current">
                                    <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="{{$transfer->received_at}}">Recebido</span>
                                </div>
                            </div>

                            <div class="process-line" style="width: 50%;"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->




                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Informações do Emisor</h4>

                                <h5>{{$transfer->name}}</h5>

                                <address class="mb-0 font-14 address-lg">
                                    {{$transfer->address}}<br>
                                    {{$transfer->country}}<br>
                                    <abbr title="Phone">P:</abbr> {{$transfer->phone_number}} <br />
                                    <abbr title="Email">Email:</abbr> {{$transfer->email}}
                                </address>

                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Informações do Pagamento</h4>

                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <p class="mb-2"><span class="fw-bold me-2">Tipo de Pagamento:</span>
                                            @if ($transfer->plan)
                                            Pago em prestções
                                            @else
                                            Pago na totalidade
                                            @endif
                                            </p>
                                        <p class="mb-2"><span class="fw-bold me-2">Provider:</span> Visa
                                            ending in 2851</p>
                                        <p class="mb-2"><span class="fw-bold me-2">Valid Date:</span> 02/2020
                                        </p>
                                        <p class="mb-0"><span class="fw-bold me-2">CVV:</span> xxx</p>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Delivery Info</h4>

                                <div class="text-center">
                                    <i class="mdi mdi-truck-fast h2 text-muted"></i>
                                    <h5><b>UPS Delivery</b></h5>
                                    <p class="mb-1"><b>Order ID :</b> xxxx235</p>
                                    <p class="mb-0"><b>Payment Mode :</b> COD</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->


            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        @include('tecnicos.footer')
        <!-- end Footer -->

    </div>
@endsection

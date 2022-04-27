@extends("tecnicos.app")
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Topbar Start -->
            @include('tecnicos.topbar')
            <!-- end Topbar -->

            <!-- Start Content-->
            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">DashBoard</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Transações</a></li>
                                    <li class="breadcrumb-item active">Todas</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Transações</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

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
                                                <th style="width: 75px;">Action</th>
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
                                                        {{ $transfer->value_sended }} {{ $transfer->currency }}

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
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-square-edit-outline"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
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

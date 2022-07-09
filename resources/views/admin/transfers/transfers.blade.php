@extends("layouts.admin.app")
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Topbar Start -->
            @include('layouts.admin.topbar')
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
                                    <li class="breadcrumb-item"><a href="{{ route('tecnico.dashboard') }}">Dashboard</a>
                                    </li>
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
                                <div class="row mb-2">
                                    <div class="col-sm-5">
                                        <a href="javascript:void(0);" id="nova_transacao" class="btn btn-success mb-2"><i
                                                class="mdi mdi-plus-circle me-2"></i> Nova Transação</a>
                                    </div>
                                </div>
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
                                                        <a href="{{ route('admin.transaction.details', $transfer->id) }}"
                                                            class="text-body fw-semibold">
                                                            {{ $transfer->name }}
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="fw-semibold">{{ $transfer->destinatary_name }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($transfer->currency === 'eur')
                                                            {{ number_format($transfer->value_sended * (int) env('EUR_CAMBIO_VALUE'), 2, ',', '.') }}
                                                        @elseif ($transfer->currency === 'usd')
                                                            {{ number_format($transfer->value_sended * (int) env('USD_CAMBIO_VALUE'), 2, ',', '.') }}
                                                        @else
                                                            {{ number_format($transfer->value_sended * (int) env('GBP_CAMBIO_VALUE'), 2, ',', '.') }}
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
                                                        {{ $transfer->created_at->format('d-m-Y H:i:s') }}
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('admin.transaction.details', $transfer->id) }}"
                                                            class="action-icon">
                                                            <i class="mdi mdi-square-edit-outline"></i>
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
        <div class="modal fade" id="nova_transacao_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.transaction.new') }} " method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row modal-body-row">
                            <div class="mb-3 col-md-12">
                                <label for="tipo_transacao" class="form-label">Tipo de transação</label>
                                <select class="form-select" id="tipo_transacao" name="payment_method">
                                    <option>Escolha o tipo da transação</option>
                                    <option value="transferencia_bancaria">Trânsferencia Bancaria</option>
                                    <option value="mb_way">MB Way</option>
                                    <option value="cash">Liquido</option>
                                </select>
                            </div>
                            <div class="col-lg-6" id="transacao_modal_body_1">
                            </div>
                            <div class="col-lg-6" id="transacao_modal_body_2">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 cambio" hidden>
                                        <label for="youSend" class="form-label">Valor a ser enviado</label>
                                        <div class="input-group">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <input type="text" data-thousands="." data-decimal=","
                                                class="form-control" data-bv-field="youSend" name="valor_enviado"
                                                id="youSend" value="25,00" placeholder="">
                                            <span class="input-group-text p-0">
                                                <select id="youSendCurrency"
                                                    data-style="form-select bg-transparent border-0"
                                                    data-container="body" data-live-search="true" name="moeda"
                                                    class="selectpicker form-control bg-transparent" required="">
                                                    <optgroup label="Moedas Disponiveis">
                                                        <option data-icon="currency-flag currency-flag-eur me-1"
                                                            data-subtext="Euro" selected="selected" value="eur">
                                                            EUR
                                                        </option>
                                                    </optgroup>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">

                                    <div class="mb-3 cambio" hidden>
                                        <label for="recipientGets" class="form-label">Valor a ser recebido</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Dbs</span>
                                            <input type="text" disabled class="form-control" id="recipientGets"
                                                value="625,00">
                                            <span class="input-group-text p-0">
                                                <select id="recipientCurrency" disabled
                                                    data-style="form-select bg-transparent border-0"
                                                    data-container="body"
                                                    class="selectpicker form-control bg-transparent" required="">
                                                    <option data-icon="currency-flag currency-flag-stp me-1"
                                                        data-subtext="Stp dobras" value="">SPT</option>
                                                </select>
                                            </span>


                                        </div>
                                        <hr>
                                        <p>Total Taxas<span class="float-end" id="taxas">6.05
                                                <span>€</span></span></p>
                                        <hr>
                                        <p class="text-4 fw-500">Total a Pagar<span class="float-end"
                                                id="total">31.05
                                                <span>€</span>
                                            </span></p>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

        @include('layouts.admin.footer')
        <!-- end Footer -->

    </div>
@endsection

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
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('tecnico.transactions') }}">Transações</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Detalhes</a></li>
                                    <li class="breadcrumb-item active">#{{ $transfer->transfer_code }} </li>
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
                                        data-bs-placement="bottom" title="{{ $transfer->created_at }}">Processado</span>
                                </div>

                                <div class="step-item">
                                    <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom">Disponivel</span>
                                </div>
                                <div class="step-item current">
                                    <span data-bs-container="#tooltip-container" id="estado_final" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="{{ $transfer->received_at }}">
                                        @if ($transfer->status === 'reimbursed')
                                            Reembolsado
                                        @else
                                            Recebido
                                        @endif

                                    </span>
                                </div>
                            </div>

                            @if ($transfer->received_at || $transfer->status === 'reimbursed')
                                <div class="process-line" style="width: 100%;"></div>
                            @else
                                <div class="process-line" style="width: 50%;"></div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- end row -->




                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Informações do Emisor</h4>

                                <h5>{{ $transfer->name }}</h5>

                                <address class="mb-0 font-14 address-lg">
                                    {{ $transfer->address }}<br>
                                    {{ $transfer->country }}<br>
                                    <abbr title="Phone">P:</abbr> {{ $transfer->phone_number }} <br />
                                    <abbr id="transfer_email" data-transfer-email={{$transfer->email}} title="Email">Email:</abbr> {{ $transfer->email }}
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
                                                Pagar em prestações
                                                {{ ((((int) $transfer->value_sended + $transfer->tax) * 20) / 100 +($transfer->value_sended + $transfer->tax)) /2 }}
                                                € por mês
                                            @else
                                                Pago na totalidade
                                            @endif
                                        </p>
                                        <p class="mb-2"><span class="fw-bold me-2">Valor enviado:</span>
                                            {{ number_format($transfer->value_sended, 2, ',', '.') }}
                                            €
                                        </p>

                                        <p class="mb-2"><span class="fw-bold me-2">Data de Envio:</span>
                                            {{ $transfer->created_at->format('d-m-Y') }} às
                                            {{ $transfer->created_at->format('H:i:s') }}
                                        </p>

                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Informações Recepção</h4>

                                <div class="text-center">
                                    {{-- <i class="mdi mdi-truck-fast h2 text-muted"></i> --}}
                                    <h5><b>{{ $transfer->destinatary_name }}</b></h5>
                                    <p class="mb-1"><b>Codigo :</b> #{{ $transfer->transfer_code }}</p>
                                    <p class="mb-0"><span class="fw-bold me-2">Valor a receber:</span>
                                        {{ number_format($transfer->value_sended * (int) env('EUR_CAMBIO_VALUE'), 2, ',', '.') }}
                                        dbs
                                    </p>
                                    <p class="mt-1">
                                        @if (!$transfer->received_at && $transfer->status != 'reimbursed')
                                            <div>
                                                <span class="fw-bold me-2 estado_recebido">Recebido:</span>
                                                <input type="checkbox" class="label_recebido" id="recebido"
                                                    data-id="{{ $transfer->id }}" data-switch="success" />
                                                <label for="recebido" class="label_recebido" data-on-label="Sim"
                                                    data-off-label="não"></label>
                                            </div>

                                            <div>
                                                <span class="fw-bold me-2 estado_reembolsar">Reembolsado:</span>
                                                <input type="checkbox" class="label_recebido" id="reembolsado"
                                                    data-id="{{ $transfer->id }}" data-switch="success" />
                                                <label for="reembolsado" class="label_recebido" data-on-label="Sim"
                                                    data-off-label="não"></label>
                                            </div>
                                        @elseif ($transfer->status === 'reimbursed')
                                            <span class="fw-bold me-2 estado_reembolsado">Reembolsado:</span>
                                            O Valor foi reembolsado
                                        @else
                                            <span class="fw-bold me-2 estado_reembolsado">Recebido:</span>
                                            {{$transfer->received_at}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
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
@section('scripts')
    <script>
        $("#recebido").click(function() {
            var id, email;
            id = $(this).attr("data-id")
            email = $("#transfer_email").attr("data-transfer-email")

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='_token']").attr("content")
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('admin.change.status') }}",
                data: {
                    "status": "recebido",
                    "id": id,
                    "email" :email
                },
                success: function(data) {
                    $(this).remove();
                    $(".label_recebido").remove();
                    $.NotificationApp.send("Sucesso", "O estado foi atualizado com sucesso",
                        "bottom-right", "Background color", "success")
                    $(".process-line").css("width", "100%")
                }
            });
        })

        $("#reembolsado").click(function() {
            var id, email;
            id = $(this).attr("data-id")

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='_token']").attr("content")
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('admin.change.status') }}",
                data: {
                    "status": "reembolsado",
                    "id": id,
                },
                success: function(data) {
                    $(this).remove();
                    $(".label_recebido").remove();

                    $(".estado_recebido").remove();
                    $(".estado_reembolsar").text("O Valor Foi Reembolsado");
                    $.NotificationApp.send("Sucesso", "O estado foi atualizado com sucesso",
                        "bottom-right", "Background color", "success")
                    $(".process-line").css("width", "100%")
                    $("#estado_final").text("Reembolsado")
                }
            });
        })
    </script>
@endsection

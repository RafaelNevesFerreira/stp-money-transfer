@extends('layouts.admin.app')
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
                                    <li class="breadcrumb-item"><a href="{{ route("admin.transfers") }}">Transações</a>
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
                                    <abbr id="transfer_email" data-transfer-email={{ $transfer->email }}
                                        title="Email">Email:</abbr> {{ $transfer->email }}
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
                                            @if ($transfer->payment_method === 'cash')
                                                Pago em Liquido
                                            @elseif ($transfer->payment_method === 'mb_way')
                                                Pago em transferência Mb Way
                                            @elseif ($transfer->payment_method === 'card')
                                                Pago em cartão de credito
                                            @else
                                                Pago em Transferência Bancaria
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
                                        @if ($transfer->payment_method != 'card')
                                        <div class='mb-3 text-center'><button class='btn btn-primary'
                                                id='detalhes_pagamento' type='button'>Detalhes</button></div>
                                    @endif


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
                                    @if ($transfer->received_at && $transfer->status == 'received')
                                        <h5><b>{{ $transfer->receptor->name }}
                                                {{ $transfer->receptor->last_name }}</b></h5>
                                        <h5><b>Data de nascença: {{ $transfer->receptor->birthday_date }} </b></h5>
                                        <h5><b>Nacionalidade : {{ $transfer->receptor->nationality }}</b></h5>
                                    @endif

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

                                            {{-- <div>
                                                <span class="fw-bold me-2 estado_reembolsar">Reembolsado:</span>
                                                <input type="checkbox" class="label_recebido" id="reembolsado"
                                                    data-id="{{ $transfer->id }}" data-switch="success" />
                                                <label for="reembolsado" class="label_recebido" data-on-label="Sim"
                                                    data-off-label="não"></label>
                                            </div> --}}
                                        @elseif ($transfer->status === 'reimbursed')
                                            <span class="fw-bold me-2 estado_reembolsado">Reembolsado:</span>
                                            O Valor foi reembolsado
                                        @else
                                            <span class="fw-bold me-2 estado_reembolsado">Recebido:</span>
                                            {{ $transfer->received_at }}
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

        <div id="detalhes_do_receptor" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input class="form-control" type="text" name="name" id="name" required
                                placeholder="Nome">
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Apelido</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" required
                                placeholder="Apelido">
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Nacionalidade</label>
                            @include('layouts.select_country')
                        </div>
                        <div class="mb-3">
                            <label for="birthday_date" class="form-label">Data de Nascimento</label>
                            <input class="form-control" type="date" max="{{ date('d/m/Y') }}" name="birthday_date"
                                id="birthday_date" required placeholder="Data de Nascimento">
                        </div>
                        <div class=' erro'>
                        </div>
                        <div class="mb-3 text-center">
                            <button class="btn btn-primary" id="enviar" type="button">Enviar</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div id="detalhes_do_pagamento" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="standard-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="standard-modalLabel">Detalhes</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <p class="mb-2"><span class="fw-bold me-2">Tipo de Pagamento:</span>
                                    @if ($transfer->payment_method === 'cash')
                                        Pago em Liquido
                                    @elseif ($transfer->payment_method === 'mb_way')
                                        Pago em transferência Mb Way
                                    @elseif ($transfer->payment_method === 'card')
                                        Pago em cartão de credito
                                    @else
                                        Pago em Transferência Bancaria
                                    @endif
                                </p>
                                <p class="mb-2"><span class="fw-bold me-2">Valor enviado:</span>
                                    {{ number_format($transfer->value_sended, 2, ',', '.') }}
                                    €
                                </p>

                                <p class="mb-2"><span class="fw-bold me-2">Por:</span>
                                    {{ $transfer->comprovative_user->name }},
                                    @if ($transfer->comprovative_user->role == 2)
                                        Tecnico
                                    @else
                                        Administrador
                                    @endif
                                </p>

                                <img class="img-fluid"
                                    src="{{ asset('images/comprovative') . '/' . $transfer->comprovative->name }}"
                                    alt="">

                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
@endsection
@section('scripts')
    <script>
        $("#recebido").click(function() {
            $("#detalhes_do_receptor").modal("show")
        })
        $("#detalhes_pagamento").click(function() {
            $("#detalhes_do_pagamento").modal("show")
        })

        $("#enviar").click(function() {
            var name, last_name, birthday_date, nationality, id, email;
            name = $("#name").val()
            last_name = $("#last_name").val()
            birthday_date = $("#birthday_date").val()
            nationality = $("#country").val()
            id = $("#recebido").attr("data-id")
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
                    "name": name,
                    "last_name": last_name,
                    "birthday_date": birthday_date,
                    "nationality": nationality,
                    "id": id,
                    "email": email
                },
                success: function(data) {
                    $(this).remove();
                    $(".label_recebido").remove();
                    $.NotificationApp.send("Sucesso", "O estado foi atualizado com sucesso",
                        "bottom-right", "Background color", "success")
                    $(".process-line").css("width", "100%")
                    $("#detalhes_do_receptor").modal("hide")

                },
                error: function(error) {
                    $(".erro").html("<p>" + error.responseJSON.message + "</p>")
                    $(".erro").addClass("alert alert-danger")
                },
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

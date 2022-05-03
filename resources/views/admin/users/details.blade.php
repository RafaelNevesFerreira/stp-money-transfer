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
                                                    <h4 class="mt-1 mb-1 text-white mt-4">{{ $user->name }}</h4>
                                                    <p class="font-13 text-white-50">Usuario Convencional</p>

                                                    <ul class="mb-0 list-inline text-light">
                                                        <li class="list-inline-item me-3">
                                                            <h5 class="mb-1 mt-2">
                                                                {{ $user_total_transactions_sem_prestacoes + $user_total_transactions_prestacoes }}
                                                            </h5>
                                                            <p class="mb-0 font-13 text-white-50 ">Transações</p>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <h5 class="mb-1 mt-2">
                                                                {{ $user->created_at->diffForHumans() }}</h5>
                                                            <p class="mb-0 font-13 text-white-50 ">Cadastrado</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col-->

                                    <div class="col-sm-4 ">
                                        <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                            <form action="{{ route('admin.user.desactive', $user->id) }}" method="post">
                                                <div>
                                                    @csrf
                                                    <button type="submit" class="btn btn-light">
                                                        <i class="mdi mdi-account-clock me-1"></i>
                                                        @if ($user->status === 0)
                                                            Ativar Usuario
                                                        @else
                                                            Desativar Usuario
                                                        @endif
                                                    </button>
                                            </form>
                                        </div>
                                        <div>
                                            <button type="submit" id="ativar_user" class="btn btn-light mt-3">
                                                <i class="mdi mdi-account-edit me-1"></i>
                                                Atualizar
                                            </button>
                                        </div>
                                        @if ($user->email_verified_at === null)
                                            <div>
                                                <form action="{{ route('admin.user.verify.email', $user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-light mt-3">
                                                        <i class="mdi mdi-email-alert me-1"></i>
                                                        Reenviar Email de Verificação
                                                    </button>
                                                </form>
                                            </div>
                                        @endif

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

                                <p class="text-muted"><strong>Email :</strong>
                                    <span id="user_email" class="ms-2">{{ $user->email }}</span>
                                </p>

                                <p class="text-muted"><strong>Pais :</strong> <span
                                        class="ms-2">{{ $user->country }}</span></p>

                                <p class="text-muted"><strong>Ultima Atualização :</strong>
                                    <span class="ms-2"> {{ $user->updated_at->format('d-m-Y') }} </span>
                                </p>
                                <p class="text-muted"><strong>Morada :</strong>
                                    <span class="ms-2"> {{ $user->address }} </span>
                                </p>
                                <p class="text-muted mb-0" id="tooltip-container">
                                    <strong>Estado :</strong>
                                    @if ($user->status === 1 && $user->email_verified_at)
                                        <span>O Usuario Esta Ativo</span>
                                    @elseif ($user->status === 0 && $user->email_verified_at)
                                        <span>O Usuario Foi Desativado</span>
                                    @else
                                        <span>O Usuario Inativo Pois Ainda Não confirmou o seu email</span>
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
                        <div class="col-sm-6">
                            <div class="card tilebox-one">
                                <div class="card-body">
                                    <i class="dripicons-basket float-end text-muted"></i>
                                    <h6 class="text-muted text-uppercase mt-0">Prestações a pagar</h6>
                                    <h2 class="m-b-20">
                                        €<span>{{ number_format($prestacoes_a_pagas, 2, ',', '.') }}</span></h2>
                                    <span class="text-muted">O valor a pagar de prestações</span>
                                </div> <!-- end card-body-->
                            </div>
                            <!--end card-->
                        </div><!-- end col -->

                        <div class="col-sm-6">
                            <div class="card tilebox-one">
                                <div class="card-body">
                                    <i class="dripicons-box float-end text-muted"></i>
                                    <h6 class="text-muted text-uppercase mt-0">Prestações Pagas</h6>
                                    <h2 class="m-b-20">
                                        €<span>{{ number_format($prestacoes_pagas, 2, ',', '.') }}</span></h2>
                                    <span class="text-muted">Total Pago</span>
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
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">

                                                </div>
                                            </td>
                                            <td class="table-user">
                                                <a href="{{ route('admin.transaction.details', $transfer->id) }}"
                                                    class="text-body fw-semibold">
                                                    {{ $transfer->name }}
                                                </a>
                                            </td>

                                            <td>
                                                <span class="fw-semibold">{{ $transfer->destinatary_name }}</span>
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
                                                {{ $transfer->created_at->format('d-m-Y H:m:s') }}
                                            </td>

                                            <td>
                                                <a href="{{ route('admin.transaction.details', $transfer->id) }}"
                                                    class="action-icon"> <i class="mdi mdi-square-edit-outline"></i>
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
    <!-- Modal -->
    <div class="modal fade" id="confirmar_senha" aria-hidden="true" aria-labelledby="confirmar_senha" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Senha de Segurança</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="ps-3 pe-3" action="#">
                        <div class="mb-3">
                            <label for="senha_seguranca" class="form-label">Senha</label>
                            <input class="form-control" type="password" id="senha_seguranca" required
                                placeholder="Digite a senha de segurança">
                            <div class="text-danger mt-2" id="erro_na_senha">

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" id="aguardar">
                    <button class="btn btn-primary" id="senha_colocada">Continuar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Modal -->
    <div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-wrong h1"></i>
                        <h4 class="mt-2">Cuidado!</h4>
                        <p class="mt-3">Os dados do usuario devem ser editados apenas pelo usuario, exepto se o
                            usuario não puder acessar a sua conta caso inseriu mal o email, por isso lhe sera pedido uma
                            senha de verificação unica.</p>
                        <button type="button" class="btn btn-light my-2" data-bs-target="#confirmar_senha"
                            data-bs-toggle="modal" data-bs-dismiss="modal">Continuar</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Modal -->
    <div class="modal fade" id="novo_email" aria-hidden="true" aria-labelledby="novo_email" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Novo Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="ps-3 pe-3" action="#">
                        <div class="mb-3">
                            <label for="email_novo" class="form-label">Email</label>
                            <input class="form-control" type="email" id="email_novo" required
                                placeholder="Digite o novo email do usuario">
                            <div class="text-danger mt-2" id="erro_email">

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" id="aguardar_email">
                    <button class="btn btn-primary" id="novo_email_colocado">Continuar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Footer Start -->
    @include('layouts.admin.footer')
    <!-- end Footer -->

    </div>
@endsection

@section('scripts')
    @if (session('message'))
        <script>
            $.NotificationApp.send("Sucesso", "{{ session('message') }}",
                "bottom-right", "Background color", "success", "hideAfter", 3000)
        </script>
    @endif

    @if (session('status') === 500)
        <script>
            $.NotificationApp.send("Erro", "{{ session('message') }}",
                "bottom-right", "Background color", "danger", "hideAfter", 3000)
        </script>
    @endif
    <script>
        $("#ativar_user").click(function() {
            $('#danger-alert-modal').modal('show');
        })

        $("#senha_colocada").click(function() {
            if ($("#senha_seguranca").val().length > 0) {
                $("#senha_colocada").remove()
                $("#aguardar").html(
                    "<button class='btn btn-primary' id='esperando' type='button' disabled> <span class='spinner-border spinner-border-sm me-1' role='status' aria-hidden='true'></span>Aguarde...</button>"
                )
                password = $("#senha_seguranca").val()
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='_token']").attr("content")
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.change.user.email.verify.secret.password') }}",
                    data: {
                        "password": password,
                    },
                    success: function(data) {
                        if (data.status === 500) {
                            $("#erro_na_senha").text(data.message)
                            $("#esperando").remove()
                            $("#aguardar").html(
                                "<button class='btn btn-primary' id='senha_colocada'>Continuar</button>"
                            )

                        } else {
                            $("#confirmar_senha").modal('hide');
                            $('#novo_email').modal('show');
                        }
                    },
                    error: function(error) {
                        $("#esperando").remove()
                        $("#aguardar").html(
                            "<button class='btn btn-primary' id='senha_colocada'>Continuar</button>"
                        )

                        $("#erro_na_senha").text(error.responseJSON.message)
                    }
                });
            } else {
                $("#erro_na_senha").text("Por favor, Digite a senha de segurança.")
            }
        })

        $("#novo_email_colocado").click(function() {
            if ($("#email_novo").val().length > 0) {
                $("#novo_email_colocado").remove()
                $("#aguardar_email").html(
                    "<button class='btn btn-primary' id='esperando_email' type='button' disabled> <span class='spinner-border spinner-border-sm me-1' role='status' aria-hidden='true'></span>Aguarde...</button>"
                )
                email = $("#user_email").text()
                email_novo = $("#email_novo").val()
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='_token']").attr("content")
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.change.user.email') }}",
                    data: {
                        "email": email,
                        "email_novo": email_novo,
                    },
                    success: function(data) {
                        if (data.status === 500) {
                            $("#erro_email").text(data.message)
                            $("#esperando_email").remove()
                            $("#aguardar_email").html(
                                "<button class='btn btn-primary' id='novo_email_colocado'>Continuar</button>"
                            )

                        } else {
                            $("#novo_email").modal('hide');
                            $("#email_novo").val("");
                            $("#senha_seguranca").val("");

                            $("#esperando_email").remove()
                            $("#aguardar_email").html(
                                "<button class='btn btn-primary' id='novo_email_colocado'>Continuar</button>"
                            )

                            $("#esperando").remove()
                            $("#aguardar").html(
                                "<button class='btn btn-primary' id='senha_colocada'>Continuar</button>"
                            )
                            $.NotificationApp.send("Sucesso", data.message,
                                "bottom-right", "Background color", "success", "hideAfter", 3000)
                            $("#user_email").text(email_novo)

                        }
                    },
                    error: function(error) {
                        $("#esperando_email").remove()
                        $("#aguardar_email").html(
                            "<button class='btn btn-primary' id='novo_email_colocado'>Continuar</button>"
                        )

                        $("#erro_email").text(error.responseJSON.message)
                    }
                });
            } else {
                $("#erro_email").text("Por favor, Digite o email.")
            }
        })

        var ano_passado = {{ $ano_passado }}
        var este_ano = {{ $este_ano }}
    </script>
    <!-- third party js -->
    <script src="{{ asset('assets/dashboard/js/vendor/Chart.bundle.min.js') }}"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script src="{{ asset('assets/dashboard/js/pages/demo.profile.js') }}"></script>
@endsection

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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ env('APP_NAME') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Site</a></li>
                                    <li class="breadcrumb-item active">FAQ</li>
                                </ol>
                            </div>
                            <h4 class="page-title">FAQ</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <h3 class="">Dúvidas Frequentes</h3>

                            <button type="button" id="novo_faq" class="btn btn-success btn-sm mt-2">
                                Criar Novo FAQ
                            </button>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->

                <div class="row pt-5">
                    <div class="col-lg-5 offset-lg-4">
                        <!-- Question/Answer -->
                        @foreach ($faqs as $faq)
                            <div id="faq{{ $faq->id }}">
                                <div class="faq-question-q-box me-1 apagar" data-id="{{ $faq->id }}"><i
                                        class="mdi mdi-delete"></i></div>
                                <div class="faq-question-q-box me-2 editar" data-id="{{ $faq->id }}"><i
                                        class="mdi mdi-square-edit-outline"></i>
                                </div>
                                <h4 class="faq-question" data-wow-delay=".1s">{{ $faq->title }}</h4>
                                <p class="faq-answer mb-4">{{ $faq->content }}</p>
                            </div>
                        @endforeach
                        {{ $faqs->links("pagination::admin") }}
                    </div>

                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        @include('layouts.admin.footer')
        <!-- end Footer -->

    </div>
    <div id="novo_faq_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <form class="ps-3 pe-3" action="{{ route('admin.site.faq.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input class="form-control" type="text" name="title" id="titulo" required
                                placeholder="Titulo da FAQ">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrição</label>
                            <textarea data-toggle="maxlength" name="content" id="description" class="form-control" maxlength="225" rows="3"
                                placeholder="Descrição"></textarea>
                        </div>
                        <div class="mb-3 text-center">
                            <button class="btn btn-primary" type="submit">Criar</button>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="modal_faq_edit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <form class="ps-3 pe-3" action="{{ route('admin.site.faq.edit.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input class="form-control" type="text" name="title" id="edit_titulo" required
                                placeholder="Titulo da FAQ">
                            <input type="text" name="id" id="edit_id" hidden>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrição</label>
                            <textarea data-toggle="maxlength" name="content" id="edit_description" class="form-control" maxlength="225" rows="3"
                                placeholder="This textarea has a limit of 225 chars."></textarea>
                        </div>
                        <div class="mb-3 text-center">
                            <button class="btn btn-primary" type="submit">Salvar</button>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-wrong h1"></i>
                        <h4 class="mt-2">Cuidado!</h4>
                        <p class="mt-3">Caso efectue a ação a Faq ira ser apagado do banco de dados, tem certeza
                            que deseja continuar?</p>
                        <button type="button" class="btn btn-light my-2" id="continuar"
                            data-bs-dismiss="modal">Continuar</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('scripts')
    <script>
        $("#novo_faq").click(function() {
            $("#novo_faq_modal").modal("show")
        })
        $(".apagar").click(function() {
            var id = $(this).attr("data-id")
            $("#danger-alert-modal").modal("show")
            $("#continuar").click(function() {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='_token']").attr("content")
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.site.faq.delete') }}",
                    data: {
                        "id": id,
                    },
                    success: function(sucesso) {
                        if (sucesso.status === 500) {
                            $("#erro_na_senha").text(sucesso.error)
                            $.NotificationApp.send("Erro", sucesso.error,
                                "bottom-right", "Background color", "danger", "hideAfter",
                                30)

                        } else {
                            $("#faq" + id).empty()
                            $.NotificationApp.send("Sucesso", sucesso.message,
                                "bottom-right", "Background color", "success", "hideAfter",
                                3000)
                        }
                    },
                    error: function(error) {
                        $.NotificationApp.send("Erro", error.responseJson.message,
                            "bottom-right", "Background color", "danger", "hideAfter", 30)

                    }
                });
            })
        })

        $(".editar").click(function() {
            var id = $(this).attr("data-id")
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='_token']").attr("content")
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('admin.site.faq.edit') }}",
                data: {
                    "id": id,
                },
                success: function(sucesso) {
                    if (sucesso.status === 500) {
                        $("#erro_na_senha").text(sucesso.error)
                        $.NotificationApp.send("Erro", sucesso.error,
                            "bottom-right", "Background color", "danger", "hideAfter",
                            30)

                    } else {
                        $("#edit_description").val(sucesso.data.content)
                        $("#edit_titulo").val(sucesso.data.title)
                        $("#edit_id").val(sucesso.data.id)
                        $("#modal_faq_edit").modal("show")

                    }
                },
                error: function(error) {
                    $.NotificationApp.send("Erro", error.responseJson.message,
                        "bottom-right", "Background color", "danger", "hideAfter", 30)

                }
            });
        })
    </script>
@endsection

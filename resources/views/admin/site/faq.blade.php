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
                            <div>
                                <div class="faq-question-q-box">Q</div>
                                <h4 class="faq-question" data-wow-delay=".1s">{{ $faq->title }}</h4>
                                <p class="faq-answer mb-4">{{ $faq->content }}</p>
                            </div>
                        @endforeach
                    </div>
                    <!--/col-md-5 -->

                    {{-- <div class="col-lg-5">
                        <!-- Question/Answer -->
                        <div>
                            <div class="faq-question-q-box">Q.</div>
                            <h4 class="faq-question">Is safe use Lorem Ipsum?</h4>
                            <p class="faq-answer mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                        </div>

                        <!-- Question/Answer -->
                        <div>
                            <div class="faq-question-q-box">Q.</div>
                            <h4 class="faq-question">When can be used?</h4>
                            <p class="faq-answer mb-4">Lorem ipsum dolor sit amet, in mea nonumes dissentias dissentiunt,
                                pro te solet oratio iriure. Cu sit consetetur moderatius intellegam, ius decore accusamus
                                te. Ne primis suavitate disputando nam. Mutat convenirete.</p>
                        </div>

                        <!-- Question/Answer -->
                        <div>
                            <div class="faq-question-q-box">Q.</div>
                            <h4 class="faq-question">License &amp; Copyright</h4>
                            <p class="faq-answer mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                        </div>

                        <!-- Question/Answer -->
                        <div>
                            <div class="faq-question-q-box">Q.</div>
                            <h4 class="faq-question">Is safe use Lorem Ipsum?</h4>
                            <p class="faq-answer mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                        </div>

                    </div>
                    <!--/col-md-5--> --}}
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
                    <form class="ps-3 pe-3" action="{{route("admin.site.faq.create")}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input class="form-control" type="text" name="title" id="titulo" required placeholder="Titulo da FAQ">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrição</label>
                            <input class="form-control" type="text" name="content" id="description" required placeholder="Descrição">
                        </div>
                        <div class="mb-3 text-center">
                            <button class="btn btn-primary" type="submit">Criar</button>
                        </div>
                    </form>

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
    </script>
@endsection

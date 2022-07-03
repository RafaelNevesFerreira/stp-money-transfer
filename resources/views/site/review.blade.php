@extends('layouts.app')
@section('content')
    <!-- Conten  ============================================= -->
    <div id="content" class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
                    <div class="bg-white shadow-sm rounded p-3 pt-sm-4 pb-sm-5 px-sm-5 mb-4">
                        <h3 class="text-5 fw-400 text-center mb-3 mb-sm-4">Deixe-nos um review</h3>
                        <hr class="mx-n3 mx-sm-n5 mb-4">
                        <form id="form-send-money" method="post" action="{{ route("review_submit") }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" required name="name">
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">País de residência</label>
                                @include("layouts.select_country")
                            </div>
                            <div class="mb-3">
                                <label for="review" class="form-label">Comentario</label>
                                <textarea class="form-control" maxlength="300" name="content" id="review" rows="5"></textarea>
                            </div>

                            <hr>
                            @if ($errors->any())
                                <div class='form-row row'>
                                    <div class='col-md-12 error form-group'>
                                        <div class='alert-danger alert'>
                                            @foreach ($errors->all() as $error)
                                                <p>{!! $error !!}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="d-grid"><button class="btn btn-primary">Enviar</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content end -->
@endsection

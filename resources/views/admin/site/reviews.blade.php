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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ env('APP_NAME') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Site</a></li>
                                    <li class="breadcrumb-item active">Reviews</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Todos os Reviews</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane show active">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="bg-dragula p-2 p-lg-4">
                                                    <h5 class="mt-0">Todos Os Reviews</h5>
                                                    <div id="company-list-left" class="py-2">
                                                        @foreach ($reviews as $review)
                                                            <div class="card mb-0 mt-2">
                                                                <div class="card-body">
                                                                    <div class="d-flex align-items-start">
                                                                        <div class="w-100 overflow-hidden">
                                                                            <h5 class="mb-1 mt-0">{{ $review->name }}
                                                                            </h5>
                                                                            <p> {{ $review->country }} </p>
                                                                            <p class="mb-0 text-muted">
                                                                                <span
                                                                                    class="fst-italic"><b>"</b>{{ $review->content }}.<b>"</b></span>
                                                                            </p>
                                                                        </div> <!-- end w-100 -->
                                                                    </div> <!-- end d-flex -->
                                                                </div> <!-- end card-body -->
                                                            </div> <!-- end col -->
                                                        @endforeach


                                                    </div> <!-- end company-list-1-->
                                                    {{ $reviews->links('pagination::admin') }}
                                                </div> <!-- end div.bg-light-->

                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div> <!-- end preview-->
                                </div> <!-- end tab-content-->
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->


            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        @include('layouts.admin.footer')
        <!-- end Footer -->

    </div>
@endsection

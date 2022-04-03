@extends("layouts.app")
@section('content')
    <!-- Page Header
                          ============================================= -->
    <section class="page-header page-header-text-light bg-dark-3 py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 order-1 order-md-0">
                    <h1>Blog</h1>
                </div>
                <div class="col-md-4 order-0 order-md-1">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="http://demo.harnishdesign.net/html/payyed/index.html">Home</a></li>
                        <li class="active">Blog</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Header end -->

    <!-- Content
                          ============================================= -->
    <div id="content">
        <div class="container">
            <div class="row">

                <!-- Middle Panel
                                ============================================= -->
                <div class="col-lg-8 col-xl-9">
                    <div class="row gy-4">
                        @foreach ($posts as $post)
                            <div class="col-12">
                                <div class="blog-post card shadow-sm border-0"> <a class="d-flex"
                                        href="blog-single.html"><img class="card-img-top"
                                            src="{{ $post->featured_image }}" alt="{{ $post->title }} image"></a>
                                    <div class="card-body p-4">
                                        <h4 class="title-blog"><a href="blog-single.html">{{ $post->title }}</a></h4>
                                        <ul class="meta-blog">
                                            <li><i
                                                    class="fas fa-calendar-alt"></i>{{ $post->created_at->diffForHumans() }}
                                            </li>
                                            <li><a href="#"><i class="fas fa-user"></i> {{ $post->author->name }}</a>
                                            </li>
                                            <li>
                                                <i class="fas fa-tag"></i>
                                                @foreach ($post->tags as $tag)
                                                    <a href="{{ $tag->name }}">
                                                        {{ $tag->name }}
                                                    </a>
                                                @endforeach

                                            </li>

                                        </ul>
                                        <p>{{ Str::limit($post->excerpt, 600, ' ..') }}</p>
                                        <a href="blog-single.html" class="btn btn-primary btn-sm">Read more</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <!-- Pagination
                                    ============================================= -->
                    <ul class="pagination justify-content-center my-5">
                        <li class="page-item disabled"> <a class="page-link" href="#" tabindex="-1"><i
                                    class="fas fa-angle-left"></i></a> </li>
                        <li class="page-item active"> <a class="page-link" href="#">1</a> </li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item d-flex align-content-center flex-wrap text-muted text-5 mx-1">......</li>
                        <li class="page-item"><a class="page-link" href="#">15</a></li>
                        <li class="page-item"> <a class="page-link" href="#"><i
                                    class="fas fa-angle-right"></i></a> </li>
                    </ul>
                    <!-- Paginations end -->

                </div>
                <!-- Middle Panel End -->

                <!-- Right Sidebar
                                ============================================= -->
                <aside class="col-lg-4 col-xl-3">
                    <!-- Search      =============================== -->
                    <div class="input-group shadow-sm mb-4">
                        <input class="form-control shadow-none border-0 pe-0" type="search" id="search-input"
                            placeholder="Search" value="">
                        <span class="input-group-text bg-white border-0 p-0">
                            <button class="btn text-muted shadow-none px-3 border-0" type="button"><i
                                    class="fa fa-search"></i></button>
                        </span>
                    </div>

                    <!-- Categories      =============================== -->
                    <div class="bg-white shadow-sm rounded p-3 mb-4">
                        <h4 class="text-5 fw-400">Categories</h4>
                        <hr class="mx-n3">
                        <ul class="list-item">
                            <li><a href="#">Industry Tips<span>(24)</span></a></li>
                            <li><a href="#">Sales & Marketing<span>(14)</span></a></li>
                            <li><a href="#">Enterprise Hub<span>(6)</span></a></li>
                            <li><a href="#">Outsourcing<span>(8)</span></a></li>
                            <li><a href="#">Finance & Management<span>(4)</span></a></li>
                            <li><a href="#">IT & Programming<span>(10)</span></a></li>
                            <li><a href="#">Design & Photography<span>(9)</span></a></li>
                        </ul>
                    </div>

                    <!-- Recent Posts              =============================== -->
                    <div class="bg-white shadow-sm rounded p-3 mb-4">
                        <h4 class="text-5 fw-400">Recent Posts</h4>
                        <hr class="mx-n3">
                        <div class="side-post">
                            <div class="item-post">
                                <div class="img-thumb"><a href="blog-single.html"><img class="rounded"
                                            src="http://demo.harnishdesign.net/html/payyed/images/blog/post-2-65x65.jpg"
                                            title="" alt=""></a></div>
                                <div class="caption"> <a href="blog-single.html">Pay Your Contractors, Employees
                                        Anywhere..</a>
                                    <p class="date-post">April 24, 2021</p>
                                </div>
                            </div>
                            <div class="item-post">
                                <div class="img-thumb"><a href="blog-single.html"><img class="rounded"
                                            src="http://demo.harnishdesign.net/html/payyed/images/blog/post-1-65x65.jpg"
                                            title="" alt=""></a></div>
                                <div class="caption"> <a href="blog-single.html">Financial Planning for Small and
                                        Medium...</a>
                                    <p class="date-post">April 24, 2021</p>
                                </div>
                            </div>
                            <div class="item-post">
                                <div class="img-thumb"><a href="blog-single.html"><img class="rounded"
                                            src="http://demo.harnishdesign.net/html/payyed/images/blog/post-3-65x65.jpg"
                                            title="" alt=""></a></div>
                                <div class="caption"> <a href="blog-single.html">Selling Profitably in New Markets
                                        Via...</a>
                                    <p class="date-post">April 24, 2021</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Popular Tags              =============================== -->
                    <div class="bg-white shadow-sm rounded p-3 mb-4">
                        <h4 class="text-5 fw-400">Popular Tags</h4>
                        <hr class="mx-n3">
                        <div class="tags"> <a href="#">Industry</a> <a href="#">Tips</a> <a href="#">2021</a> <a
                                href="#">IT</a> <a href="#">Outsourcing</a> <a href="#">Design</a> <a
                                href="#">Enterprise</a> <a href="#">Marketing</a> </div>
                    </div>
                </aside>
                <!-- Right Sidebar End -->

            </div>
        </div>
    </div>
    <!-- Content end -->
@endsection

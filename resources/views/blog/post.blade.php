@extends("layouts.app")
@section('content')
    <!-- Page Header
                                          ============================================= -->
    <section class="page-header page-header-text-light bg-dark-3 py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 order-1 order-md-0">
                    <h1>{{ $post->title }}</h1>
                </div>
                <div class="col-md-4 order-0 order-md-1">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li class="active">{{ $post->title }}</li>
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
                    <div class="blog-post card shadow-sm border-0 mb-4 p-4">
                        <h2 class="title-blog text-7">{{ $post->title }}</h2>
                        <ul class="meta-blog mb-4">
                            <li><i class="fas fa-calendar-alt"></i>{{ $post->created_at->diffForHumans() }}</li>
                            <li><a href="#"><i class="fas fa-user"></i> {{ $post->author->name }}</a></li>
                            <li>
                                <i class="fas fa-tag"></i>
                                @forelse ($post->tags as $tag)
                                    <a href="{{ $tag->name }}">
                                        {{ $tag->name }}
                                    </a>
                                @empty
                                @endforelse

                            </li>
                        </ul>
                        <a href="blog-single.html">
                            <img class="img-fluid" src="{{ $post->featured_image }}"
                                alt="{{ $post->title }} image">
                        </a>
                        <div class="card-body px-0 pb-0 " id="conteudo">
                            {!! $post->content !!}
                        </div>
                        <hr class="my-4">

                        <!-- Tags & Share Social
                                                        ================================= -->
                        <div class="row mb-2">
                            <div class="col-lg-7 col-xl-8">
                                <div class="tags text-center text-lg-start">
                                    @forelse ($post->tags as $tag)
                                        <a href="{{ $tag->name }}">{{ $tag->name }}</a>
                                    @empty
                                    @endforelse
                                </div>
                                <div class="col-lg-5 col-xl-4">
                                    <div class="d-flex flex-column">
                                        <ul
                                            class="social-icons social-icons-colored justify-content-center justify-content-lg-end">
                                            <li class="social-icons-facebook"><a data-bs-toggle="tooltip"
                                                    href="http://www.facebook.com/" target="_blank" title="Facebook"><i
                                                        class="fab fa-facebook-f"></i></a></li>
                                            <li class="social-icons-linkedin"><a data-bs-toggle="tooltip"
                                                    href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i
                                                        class="fab fa-linkedin-in"></i></a></li>
                                            <li class="social-icons-instagram"><a data-bs-toggle="tooltip"
                                                    href="http://www.instagram.com/" target="_blank" title="Instagram"><i
                                                        class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Author
                                               ================================= -->
                            <div class="row g-0 bg-light rounded p-4 mb-4 text-center text-sm-start">
                                <div class="col-12 col-sm-auto me-4 mb-2 mb-sm-0"> <img class="rounded"
                                        src="{{ $post->author->avatar }}" alt="Author Avatar">
                                </div>
                                <div class="col-12 col-sm">
                                    <h4 class="title-blog text-4 mb-2"><a href="#">{{ $post->author->name }}</a></h4>
                                    <p class="mb-2">{!! $post->author->bio !!}</p>
                                    <div class="d-flex flex-column">
                                        <ul
                                            class="social-icons social-icons-muted justify-content-center justify-content-sm-start ms-n2">
                                            <li class="social-icons-twitter">
                                                <a data-bs-toggle="tooltip" href="http://www.twitter.com/" target="_blank"
                                                    title="Twitter">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="social-icons-facebook">
                                                <a data-bs-toggle="tooltip" href="http://www.facebook.com/" target="_blank"
                                                    title="Facebook">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li class="social-icons-linkedin">
                                                <a data-bs-toggle="tooltip" href="http://www.linkedin.com/" target="_blank"
                                                    title="Linkedin">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- Middle Panel End -->

                <!-- Right Sidebar  ============================================= -->
                @include("layouts.blog.asside")
                <!-- Right Sidebar End -->
            </div>
        </div>
    </div>

    <!-- Content end -->
@endsection

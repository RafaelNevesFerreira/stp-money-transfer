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
                        <li><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="active"><a href="{{ route('blog') }}">Blog</a></li>
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
                                        href="{{ route('post', $post->slug) }}"><img class="card-img-top"
                                            src="{{ $post->featured_image }}" alt="{{ $post->title }} image"></a>
                                    <div class="card-body p-4">
                                        <h4 class="title-blog"><a
                                                href="{{ route('post', $post->slug) }}">{{ $post->title }}</a></h4>
                                        <ul class="meta-blog">
                                            <li><i
                                                    class="fas fa-calendar-alt"></i>{{ $post->created_at->diffForHumans() }}
                                            </li>
                                            <li><a href="#"><i class="fas fa-user"></i> {{ $post->author->name }}</a>
                                            </li>
                                            <li>
                                                <i class="fas fa-tag"></i>
                                                @foreach ($post->tags as $tag)
                                                    <a href="{{ route('tag', $tag->slug) }}">
                                                        {{ $tag->name }}
                                                    </a>
                                                @endforeach

                                            </li>

                                        </ul>
                                        <p>{{ Str::limit($post->excerpt, 600, ' ..') }}</p>
                                        <a href="{{ route('post', $post->slug) }}" class="btn btn-primary btn-sm">Read
                                            more</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <!-- Pagination  ============================================= -->

                        {{ $posts->links("pagination::default") }}

                    <!-- Paginations end -->

                </div>
                <!-- Middle Panel End -->

                <!-- Right Sidebar
                                        ============================================= -->
                @include('layouts.blog.asside')
                <!-- Right Sidebar End -->

            </div>
        </div>
    </div>
    <!-- Content end -->
@endsection

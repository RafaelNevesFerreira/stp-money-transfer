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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Extended UI</a></li>
                                    <li class="breadcrumb-item active">Dragula</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Dragula</h4>
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
                                                    {{ $reviews->links("pagination::admin") }}
                                                </div> <!-- end div.bg-light-->

                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div> <!-- end preview-->

                                    <div class="tab-pane" id="move-stuff-code">
                                        <p>Make sure to include following js files at end of <code>body element</code></p>

                                        <pre>
                                        <span class="html escape">
                                            &lt;script src=&quot;assets/js/vendor/dragula.min.js&quot;&gt;&lt;/script&gt;
                                            &lt;script src=&quot;assets/js/ui/component.dragula.js&quot;&gt;&lt;/script&gt;
                                        </span>
                                    </pre> <!-- end highlight-->

                                        <pre class="mb-0">
                                        <span class="html escape">
                                            &lt;div class=&quot;row&quot; data-plugin=&quot;dragula&quot; data-containers='[&quot;company-list-left&quot;, &quot;company-list-right&quot;]'&gt;
                                                &lt;div class=&quot;col-md-6&quot;&gt;
                                                    &lt;div class=&quot;bg-dragula p-2 p-lg-4&quot;&gt;
                                                        &lt;h5 class=&quot;mt-0&quot;&gt;Part 1&lt;/h5&gt;
                                                        &lt;div id=&quot;company-list-left&quot; class=&quot;py-2&quot;&gt;

                                                            &lt;div class=&quot;card mb-0 mt-2&quot;&gt;
                                                                &lt;div class=&quot;card-body&quot;&gt;
                                                                    &lt;div class=&quot;d-flex align-items-start&quot;&gt;
                                                                        &lt;img src=&quot;assets/images/users/avatar-1.jpg&quot; alt=&quot;image&quot; class=&quot;me-3 d-none d-sm-block avatar-sm rounded-circle&quot;&gt;
                                                                        &lt;div class=&quot;w-100 overflow-hidden&quot;&gt;
                                                                            &lt;h5 class=&quot;mb-1 mt-0&quot;&gt;Louis K. Bond&lt;/h5&gt;
                                                                            &lt;p&gt; Founder &amp; CEO &lt;/p&gt;
                                                                            &lt;p class=&quot;mb-0 text-muted&quot;&gt;
                                                                                &lt;span class=&quot;fst-italic&quot;&gt;&lt;b&gt;&quot;&lt;/b&gt;Disrupt pork belly poutine, asymmetrical tousled succulents selfies. You probably haven't heard of them tattooed master cleanse live-edge keffiyeh.&lt;/span&gt;
                                                                            &lt;/p&gt;
                                                                        &lt;/div&gt; &lt;!-- end w-100 --&gt;
                                                                    &lt;/div&gt; &lt;!-- end d-flex --&gt;
                                                                &lt;/div&gt; &lt;!-- end card-body --&gt;
                                                            &lt;/div&gt; &lt;!-- end col --&gt;

                                                            &lt;div class=&quot;card mb-0 mt-2&quot;&gt;
                                                                &lt;div class=&quot;card-body&quot;&gt;
                                                                    &lt;div class=&quot;d-flex align-items-start&quot;&gt;
                                                                        &lt;img src=&quot;assets/images/users/avatar-2.jpg&quot; alt=&quot;image&quot; class=&quot;me-3 d-none d-sm-block avatar-sm rounded-circle&quot;&gt;
                                                                        &lt;div class=&quot;w-100 overflow-hidden&quot;&gt;
                                                                            &lt;h5 class=&quot;mb-1 mt-0&quot;&gt;Dennis N. Cloutier&lt;/h5&gt;
                                                                            &lt;p&gt; Software Engineer &lt;/p&gt;
                                                                            &lt;p class=&quot;mb-0 text-muted&quot;&gt;
                                                                                &lt;span class=&quot;fst-italic&quot;&gt;&lt;b&gt;&quot;&lt;/b&gt;Disrupt pork belly poutine, asymmetrical tousled succulents selfies. You probably haven't heard of them tattooed master cleanse live-edge keffiyeh.&lt;/span&gt;
                                                                            &lt;/p&gt;
                                                                        &lt;/div&gt; &lt;!-- end w-100 --&gt;
                                                                    &lt;/div&gt; &lt;!-- end d-flex --&gt;
                                                                &lt;/div&gt; &lt;!-- end card-body --&gt;
                                                            &lt;/div&gt; &lt;!-- end col --&gt;

                                                            &lt;div class=&quot;card mb-0 mt-2&quot;&gt;
                                                                &lt;div class=&quot;card-body&quot;&gt;
                                                                    &lt;div class=&quot;d-flex align-items-start&quot;&gt;
                                                                        &lt;img src=&quot;assets/images/users/avatar-3.jpg&quot; alt=&quot;image&quot; class=&quot;me-3 d-none d-sm-block avatar-sm rounded-circle&quot;&gt;
                                                                        &lt;div class=&quot;w-100 overflow-hidden&quot;&gt;
                                                                            &lt;h5 class=&quot;mb-1 mt-0&quot;&gt;Susan J. Sander&lt;/h5&gt;
                                                                            &lt;p&gt; Web Designer &lt;/p&gt;
                                                                            &lt;p class=&quot;mb-0 text-muted&quot;&gt;
                                                                                &lt;span class=&quot;fst-italic&quot;&gt;&lt;b&gt;&quot;&lt;/b&gt;Disrupt pork belly poutine, asymmetrical tousled succulents selfies. You probably haven't heard of them tattooed master cleanse live-edge keffiyeh.&lt;/span&gt;
                                                                            &lt;/p&gt;
                                                                        &lt;/div&gt; &lt;!-- end w-100 --&gt;
                                                                    &lt;/div&gt; &lt;!-- end d-flex --&gt;
                                                                &lt;/div&gt; &lt;!-- end card-body --&gt;
                                                            &lt;/div&gt; &lt;!-- end col --&gt;

                                                        &lt;/div&gt; &lt;!-- end company-list-1--&gt;
                                                    &lt;/div&gt; &lt;!-- end div.bg-light--&gt;
                                                &lt;/div&gt; &lt;!-- end col --&gt;

                                                &lt;div class=&quot;col-md-6&quot;&gt;
                                                    &lt;div class=&quot;bg-dragula p-2 p-lg-4&quot;&gt;
                                                        &lt;h5 class=&quot;mt-0&quot;&gt;Part 2&lt;/h5&gt;
                                                        &lt;div id=&quot;company-list-right&quot; class=&quot;py-2&quot;&gt;
                                                            &lt;div class=&quot;card mb-0 mt-2&quot;&gt;

                                                                &lt;div class=&quot;card-body p-3&quot;&gt;
                                                                    &lt;div class=&quot;d-flex align-items-start&quot;&gt;
                                                                        &lt;img src=&quot;assets/images/users/avatar-4.jpg&quot; alt=&quot;image&quot; class=&quot;me-3 d-none d-sm-block avatar-sm rounded-circle&quot;&gt;
                                                                        &lt;div class=&quot;w-100 overflow-hidden&quot;&gt;
                                                                            &lt;h5 class=&quot;mb-1 mt-0&quot;&gt;James M. Short&lt;/h5&gt;
                                                                            &lt;p&gt; Web Developer &lt;/p&gt;
                                                                            &lt;p class=&quot;mb-0 text-muted&quot;&gt;
                                                                                &lt;span class=&quot;fst-italic&quot;&gt;&lt;b&gt;&quot;&lt;/b&gt;Disrupt pork belly poutine, asymmetrical tousled succulents selfies. You probably haven't heard of them tattooed master cleanse live-edge keffiyeh &lt;/span&gt;
                                                                            &lt;/p&gt;
                                                                        &lt;/div&gt; &lt;!-- end w-100 --&gt;
                                                                    &lt;/div&gt; &lt;!-- end d-flex --&gt;
                                                                &lt;/div&gt; &lt;!-- end card-body --&gt;
                                                            &lt;/div&gt; &lt;!-- end col --&gt;

                                                            &lt;div class=&quot;card mb-0 mt-2&quot;&gt;
                                                                &lt;div class=&quot;card-body p-3&quot;&gt;
                                                                    &lt;div class=&quot;d-flex align-items-start&quot;&gt;
                                                                        &lt;img src=&quot;assets/images/users/avatar-5.jpg&quot; alt=&quot;image&quot; class=&quot;me-3 d-none d-sm-block avatar-sm rounded-circle&quot;&gt;
                                                                        &lt;div class=&quot;w-100 overflow-hidden&quot;&gt;
                                                                            &lt;h5 class=&quot;mb-1 mt-0&quot;&gt;Gabriel J. Snyder&lt;/h5&gt;
                                                                            &lt;p&gt; Business Analyst &lt;/p&gt;
                                                                            &lt;p class=&quot;mb-0 text-muted&quot;&gt;
                                                                                &lt;span class=&quot;fst-italic&quot;&gt;&lt;b&gt;&quot;&lt;/b&gt;Disrupt pork belly poutine, asymmetrical tousled succulents selfies. You probably haven't heard of them tattooed master cleanse live-edge keffiyeh &lt;/span&gt;
                                                                            &lt;/p&gt;
                                                                        &lt;/div&gt; &lt;!-- end w-100 --&gt;
                                                                    &lt;/div&gt; &lt;!-- end d-flex --&gt;
                                                                &lt;/div&gt; &lt;!-- end card-body --&gt;
                                                            &lt;/div&gt; &lt;!-- end col --&gt;

                                                            &lt;div class=&quot;card mb-0 mt-2&quot;&gt;
                                                                &lt;div class=&quot;card-body p-3&quot;&gt;
                                                                    &lt;div class=&quot;d-flex align-items-start&quot;&gt;
                                                                        &lt;img src=&quot;assets/images/users/avatar-6.jpg&quot; alt=&quot;image&quot; class=&quot;me-3 d-none d-sm-block avatar-sm rounded-circle&quot;&gt;
                                                                        &lt;div class=&quot;w-100 overflow-hidden&quot;&gt;
                                                                            &lt;h5 class=&quot;mb-1 mt-0&quot;&gt;Louie C. Mason&lt;/h5&gt;
                                                                            &lt;p&gt;Human Resources&lt;/p&gt;
                                                                            &lt;p class=&quot;mb-0 text-muted&quot;&gt;
                                                                                &lt;span class=&quot;fst-italic&quot;&gt;&lt;b&gt;&quot;&lt;/b&gt;Disrupt pork belly poutine, asymmetrical tousled succulents selfies. You probably haven't heard of them tattooed master cleanse live-edge keffiyeh &lt;/span&gt;
                                                                            &lt;/p&gt;
                                                                        &lt;/div&gt; &lt;!-- end w-100 --&gt;
                                                                    &lt;/div&gt; &lt;!-- end d-flex --&gt;
                                                                &lt;/div&gt; &lt;!-- end card-body --&gt;
                                                            &lt;/div&gt; &lt;!-- end col --&gt;

                                                        &lt;/div&gt; &lt;!-- end company-list-2--&gt;
                                                    &lt;/div&gt; &lt;!-- end div.bg-light--&gt;
                                                &lt;/div&gt; &lt;!-- end col --&gt;

                                            &lt;/div&gt; &lt;!-- end row --&gt;
                                        </span>
                                    </pre> <!-- end highlight-->
                                    </div> <!-- end preview code-->
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

@section('scripts')
    <script src="{{ asset('assets/dashboard/js/vendor/dragula.min.js') }}"></script>
@endsection

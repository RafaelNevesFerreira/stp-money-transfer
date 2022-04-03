@extends("layouts.app")
@section('content')
    <!-- Page Header
        ============================================= -->
    <div class="page-header page-header-text-light bg-dark">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Elements 2</h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="http://demo.harnishdesign.net/html/payyed/index.html">Home</a></li>
                        <li class="active">Elements 2</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header end -->

    <!-- Content
      ============================================= -->
    <div id="content">
        <div class="container">
            <div class="bg-white shadow-md rounded p-4 mb-4">
                <div class="row">
                    <div class="col-sm-6">

                        <!-- Typography    ============================================= -->
                        <h2 class="text-6 mb-3">Typography</h2>
                        <h1>H1 Heading. Lorem ipsum</h1>
                        <h2>H2 Heading. Lorem ipsum</h2>
                        <h3>H3 Heading. Lorem ipsum</h3>
                        <h4>H4 Heading. Lorem ipsum</h4>
                        <h5>H5 Heading. Lorem ipsum</h5>
                        <h6>H6 Heading. Lorem ipsum</h6>
                        <!-- Typography End-->

                        <!-- Buttons        ============================================= -->
                        <h2 class="text-6 mb-3 mt-5">Buttons</h2>
                        <div class="row gy-4">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-sm">Small Button</button>
                                <button type="button" class="btn btn-primary mx-2">Default Button</button>
                                <button type="button" class="btn btn-primary btn-lg">Large Button</button>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-outline-primary btn-sm shadow-none">Small
                                    Button</button>
                                <button type="button" class="btn btn-outline-primary mx-2 shadow-none">Default
                                    Button</button>
                                <button type="button" class="btn btn-outline-primary btn-lg shadow-none">Large
                                    Button</button>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn btn-primary" onclick="">Block Button</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-primary rounded-0">Rounded Square</button>
                                <button type="button" class="btn btn-primary mx-2">Default</button>
                                <button type="button" class="btn btn-primary rounded-pill">Rounded Pill</button>
                            </div>
                        </div>
                        <!-- Buttons End-->

                    </div>

                </div>

                <!-- Highlights      ============================================= -->
                <h2 class="text-center mt-5 mb-4">Highlights</h2>
                <p>Lorem ipsum dolor sit amet,
                    <mark>consectetuer adipiscing</mark>
                    elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor
                    vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod,
                    turpis sollicitudin lobortis pellentesque,
                    <mark class="bg-primary text-white px-1">libero massa</mark>
                    dapibus dui, eu. Lorem
                    <mark class="bg-secondary text-white px-1">ipsum dolor</mark>
                    sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin
                    eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros
                    gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.
                </p>
                <!-- Highlights End-->

                <h2 class="text-center my-4">Table</h2>
                <div class="row g-4">
                    <div class="col-md-6">
                        <!-- Basic Table                ============================================= -->
                        <h4 class="text-5">Basic Table</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Aaron</td>
                                        <td>Seth</td>
                                        <td>@aaron</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Daichi</td>
                                        <td>Barbal</td>
                                        <td>@daichi</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Tabor</td>
                                        <td>Guju</td>
                                        <td>@tabor</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Basic Table End-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content end -->
@endsection

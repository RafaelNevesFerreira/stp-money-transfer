@extends("layouts.admin.app")
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Topbar Start -->
            @include('layouts.admin.topbar')
            <!-- end Topbar -->

            <!-- Start Content-->
            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('tecnico.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Transações</a></li>
                                    <li class="breadcrumb-item active">Todas</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Transações</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

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
                                                <th>Nome</th>
                                                <th>Pais</th>
                                                <th>Data de verificação</th>
                                                <th>Email</th>
                                                <th>Telemovel</th>
                                                <th>Registrado</th>
                                                <th style="width: 75px;">Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $user)
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="customCheck2">

                                                        </div>
                                                    </td>
                                                    <td class="table-user">
                                                        <a href="javascript:void(0);" class="text-body fw-semibold">
                                                            {{ $user->name }}
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <span class="fw-semibold">{{ $user->country }}</span>
                                                    </td>
                                                    <td>
                                                        {{ $user->email_verified_at }}

                                                    </td>
                                                    <td>
                                                        {{ $user->email }}
                                                    </td>

                                                    <td>
                                                        {{ $user->phone_number }}

                                                    </td>
                                                    <td>
                                                        {{ $user->created_at }}
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('admin.user.details', $user->id) }}"
                                                            class="action-icon"> <i
                                                                class="mdi mdi-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->

        @include('layouts.admin.footer')
        <!-- end Footer -->

    </div>
@endsection

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}" />

    <title>{{ env('APP_NAME') }} - Money Transfer and Online Payments HTML Template</title>

    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/images/site.webmanifest') }}">

    <!-- App css -->
    <link href="{{ asset('assets/dashboard/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/dashboard/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('assets/dashboard/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/dashboard/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/dashboard/css/app-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="dark-style" />
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

</head>

@if (Auth::user()->theme_color == 'dark')

    <body class="loading"
        data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":true, "showRightSidebarOnStart": true}'>
    @else

        <body class="loading"
            data-layout-config='{"leftSideBarTheme":"ligth","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
@endif <!-- Begin page -->
<!-- Begin page -->
<div class="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    @include('layouts.admin.left_sidebar')
    <!-- Left Sidebar End -->

    @include('layouts.admin.right_sidebar')

    @yield("content")


</div>
<!-- END wrapper -->

<!-- bundle -->
<script src="{{ asset('assets/dashboard/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/app.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/vendor/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/vendor/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/vendor/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/vendor/dataTables.checkboxes.min.js') }}"></script>

<script src="{{ asset('assets/dashboard/js/pages/demo.sellers.js') }}"></script>
@if (session('message'))
    <script>
        $.NotificationApp.send("Sucesso", "{{ session('message') }}",
            "bottom-right", "Background color", "success", "hideAfter", 3000)
    </script>
@endif

@if (session('status') === 500)
    <div id="status.error" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-wrong h1"></i>
                        <h4 class="mt-2">Cuidado!</h4>
                        <p class="mt-3">{{ session('error') }}.</p>
                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        $("#status.error").modal('show');
    </script>
@endif
<script>
    $(".theme_color").click(function() {
        $.ajax({
            type: "post",
            url: "/admin/change_theme",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            data: {
                theme: $(this).val(),
            },
            success: function(data) {
                location.reload();
            },
            error: function(error) {
                alert("sory, we have an error, try later")
            }
        });
    })
    $("#logout").click(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $("meta[name='_token']").attr("content")
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('logout') }}",
            success: function(data) {
                location.reload(true);
            }
        });
    })
</script>

@yield("scripts")


</body>

</html>

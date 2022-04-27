<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from coderthemes.com/hyper_2/saas/dashboard-projects.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 04 Feb 2022 07:47:55 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Project Dashboard | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('assets/dashboard/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/dashboard/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/dashboard/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('assets/dashboard/js/chart.min.js') }}"></script>

</head>

<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        @include("tecnicos.left_sidebar")
        <!-- Left Sidebar End -->
        @yield("content")


    </div>
    <!-- END wrapper -->

    <!-- bundle -->
    <script src="{{ asset('assets/dashboard/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/app.min.js') }}"></script>

</body>

</html>

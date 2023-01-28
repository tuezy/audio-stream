<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>{{ $pageTitle ?? 'Starter' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    @include("layouts.partials.head-css")
</head>

<body>

<!-- Begin page -->
<div id="layout-wrapper">

    @include('layouts.partials.topbar')
    @include('layouts.partials.sidebar')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                @include("layouts.partials.breadcrumb")
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        @include("layouts.partials.footer")
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->



@include("layouts.partials.customizer")
@include("layouts.partials.vendor-scripts")
<script src="assets/js/app.js"></script>
</body>

</html>

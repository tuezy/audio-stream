<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      data-layout="vertical"
      data-topbar="light"
      data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="enable">
<head>
    <meta charset="utf-8" />
    <title>{{ core()->getSetting('site_title') ?? 'Starter' }}</title>
    <meta name="viewport" content="width=1366">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    @foreach([
        'assets/css/bootstrap.min.css',
        'assets/css/icons.min.css',
        'assets/css/app.min.css',
        'assets/css/custom.min.css',
        'assets/app/index/css/app.css',
        'assets/libs/sweetalert2/sweetalert2.min.css'
    ] as $style)
        <link href="{{ asset($style) }}" rel="stylesheet" type="text/css" />
    @endforeach
    @yield("css")
    @stack("styles")
</head>

<body id="app-index">
<!-- Begin page -->
<div id="layout-wrapper">
    @include("index.layouts.partials.header")
    <div class="container pt-5">
        <div class="mt-5">
            @if(session('errors'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach(session('errors')->all() as $error)
                        <p><strong>{{ $error }}</strong>.</p>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>

    @yield("content")
    @include("index.layouts.partials.footer")
    @include("index.pages.ui.create")

</div>

@include("index.layouts.partials.vendor-scripts")
@yield("script")
@stack("scripts")
<script>
    var cmsItem = document.getElementsByClassName("cms-item");
    Array.from(cmsItem).forEach(function (element) {
        element.addEventListener("click", function () {
            this.classList.toggle("active");
        });
    });
</script>
</body>

</html>

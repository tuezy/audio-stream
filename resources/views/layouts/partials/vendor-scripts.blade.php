@foreach([
    "assets/libs/bootstrap/js/bootstrap.bundle.min.js",
    "assets/libs/simplebar/simplebar.min.js",
    "assets/libs/node-waves/waves.min.js",
    "assets/libs/feather-icons/feather.min.js",
    "assets/js/pages/plugins/lord-icon-2.1.0.js",
    "assets/js/plugins.js"
] as $script)
    <script src="{{ asset($script) }}"></script>
@endforeach
<!-- JAVASCRIPT -->


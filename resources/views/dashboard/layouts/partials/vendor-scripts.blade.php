<script type="text/javascript">
    var JS_INLINE = JS_INLINE || {};
</script>
@foreach([
    "assets/libs/bootstrap/js/bootstrap.bundle.min.js",
    "assets/libs/simplebar/simplebar.min.js",
    "assets/libs/node-waves/waves.min.js",
    "assets/libs/feather-icons/feather.min.js",
    "assets/js/pages/plugins/lord-icon-2.1.0.js",
] as $script)
    <script src="{{ asset($script) }}"></script>
@endforeach
<!-- JAVASCRIPT -->

<script>
    if(document.querySelectorAll("[toast-list]").length > 0 ||
        document.querySelectorAll('[data-choices]').length > 0 ||
        document.querySelectorAll("[data-provider]").length > 0
    ){
        document.writeln("<script type='text/javascript' src='{{ asset("assets/libs/toastify-js.js") }}'><\/script>");
        document.writeln("<script type='text/javascript' src='{{ asset("assets/libs/choices.js/public/assets/scripts/choices.min.js") }}'><\/script>");
        document.writeln("<script type='text/javascript' src='{{ asset("assets/libs/flatpickr/flatpickr.min.js") }}'><\/script>");
    }
</script>
<script src="{{ asset("assets/js/app.js") }}"></script>
<script src="{{ asset("assets/app/dashboard/js/main.js") }}"></script>

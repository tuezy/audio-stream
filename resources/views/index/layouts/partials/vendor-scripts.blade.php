<script type="text/javascript">
    var JS_INLINE = JS_INLINE || {};
</script>


@foreach([
    "assets/libs/bootstrap/js/bootstrap.bundle.min.js",
    "assets/libs/simplebar/simplebar.min.js",
    "assets/libs/node-waves/waves.min.js",
    "assets/libs/feather-icons/feather.min.js",
    "assets/js/pages/plugins/lord-icon-2.1.0.js",
    "assets/libs/sweetalert2/sweetalert2.min.js",
    "assets/js/pages/sweetalerts.init.js",
    'assets/libs/dragula/dragula.min.js',
    "assets/js/pages/landing.init.js"
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
<script src="{{ asset("assets/app/index/js/main.js") }}"></script>
<script>
    /**
     * flatpickr
     */
    var flatpickrExamples = document.querySelectorAll("[data-provider]");
    Array.from(flatpickrExamples).forEach(function (item) {
        if (item.getAttribute("data-provider") == "flatpickr") {
            var dateData = {};
            var isFlatpickerVal = item.attributes;
            if (isFlatpickerVal["data-date-format"])
                dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
            if (isFlatpickerVal["data-enable-time"]) {
                (dateData.enableTime = true),
                    (dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString() + " H:i");
            }
            if (isFlatpickerVal["data-altFormat"]) {
                (dateData.altInput = true),
                    (dateData.altFormat = isFlatpickerVal["data-altFormat"].value.toString());
            }
            if (isFlatpickerVal["data-minDate"]) {
                dateData.minDate = isFlatpickerVal["data-minDate"].value.toString();
                dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
            }
            if (isFlatpickerVal["data-maxDate"]) {
                dateData.maxDate = isFlatpickerVal["data-maxDate"].value.toString();
                dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
            }
            if (isFlatpickerVal["data-deafult-date"]) {
                dateData.defaultDate = isFlatpickerVal["data-deafult-date"].value.toString();
                dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
            }
            if (isFlatpickerVal["data-multiple-date"]) {
                dateData.mode = "multiple";
                dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
            }
            if (isFlatpickerVal["data-range-date"]) {
                dateData.mode = "range";
                dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
            }
            if (isFlatpickerVal["data-inline-date"]) {
                (dateData.inline = true),
                    (dateData.defaultDate = isFlatpickerVal["data-deafult-date"].value.toString());
                dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
            }
            if (isFlatpickerVal["data-disable-date"]) {
                var dates = [];
                dates.push(isFlatpickerVal["data-disable-date"].value);
                dateData.disable = dates.toString().split(",");
            }
            if (isFlatpickerVal["data-week-number"]) {
                var dates = [];
                dates.push(isFlatpickerVal["data-week-number"].value);
                dateData.weekNumbers = true
            }
            flatpickr(item, dateData);
        } else if (item.getAttribute("data-provider") == "timepickr") {
            var timeData = {};
            var isTimepickerVal = item.attributes;
            if (isTimepickerVal["data-time-basic"]) {
                (timeData.enableTime = true),
                    (timeData.noCalendar = true),
                    (timeData.dateFormat = "H:i");
            }
            if (isTimepickerVal["data-time-hrs"]) {
                (timeData.enableTime = true),
                    (timeData.noCalendar = true),
                    (timeData.dateFormat = "H:i"),
                    (timeData.time_24hr = true);
            }
            if (isTimepickerVal["data-min-time"]) {
                (timeData.enableTime = true),
                    (timeData.noCalendar = true),
                    (timeData.dateFormat = "H:i"),
                    (timeData.minTime = isTimepickerVal["data-min-time"].value.toString());
            }
            if (isTimepickerVal["data-max-time"]) {
                (timeData.enableTime = true),
                    (timeData.noCalendar = true),
                    (timeData.dateFormat = "H:i"),
                    (timeData.minTime = isTimepickerVal["data-max-time"].value.toString());
            }
            if (isTimepickerVal["data-default-time"]) {
                (timeData.enableTime = true),
                    (timeData.noCalendar = true),
                    (timeData.dateFormat = "H:i"),
                    (timeData.defaultDate = isTimepickerVal["data-default-time"].value.toString());
            }
            if (isTimepickerVal["data-time-inline"]) {
                (timeData.enableTime = true),
                    (timeData.noCalendar = true),
                    (timeData.defaultDate = isTimepickerVal["data-time-inline"].value.toString());
                timeData.inline = true;
            }
            flatpickr(item, timeData);
        }
    });

    var drake = dragula(document.getElementById("playlist")).on('drag', function (el) {
        console.log('Dảg');
        el.className = el.className.replace('ex-moved', '');
    }).on('drop', function (el) {
        el.className += ' ex-moved';
    }).on('over', function (el, container) {
        container.className += ' ex-over';
    }).on('out', function (el, container) {
        container.className = container.className.replace('ex-over', '');
    });




</script>


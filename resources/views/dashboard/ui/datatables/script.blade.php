<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

        var datatableColumns = @json($columns ?? '{}');
        let table = new DataTable('#datatables-html', {
            processing: true,
            serverSide:true,
            paging: true,
            ordering: true,
            info: false,
            searching:true,
            fixedHeader: true,
            "pageLength": 15,
            order: [[1, 'asc']],
            "ajax":{
                "url": "{{ url()->current() }}",
                "dataType": "json",
                "type": "GET",
                "data":{
                    _token: "{{csrf_token()}}",
                }
            },
            "columns": datatableColumns

        });
        var customBtnSubmit = document.getElementById("custom-btn-submit");
        var customInputSearch = document.getElementById("custom-input-search");

        customBtnSubmit.addEventListener("click", function (value) {
            table.search(customInputSearch.value ).draw();
        });
        var checkAll = document.getElementById("checkAll");
        if (checkAll) {
            checkAll.onclick = function () {
                var checkboxes = document.querySelectorAll('.form-check-all input[type="checkbox"]');
                var checkedCount = document.querySelectorAll('.form-check-all input[type="checkbox"]:checked').length;
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = this.checked;
                    if (checkboxes[i].checked) {
                        checkboxes[i].closest("tr").classList.add("table-active");
                    } else {
                        checkboxes[i].closest("tr").classList.remove("table-active");
                    }
                }
            };
        }
    });



    

</script>
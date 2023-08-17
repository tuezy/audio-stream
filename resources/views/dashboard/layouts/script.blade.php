<script>
    function singleDelete(id){
        Swal.fire({
            title: "Bạn có chắc muốn xóa?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
            cancelButtonClass: 'btn btn-danger w-xs mt-2',
            confirmButtonText: "Yes, delete it!",
            buttonsStyling: false,
            showCloseButton: true
        }).then(function (result) {
            if (result.value) {
                try {
                    axios.delete('{{route("dashboard.$entity.delete")}}', {
                        data: {
                            ids: id
                        }
                    }).then(function (response) {
                        if(response.data.success){
                            location.reload();
                        }
                    })
                } catch (error) {
                    console.log(error)
                }
            }
        });
    }
    function showEditModal(id){
        try {
            axios.get('{{request()->url()}}/edit/'+id, {
                data: {
                    id: id
                }
            }).then(function (response) {
                document.getElementById('updateContentEdit').innerHTML = response.data;
                let myModal = new bootstrap.Modal(document.getElementById('showUpdateModal'), {
                    keyboard: false
                });
                myModal.show();
            })
        } catch (error) {
            console.log(error)
        }

    }
    function deleteMultiple() {
        ids_array = [];
        var items = document.getElementsByName('chk_child');
        for (i = 0; i < items.length; i++) {
            if (items[i].checked == true) {
                ids_array.push(items[i].value);
            }
        }

        if (typeof ids_array !== 'undefined' && ids_array.length > 0) {
            singleDelete(ids_array);
        } else {
            Swal.fire({
                title: 'Chọn ít nhất 1 dòng',
                confirmButtonClass: 'btn btn-info',
                buttonsStyling: false,
                showCloseButton: true
            });
        }
    }
</script>
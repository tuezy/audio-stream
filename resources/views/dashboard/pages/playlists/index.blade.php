@extends("dashboard.main")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center g-3">
                        <div class="col-md-3">
                            <h5 class="card-title mb-0">Danh sách phát</h5>
                        </div>
                        <div class="col-sm-auto ms-auto">
                            <div class="d-flex flex-wrap align-items-start justify-content-end gap-2">
{{--                                <button type="button"--}}
{{--                                        class="btn btn-success add-btn"--}}
{{--                                        data-bs-toggle="modal"--}}
{{--                                        id="create-btn"--}}
{{--                                        data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> New</button>--}}

{{--                                <a href="{{ route('dashboard.'.$entity.'.create') }}" type="button"--}}
{{--                                        class="btn btn-success add-btn"--}}
{{--                                        id="create-btn"--}}
{{--                                        ><i class="ri-add-line align-bottom me-1"></i> Add New Content</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {{ $datatables->html() }}
        </div>
    </div>
    @include("dashboard.pages.$entity.modal.create")
    <div id="updateContentEdit"></div>
@endsection
@section("script")
    {{ $datatables->includeScript() }}

{{--    <script>--}}
{{--        function singleDelete(id){--}}
{{--            Swal.fire({--}}
{{--                title: "Bạn có chắc muốn xóa?",--}}
{{--                text: "You won't be able to revert this!",--}}
{{--                icon: "warning",--}}
{{--                showCancelButton: true,--}}
{{--                confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',--}}
{{--                cancelButtonClass: 'btn btn-danger w-xs mt-2',--}}
{{--                confirmButtonText: "Yes, delete it!",--}}
{{--                buttonsStyling: false,--}}
{{--                showCloseButton: true--}}
{{--            }).then(function (result) {--}}
{{--                if (result.value) {--}}
{{--                    try {--}}
{{--                        axios.delete('{{route("dashboard.".$entity.".delete")}}', {--}}
{{--                            data: {--}}
{{--                                ids: id--}}
{{--                            }--}}
{{--                        }).then(function (response) {--}}
{{--                            if(response.data.success){--}}
{{--                                location.reload();--}}
{{--                            }--}}
{{--                        })--}}
{{--                    } catch (error) {--}}
{{--                        console.log(error)--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--        function showEditModal(id){--}}
{{--            try {--}}
{{--                axios.get('{{request()->url()}}/edit/'+id, {--}}
{{--                    data: {--}}
{{--                        id: id--}}
{{--                    }--}}
{{--                }).then(function (response) {--}}
{{--                    console.log(response.data);--}}
{{--                    document.getElementById('updateContentEdit').innerHTML = response.data;--}}
{{--                    console.log(response.data, document.getElementById('updateContentEdit'));--}}
{{--                    let myModal = new bootstrap.Modal(document.getElementById('showUpdateModal'), {--}}
{{--                        keyboard: false--}}
{{--                    });--}}
{{--                    myModal.show();--}}
{{--                })--}}
{{--            } catch (error) {--}}
{{--                console.log(error)--}}
{{--            }--}}

{{--        }--}}
{{--        function deleteMultiple() {--}}
{{--            ids_array = [];--}}
{{--            var items = document.getElementsByName('chk_child');--}}
{{--            for (i = 0; i < items.length; i++) {--}}
{{--                if (items[i].checked == true) {--}}
{{--                    ids_array.push(items[i].value);--}}
{{--                }--}}
{{--            }--}}

{{--            if (typeof ids_array !== 'undefined' && ids_array.length > 0) {--}}
{{--                singleDelete(ids_array);--}}
{{--            } else {--}}
{{--                Swal.fire({--}}
{{--                    title: 'Hãy chọn ít nhất 1 dòng',--}}
{{--                    confirmButtonClass: 'btn btn-info',--}}
{{--                    buttonsStyling: false,--}}
{{--                    showCloseButton: true--}}
{{--                });--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}
    <script>
        function pageSingleDelete(id) {
            return singleDelete('{{route("dashboard.".$entity.".delete")}}', id);
        }
        function pageDeleteMultiple() {
            return deleteMultiple('{{route("dashboard.".$entity.".delete")}}');
        }
        function showPageEditModal(id){
            return showEditModal('{{request()->url()}}/edit/'+id);
        }
    </script>
@endsection

@push("styles")
    {{ $datatables->includeStyles() }}
@endpush
@push("scripts")
    {{ $datatables->script() }}
@endpush


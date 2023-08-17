@extends("dashboard.main")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center g-3">
                        <div class="col-md-3">
                            <h5 class="card-title mb-0">Câu hỏi thường gặp</h5>
                        </div>
                        <div class="col-sm-auto ms-auto">
                            <div class="d-flex flex-wrap align-items-start justify-content-end gap-2">
                                <a href="{{ route('dashboard.cms.create') }}" type="button"
                                        class="btn btn-success add-btn"
                                        id="create-btn"
                                        ><i class="ri-add-line align-bottom me-1"></i> Thêm</a>
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
    @include("dashboard.pages.roles.create-modal")
    @include("dashboard.pages.roles.update-permission")
@endsection
@section("script")
    {{ $datatables->includeScript() }}
    @include("dashboard.layouts.script")
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


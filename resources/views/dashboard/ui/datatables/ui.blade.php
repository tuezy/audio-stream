<div class="card">
    <div class="card-header">
        <div class="row align-items-center g-3">
            <div class="col-md-3">
                <button class="btn btn-soft-danger"
                        id="remove-actions"
                        onclick="pageDeleteMultiple()"
                        style="display: block;">
                    <i class="ri-delete-bin-2-line"></i>
                </button>
            </div>
            <div class="col-md-auto ms-auto">
                <div class="d-flex gap-2">
                    <div class="search-box">
                        <input type="text" class="form-control search" placeholder="từ khóa ..." id="custom-input-search">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                    <button class="btn btn-success" id="custom-btn-submit"><i class="ri-equalizer-line align-bottom me-1" ></i> Tìm kiếm</button>
                </div>
            </div>
            <!--end col-->
        </div>
    </div>
    <div class="card-body p-4">
        <table id="datatables-html" class="display table table-bordered dt-responsive" style="width:100%">
            <thead>
            @foreach($columns as $column)
                @if($column['data'] == 'checkbox')
                    <th>
                        <div class="form-check text-center">
                            <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                        </div>
                    </th>
                @else
                    <th>{{ $column['title'] }}</th>
                @endif
            @endforeach
            </thead>
            <tbody class="form-check-all"></tbody>
        </table>
    </div>
</div>



@push("styles")
    <style>
        @isset($hideSearch)
#datatables-html_filter{
            display: none;
        }
        @endisset
#datatables-html_length{
            display: none;
        }

    </style>
@endpush
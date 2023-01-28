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

@push("styles")
    <style>
        .dt-id{
            width: 30px!important;
        }
        .dt-action{
            width: 50px!important;
        }
        .dt-code{
            width: 50px!important;
        }
        .dt-date{
            width: 95px!important;
        }
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
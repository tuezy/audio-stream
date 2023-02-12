@extends("index.main")
@section("content")
    <div id="cms" class="py-5">
        <div class="container">
            <div class="block-title text-center mb-4">
                <span>CÂU HỎI THƯỜNG GẶP</span>
            </div>
            <div class="cms-content">
                <div class="row">
                    @isset($cms)
                        @foreach($cms as $item)
                            @include('index.pages.cms.partials.item', ['item' => $item])
                        @endforeach
                    @endisset
                </div>
                <div class="row">
                    {{ $cms->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
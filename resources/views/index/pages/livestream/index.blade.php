@extends("index.main")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="block-title text-center mb-4">
                    <span>Các Thành Viên Đang Trực Tuyến</span>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($customers as $customer)
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="customer_streaming text-center mb-4">
                        <div class="__image shadow mb-3">
                            <a href="{{ route("livestream.customer.channel", [
    'channel' => $customer->live_channel
]) }}">
                                <img src="{{asset("images/play-final.png")}}" alt="images/play-final.png" class="img-fluid">
                            </a>
                        </div>
                        <div class="h4">{{ $customer->name }}</div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
@endsection
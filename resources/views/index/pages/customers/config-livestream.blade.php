@extends("index.main")
@section("content")
    <div class="container my-5">
        <div class="row">
            @if($customer->isLive ==false)
                <form action="{{ route("api.livestream.enable") }}" method="POST">

                    <input type="hidden" name="live_channel" value="{{ $customer->live_channel }}">
                    <input type="hidden" name="live_key" value="{{ $customer->live_key }}">
                    @csrf
                    <input type="hidden" name="enable_livestream" value="{{ $customer->email }}">
                    <button class="btn btn-primary">Bật Chức Năng Livestream</button>
                </form>
            @else

            <div class="col-12 col-lg-6">
                <div class="media-player">
                    <div id="player"></div>
                </div>
                <div>
                    <div class="form-group media-form my-3">
                        <label for="" class="title-link-status">Link M3U8</label>
                        <input type="text" class="form-control" value="http://192.168.206.130/hls/{{ $customer->live_key }}/index.m3u8">
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="block-title text-center mb-4">
                    <span>Thông số livestream</span>
                </div>
                <div class="form-group mb-3">
                    <label for="">RTMP Server:</label>
                    <input type="text" class="form-control" value="{{ config("livestream.rtmp-server") }}?channel={{ $customer->live_channel }}">
                </div>
                <div class="form-group">
                    <label for="">Key:</label>
                    <input type="text" class="form-control" value="{{ $customer->live_key }}">
                </div>
                <div class="form-group my-4">
                    <form action="{{ route("api.livestream.enable") }}" method="POST">
                        <input type="hidden" name="live_channel" value="{{ $customer->live_channel }}">
                        <input type="hidden" name="live_key" value="{{ $customer->live_key }}">
                        @csrf
                            <input type="hidden" name="disable_livestream" value="{{ $customer->email }}">
                            <button class="btn btn-dark">Tắt Chức Năng Livestream</button>

                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

@push("scripts")
    <script src="{{ asset("assets/libs/playerjs_audio_2.js?v=1") }}"></script>
    <script
            src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
            crossorigin="anonymous"></script>
    <script>
        var player = new Playerjs({id:"player", file:[
            "http://192.168.206.130/hls/{{ $customer->live_key }}/index.m3u8"
            ],
            poster: "{{asset("images/play-final.png")}}"
        });
        function audioplay(link, title){
            player.api("play", link);
            player.api("title", title);
            player.api("poster", "{{asset("images/play-final.png")}}");
        }
        audioplay("http://192.168.206.130/hls/{{ $customer->live_key }}/index.m3u8", "Live stream");
    </script>

@endpush
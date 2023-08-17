@extends("index.main")
@section("content")
    <div class="container my-5">
        <div class="row">
            <div class="media-player">
                <div id="player"></div>
            </div>
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
        @if($customer->use_default_channel)
        var hlsFile = "{{ config("livestream.rtmp-server-hls") }}{{ $customer->live_channel }}/index.m3u8";
        @else
        var hlsFile = "{{ config("livestream.rtmp-server-hls") }}{{ $customer->live_channel }}/{{ $customer->live_key }}/index.m3u8";
        @endif
        var player = new Playerjs({id:"player", file:[
                hlsFile
            ],
            poster: "{{asset("images/play-final.png")}}"
        });
        function audioplay(link, title){
            player.api("play", link);
            player.api("title", title);
            player.api("poster", "{{asset("images/play-final.png")}}");
        }
        audioplay(hlsFile, "Live stream");
    </script>

@endpush
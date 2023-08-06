@extends("index.main")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="media-player">
                    <div id="player"></div>
                </div>
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

        var player = new Playerjs({id:"player", file:[
            "http://103.186.65.162:8080/hls/audio-streamming.m3u8"
            ],
            poster: "{{asset("images/play-final.png")}}"
        });

        function audioplay(link, title){
            player.api("play", link);
            player.api("title", title);
            player.api("poster", "{{asset("images/play-final.png")}}");
        }
        audioplay("http://103.186.65.162:8080/hls/audio-streamming.m3u8", "Live stream");
    </script>

@endpush
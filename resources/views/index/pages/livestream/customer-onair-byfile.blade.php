@extends("index.main")
    @section("content")

        <div class="container">
            <div class="block-title text-center mb-4">
                <span>Thành viên <span class="text-uppercase text-danger fw-bold">{{ $customer->live_channel }}</span> đang phát sóng trực tuyến</span>
            </div>
        </div>
        <div id="customer-onair" class="py-5">
            <div class="container my-5">

                <div class="row justify-content-center">
                    <div class="col-md-6 col-12">
                        <div class="media-player">
                            <div id="player"></div>
                        </div>
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
            var hlsFile = "{{ config("livestream.rtmp-server-hls") }}{{ $file }}";

            var player = new Playerjs({id:"player", file:[
                    hlsFile
                ],
                poster: "{{asset("images/play-final.png")}}",
                autoplay: 1
            });
            function audioplay(link, title){
                player.api("play", link);
                player.api("title", title);
                player.api("poster", "{{asset("images/play-final.png")}}");
            }
            audioplay(hlsFile, "Live stream");

        </script>
    @endpush

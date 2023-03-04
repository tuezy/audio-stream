@extends("index.main")
@section("content")
    <div class="vertical-overlay" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent.show"></div>
    <div id="main-content" class="mt-5">
        <div id="mediaplay" class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="media-player">
                            <div id="player"></div>
                        </div>
                        <div class="media-form mt-3">
                            <livewire:link-status></livewire:link-status>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel-danhsachphat">
                            <span class="title">Danh sách phát</span>
                            <a class="nav-link" data-bs-toggle="modal" id="create-btn-search" data-bs-target="#showModal"><span class="btn-taomoi">Tạo mới</span></a>
                        </div>
                        <div class="playing">
                            <div class="playing__film">
                                @foreach($playlists as $broadcast_date => $playlist)
                                    <span class="broadcast_date broadcast_date_{{$playlist[0]['id']}}" value="{{$playlist[0]['id']}}" onclick="changePlaylist({{$playlist[0]['id']}}, 'broadcast_date_{{$playlist[0]['id']}}')">{{ \Illuminate\Support\Carbon::createFromFormat("Y-m-d", $broadcast_date)->format("d-m-Y") }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div id="playlist">
                        </div>
                        <button class="my-3 btn btn-outline-success btn-update-index-playlist d-none" onclick="updateIndexPlaylist()">Cập nhật Playlist</button>

                    </div>
                </div>
            </div>
        </div>
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
                        <a class="btn-xemthem mx-auto" href="{{ route("index.faq") }}">XEM THÊM</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push("scripts")
    <script src="{{ asset("assets/libs/playerjs_audio.js") }}"></script>

    <script>
        var player = new Playerjs({id:"player"});

        var playlists = document.getElementsByClassName("broadcast_date");

        if(playlists.length > 0){
            const firstPlaylist = playlists[0].getAttribute("value");
            playlists[0].classList.add('active');
            loadPlaylist(firstPlaylist);
        }else{
            console.log("Empty playlist");
        }

        var mediaVideos = document.getElementsByClassName("media-item__icon");

        Array.from(mediaVideos).forEach(function (element) {
            element.addEventListener("click", function () {
                var mediaSelected = element.getAttribute("target");

                var mediaSelecting = document.getElementsByClassName("media_selected");
                if(mediaSelecting.length > 0){
                    mediaSelecting[0].classList.remove("media_selected");
                }

                var videoSelected = document.getElementsByClassName(mediaSelected);
                videoSelected[0].classList.add("media_selected");
            });
        });

        function changePlaylist(id,event){
            loadPlaylist(id);
            let broadcastDate = document.getElementsByClassName("broadcast_date");
            Array.from(broadcastDate).forEach(function (element) {
                if(element.classList.contains('active')){
                    element.classList.remove('active');
                }
                //
            });
            let broadcastDateSeletcted = document.getElementsByClassName(event);
            broadcastDateSeletcted[0].classList.add('active');
        }

        function loadPlaylist(id){
            try {
                axios.post('{{request()->url()}}/playlist', {
                    data: {
                        id: id
                    }
                }).then(function (response) {
                    document.getElementById('playlist').innerHTML = response.data;
                })
            } catch (error) {
                console.log(error)
            }
            updatePlayer();
        }

        function audioplay(link, title){
            player.api("play", link);
            player.api("title", title);
        }

        function updatePlayer(){
            // var downloadPaths = document.getElementsByClassName("media-item__downloadPath");
            // player.api("playlist", []);
            // Array.from(downloadPaths).forEach(function (element) {
            //     let aHerf = element.getAttribute("href");
            //     let aTitle = element.getAttribute("title");
            //     player.api("push", [{
            //         "file" : aHerf,
            //         "title" : aTitle
            //     }])
            // });
        }


    </script>

    <script>
        function singleDelete(id){
            Swal.fire({
                title: "Bạn có chắc muốn xóa?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                cancelButtonClass: 'btn btn-danger w-xs mt-2',
                confirmButtonText: "Có",
                cancelButtonText: "Không",
                buttonsStyling: false,
                showCloseButton: true
            }).then(function (result) {
                if (result.value) {
                    try {
                        axios.delete('{{route("customers.delete.audio")}}', {
                            data: {
                                id: id
                            }
                        }).then(function (response) {
                            if(response.data.success){
                                location.reload();
                            }
                        })
                    } catch (error) {
                        console.log(error)
                    }
                }
            });
        }

        var drake = dragula([document.getElementById("playlist")])
            .on('drag', function (el) {
            el.className = el.className.replace('ex-moved', '');
            }).on('drop', function (el) {
                el.className += ' ex-moved';
            }).on('over', function (el, container) {
                container.className += ' ex-over';
            }).on('out', function (el, container) {
                container.className = container.className.replace('ex-over', '');
                let btn = document.getElementsByClassName("btn-update-index-playlist");
                btn[0].classList.remove('d-none');
            });

        function updateIndexPlaylist(){
            var playlists = document.getElementsByClassName("media-item");
            var indexs = [];

            Array.from(playlists).forEach(function (element) {
               indexs.push(element.getAttribute("value"));
            });

            try {
                axios.post('{{route("customers.update.playlist")}}', {
                    data: {
                        indexs: JSON.stringify(indexs)
                    }
                }).then(function (response) {
                    if(response.data.success){
                        location.reload();
                    }
                })
            } catch (error) {
                console.log(error)
            }
        }
    </script>
@endpush

@push("styles")
    <style>
        #player {
            height: 55px!important;
        }
    </style>
@endpush
@extends("index.main")
@section("content")
    <div class="vertical-overlay" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent.show"></div>
    <div id="main-content" class="mt-5">
        <div id="mediaplay" class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="media-player">
                            <div id="player"></div>
                            <div class="playing">
                                <div class="playing__film">
                                    {{ $video->title ?? '' }}
                                </div>
                            </div>
                            <div id="playlist">
                                @foreach($items as $item)
                                    <div class="media-item media-item__{{$item->id}}">
                                        <div class="media-item__icon" href="{{ $item->path }}" target="media-item__{{$item->id}}">
                                        </div>
                                        <div class="media-item__info">
                                            <div>
                                                <div class="title">{{ $item->title }}</div>
                                                <div class="description">{{ \Illuminate\Support\Str::words($item->content, 10) }}</div>
                                            </div>

                                        </div>
                                        <div class="media-item__download">
                                            <a href="{{ $item->path }}" download="{{ $item->slug }}" class="media-item__downloadPath" target="_blank">
                                                <img src="{{ asset("images/icon_download.png") }}" alt="icon_download"> Tải xuống
                                            </a>
                                        </div>
                                        <div class="media-item__delete">
                                            <a onclick="singleDelete({{ $item->id }})">
                                                <img src="{{ asset("images/icon_delete.png") }}" alt="icon_delete"> Xóa
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="my-3">
                                    {{ $items->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        @include("index.pages.ui.search")
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
                                <div class="col-lg-6">
                                    <div class="cms-item mb-4">
                                        <div class="title">
                                            {{ $item->title }}
                                            <div class="btn-more-pos"><span class="btn-more"></span></div>
                                        </div>
                                        <div class="content mt-2">
                                            {{ $item->content }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                    <div class="row">
                        <button class="btn-xemthem mx-auto">XEM THÊM</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push("scripts")
    <script src="{{ asset("assets/libs/playerjs.js") }}"></script>
    <script>
        var cmsItem = document.getElementsByClassName("cms-item");
        Array.from(cmsItem).forEach(function (element) {
            element.addEventListener("click", function () {
                this.classList.toggle("active");
            });
        });
    </script>
    <script>
        var player = null;
        // var mediaItems = document.getElementsByClassName("media-item");
        // Array.from(mediaItems).forEach(function (element) {
        //     element.addEventListener("click", function () {
        //         const inner = element.getElementsByClassName('media-item__downloadPath');
        //         const href = inner[0].href;
        //
        //         var mediaSelecting = document.getElementsByClassName("media_selected");
        //         mediaSelecting[0].classList.remove("media_selected");
        //         element.classList.add("media_selected");
        //         player.api("play", href);
        //     });
        // });
        //
        // if(mediaItems.length > 0){
        //     var firstItem = mediaItems[0].getElementsByClassName('media-item__downloadPath');
        //     var firstItemHref = firstItem[0].href;
        //     player = new Playerjs({id:"player", file:firstItemHref});
        //     mediaItems[0].classList.add('media_selected');
        // }

        var mediaVideos = document.getElementsByClassName("media-item__icon");
        Array.from(mediaVideos).forEach(function (element) {
            element.addEventListener("click", function () {
                const href = element.getAttribute("href");
                var mediaSelected = element.getAttribute("target");

                var mediaSelecting = document.getElementsByClassName("media_selected");
                if(mediaSelecting.length > 0){
                    mediaSelecting[0].classList.remove("media_selected");
                }

                var videoSelected = document.getElementsByClassName(mediaSelected);

                videoSelected[0].classList.add("media_selected");
                player.api("play", href);
            });
        });

        if(mediaVideos.length > 0){
            const href = mediaVideos[0].getAttribute("href");
            player = new Playerjs({id:"player", file:href});

            var mediaSelected = element.getAttribute("target");

            var mediaSelecting = document.getElementsByClassName("media_selected");
            if(mediaSelecting.length > 0){
                mediaSelecting[0].classList.remove("media_selected");
            }

        }else {
            player = new Playerjs({id:"player"});
        }


    </script>
    <script>
        function singleDelete(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                cancelButtonClass: 'btn btn-danger w-xs mt-2',
                confirmButtonText: "Yes, delete it!",
                buttonsStyling: false,
                showCloseButton: true
            }).then(function (result) {
                if (result.value) {
                    try {
                        axios.delete('{{route("video.delete")}}', {
                            data: {
                                ids: id
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
    </script>

@endpush
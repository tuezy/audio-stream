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
                                    Tên phim đang phát
                                </div>
                            </div>
                            <div id="playlist">
                                <div class="media-item">
                                    <div class="media-item__icon">
                                    </div>
                                    <div class="media-item__info">
                                        <div>
                                            <div class="title">Tên phim</div>
                                            <div class="description">Nội dung ghi chú của file</div>
                                        </div>

                                    </div>
                                    <div class="media-item__download">
                                        <img src="{{ asset("images/icon_download.png") }}" alt="icon_download"> Tải xuống
                                    </div>
                                    <div class="media-item__delete">
                                        <img src="{{ asset("images/icon_delete.png") }}" alt="icon_delete"> Xóa
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="media-search">
                            <div class="media-search__title">
                                <span>Tìm Kiếm</span>
                            </div>
                            <div class="media-search__type">
                                <ul>
                                    <li>Âm thanh</li>
                                    <span></span>
                                    <li>Phim</li>
                                </ul>
                            </div>
                            <div class="media-search__content">
                                <div class="media-form">
                                    <label for="media_type">Thể Loại</label>
                                    <select type="text" class="form-control" id="media_type" placeholder=>
                                        <option value="0">Chọn thể loại</option>
                                    </select>
                                </div>
                                <div class="media-form">
                                    <label for="media_type">Tên file</label>
                                    <select type="text" class="form-control" >
                                        <option value="0">Nhập tên file cần tìm</option>
                                    </select>
                                </div>
                                <button type="submit" class="media-search_btn">Tìm</button>
                            </div>

                        </div>
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
        var player = new Playerjs({id:"player", file:"http://45.76.204.156:88/hls/upload/1/20-01-2023/morning/morning.m3u8"});
    </script>
@endpush
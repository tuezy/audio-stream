<div class="media-search">
    <div class="media-search__title">
        <span>Tìm Kiếm</span>
    </div>
    <div class="media-search__type">
        <ul class="nav" role="tablist">
            <li><a data-bs-toggle="tab" href="#searchAudio"  class="active">Âm thanh</a></li>
            <span></span>
            <li><a data-bs-toggle="tab" href="#searchVideo">Phim</a></li>
        </ul>
    </div>
    <div class="media-search__content">
        <div class="tab-content">
            <div class="tab-pane active show" id="searchAudio" role="tabpanel">
                @include("index.pages.audio.search")
            </div>
            <!--end tab-pane-->
            <div class="tab-pane " id="searchVideo" role="tabpanel">
                @include("index.pages.video.search")
            </div>
        </div>
    </div>

</div>
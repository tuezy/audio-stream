<div class="modal fade index-creator" id="showModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

                <div class="modal-body">
                    <div class="media-search">
                        <div class="media-search__title">
                            <span>TẠO NỘI DUNG</span>
                        </div>
                        <div class="media-search__type">
                            <ul class="nav" role="tablist">
                                <li><a data-bs-toggle="tab" href="#createAudio"  class="active">Âm thanh</a></li>
                                <span></span>
                                <li><a data-bs-toggle="tab" href="#createVideo">Phim</a></li>
                            </ul>
                        </div>
                        <div class="media-search__content">
                            <div class="tab-content">
                            <div class="tab-pane active show" id="createAudio" role="tabpanel">
                                @include("index.pages.audio.create-modal")
                            </div>
                            <!--end tab-pane-->
                            <div class="tab-pane" id="createVideo" role="tabpanel">
                                @include("index.pages.video.create-modal")
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
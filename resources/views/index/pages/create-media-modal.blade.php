<div class="modal fade index-creator" id="showModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="tablelist-form" autocomplete="off" method="POST" action="{{ route("customers.upload") }}">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="media-search">
                        <div class="media-search__title">
                            <span>TẠO NỘI DUNG</span>
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
                                <label for="media_type" class="label">Thể Loại</label>
                                <select type="text" class="form-control" id="media_type" placeholder="">
                                    <option value="0">Chọn thể loại</option>
                                </select>
                            </div>
                            <div class="d-flex">
                                <div class="media-form me-5">
                                    <label for="media_type" class="label">Ngày Phát</label>

                                    <input type="text" name="start_date"
                                           class="media_type form-control border-0 dash-filter-picker shadow  flatpickr-input"
                                           data-provider="flatpickr"
                                           data-date-format="d-m-Y"
                                           placeholder="Chọn Ngày Phát">
                                </div>
                                <div class="media-form">
                                    <label for="media_type" class="label">Buổi Phát</label>
                                    <select type="text" class="form-control media_type" id="media_type" placeholder=>
                                        <option value="0">Chọn Buổi Phát</option>
                                    </select>
                                </div>
                            </div>
                            <div class="media-form">
                                <label for="media_type" class="label">Đăng file âm thanh</label>
                                <input type="file" class="form-control" placeholder="Vui lòng chọn file cần đăng" >
                            </div>
                            <div class="media-form">
                                <label for="media_type" class="label">Ghi Chú</label>
                                <textarea name="description" class="form-control" cols="30" rows="7" placeholder="Nhập nội dung ghi chú"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="media-search_btn mx-auto">Lưu</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
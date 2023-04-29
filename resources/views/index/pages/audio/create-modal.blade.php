<form class="tablelist-form" autocomplete="off" method="POST" action="{{ route("customers.upload.audio") }}" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="media-form">
        <label for="media_type" class="label">Tiêu đề</label>
        <input type="text" name="title" class="form-control">
    </div>
    <div class="d-flex">
        <div class="media-form me-5">
            <label for="media_type" class="label">Ngày Phát</label>
            <input type="text" name="broadcast_date"
                   class="media_type form-control border-0 dash-filter-picker shadow  flatpickr-input"
                   data-provider="flatpickr"
                   data-date-format="Y-m-d"
                   placeholder="Chọn Ngày Phát">
        </div>
        <div class="media-form">
            <label for="media_type" class="label">Buổi Phát</label>
            <select type="text" class="form-control media_type" id="media_type" name="broadcast_on">
                <option value=''>Chọn Buổi Phát</option>
                @foreach(\App\Models\Playlist::PLAYLIST_TYPES as $type => $playlist)
                    <option value="{{ $playlist }}">@lang("translation.".$type)</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="media-form">
        <label for="media_type" class="label">Đăng file âm thanh</label>
        <input type="file" class="form-control" name="file" placeholder="Vui lòng chọn file cần đăng" >
    </div>
    <div class="media-form">
        <label for="media_type" class="label">Ghi Chú</label>
        <textarea name="description" class="form-control" cols="30" rows="7" placeholder="Nhập nội dung ghi chú"></textarea>
    </div>
    <div class="text-center">
        <button type="submit" class="media-search_btn mx-auto">Lưu</button>
    </div>
</form>
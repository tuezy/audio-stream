<form action="">
    <div class="media-form">
        <label for="media_type">Buổi phát</label>
        <select type="text" class="form-control" id="media_type">
            <option value="0">Chọn buổi phát</option>
            @foreach(\App\Models\Playlist::PLAYLIST_TYPES as $type => $playlist)
                <option value="{{ $playlist }}">@lang("translation.".$type)</option>
            @endforeach
        </select>
    </div>

    <div class="media-form">
        <label for="media_type">Ngày phát</label>
        <div class="input-group" id="media_type">
            <input type="text" name="start_date"
                   class="form-control border-0 dash-filter-picker shadow  flatpickr-input"
                   data-provider="flatpickr"
                   data-date-format="d-m-Y"
                   data-deafult-date="10-02-2023">
        </div>
    </div>
    <div class="media-form">
        <label for="media_type">Tên file</label>
        <input type="text" name="title" class="form-control" placeholder="Nhập tên file cần tìm">
    </div>
    <button type="submit" class="media-search_btn">Tìm</button>
</form>
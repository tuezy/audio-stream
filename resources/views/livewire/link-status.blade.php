<div>
    <div class="media-form">
        <label for="media_type" class="title-link-status">Trạng thái  link hôm nay</label>
        <div class="input-group">
            <input type="text"
                   class="form-control"
                   aria-describedby="button-addon2"
                   value="{{ asset($linkM3u8) }}" >
            <button class="btn btn-outline-info" type="button" id="button-addon2" style="font-weight: 800">
                {{ $playlist_status ?? "Chưa sẵn sàng"}}</button>
        </div>
    </div>
</div>

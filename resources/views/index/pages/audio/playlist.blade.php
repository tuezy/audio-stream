@foreach($playlist as $item)
    <div class="media-item media-item__{{$item->id}}" value="{{$item->id}}">
        <div class="media-item__icon" onclick="audioplay('{{ asset($item->path) }}')" target="media-item__{{$item->id}}">
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
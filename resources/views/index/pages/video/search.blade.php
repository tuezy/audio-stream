<form action="{{ route("index.timkiem") }}" method="GET">
    @csrf
    <input type="hidden" name="video" value="onthefire">
    <div class="media-form">
        <label for="media_type">Thể loại</label>
        @php
            $categories = \App\Models\Category::all(['id','title', 'slug']);
        @endphp
        <select class="form-select" name="category_id">
            <option value="0">Thể loại</option>
            @foreach($categories as $group => $values)
                <option value="{{ $values->id }}">{{ $values->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="media-form">
        <label for="media_type">Tên file</label>
        <input type="text" name="title" class="form-control" placeholder="Nhập tên file cần tìm">
    </div>
    <button type="submit" class="media-search_btn">Tìm</button>
</form>
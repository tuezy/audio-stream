<form class="tablelist-form" autocomplete="off" method="POST" action="{{ route("customers.upload.video") }}" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="media-form">
        <label for="media_type" class="label">Tiêu đề</label>
        <input type="text" name="title" class="form-control">
    </div>
    <div class="d-flex">

        <div class="media-form">
            <label for="media_type" class="label">Thể loại</label>
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
    </div>
    <div class="media-form">
        <label for="media_type" class="label">Đăng file phim</label>
        <input type="file" name="file" class="form-control" placeholder="Vui lòng chọn file cần đăng" >
    </div>
    <div class="media-form">
        <label for="media_type" class="label">Ghi Chú</label>
        <textarea name="description" class="form-control" cols="30" rows="7" placeholder="Nhập nội dung ghi chú"></textarea>
    </div>
    <div class="text-center">
        <button type="submit" class="media-search_btn mx-auto">Lưu</button>
    </div>
</form>
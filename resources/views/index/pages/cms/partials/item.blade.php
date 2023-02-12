<div class="col-lg-6">
    <div class="cms-item mb-4">
        <div class="title">
            {{ $item->title }}
            <div class="btn-more-pos"><span class="btn-more"></span></div>
        </div>
        <div class="content mt-2">
            {!! $item->short_content !!}
            <div class="xemchitiet my-3 text-right">
                <a href="{{ route("index.faq.item", ['slug' => $item->slug]) }}">Xem chi tiết <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                        </svg>
                    </span></a>
            </div>
        </div>

    </div>
</div>
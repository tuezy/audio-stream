<ul class="pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
    <li class="page-item disabled">
        <a href="#" class="page-link">Previous</a>
    </li>
    <li class="page-item active">
        <a href="#" class="page-link">1</a>
    </li>
    <li class="page-item ">
        <a href="#" class="page-link">2</a>
    </li>
    <li class="page-item">
        <a href="#" class="page-link">3</a>
    </li>
    <li class="page-item">
        <a href="#" class="page-link">4</a>
    </li>
    <li class="page-item">
        <a href="#" class="page-link">5</a>
    </li>
    <li class="page-item">
        <a href="#" class="page-link">Next</a>
    </li>
</ul>
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

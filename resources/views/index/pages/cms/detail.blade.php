@extends("index.main")
@section("content")
  <div class="container">
      <div id="cms-detail">
          <div class="block-title text-center mb-4">
              <span>{{ $item->title }}</span>
          </div>
          <div class="cms-detail__content">
              {!! $item->content !!}
          </div>
      </div>
  </div>
@endsection

@push("styles")
    <style>
        img{
            max-width: 100% !important;
        }
        p{
            line-height: 1.5rem;
        }
    </style>
@endpush
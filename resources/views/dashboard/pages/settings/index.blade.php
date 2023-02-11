@extends("dashboard.main")
@section("content")

    <form action="" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            @foreach($keys as $i => $key)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if($key == 'general') active @endif"
                                       data-bs-toggle="tab"
                                       href="#settings_{{$key}}"
                                       role="tab"
                                       aria-selected="true">
                                        <i class="fas fa-home"></i>
                                        {{ __($key) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            @foreach($settings as $key => $setting)
                                <div class="tab-pane @if($key=='general') active @endif" id="settings_{{$key}}" role="tabpanel">
                                    @foreach($setting as $config)
                                        @include("dashboard.pages.settings.input", ['config' => $config])
                                    @endforeach
                                </div>
                            @endforeach
                            <div class="row align-items-center mb-3">
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        <button type="button" class="btn btn-soft-success">Hủy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </form>
@endsection

<div class="topbar">
    <div class="container">
        <div class="topbar-wrapper d-flex justify-content-between align-items-center">
            <div class="topbar-left">
                <div>{{ core()->getSetting('site_title') }}</div>
            </div>
            <div class="tobpar-right d-flex justify-content-end">
                <div class="topbar-address me-4">
                    {{ core()->getSetting('address') }}
                </div>
                <div class="topbar-email">
                    {{ core()->getSetting('email') }}
                </div>
            </div>
        </div>
    </div>
</div>
@auth
<nav class="p-0 navbar-expand-lg navbar-landing fixed-top" id="navbar">
    <div class="container">
        <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>

        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
            <ul class="index-menu navbar-nav mt-2 mt-lg-0" >
                <li class="nav-item">
                    <a class="nav-link @if(\Illuminate\Support\Str::contains(request()->url(), '/phat-thanh-buoi-sang')) active @endif" href="{{ route("home.sang") }}">Phát thanh buổi sáng</a>
                </li>
               <li class="nav-item">
                   <a class="nav-link mx-3">|</a>
               </li>
                <li class="nav-item">
                    <a class="nav-link @if(\Illuminate\Support\Str::contains(request()->url(), '/phat-thanh-buoi-trua')) active @endif" href="{{ route("home.trua") }}">Phát thanh buổi trưa</a>
                </li>
               <li class="nav-item">
                   <a class="nav-link mx-3">|</a>
               </li>
                <li class="nav-item">
                    <a class="nav-link @if(\Illuminate\Support\Str::contains(request()->url(), '/phat-thanh-buoi-toi')) active @endif" href="{{ route("home.toi") }}">Phát thanh buổi tối</a>
                </li>
               <li class="nav-item  d-none">
                   <a class="nav-link mx-3">|</a>
               </li>
                <li class="nav-item d-none">
                    <a class="nav-link @if(\Illuminate\Support\Str::contains(request()->url(), '/phim')) active @endif" href="{{ route("video.index") }}">Phim</a>
                </li>
               <li class="nav-item">
                   <a class="nav-link mx-3">|</a>
               </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="modal" id="create-btn-search" data-bs-target="#showModalSearch">Tìm kiếm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3">|</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(\Illuminate\Support\Str::contains(request()->url(), '/phim')) active @endif" href="{{ route("customers.panel") }}">Quản lý buổi phát thanh</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3">|</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(\Illuminate\Support\Str::contains(request()->url(), '/livestream')) active @endif" href="{{ route("livestream.index") }}">Trực tuyến</a>
                </li>

            </ul>

            <div class="user_panel">
                <div class="dropdown ms-1 topbar-head-dropdown header-item">
                    <div data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="user_panel_name">
                        <span class="username">{{ \Illuminate\Support\Facades\Auth::guard("customers")->user()->name }}</span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-end">
{{--                        <a href="{{ route("customers.livestream.config") }}" class="dropdown-item notify-item language py-2" data-lang="en" title="Phát sóng trực tiếp">--}}
{{--                            Phát sóng trực tiếp--}}
{{--                        </a>--}}
                        <a href="{{ route("customers.panel") }}" class="dropdown-item notify-item language py-2" data-lang="en" title="English">
                            <i class="bx bx-user-circle font-size-16 align-middle me-1"></i><span>Thông tin</span>
                        </a>

                        <a class="dropdown-item " href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off font-size-16 align-middle me-1"></i> <span key="t-logout">@lang('translation.logout')</span></a>
                        <form id="logout-form" action="{{ route('customers.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</nav>
@endauth
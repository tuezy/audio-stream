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
               <li class="nav-item">
                   <a class="nav-link mx-3">|</a>
               </li>
                <li class="nav-item">
                    <a class="nav-link @if(\Illuminate\Support\Str::contains(request()->url(), '/phim')) active @endif" href="{{ route("video.index") }}">Phim</a>
                </li>
               <li class="nav-item">
                   <a class="nav-link mx-3">|</a>
               </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal">Tạo nội dung</a>
                </li>

            </ul>

            <div class="user_panel">
                <div class="dropdown ms-1 topbar-head-dropdown header-item">
                    <div data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="user_panel_name">
                        <span class="username">{{ \Illuminate\Support\Facades\Auth::guard("customers")->user()->name }}</span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="{{ route("customers.panel") }}" class="dropdown-item notify-item language py-2" data-lang="en" title="English">
                            Thông tin
                        </a>
                        <a href="customer/logout" class="dropdown-item notify-item language py-2" data-lang="en" title="English">
                           Logout
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</nav>
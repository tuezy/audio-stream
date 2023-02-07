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
                    <a class="nav-link active" href="phat-thanh-buoi-sang">Phát thanh buổi sáng</a>
                </li>
               <li class="nav-item">
                   <a class="nav-link mx-3">|</a>
               </li>
                <li class="nav-item">
                    <a class="nav-link" href="phat-thanh-buoi-trua">Phát thanh buổi trưa</a>
                </li>
               <li class="nav-item">
                   <a class="nav-link mx-3">|</a>
               </li>
                <li class="nav-item">
                    <a class="nav-link" href="phat-thanh-buoi-toi">Phát thanh buổi tối</a>
                </li>
               <li class="nav-item">
                   <a class="nav-link mx-3">|</a>
               </li>
                <li class="nav-item">
                    <a class="nav-link" href="phim">Phim</a>
                </li>
               <li class="nav-item">
                   <a class="nav-link mx-3">|</a>
               </li>
                <li class="nav-item">
                    <a class="nav-link" href="#reviews">Tạo nội dung</a>
                </li>

            </ul>

            <div class="">
                <a href="auth-signin-basic.html" class="btn btn-link fw-medium text-decoration-none text-dark">Sign in</a>
                <a href="auth-signup-basic.html" class="btn btn-primary">Sign Up</a>
            </div>
        </div>

    </div>
</nav>
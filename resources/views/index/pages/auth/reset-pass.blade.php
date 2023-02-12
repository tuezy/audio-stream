@extends('index.main-without-nav')
@section('content')
    <div class="auth-page-wrapper pt-5" id="index-login">
        <!-- auth page bg -->
        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index" class="d-inline-block auth-logo">
                                    <img src="{{ URL::asset('assets/dashboard/images/logo-light.png')}}" alt="" height="20">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="mt-4">

                            <div class="card-body p-4">
                                @isset($status)
                                    <div class="card">
                                        <div class="card-body">
                                            Một đường link để tạo lại mật khẩu đã được gửi đi, vui lòng kiểm tra hộp thư email bạn đã cung cấp.
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route("index")}}" class="btn-submit btn btn-outline-light w-100" type="submit">Quay Lại</a>
                                    </div>
                                @else
                                <div class="text-center mt-2">
                                    <h5 class="text-white mb-3">Chào mừng bạn đến với website</h5>
                                    <h3 class="text-white"><a href="{{ route('index') }}" class="home-link-white">{{ \Illuminate\Support\Str::upper(core()->getSetting('site_title')) }}</a></h3>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="{{ route('index.reset-pass') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="username" name="email" placeholder="Email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="float-end mt-2 mb-4">
                                            <a href="{{ route('index.login') }}" class="text-white">Đăng nhập</a>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn-submit btn btn-outline-light w-100" type="submit">Quên Mật Khẩu</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            @endisset
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center d-none">
                            <p class="mb-0">Don't have an account ? <a href="register" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->

        <!-- end Footer -->
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/particles.js/particles.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/particles.app.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/password-addon.init.js') }}"></script>
@endsection



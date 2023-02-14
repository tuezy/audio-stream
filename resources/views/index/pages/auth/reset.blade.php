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
                                    <img src="{{ URL::asset('assets/dashboard/images/logo-broadcast.png')}}" alt="" height="20">
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
                                <div class="text-center mt-2">
                                    <h5 class="text-white mb-3">Chào mừng bạn đến với website</h5>
                                    <h3 class="text-white"><a href="{{ route('index') }}" class="home-link-white">{{ \Illuminate\Support\Str::upper(core()->getSetting('site_title')) }}</a></h3>
                                </div>
                                <div class="p-2 mt-4">
                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <div class="mb-3">
                                            <label for="username" class="form-label text-white">Email</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="username" name="email" value="{{ $email ?? old('email') }}" placeholder="Email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label text-white" for="password-input">Mật khẩu</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu" id="password-input">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                    <label class="form-label text-white" for="password-input">Nhập lại mật khẩu</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" name="password_confirmation" placeholder="Mật khẩu" id="password-input">
                                                        @error('password_confirmation')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>
                                            </div>
                                        <div class="mt-4">
                                            <button class="btn-submit btn btn-outline-light w-100" type="submit">Đặt lại mật khẩu</button>
                                        </div>

                                        <div class="mt-4 text-center d-none">
                                            <div class="signin-other-title">
                                                <h5 class="fs-13 mb-4 title">Sign In with</h5>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-facebook-fill fs-16"></i></button>
                                                <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></button>
                                                <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i class="ri-github-fill fs-16"></i></button>
                                                <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i class="ri-twitter-fill fs-16"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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



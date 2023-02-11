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
                                <div class="p-2 mt-4">
                                       <div class="card">
                                           <div class="card-body">
                                               {{ $message ?? "Có lỗi xảy ra, vui lòng kiểm tra lại."}}
                                           </div>
                                       </div>
                                        <div class="mt-4">
                                            <a href="{{ $link ?? route("index")}}" class="btn-submit btn btn-outline-light w-100" type="submit">Quay Lại</a>
                                        </div>

                                </div>
                            </div>
                            <!-- end card body -->
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



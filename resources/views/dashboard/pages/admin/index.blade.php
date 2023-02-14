@extends("dashboard.main")
@section("content")

    <form  method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active"
                                   data-bs-toggle="tab"
                                   href="#admin_changepass"
                                   role="tab"
                                   aria-selected="true">
                                    <i class="fas fa-home"></i>
                                    Change Password
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                                <div class="tab-pane active" id="admin_changepass" role="tabpanel">
                                    <div class="mb-3">
                                        <label class="form-label text-white" for="password-input">mật khẩu cũ</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" name="old_password" placeholder="Mật khẩu" id="password-input">
                                            @error('old_password')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-white" for="password-input">mật khẩu mới</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu" id="password-input">
                                            @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
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
                                </div>
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

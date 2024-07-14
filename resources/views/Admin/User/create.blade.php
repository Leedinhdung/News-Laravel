@extends('Admin.layouts.master')
@section('title')
    Thêm người dùng | Velzon
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới người dùng</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý người dùng</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Các bươc đăng ký</h4>
        </div><!-- end card header -->
        <div class="card-body">
            <form action="{{route('admin.user.store')}}" enctype="multipart/form-data" method="POST" class="form-steps"
                  autocomplete="off">
                @csrf
                <div class="text-center pt-3 pb-4 mb-1">
                    <h5>Đăng ký tài khoản của bạn</h5>
                </div>
                <div id="custom-progress-bar" class="progress-nav mb-4">
                    <div class="progress" style="height: 1px;">
                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                             aria-valuemin="0"
                             aria-valuemax="100"></div>
                    </div>

                    <ul class="nav nav-pills progress-bar-tab custom-nav" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill active" data-progressbar="custom-progress-bar"
                                    id="pills-gen-info-tab" data-bs-toggle="pill" data-bs-target="#pills-gen-info"
                                    type="button" role="tab" aria-controls="pills-gen-info" aria-selected="true">1
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" data-progressbar="custom-progress-bar"
                                    id="pills-info-desc-tab" data-bs-toggle="pill" data-bs-target="#pills-info-desc"
                                    type="button" role="tab" aria-controls="pills-info-desc"
                                    aria-selected="false">2
                            </button>
                        </li>

                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pills-gen-info" role="tabpanel"
                         aria-labelledby="pills-gen-info-tab">
                        <div>
                            <div class="mb-4">
                                <div>
                                    <h5 class="mb-1">Thông tin chung</h5>
                                    <p class="text-muted">Điền đầy đủ các thông tin dưới đây</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-first-name-input">Họ</label>
                                        <input type="text" class="form-control" name="first_name"
                                               id="gen-info-first-name-input" placeholder="Nhập họ"
                                               value="{{ old('first_name') }}" required>
                                        <div class="invalid-feedback">Vui lòng nhập họ của bạn</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-last-name-input">Tên</label>
                                        <input type="text" class="form-control" name="last_name"
                                               id="gen-info-last-name-input" placeholder="Nhập tên"
                                               value="{{ old('last_name') }}" required>
                                        <div class="invalid-feedback">Vui lòng nhập tên của bạn</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-phone-input">Số điện thoại</label>
                                        <input type="text" class="form-control" name="phone" id="gen-info-phone-input"
                                               placeholder="Nhập số điện thoại" value="{{ old('phone') }}" required>
                                        <div class="invalid-feedback">Vui lòng nhập số điện thoại của bạn</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-username-input">Tên tài khoản</label>
                                        <input type="text" class="form-control" name="username"
                                               id="gen-info-username-input" placeholder="Nhập tên tài khoản" required>
                                        <div class="invalid-feedback">Vui lòng nhập tên tài khoản</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-email-input">Email</label>
                                        <input type="email" class="form-control" name="email"
                                               id="gen-info-email-input" placeholder="Nhập email"
                                               value="{{ old('email') }}" required>
                                        <div class="invalid-feedback">Vui lòng nhập địa chỉ email</div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-password-input">Mật khẩu</label>
                                        <input type="password" class="form-control" name="password"
                                               id="gen-info-password-input"
                                               placeholder="Nhập mật khẩu" required>
                                        <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-email-input">Vai trò</label>
                                        <select class="js-example-basic-multiple" name="role_id[]"
                                                multiple="multiple" required>
                                            @foreach($role as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Vui lòng chọn vai trò</div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="d-flex align-items-start gap-3 mt-4">
                            <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                    data-nexttab="pills-info-desc-tab"><i
                                    class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Bước tiếp
                                theo
                            </button>
                        </div>
                    </div>
                    <!-- end tab pane -->

                    <div class="tab-pane fade" id="pills-info-desc" role="tabpanel"
                         aria-labelledby="pills-info-desc-tab">
                        <div>
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto mb-2">
                                    <img src="{{ asset('assets/images/users/user-dummy-img.jpg') }}"
                                         class="rounded-circle avatar-lg img-thumbnail user-profile-image"
                                         alt="user-profile-image">
                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                        <input id="profile-img-file-input" type="file" class="profile-img-file-input"
                                               name="thumbnail">
                                        <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                <i class="ri-camera-fill"></i>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <h5 class="fs-14">Thêm ảnh</h5>

                            </div>

                            <div>
                                <label class="form-label" for="gen-info-description-input">Mô tả</label>
                                <textarea class="form-control" name="description" placeholder="Nhập mô tả"
                                          id="gen-info-description-input"
                                          rows="4"
                                          required></textarea>
                                <div class="invalid-feedback">Vui lòng nhập mô tả</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-3 mt-4">
                            <button type="button" class="btn btn-link text-decoration-none btn-label previestab"
                                    data-previous="pills-gen-info-tab"><i
                                    class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Quay lại
                            </button>
                            <button class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                    data-nexttab="pills-success-tab"><i
                                    class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Đăng ký
                            </button>
                        </div>
                    </div>

                    <!-- end tab pane -->


                    <!-- end tab pane -->
                </div>
                <!-- end tab content -->
            </form>
        </div>
        <!-- end card body -->
    </div>
@endsection
@section('style-libs')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('script-libs')
    <!-- ckeditor -->
    <script src="{{ asset('assets/js/pages/form-wizard.init.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{asset('assets/js/pages/select2.init.js')}}"></script>
    <script>
        $(".js-example-basic-multiple").select2({
            placeholder: "Select a state",
            allowClear: true
        });
    </script>
@endsection

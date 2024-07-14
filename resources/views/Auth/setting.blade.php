@extends('Admin.Layouts.master')
@section('content')
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="{{ asset('assets/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">
            <div class="overlay-content">
                <div class="text-end p-3">
                    <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                        <input id="profile-foreground-img-file-input" type="file"
                               class="profile-foreground-img-file-input">
                        <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                            <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.auth.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xxl-3">
                <div class="card mt-n5">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                @php
                                    $url = $user->thumbnail;
                                    if (!\Illuminate\Support\Str::contains($url, 'http')) {
                                        $url = \Illuminate\Support\Facades\Storage::url($url);
                                    }
                                @endphp
                                <img src="{{ $url }}"
                                     class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                     alt="user-profile-image">
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input id="profile-img-file-input" type="file" name="thumbnail"
                                           class="profile-img-file-input">
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body"><i
                                                class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <h5 class="fs-16 mb-1">{{$user->first_name}} {{$user->last_name}}</h5>
                            <p class="text-muted mb-0"></p>
                        </div>
                    </div>
                </div>
                <!--end card-->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-5">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-0">Complete Your Profile</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="javascript:void(0);" class="badge bg-light text-primary fs-12"><i
                                        class="ri-edit-box-line align-bottom me-1"></i> Edit</a>
                            </div>
                        </div>
                        <div class="progress animated-progress custom-progress progress-label">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30"
                                 aria-valuemin="0" aria-valuemax="100">
                                <div class="label">30%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-0">Portfolio</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="javascript:void(0);" class="badge bg-light text-primary fs-12"><i
                                        class="ri-add-fill align-bottom me-1"></i> Add</a>
                            </div>
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-body text-body">
                                    <i class="ri-github-fill"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="" id="gitUsername" placeholder="github"
                                   value="@daveadame">
                        </div>

                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            <div class="col-xxl-9">
                <div class="card mt-xxl-n5">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                    <i class="fas fa-home"></i> Thông tin cá nhân
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <form action="javascript:void(0);">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">Họ</label>
                                                <input type="text" class="form-control" name="first_name"
                                                       id="firstnameInput" placeholder="Enter your firstname"
                                                       value="{{ $user->first_name }}">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="lastnameInput" class="form-label">Tên</label>
                                                <input name="last_name" type="text" class="form-control"
                                                       id="lastnameInput" placeholder="Enter your lastname"
                                                       value="{{ $user->last_name }}">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Số điện thoại</label>
                                                <input name="phone" type="text" class="form-control"
                                                       value="{{ $user->phone }}"
                                                       id="phonenumberInput" placeholder="Enter your phone number">
                                            </div>
                                        </div>

                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Email</label>
                                                <input name="email" type="email" class="form-control"
                                                       id="emailInput" value="{{ $user->email }}"
                                                       placeholder="Enter your email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-email-input">Vai trò</label>
                                                <select class="js-example-basic-multiple" name="role_id[]"
                                                        multiple="multiple" required>
                                                    @foreach($role as $value)
                                                        <option
                                                            {{--Kiểm tra xem id có nằm trong roleOfUser hay không,
                                                             nếu có thì so sash với value->id,
                                                             trùng nhau thì in ra selected không thì thôi--}}
                                                            {{$roleOfUser->contains('id',$value->id)?'selected':''}}
                                                            value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">Vui lòng chọn vai trò</div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="mb-3 pb-2">
                                                <label for="exampleFormControlTextarea"
                                                       class="form-label">Tiểu sử</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea"
                                                          placeholder="Enter your description" rows="3"
                                                          name="description">{{$user->description}}</textarea>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                <a href="{{route('admin.auth.profile',$user->id)}}"
                                                   class="btn btn-soft-success">Quay lại</a>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                            <!--end tab-pane-->

                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>

        <!--end row-->
    </form>
@endsection
@section('style-libs')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('script-libs')
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

@extends('Admin.layouts.master')
@section('title')
    Thêm danh mục | Velzon
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới danh mục</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý danh mục</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form action="{{ route('admin.role.update', $role->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Tên vai trò</label>
                            <input type="text" name="name" class="form-control" value="{{ $role->name }}">
                            @error('name')
                                <div class="error-message mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label>Mô tả vai trò</label>
                            <textarea name="description" class="form-control" cols="30" rows="10">{{ $role->description }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-primary w-sm">Đăng</button>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Các quyền</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        @foreach ($list_permission as $key => $value)
                            <div class="list-group">
                                <div class="list-group-item nested-1">
                                    <input type="checkbox" class="checkbox_wrapper form-check-input">
                                    <span class="text-uppercase fw-bold">{{ $key }}</span>

                                    @foreach ($value as $item)
                                        <div class="mt-2 ">
                                            <div class="list-group-item nested-2">
                                                <input type="checkbox" class="checkbox_child form-check-input"
                                                    name="permission_id[]" value="{{ $item->id }}" {{-- $role->permissions:truy cập vào đối tượng để lấy dữ liệu của đối tượng đó --}}
                                                    {{-- constains : dùng để kiểm tra xem đối tượng kia có những điều kiện mà mình truyền vào không --}}
                                                    {{ $role->permissions->contains('id', $item->id) ? 'checked' : '' }}>
                                                <span>{{ $item->name }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
        </div>
    </form>
@endsection
@section('style-libs')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-tagsinput.css') }}">
    <style>
        .label-info {
            background-color: #405189;
            padding: 1px 7px;
            border-radius: 5px;
            margin-bottom: 2px;
        }
    </style>
@endsection
@section('script-libs')
    <!-- ckeditor -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.js"
        integrity="sha512-cG3ZNAM4Uv2CO/rbBbA7v24d5COF/P5QgDE5HzfoM41uRK7wTIXtxy4UO9ZKE0bjUprMr92Lhv5O6CWdnIZZ/w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.checkbox_wrapper').on('click', function() {
            $(this).parents('.list-group-item').find('.checkbox_child').prop('checked', $(this).prop('checked'))
        });
    </script>
@endsection

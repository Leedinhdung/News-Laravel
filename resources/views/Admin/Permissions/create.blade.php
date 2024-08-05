@extends('Admin.layouts.master')
@section('title')
    Thêm danh mục | Velzon
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới quyền</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý quyền</a></li>
                        <li class="breadcrumb-item active">Thêm mới quyền</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form action="{{ route('admin.permission.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Tên quyền</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <div class="error-message mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label>Slug</label>

                            <input type="text" name="slug" class="form-control" id=""
                                placeholder="Vd: post.list, post.create...">
                            @error('slug')
                                <div class="error-message mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <small>Vui lòng nhập slug giống như hướng dẫn!</small>
                        </div>
                        <div class="mb-3">
                            <label>Mô tả</label>
                            <textarea name="description" id="" class="form-control" cols="30" rows="10"></textarea>
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
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Danh sách quyền</h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Tên quyền</th>
                                            <th scope="col">Mô tả</th>
                                            <th scope="col">Slug</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($list_permission as $key => $value)
                                            @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <td></td>
                                                <td colspan="4" class="text-uppercase fw-bold">{{ $key }}</td>

                                            </tr>
                                            @foreach ($value as $item)
                                                <tr>
                                                    <th scope="row"><a href="#"
                                                            class="fw-medium">{{ $i }}</a></th>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->description }}</td>
                                                    <td>{{ $item->slug }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.permission.edit', $item->id) }}"
                                                            class="btn btn-warning btn-sm">Chỉnh sửa</a>
                                                        <a href="{{ route('admin.permission.destroy', $item->id) }}"
                                                            class="btn btn-danger btn-sm">Xóa</a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            {{-- @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <th scope="row"><a href="#"
                                                        class="fw-medium">{{ $i }}</a></th>
                                                <td>{{ $permission->name }}</td>
                                                <td>{{ $permission->description }}</td>
                                                <td>{{ $permission->slug }}</td>
                                                <td>
                                                    <a href="{{ route('admin.permission.edit', $permission->id) }}"
                                                        class="btn btn-warning btn-sm">Chỉnh sửa</a>
                                                    <a href="{{ route('admin.permission.destroy', $permission->id) }}"
                                                        class="btn btn-danger btn-sm">Xóa</a>
                                                </td>
                                            </tr> --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
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

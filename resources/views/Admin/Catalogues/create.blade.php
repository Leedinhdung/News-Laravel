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

    <form action="{{ route('admin.catalogues.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Tên danh mục</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <div class="error-message mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label>Mô tả danh mục</label>

                            <textarea rows="10" cols="10" class="form-control" name="description"></textarea>
                        </div>
                    </div>
                </div>
                <!-- end card -->


                <!-- end card -->


                <!-- end card -->

            </div>
            <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Status</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                <input type="checkbox" name="is_active" checked value="1" class="form-check-input">
                                <label class="form-check-label" for="customSwitchsizemd">Is Active</label>
                            </div>
                        </div>


                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Danh mục Categories</h5>
                    </div>
                    <div class="card-body">
                        <select class="form-select" name="parent_id">

                            <option value="0">--Chọn danh mục--</option>

                            @foreach ($data as $key => $value)
                                <option value="{{ $value->id }}">
                                    @php
                                        $str = '';
                                        for ($i = 0; $i < $value->level; $i++) {
                                            echo $str;
                                            $str .= '-';
                                        }
                                    @endphp
                                    {{ $value->name }}
                                </option>
                            @endforeach
                            {{-- @foreach ($data as $catalogue)
                                @if ($catalogue->parent_id == 0)
                                    <option value="{{ $catalogue->id }}">{{ $catalogue->name }}</option>
                                    @foreach ($data as $cata => $sub_cata)
                                        @if ($sub_cata->parent_id != 0 && $sub_cata->parent_id == $catalogue->id)
                                            <option value="{{ $sub_cata->id }}">-{{ $sub_cata->name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach --}}
                        </select>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <!-- end card -->


                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-primary w-sm">Đăng</button>
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
@endsection

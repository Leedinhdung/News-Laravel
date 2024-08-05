@extends('Admin.layouts.master')
@section('title')
    Chỉnh sửa danh mục | Velzon
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Cập nhật danh mục</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.catalogues.index') }}">Quản lý danh mục</a></li>
                        <li class="breadcrumb-item active">Cập nhật</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <form action="{{ route('admin.catalogues.update', $catalogue->id) }}" method="POST" enctype="multipart/form-data"
        class="needs-validation">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Tên danh mục</label>
                            <input type="text" name="name" class="form-control" id="catalogue-title-input"
                                value="{{ $catalogue->name }}" placeholder="Nhập tên danh mục">
                            <div class="invalid-feedback">Nhập tên danh mục</div>
                        </div>
                        <div>
                            <label>Mô tả danh mục</label>
                            <textarea rows="10" cols="10" class="form-control" name="description">{{ $catalogue->description }}</textarea>
                        </div>
                    </div>
                </div>
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
                                <input type="checkbox" name="is_active" @if ($catalogue->is_active == 1) checked @endif
                                    value="1" class="form-check-input">
                                <label class="form-check-label" for="customSwitchsizemd">Is Active</label>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <!-- end card -->

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Danh mục Categories</h5>
                    </div>
                    <div class="card-body">
                        <select class="form-select" name="parent_id">

                            <option value="0">--Chọn danh mục--</option>
                            @foreach ($data as $key => $value)
                                <option value="{{ $value->id }}" @if ($value->id == $catalogue->id) selected @endif>
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
        <div class=" mt-2 mb-3">
            <button type="submit" class="btn btn-primary w-sm">Cập nhật</button>
        </div>
    </form>
@endsection

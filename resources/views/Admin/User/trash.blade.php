@extends('Admin.layouts.master');
@section('title')
    Thùng rác | Velzon
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản lý tài khoản</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý tài khoản</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="customerList">
                <div class="card-header border-bottom-dashed">
                    <div class="row g-4 align-items-center">
                        <div class="col-sm">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title mb-0">Danh sách danh mục</h5>
                                <a href="{{ route('admin.user.create') }}" class="btn btn-primary add-btn"><i
                                        class="ri-add-line align-bottom me-1"></i> Thêm mới</a>
                            </div>
                            <div class="">
                                <span>Tất cả ({{ $all }}) |</span>
                                <span><a href="{{ route('admin.user.index') }}">Quay lại</a></span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-body">
                    <div>
                        <div class="card-body">
                            <table id="example"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead class="table-light text-muted">
                                    <tr class="text-center">
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check_All"
                                                    value="option">
                                            </div>
                                        </th>

                                        <th class="sort" data-sort="id">STT</th>

                                        <th class="sort" data-sort="name">Họ và tên</th>
                                        <th class="sort " data-sort="thumbnail ">Ảnh</th>
                                        <th class="sort" data-sort="email">Email</th>
                                        <th class="sort" data-sort="role">Quyền</th>
                                        <th class="sort " data-sort="action">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($data as $value)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr class="text-center">
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input checkbox" type="checkbox"
                                                        name="chk_child" value="option1">
                                                </div>
                                            </th>
                                            <td>{{ $i }}</td>
                                            <td class="name">{{ $value->first_name }} {{ $value->last_name }}</td>
                                            <td class="thumbnail text-center">
                                                @php
                                                    $url = \Illuminate\Support\Facades\Storage::url($value->thumbnail);
                                                @endphp
                                                <img src="{{ $url }}" width="50" alt="">
                                            </td>
                                            <td class="email">{{ $value->email }}</td>
                                            <td class="role ">
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.user.restore', $value->id) }}"
                                                    class="btn btn-sm btn-warning"
                                                    onclick="return confirm('Bạn có chắc chắn muôn khôi phục tài khoản này không?')">Khôi
                                                    phục</a>
                                                <a href="{{ route('admin.user.destroy', $value->id) }}"
                                                    onclick="return confirm('Bạn có chắc chắn muôn xóa tài khoản này không?')"
                                                    class="btn btn-sm btn-danger">Xóa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>


                    <!-- Modal -->

                    <!--end modal -->
                </div>
            </div>
        </div>
    </div><!--end col-->
@endsection
@section('style-libs')
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('script-libs')
    <script src="{{ asset('assets/libs/list.js/list.min.js') }}"></script>
    <script src="{{ asset('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <!--ecommerce-customer init js -->
    <script src="{{ asset('assets/js/pages/data-list.init.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection

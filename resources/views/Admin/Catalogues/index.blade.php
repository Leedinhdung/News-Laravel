@extends('Admin.layouts.master');
@section('title')
    Danh sách danh mục | Velzon
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản lý danh mục</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý danh mục</a></li>
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
                                <a href="{{ route('admin.catalogues.create') }}" class="btn btn-primary add-btn"><i
                                        class="ri-add-line align-bottom me-1"></i> Thêm mới</a>
                            </div>
                            <div class="">
                                <span>Tất cả ({{ $all }}) |</span>
                                <span>Đang hoạt động ({{ $all }}) |</span>
                                <span><a href="{{ route('admin.catalogues.trash') }}">Thùng rác
                                        ({{ $trash }})</a></span>
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

                                        <th class="sort" data-sort="name">Danh mục</th>
                                        <th class="sort" data-sort="children">Danh mục cha</th>
                                        <th class="sort" data-sort="slug">Đường dẫn</th>
                                        <th class="sort" data-sort="description">Mô tả</th>
                                        <th class="sort text-center" data-sort="status">Trạng thái</th>
                                        <th class="sort" data-sort="action">Hành động</th>
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
                                            <td class="name">{{ $value->name }}</td>

                                            <td>{{ $value->parent ? $value->parent->name : '' }}</td>

                                            <td class="slug">{{ $value->slug }}</td>
                                            <td class="description">{{ $value->description }}</td>
                                            <td class="status text-center">{!! $value->is_active
                                                ? '<span class="badge bg-danger text-uppercase">Kích hoạt</span>'
                                                : '<span class="badge bg-info">Chờ duyệt</span>' !!}
                                            </td>

                                            <td>
                                                <a href="{{ route('admin.catalogues.edit', $value->id) }}"
                                                    class="btn btn-warning btn-sm">

                                                    Chỉnh sửa</a>

                                                <a href="{{ route('admin.catalogues.delsoft', $value->id) }}"
                                                    onclick="return confirm('Bạn có chắc chắn xóa không?')"
                                                    class="btn btn-danger btn-sm">
                                                    Xóa
                                                </a>

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection


@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script>
        const selectAllCheckbox = document.getElementById('check_All');
        const Checkboxes = document.querySelectorAll('.checkbox');
        selectAllCheckbox.addEventListener('change', (event) => {
            const isChecked = event.target.checked;
            Checkboxes.forEach(checkbox => checkbox.checked = isChecked);
        });
    </script>
@endsection

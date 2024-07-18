@extends('Admin.layouts.master');
@section('title')
    Danh sách bài viết | Velzon
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản lý bài viết</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý bài viết</a></li>
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
                                <h5 class="card-title mb-0">Danh sách bài viết</h5>
                                <a href="{{ route('admin.post.create') }}" class="btn btn-primary add-btn"><i
                                        class="ri-add-line align-bottom me-1"></i> Thêm mới</a>
                            </div>
                            <div class="">
                                <span>Tất cả ({{ $all }}) |</span>
                                <span>Đang hoạt động ({{ $all }}) |</span>
                                <span><a href="{{ route('admin.post.trash') }}">Thùng rác ({{ $trash }})</a> </span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>

                                <th scope="col" style="width: 15px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check_All" value="option">
                                    </div>
                                </th>
                                <th data-ordering="false" style="width: 15px;">SR</th>

                                <th>Tiêu đề</th>
                                <th>Hình ảnh</th>
                                <th>Tác giả</th>
                                <th>Danh mục</th>
                                <th>Ngày viết</th>
                                <th>Từ khóa</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($data as $item)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input checkbox" type="checkbox" name="list_check[]"
                                                value="{{ $item->id }}">
                                        </div>
                                    </th>
                                    <td>{{ $i }}</td>
                                    <td><a href="">{{ $item->title }}</a>
                                    </td>

                                    <td>

                                        @php
                                            $url = Storage::url($item->thumbnail);
                                        @endphp
                                        <div class="d-flex align-items-center justify-content-center">
                                            <img src="{{ $url }}" alt="" width="50px" />
                                        </div>
                                    </td>
                                    <td>
                                        @if ($item->user->thumbnail)
                                            @php
                                                $url = \Illuminate\Support\Facades\Storage::url($item->user->thumbnail);
                                            @endphp
                                            <a href="{{ route('admin.auth.profile', $item->user->id) }}">
                                                <div class="d-flex gap-2 align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <img src="{{ $url }}" alt=""
                                                            class="avatar-xs rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        {{ $item->user->first_name }} {{ $item->user->last_name }}
                                                    </div>
                                                </div>
                                            </a>
                                        @else
                                            <a href="{{ route('admin.auth.profile', $item->user->id) }}">
                                                <div class="d-flex gap-2 align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <img class="rounded-circle header-profile-user"
                                                            src="https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg"
                                                            alt="Header Avatar" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        {{ $item->user->first_name }} {{ $item->user->last_name }}
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                        {{-- @php
                                            $url = Storage::url($item->user->thumbnail);
                                        @endphp
                                        <a href="{{ route('admin.auth.profile', $item->user->id) }}">
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ $url }}" alt=""
                                                        class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">
                                                    {{ $item->user->first_name }} {{ $item->user->last_name }}
                                                </div>
                                            </div>
                                        </a> --}}

                                    </td>

                                    <td>
                                        <span style="font-size: 14px" class="badge text-dark p-2 ">

                                            {{ $item->catalogue ? $item->catalogue->name : 'Chưa phân loại' }}
                                        </span>
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        @foreach ($item->tags as $tag)
                                            <span class="badge bg-primary text-uppercase">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="phone">
                                        {!! $item->is_active
                                            ? '<span class="badge bg-danger text-uppercase">Kích hoạt</span>'
                                            : '<span class="badge bg-info">Chờ duyệt</span>' !!}
                                    </td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">

                                                <li><a href="{{ route('admin.post.show', $item->id) }}"
                                                        class="dropdown-item edit-item-btn"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Chỉnh sửa</a>
                                                </li>
                                                <li><a href="{{ route('admin.post.edit', $item->id) }}"
                                                        class="dropdown-item edit-item-btn"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Chỉnh sửa</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.post.delsoft', $item->id) }}"
                                                        onclick="return confirm('Bạn có chắc chắn xóa bài viết {{ $item->title }} không?')"
                                                        class="dropdown-item remove-item-btn">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                        Xóa
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div>
@endsection
@section('style-libs')
    <!--datatable css-->
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

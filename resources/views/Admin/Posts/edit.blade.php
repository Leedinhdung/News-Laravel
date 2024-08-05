@extends('Admin.Layouts.master')
@section('title')
    Chỉnh sửa bài viết | Velzon
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Chỉnh sửa bài viết</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý bài viết</a></li>
                    <li class="breadcrumb-item active">Chỉnh sửa</li>
                </ol>
            </div>

        </div>
    </div>
</div>
    <form action="{{ route('admin.post.update', $data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="text-end mb-3 mt-2">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Tiêu đề</label>
                            <input type="text" class="form-control" name="title" id="product-title-input"
                                value="{{ $data->title }}">
                            @error('title')
                                <div class="error-message mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Tóm tắt</label>

                            <textarea name="excerpt" class="form-control text-start" rows="7">{{ $data->excerpt }} </textarea>
                            @error('excerpt')
                                <div class="error-message mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2">Nội dung</label>

                            <textarea name="content" id="content" class="form-control" rows="10" cols="10">
                            {{ $data->content }}
                            </textarea>
                            @error('content')
                                <div class="error-message mt-2 text-danger">{{ $message }}</div>
                            @enderror
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
                        <h5 class="card-title mb-0">Ảnh</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            @php
                                $url = $data->thumbnail;
                                if (!\Illuminate\Support\Str::contains($url, 'http')) {
                                    $url = \Illuminate\Support\Facades\Storage::url($url);
                                }
                            @endphp
                            <img src="{{ $url }}" alt="" class="rounded-2 w-100">
                        </div>
                        <div>
                            <input type="file" class="form-control" name="thumbnail" id="">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Trạng thái</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                <input type="checkbox" name="is_active" @if ($data->is_active == 1) checked @endif
                                    value="1" class="form-check-input">
                                <label class="form-check-label" for="customSwitchsizemd">Is Active</label>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Danh mục</h5>
                    </div>
                    <div class="card-body">
                        <select class="form-select" name="catalogue_id">

                            <option value="0">--Chọn danh mục--</option>
                            @foreach ($listCat as $key => $value)
                                <option value="{{ $value->id }}" @if ($value->id == $data->id) selected @endif>
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
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tags</h5>
                    </div>
                    <div class="card-body">
                        {{-- @foreach ($data->tags as $value)
                            <option  {{ $tagsOfPost->contains('id', $value->id) ? 'selected' : '' }}
                                value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach --}}
                        <input type="text" name="new_tags[]" data-role="tagsinput" value="{{$tagsOfPost}}">
                    </div>
                </div>


                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </form>
@endsection
@section('style-libs')
    <link href="{{ asset('assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
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
    <script src="https://cdn.tiny.cloud/1/v0sppfpond2fherytdggptl851wb7938ns7t8ctc4fj233v0/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                "See docs to implement AI Assistant")),
        });
    </script>
    <script src="{{ asset('assets/libs/dropzone/dropzone-min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/ecommerce-product-create.init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.js"
        integrity="sha512-cG3ZNAM4Uv2CO/rbBbA7v24d5COF/P5QgDE5HzfoM41uRK7wTIXtxy4UO9ZKE0bjUprMr92Lhv5O6CWdnIZZ/w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

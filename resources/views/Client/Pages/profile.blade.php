@extends('Client.Layouts.master')

@section('content')
    <section class="section">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <h1 class="mb-5">Thông tin cá nhân</h1>
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header text-center">Chỉnh sửa thông tin cá nhân</div>
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    @if (Auth::user()->thumbnail)
                                        @php
                                            if (\Illuminate\Support\Facades\Auth::user()) {
                                                $url = \Illuminate\Support\Facades\Storage::url(
                                                    Auth::user()->thumbnail,
                                                );
                                            }
                                        @endphp
                                        <img class="rounded-circle img-thumbnail" src="{{ $url }}"
                                            alt="Header Avatar" width="200" />
                                    @else
                                        <img class="rounded-circle img-thumbnail"
                                            src="https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg"
                                            alt="Header Avatar" width="200" />
                                    @endif
                                </div>

                                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mt-2">
                                        <label for="profile_image">Cập nhật ảnh</label>
                                        <input type="file" name="thumbnail" id="profile_image" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="first_name">Họ</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control"
                                            value="{{ old('first_name', auth()->user()->first_name) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="last_name">Tên</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control"
                                            value="{{ old('last_name', auth()->user()->last_name) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            value="{{ old('email', auth()->user()->email) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="text" name="phone" id="phone" class="form-control"
                                            value="{{ old('phone', auth()->user()->phone) }}">
                                    </div>

                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

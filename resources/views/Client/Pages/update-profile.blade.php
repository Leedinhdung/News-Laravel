@extends('Client.Layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Chỉnh sửa thông tin cá nhân</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                         

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

                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ old('address', auth()->user()->address) }}">
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
@endsection

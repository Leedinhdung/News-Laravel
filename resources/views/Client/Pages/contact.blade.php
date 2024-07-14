@extends('Client.Layouts.master')
@section('content')
    <!-- Contact Us Start -->
    <section class="section">
        <div class="container">
            <div class="text-center mx-auto">
                <h1 class="mb-4 text-uppercase">Liên hệ</h1>
                <ul class="list-inline">
                    <li class="list-inline-item"><a class="text-default" href="">Trang chủ
                            &nbsp; &nbsp; /</a></li>
                    <li class="list-inline-item text-primary">Liên hệ</li>
                </ul>
            </div>
            <div class="row my-5">

                <div class="col-lg-8 mx-auto">

{{--                    <div class="content mb-5">--}}
{{--                        <h2 id="we-would-love-to-hear-from-you">We would Love To Hear From You&hellip;.</h2>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Velit massa vitae felis augue. In--}}
{{--                            venenatis scelerisque accumsan egestas mattis. Massa feugiat in sem pellentesque.</p>--}}
{{--                    </div>--}}

                    <form method="POST" action="#">
                        <div class="form-group">
                            <label for="name">Họ và tên</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Vui lòng nhập họ và tên"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                   placeholder="email@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Lý do </label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Lý do bạn gửi thư">
                        </div>
                        <div class="form-group">
                            <label for="message">Tin nhắn</label>
                            <textarea name="message" id="message" class="form-control"
                                      placeholder="Vui lòng nhập tin nhắn"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Us End -->
@endsection


@extends('Client.Layouts.master')
@section('content')
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class=" col-lg-10   mb-5 mb-lg-0">
                    <article>
                        <div class="post-slider mb-4">
                            @php
                                $url = \Illuminate\Support\Facades\Storage::url($post->thumbnail);
                            @endphp
                            <img src="{{ $url }}" class="card-img" alt="post-thumb">
                        </div>

                        <h1 class="h2">{{ $post->title }}</h1>
                        <ul class="card-meta my-3 list-inline">
                            <li class="list-inline-item">
                                <a href="author-single.html" class="card-meta-author">
                                    @php
                                        $url = \Illuminate\Support\Facades\Storage::url($post->user->thumbnail);
                                    @endphp
                                    <img src="{{ $url }}" alt="">
                                    <span>{{ $post->user->first_name }} {{ $post->user->last_name }}</span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <i class="ti-calendar"></i>{{ $formattedDate }}
                            </li>
                            <li class="list-inline-item">
                                <ul class="card-meta-tag list-inline">
                                    @foreach ($post->tags as $key)
                                        <li class="list-inline-item"><a href="tags.html">{{ $key->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        <div class="content">
                            {!! $post->content !!}
                        </div>
                    </article>
                    <div>

                        <div>
                            <span class="h6">Lượt xem:</span>
                            <span class="h6">{{ $post->views }}</span>
                        </div>


                    </div>
                </div>

                <div class=" col-md-10">
                    <div class="mb-5 border-top mt-4 pt-5">
                        <h3 class="mb-4">Các bình luận</h3>
                        @foreach ($post->comment as $comment)
                            <div class="media d-block d-sm-flex">
                                <div class="d-inline-block mr-2 mb-3 mb-md-0" href="#">
                                    @php
                                        $url = \Illuminate\Support\Facades\Storage::url($post->user->thumbnail);
                                    @endphp
                                    <img width="50px" class="mr-3 rounded-circle" src="{{ $url }}"
                                        alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#!" class="h4 d-inline-block mb-3">{{ $post->user->first_name }}
                                        {{ $post->user->last_name }}</a>

                                    <p>{{ $comment->content }}</p>

                                    <span class="text-black-800 mr-3 font-weight-600">
                                        {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i:s') }}
                                    </span>
                                    <a class="text-primary font-weight-600" href="#!">Trả lời</a>
                                </div>
                            </div>
                        @endforeach


                    </div>

                    <div>
                        <h3 class="mb-4">Bình luận</h3>
                        <form method="POST" action="{{ route('comment-news', $post->id) }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <textarea class="form-control shadow-none" name="content" rows="7" placeholder=" Bình luận"></textarea>
                                    <p>Ý kiến của bạn sẽ được xét duyệt trước khi đăng. Xin vui lòng gõ tiếng Việt có dấu
                                    </p>
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    @error('content')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Gửi</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

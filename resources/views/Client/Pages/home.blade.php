@extends('Client.Layouts.master')
@section('content')
    <div class="banner text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <h1 class="mb-5">Bạn muốn đọc gì trong ngày hôm nay?</h1>
                </div>
            </div>
        </div>

        <svg class="banner-shape-1" width="39" height="40" viewBox="0 0 39 40" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306"
                stroke-miterlimit="10" />
            <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
                stroke-miterlimit="10" />
        </svg>

        <svg class="banner-shape-2" width="39" height="39" viewBox="0 0 39 39" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_d)">
                <path class="path"
                    d="M24.1587 21.5623C30.02 21.3764 34.6209 16.4742 34.435 10.6128C34.2491 4.75147 29.3468 0.1506 23.4855 0.336498C17.6241 0.522396 13.0233 5.42466 13.2092 11.286C13.3951 17.1474 18.2973 21.7482 24.1587 21.5623Z" />
                <path
                    d="M5.64626 20.0297C11.1568 19.9267 15.7407 24.2062 16.0362 29.6855L24.631 29.4616L24.1476 10.8081L5.41797 11.296L5.64626 20.0297Z"
                    stroke="#040306" stroke-miterlimit="10" />
            </g>
            <defs>
                <filter id="filter0_d" x="0.905273" y="0" width="37.8663" height="38.1979" filterUnits="userSpaceOnUse"
                    color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                    <feOffset dy="4" />
                    <feGaussianBlur stdDeviation="2" />
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape" />
                </filter>
            </defs>
        </svg>


        <svg class="banner-shape-3" width="39" height="40" viewBox="0 0 39 40" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306"
                stroke-miterlimit="10" />
            <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
                stroke-miterlimit="10" />
        </svg>


        <svg class="banner-border" height="240" viewBox="0 0 2202 240" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M1 123.043C67.2858 167.865 259.022 257.325 549.762 188.784C764.181 125.427 967.75 112.601 1200.42 169.707C1347.76 205.869 1901.91 374.562 2201 1"
                stroke-width="2" />
        </svg>
    </div>

    <section class="section pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <h2 class="h5 section-title">Tin mới </h2>
                    <a href="{{ route('detail-post', ['id' => $latestPost->id, 'slug' => $latestPost->slug]) }}">
                        <article class="card">
                            <div class="post-slider slider-sm">
                                @php
                                    $url = \Illuminate\Support\Facades\Storage::url($latestPost->thumbnail);
                                @endphp
                                <img src="{{ $url }}" class="card-img-top" alt="post-thumb">
                            </div>

                            <div class="card-body">
                                <h3 class="h4 mb-3"><a class="post-title"
                                        href="{{ route('detail-post', ['id' => $latestPost->id, 'slug' => $latestPost->slug]) }}"
                                        data-id="{{ $latestPost->id }}"> {{ $latestPost->title }}
                                    </a></h3>
                                <ul class="card-meta
                                        list-inline">
                                    <li class="list-inline-item">
                                        <a href="author-single.html" class="card-meta-author">
                                            @php
                                                $url = \Illuminate\Support\Facades\Storage::url(
                                                    $latestPost->user->thumbnail,
                                                );
                                            @endphp
                                            <img src="{{ $url }}" alt="">
                                            <span>{{ $latestPost->user->first_name }}
                                                {{ $latestPost->user->last_name }}</span>
                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <i
                                            class="ti-calendar"></i>{{ \Carbon\Carbon::parse($latestPost->created_at)->format('d/m/Y ') }}
                                    </li>
                                    <li class="list-inline-item">
                                        <ul class="card-meta-tag list-inline">
                                            @foreach ($latestPost->tags as $value)
                                                <li class="list-inline-item "><a class="bg-success text-white"
                                                        href="tags.html">{{ $value->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                                <p>{{ $latestPost->excerpt }}</p>
                                <a href="{{ route('detail-post', ['id' => $latestPost->id, 'slug' => $latestPost->slug]) }}"
                                    class="btn btn-outline-primary">Xem thêm</a>
                            </div>
                        </article>
                    </a>
                </div>
                <div class="col-lg-4 mb-5">
                    <h2 class="h5 section-title">Các tin khác</h2>
                    @foreach ($latestRecords as $item)
                        <article class="card mb-4">
                            <div class="card-body d-flex">
                                @php
                                    $url = \Illuminate\Support\Facades\Storage::url($item->thumbnail);
                                @endphp
                                <img class="card-img-sm" src="{{ $url }}" alt="">
                                <div class="ml-3">
                                    <h6><a href="{{ route('detail-post', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                            class="post-title" data-id="{{ $item->id }}">{{ $item->title }}</a>
                                    </h6>
                                    <ul class="card-meta list-inline mb-0">
                                        <li class="list-inline-item mb-0">
                                            <i
                                                class="ti-calendar"></i>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y ') }}
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>


                <div class="col-12">
                    <div class="border-bottom border-default"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-sm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8  mb-5 mb-lg-0">
                    <h2 class="h5 section-title">Tin nổi bật</h2>

                    @foreach ($post as $item)
                        <article class="card mb-4">
                            <div class="post-slider">
                                @php
                                    $url = \Illuminate\Support\Facades\Storage::url($item->thumbnail);
                                @endphp
                                <img src="{{ $url }}" class="card-img-top" alt="post-thumb">
                            </div>
                            <div class="card-body">
                                <h3 class="mb-3"><a class="post-title"
                                        href="{{ route('detail-post', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                        data-id="{{ $item->id }}">{{ $item->title }}</a>
                                </h3>
                                <ul class="card-meta list-inline">
                                    <li class="list-inline-item">
                                        <a href="author-single.html" class="card-meta-author">
                                            <img src="{{ asset('client/images/john-doe.jpg') }}">
                                            <span>{{ $item->user->first_name }} {{ $item->user->last_name }}</span>
                                        </a>
                                    </li>
                                    {{--                                    <li class="list-inline-item"> --}}
                                    {{--                                        <i class="ti-timer"></i>2 Min To Read --}}
                                    {{--                                    </li> --}}
                                    <li class="list-inline-item">
                                        <i
                                            class="ti-calendar"></i>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                    </li>
                                    <li class="list-inline-item">
                                        <ul class="card-meta-tag list-inline">
                                            @foreach ($item->tags as $key)
                                                <li class="list-inline-item"><a href="tags.html">{{ $key->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                                <p>{{ $item->excerpt }}</p>
                                <a href="{{ route('detail-post', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                    class="btn btn-outline-primary">Xem thêm</a>
                            </div>
                        </article>
                    @endforeach

                    <ul class="pagination justify-content-center">
                        <li class="page-item page-item active ">
                            <a href="#!" class="page-link">1</a>
                        </li>
                        <li class="page-item">
                            <a href="#!" class="page-link">2</a>
                        </li>
                        <li class="page-item">
                            <a href="#!" class="page-link">&raquo;</a>
                        </li>
                    </ul>
                </div>
                <aside class="col-lg-4 sidebar-home">
                    <!-- Search -->
                    <div class="widget">
                        <h4 class="widget-title"><span>Search</span></h4>
                        <form action="#!" class="widget-search">
                            <input class="mb-3" id="search-query" name="s" type="search"
                                placeholder="Type &amp; Hit Enter...">
                            <i class="ti-search"></i>
                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                        </form>
                    </div>
                    <div class="widget widget-categories">
                        <h4 class="widget-title"><span>Danh mục</span></h4>
                        <ul class="list-unstyled widget-list">
                            @foreach ($menu as $item)
                                <li><a href="{{ route('catalogue-news', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                        class="d-flex">{{ $item->name }}</a>
                                </li>
                            @endforeach


                        </ul>
                    </div>
                    <!-- about me -->

                    <!-- Promotion -->


                    <!-- authors -->

                    <!-- Search -->

                    <div class="widget">
                        <h4 class="widget-title"><span>Never Miss A News</span></h4>
                        <form action="#!" method="post" name="mc-embedded-subscribe-form" target="_blank"
                            class="widget-search">
                            <input class="mb-3" id="search-query" name="s" type="search"
                                placeholder="Your Email Address">
                            <i class="ti-email"></i>
                            <button type="submit" class="btn btn-primary btn-block" name="subscribe">Subscribe now
                            </button>
                            <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                <input type="text" name="b_463ee871f45d2d93748e77cad_a0a2c6d074" tabindex="-1">
                            </div>
                        </form>
                    </div>

                    <!-- categories -->
                    <!-- tags -->
                    <!-- recent post -->
                    <div class="widget">
                        <h4 class="widget-title">Bài đăng gần đây</h4>

                        <!-- post-item -->
                        <article class="widget-card">
                            @foreach ($post as $item)
                                <div class="d-flex">
                                    <img class="card-img-sm" src="{{ \Storage::url($item->thumbnail) }}">
                                    <div class="ml-3">
                                        <h5><a class="post-title"
                                                href="{{ route('detail-post', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                                data-id="{{ $item->id }}">{{ $item->title }}</a></h5>

                                    </div>
                                </div>
                            @endforeach
                        </article>
                    </div>
                    <div class="widget">
                        <h4 class="widget-title"><span>Tags</span></h4>
                        <ul class="list-inline widget-list-inline widget-card">
                            <li class="list-inline-item"><a href="tags.html">City</a></li>
                            <li class="list-inline-item"><a href="tags.html">Color</a></li>
                            <li class="list-inline-item"><a href="tags.html">Creative</a></li>
                            <li class="list-inline-item"><a href="tags.html">Decorate</a></li>
                            <li class="list-inline-item"><a href="tags.html">Demo</a></li>
                        </ul>
                    </div>
                    <!-- Social -->
                    <div class="widget">
                        <h4 class="widget-title"><span>Social Links</span></h4>
                        <ul class="list-inline widget-social">
                            <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="ti-linkedin"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="ti-youtube"></i></a></li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection

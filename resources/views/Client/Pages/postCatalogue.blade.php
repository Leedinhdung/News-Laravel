@extends('Client.Layouts.master')
@section('content')
    <section class="section pb-0">
        <div class="container">
            <div class="container my-5">
                <div class="row">
                    <div class="text-center mx-auto">
                        <h1 class="mb-4 text-uppercase">{{ $catalogue->name }}</h1>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a class="text-default" href="">Trang chủ
                                    &nbsp; &nbsp; /</a></li>
                            <li class="list-inline-item text-primary">{{ $catalogue->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <h2 class="h5 section-title">{{ $catalogue->name }}</h2>
                    @foreach ($post as $item)
                        <article class="card mb-4">
                            <div class="card-body d-flex">
                                @php
                                    $url = \Illuminate\Support\Facades\Storage::url($item->thumbnail);
                                @endphp
                                <img class="card-img-sm" src="{{ $url }}" alt="">
                                <div class="ml-3">
                                    <h4><a href="{{ route('detail-post', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                            class="post-title" data-id="{{ $item->id }}">{{ $item->title }}</a>
                                    </h4>
                                    <p class="text-sm-start">{{ $item->excerpt }}</p>
                                    <ul class="card-meta list-inline mb-0">
                                        <li class="list-inline-item mb-0">
                                            <i class="ti-calendar"></i>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    @endforeach
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

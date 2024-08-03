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
                                            <i class="ti-calendar"></i>{{ $formattedDate }}
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
                    <!-- Promotion -->
                    <div class="promotion">
                        <img src="{{ asset('client/images/promotion.jpg') }}" class="img-fluid w-100">
                        <div class="promotion-content">
                            <h5 class="text-white mb-3">Create Stunning Website!!</h5>
                            <p class="text-white mb-4">Lorem ipsum dolor sit amet, consectetur sociis. Etiam nunc amet
                                id
                                dignissim. Feugiat id tempor vel sit ornare turpis posuere.</p>
                            <a href="https://themefisher.com/" class="btn btn-primary">Get Started</a>
                        </div>
                    </div>

                    <!-- authors -->
                    <div class="widget widget-author">
                        <h4 class="widget-title">Authors</h4>
                        <div class="media align-items-center">
                            <div class="mr-3">
                                <img class="widget-author-image" src="{{ asset('client/images/john-doe.jpg') }}">
                            </div>
                            <div class="media-body">
                                <h5 class="mb-1"><a class="post-title" href="author-single.html">Charls Xaviar</a></h5>
                                <span>Author &amp; developer of Bexer, Biztrox theme</span>
                            </div>
                        </div>
                        <div class="media align-items-center">
                            <div class="mr-3">
                                <img class="widget-author-image" src="{{ asset('client/images/kate-stone.jpg') }}">
                            </div>
                            <div class="media-body">
                                <h5 class="mb-1"><a class="post-title" href="author-single.html">Kate Stone</a></h5>
                                <span>Author &amp; developer of Bexer, Biztrox theme</span>
                            </div>
                        </div>
                        <div class="media align-items-center">
                            <div class="mr-3">
                                <img class="widget-author-image" src="{{ asset('client/images/john-doe.jpg') }}"
                                    alt="John Doe">
                            </div>
                            <div class="media-body">
                                <h5 class="mb-1"><a class="post-title" href="author-single.html">John Doe</a></h5>
                                <span>Author &amp; developer of Bexer, Biztrox theme</span>
                            </div>
                        </div>
                    </div>
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
                    <div class="widget widget-categories">
                        <h4 class="widget-title"><span>Categories</span></h4>
                        <ul class="list-unstyled widget-list">
                            <li><a href="tags.html" class="d-flex">Creativity <small class="ml-auto">(4)</small></a>
                            </li>

                        </ul>
                    </div><!-- tags -->
                    <div class="widget">
                        <h4 class="widget-title"><span>Tags</span></h4>
                        <ul class="list-inline widget-list-inline widget-card">
                            <li class="list-inline-item"><a href="tags.html">City</a></li>
                            <li class="list-inline-item"><a href="tags.html">Color</a></li>
                        </ul>
                    </div><!-- recent post -->
                    <div class="widget">
                        <h4 class="widget-title">Recent Post</h4>

                        <!-- post-item -->
                        <article class="widget-card">
                            <div class="d-flex">
                                <img class="card-img-sm" src="{{ asset('client/images/post/post-10.jpg') }}">
                                <div class="ml-3">
                                    <h5><a class="post-title" href="post/elements/">Elements That You Can Use In This
                                            Template.</a></h5>
                                    <ul class="card-meta list-inline mb-0">
                                        <li class="list-inline-item mb-0">
                                            <i class="ti-calendar"></i>15 jan, 2020
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>

                        <article class="widget-card">
                            <div class="d-flex">
                                <img class="card-img-sm" src="{{ asset('client/images/post/post-3.jpg') }}">
                                <div class="ml-3">
                                    <h5><a class="post-title" href="post-details.html">Advice From a Twenty
                                            Something</a>
                                    </h5>
                                    <ul class="card-meta list-inline mb-0">
                                        <li class="list-inline-item mb-0">
                                            <i class="ti-calendar"></i>14 jan, 2020
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>

                        <article class="widget-card">
                            <div class="d-flex">
                                <img class="card-img-sm" src="{{ asset('client/images/post/post-7.jpg') }}">
                                <div class="ml-3">
                                    <h5><a class="post-title" href="post-details.html">Advice From a Twenty
                                            Something</a>
                                    </h5>
                                    <ul class="card-meta list-inline mb-0">
                                        <li class="list-inline-item mb-0">
                                            <i class="ti-calendar"></i>14 jan, 2020
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>
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

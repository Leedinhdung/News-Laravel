<nav class="navbar navbar-expand-lg navbar-white">
    <a class="navbar-brand order-1" href="{{ route('home') }}">
        <img class="img-fluid" width="100px" src="{{ asset('client/images/logo.png') }}"
            alt="Reader | Hugo Personal Blog Template">
    </a>
    <div class="collapse navbar-collapse text-center order-lg-2 order-3" id="navigation">
        <ul class="navbar-nav mx-auto">
            @foreach ($menu as $item)
                <li class="nav-item dropdown">
                    @if ($item->parent_id == 0)
                        <a class="nav-link"
                            href="{{ route('catalogue-news', ['id' => $item->id, 'slug' => $item->slug]) }}"
                            role="button" @if ($item->parent_id != 0) data-toggle="dropdown" @endif
                            aria-haspopup="true" aria-expanded="false">
                            {{ $item->name }} <i class="ti-angle-down ml-1"></i>
                        </a>
                        @foreach ($menu as $key => $sub_menu)
                            @if ($sub_menu->parent_id != 0 && $item->id == $sub_menu->parent_id)
                                <div class="dropdown-menu">
                                    <a class=""
                                        href="{{ route('catalogue-news', ['id' => $sub_menu->id, 'slug' => $sub_menu->slug]) }}">{{ $sub_menu->name }}</a>
                                </div>
                            @endif
                        @endforeach
                    @endif

                </li>
            @endforeach


            <li class="nav-item">
                <a class="nav-link" href="{{ route('contact') }}">Liên hệ</a>
            </li>
        </ul>
    </div>

    <div class="order-2 order-lg-3 d-flex align-items-center">


        <!-- search -->
        <form class="search-bar" action="{{ route('search-news') }}" method="GET">
            @csrf
            <input id="search-query" class="pr-5" name="key" type="text" placeholder="Tìm kiếm " required>
            <button type="submit" class="btn"><i class="ti-search"></i></button>
        </form>

        <button class="navbar-toggler border-0 order-1" type="button" data-toggle="collapse" data-target="#navigation">
            <i class="ti-menu"></i>
        </button>
        {{--        @if (Auth::user()) --}}
        {{--            <div class="dropdown ml-auto"> --}}
        {{--                @php --}}
        {{--                    $url = \Illuminate\Support\Facades\Storage::url(\Illuminate\Support\Facades\Auth::user()->thumbnail); --}}
        {{--                @endphp --}}
        {{--                <img class="rounded-circle header-profile-user" src="{{ $url }}" alt=" " width="30px"> --}}
        {{--                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" --}}
        {{--                   data-bs-toggle="dropdown" aria-expanded="false"> --}}
        {{--                    {{Auth::user()->name}} --}}
        {{--                </a> --}}
        {{--                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink"> --}}
        {{--                    <a class="" href="{{route('logout')}}">{{ __('logout')}} </a> --}}
        {{--                    <a class="" href="{{route('admin.dashboard')}}">{{ __('admin.dashboard')}} </a> --}}
        {{--                </div> --}}
        {{--            </div> --}}
        {{--           --}}

        {{--        @else --}}
        {{--            <a href="{{route('login')}}" class="btn btn-outline-primary ml-5 d-none d-md-inline-block">Đăng nhập</a>F --}}
        {{--        @endif --}}
        @if (Auth::user())
            <div class="dropdown ml-sm-3 header-item topbar-user">
                <a href="" class="" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="d-flex align-items-center">
                        @php
                            if (\Illuminate\Support\Facades\Auth::user()) {
                                $url = \Illuminate\Support\Facades\Storage::url(Auth::user()->thumbnail);
                            }
                        @endphp
                        <img class="rounded-circle header-profile-user" src="{{ $url }}" alt="Header Avatar"
                            width="40" />
                    </span>
                </a>
                <div class="dropdown-menu ">
                    <!-- item-->
                    <h6 class="">Chào {{ Auth::user()->last_name }}!</h6>
                    <a class="dropdown-item" href="{{ route('admin.auth.profile', Auth::user()->id) }}">
                        <i class="mdi mdi-account-circle "></i>
                        <span class="align-middle">Thông tin cá nhân</span>
                    </a>
                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-account-key-outline"></i>
                        <span class="align-middle">Trang quản trị</span>
                    </a>
                    <a class="dropdown-item" href="apps-chat.html">
                        <i class="mdi mdi-message-text-outline "></i>
                        <span class="align-middle">Tin nhắn</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="pages-profile-settings.html">
                        <i class="mdi mdi-cog-outline "></i>
                        <span class="align-middle">Cài đặt</span>
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="mdi mdi-logout "></i>
                        <span class="align-middle">Đăng xuất</span>
                    </a>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary ml-5 d-none d-md-inline-block">Đăng nhập</a>
        @endif
    </div>
</nav>

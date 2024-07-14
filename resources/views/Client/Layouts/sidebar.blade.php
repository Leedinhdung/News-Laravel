<ul id="sidebar_menu">
    <li class="mm-active">
        <a  href="#" aria-expanded="false">
            <div class="icon_menu">
                <img src="{{asset('img/menu-icon/dashboard.svg')}}" alt>
            </div>
            <span>Dashboard</span>
        </a>

    </li>
    <li class="mm-active">
        <a class="has-arrow" href="#" aria-expanded="false">
            <div class="icon_menu">
                <img src="{{asset('img/menu-icon/dashboard.svg')}}" alt>
            </div>
            <span>Danh mục</span>
        </a>
        <ul>
            <li><a class="active" href="{{route('admin.catalogues.index')}}">Danh sách</a></li>
            <li><a href="{{route('admin.catalogues.create')}}">Thêm mới</a></li>
        </ul>
    </li>
    <li class="mm-active">
        <a class="has-arrow" href="#" aria-expanded="false">
            <div class="icon_menu">
                <img src="{{asset('img/menu-icon/dashboard.svg')}}" alt>
            </div>
            <span>Tin tức</span>
        </a>
        <ul>
            <li><a class="active" href="{{route('admin.news.index')}}">Danh sách</a></li>
            <li><a href="{{route('admin.news.create')}}">Thêm mới</a></li>

        </ul>
    </li>

</ul>

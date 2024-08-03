<div class="app-menu navbar-menu bg-primary">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22" />
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17" />
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22" />
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="17" />
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>Quản lý</span></li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link menu-link">
                        <i class="ri-dashboard-2-line"></i>
                        <span>Trang chủ</span>
                    </a>

                </li>
                <!-- end Dashboard Menu -->
                @canany(['category.add', 'category.list', 'category.edit', 'category.delete'])
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarCatalogues" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarCatalogues">
                            <i class="ri-layout-3-line"></i>
                            <span>Quản lý danh mục</span>

                        </a>
                        <div class="collapse menu-dropdown" id="sidebarCatalogues">
                            <ul class="nav nav-sm flex-column">
                                @can('category.list')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.catalogues.index') }}" class="nav-link">Danh sách</a>
                                    </li>
                                @endcan
                                @can('category.add')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.catalogues.create') }}" class="nav-link">Thêm mới</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcanany


                @canany(['post.list', 'post.add', 'post.edit', 'post.delete'])
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarProducts" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarProducts">
                            <i class="ri-layout-3-line"></i>
                            <span>Quản lý bài viết</span>

                        </a>
                        <div class="collapse menu-dropdown" id="sidebarProducts">
                            <ul class="nav nav-sm flex-column">
                                @can('post.list')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.post.index') }}" class="nav-link">Danh sách</a>
                                    </li>
                                @endcan
                                @can('post.add')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.post.create') }}" class="nav-link">Thêm mới</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcanany
                @canany(['user.list', 'user.add', 'user.edit', 'user.delete'])
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarUsers" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarUsers">
                            <i class="ri-layout-3-line"></i>
                            <span>Quản lý nhân viên</span>

                        </a>
                        <div class="collapse menu-dropdown" id="sidebarUsers">
                            <ul class="nav nav-sm flex-column">
                                @can('user.list')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.user.index') }}" class="nav-link">Danh sách</a>
                                    </li>
                                @endcan
                                @can('user.add')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.user.create') }}" class="nav-link">Thêm mới</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcanany
                @canany(['role.list', 'role.add', 'role.edit', 'role.delete'])
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarRoles" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarRoles">
                            <i class="ri-layout-3-line"></i>
                            <span>Quản lý phân quyền</span>

                        </a>
                        <div class="collapse menu-dropdown" id="sidebarRoles">
                            <ul class="nav nav-sm flex-column">
                                @can('role.add')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.role.create') }}" class="nav-link">Thêm mới vai trò</a>
                                    </li>
                                @endcan
                                {{-- @can('permission.add') --}}
                                    <li class="nav-item">
                                        <a href="{{ route('admin.permission.create') }}" class="nav-link">Thêm mới quyền</a>
                                    </li>
                                {{-- @endcan --}}
                                @can('role.list')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.role.index') }}" class="nav-link">Danh sách vai trò</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcanany

                <!-- end Dashboard Menu -->
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

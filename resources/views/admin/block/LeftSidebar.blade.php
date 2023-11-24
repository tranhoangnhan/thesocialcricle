<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Light Logo-->
        <a href="/admin" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('clients/assets/images/logo-white.png') }}" alt="" width="200">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('clients/assets/images/logo-white.png') }}" alt="" width="200">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link"   href="{{route('admin') }}">
                        <i class="ri-dashboard-2-line"></i> <span>Trang chủ</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a   href="{{ route('admin-user.index') }}" class="nav-link" data-key="t-chat"><i class="ri-user-2-fill"></i>  Tài khoản </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPost" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPost">
                        <i class="fa-regular fa-bookmark"></i> <span data-key="t-apps">Khóa học</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPost">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a   href="{{route('admin.course') }}" class="nav-link" data-key="t-calendar">Danh sách khóa học</a>
                            </li>
                            <li class="nav-item">
                                <a   href="{{route('admin.course-category') }}" class="nav-link" data-key="t-calendar">Danh mục khóa học</a>
                            </li>
                            <li class="nav-item">
                                <a   href="{{route('admin.course-mount') }}" class="nav-link" data-key="t-chat"> Doanh thu </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarComment" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarComment">
                        <i class="ri-repeat-fill"></i> <span data-key="t-widgets">Phản hồi</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarComment">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link"   href="{{ route('admin.report') }}">
                                    Báo cáo
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link"   href="{{ route('admin.feedback') }}">
                              Ý kiến người dùng
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/admin/bill">
                        <i class="ri-honour-line"></i> <span data-key="t-widgets">Hóa đơn</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/">
                        <i class="ri-arrow-drop-left-fill"></i> <span data-key="t-widgets">Trở về Website</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>

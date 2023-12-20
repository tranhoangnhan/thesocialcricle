<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header float-end">
            <div class="d-flex ">
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            {!! getAvatar(
                                auth()->user()->user_id,
                                null,
                                'border-radius:10px;font-size:30px!important;font-family: Arial, Helvetica, sans-serif;
                                background: #2a64e2f5;
                                font-size: 16px;
                                color: #fff;
                                text-align: center;
                                display: flex;
                                justify-content: center;
                                align-items: center;',
                                'rounded-circle header-profile-user',
                            ) !!}
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{!!getName(auth()->user()->user_id)!!}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Founder</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end " aria-labelledby="page-header-user-dropdown">
                        <a class="dropdown-item" href="">
                            <i class="ri-user-line align-middle me-1"></i>
                            <span class="align-middle">Hồ sơ</span>
                        </a>
                        <a class="dropdown-item d-block" href="{{ route('logout') }}">
                            <i class="ri-logout-circle-line align-middle me-1"></i>
                            <span class="align-middle">Đăng xuất</span>
                        </a>
                </div>
            </div>
        </div>
    </div>
</header>
<style>
    @media (max-width: 991px) {
        .header-item.topbar-user .dropdown-menu {
            width: 10%;
        }
    }
</style>

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="/" class="brand-link">
            <img src="{{ asset('adminlte/dist/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">AdminLTE 4</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column">
                <li class="nav-item">
                    <a href="/" class="nav-link
                    {{ request()->is('/') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Trang chủ</p>
                    </a>
                </li>

                @if (auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a href="/users"
                            class="nav-link
                        {{ request()->routeIs('users.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Quản lý người dùng</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('posts.index') }}"
                        class="nav-link
                        {{ request()->routeIs('posts.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Bài viết</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<style>
    .nav-link.active {
        background-color: #007afdff !important; /* xanh */
        color: #fff !important;
    }
    .nav-link.active i {
        color: #fff !important;
    }
</style>

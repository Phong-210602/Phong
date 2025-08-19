<div class="app-main">
  <header class="app-header navbar navbar-expand bg-body border-bottom">
    <div class="container-fluid">
      
      <!-- Nút mở sidebar -->
      <div class="navbar-nav">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="fas fa-bars"></i>
        </a>
      </div>

      <!-- Navbar Right -->
      <div class="navbar-nav ms-auto">
        <!-- Dropdown user menu -->
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <img src="{{ asset('abc/avatar-cute-3.jpg')}}" class="user-image rounded-circle shadow" alt="User Image">
            <span class="d-none d-md-inline">
              {{ Auth::user()->first_name ?? 'Người dùng' }}
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
            <li class="user-header text-bg-primary">
              <img src="{{ asset('abc/avatar-cute-3.jpg')}}" class="rounded-circle shadow" alt="User Image">
              <p>
                {{ Auth::user()->first_name ?? 'Người dùng' }} - Lập trình viên Web
                <small>Thành viên từ Tháng 11, 2023</small>
              </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <div class="row">
                <div class="col-4 text-center"><a href="#">Người theo dõi</a></div>
                <div class="col-4 text-center"><a href="#">Doanh số</a></div>
                <div class="col-4 text-center"><a href="#">Bạn bè</a></div>
              </div>
            </li>
            <!-- Menu Footer -->
            <li class="user-footer">
              <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Hồ sơ</a>
              <form method="POST" action="{{ route('logout') }}" class="d-inline float-end">
                @csrf
                <button type="submit" class="btn btn-default btn-flat">Đăng xuất</button>
              </form>
            </li>
          </ul>
        </li>
      </div>
    </div>
  </header>   

  <div class="app-content">
    <div class="container-fluid">
      @yield('content')
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

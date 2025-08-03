<div class="app-main">
      <header class="app-header navbar navbar-expand bg-body border-bottom">
        <div class="container-fluid">
          <div class="navbar-nav">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
              <i class="fas fa-bars"></i>
            </a>
          </div>
          
          <div class="navbar-nav ms-auto">
            <span class="navbar-text me-3">
              <i class="fas fa-user me-1"></i>
              Xin chào, {{ Auth::user()->first_name ?? 'Người dùng' }}
            </span>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-outline-danger">
                <i class="fas fa-sign-out-alt me-1"></i>
                Đăng xuất
              </button>
            </form>
          </div>
        </div>
      </header>   

        <div class="app-content">
          <div class="container-fluid">
          @yield('content')
        </div>
      </div> 
</div>
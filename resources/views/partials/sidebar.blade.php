<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand d-flex align-items-center m-0 px-4" href="{{ route('dashboard') }}">
      <img src="/assets/img/logo2.svg" class="navbar-brand-img h-100" alt="main_logo" style="height: 100%; width: auto;">
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="nk-sidebar w-auto">
    <ul class="navbar-nav">
      <li class="nav-label">Dashboard</li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"
           style="position: relative; padding-left: 10px;">
          <div class="d-flex align-items-center">
            <div class="fa fa-home icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
              style="background-color: {{ request()->routeIs('dashboard') ? '#0d6efd' : '#ffffff' }} !important; color: {{ request()->routeIs('dashboard') ? '#ffffff' : '#000000' }} !important;">
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </div>
          @if(request()->routeIs('dashboard'))
            <div style="position: absolute; left: 0; top: 0; width: 4px; height: 100%; background-color: #0d6efd;"></div>
          @endif
        </a>
      </li>
      <li class="nav-label">Management</li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}" href="{{ route('laporan.index') }}">
          <div class="fa fa-file-alt icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
               style="background-color: {{ request()->routeIs('laporan.index') ? '#0d6efd' : '#ffffff' }} !important; color: {{ request()->routeIs('laporan.index') ? '#ffffff' : '#000000' }} !important;">
          </div>
          <span class="nav-link-text ms-1">Management Laporan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('pinalti.index') ? 'active' : '' }}" href="{{ route('pinalti.index') }}">
          <div class="fa fa-exclamation-triangle icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
               style="background-color: {{ request()->routeIs('pinalti.index') ? '#0d6efd' : '#ffffff' }} !important; color: {{ request()->routeIs('pinalti.index') ? '#ffffff' : '#000000' }} !important;">
          </div>
          <span class="nav-link-text ms-1">Management Pinalti</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('pinalti.index') ? 'active' : '' }}" href="{{ route('pinalti.index') }}">
          <div class="fa fa-balance-scale icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
               style="background-color: {{ request()->routeIs('pinalti.index') ? '#0d6efd' : '#ffffff' }} !important; color: {{ request()->routeIs('pinalti.index') ? '#ffffff' : '#000000' }} !important;">
          </div>
          <span class="nav-link-text ms-1">Management Aju Banding</span>
        </a>
      </li>
      <li class="nav-label">User</li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
          <div class="fa fa-users icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
               style="background-color: {{ request()->routeIs('admin.users.index') ? '#0d6efd' : '#ffffff' }} !important; color: {{ request()->routeIs('admin.users.index') ? '#ffffff' : '#000000' }} !important;">
          </div>
          <span class="nav-link-text ms-1">Pengguna</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.users.banned') ? 'active' : '' }}" href="{{ route('admin.users.banned') }}">
          <div class="fa fa-ban icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
               style="background-color: {{ request()->routeIs('admin.users.banned') ? '#0d6efd' : '#ffffff' }} !important; color: {{ request()->routeIs('admin.users.banned') ? '#ffffff' : '#000000' }} !important;">
          </div>
          <span class="nav-link-text ms-1">Banned Pengguna</span>
        </a>
      </li>
    </ul>
  </div>
</aside>

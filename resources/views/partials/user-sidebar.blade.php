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
        <li class="nav-item" style="position: relative;">
          <a class="nav-link {{ request()->routeIs('user.home') ? 'active' : '' }}" href="{{ route('user.home') }}">
            <div class="fa fa-home icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
                 style="background-color: {{ request()->routeIs('user.home') ? '#3243fd' : '#ffffff' }} !important; color: {{ request()->routeIs('user.home') ? '#ffffff' : '#000000' }} !important;">
            </div>
            <span class="nav-link-text ms-1">Home</span>
            @if(request()->routeIs('user.home'))
              <div style="position: absolute; left: 0; top: 0; width: 4px; height: 100%; background-color: #3243fd; border-radius: 0 6px 6px 0;"></div>
            @endif
          </a>
        </li>
        <li class="nav-item" style="position: relative;">
          <a class="nav-link {{ request()->routeIs('user.home') ? 'active' : '' }}" href="{{ route('user.home') }}">
            <div class="fa fa-search icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
                 style="background-color: {{ request()->routeIs('#') ? '#3243fd' : '#ffffff' }} !important; color: {{ request()->routeIs('#') ? '#ffffff' : '#000000' }} !important;">
            </div>
            <span class="nav-link-text ms-1">Jelajahi</span>
            @if(request()->routeIs('#'))
              <div style="position: absolute; left: 0; top: 0; width: 4px; height: 100%; background-color: #3243fd; border-radius: 0 6px 6px 0;"></div>
           @endif
          </a>
        </li>
        <li class="nav-item" style="position: relative;">
          <a class="nav-link {{ request()->routeIs('user.profile') ? 'active' : '' }}" href="{{ route('user.profile') }}">
            <div class="fa fa-user icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
                 style="background-color: {{ request()->routeIs('user.profile') ? '#3243fd' : '#ffffff' }} !important; color: {{ request()->routeIs('user.profile') ? '#ffffff' : '#000000' }} !important;">
            </div>
            <span class="nav-link-text ms-1">Profile</span>
            @if(request()->routeIs('user.profile'))
              <div style="position: absolute; left: 0; top: 0; width: 4px; height: 100%; background-color: #3243fd; border-radius: 0 6px 6px 0;"></div>
            @endif
          </a>
        </li>
        <li>
          <a class="text-danger" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out-alt me-2"></i> Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
      </ul>
    </div>
</aside>

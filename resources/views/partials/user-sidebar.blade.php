<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
  <div class="sidenav-header">
    <a class="navbar-brand d-flex align-items-center m-0 px-4" href="{{ route('dashboard') }}">
      <img src="/assets/img/logo2.svg" class="navbar-brand-img h-100" alt="main_logo" style="height: 100%; width: auto;">
    </a>
  </div>
  <hr class="horizontal dark mt-0">

  <div class="nk-sidebar w-auto">
    <ul class="navbar-nav">
      <!-- Home -->
      <li class="nav-item" style="position: relative;">
        <a class="nav-link {{ request()->routeIs('user.home') ? 'active' : '' }}" href="{{ route('user.home') }}">
          <div class="fa fa-comment-dots icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
               style="background-color: {{ request()->routeIs('user.home') ? '#3243fd' : '#ffffff' }} !important; color: {{ request()->routeIs('user.home') ? '#ffffff' : '#000000' }} !important;">
          </div>
          <span class="nav-link-text ms-1">Chat</span>
          @if(request()->routeIs('user.home'))
            <div style="position: absolute; left: 0; top: 0; width: 4px; height: 100%; background-color: #3243fd; border-radius: 0 6px 6px 0;"></div>
          @endif
        </a>
      </li>

      <!-- Jelajahi -->
      <li class="nav-item" style="position: relative;">
        <a class="nav-link {{ request()->routeIs('user.jelajahi') ? 'active' : '' }}" href="{{ route('user.jelajahi') }}">
          <div class="fa fa-search icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
               style="background-color: {{ request()->routeIs('user.jelajahi') ? '#3243fd' : '#ffffff' }} !important; color: {{ request()->routeIs('user.jelajahi') ? '#ffffff' : '#000000' }} !important;">
          </div>
          <span class="nav-link-text ms-1">Jelajahi</span>
          @if(request()->routeIs('user.jelajahi'))
            <div style="position: absolute; left: 0; top: 0; width: 4px; height: 100%; background-color: #3243fd; border-radius: 0 6px 6px 0;"></div>
         @endif
        </a>
      </li>
    </ul>

    <ul class="navbar-nav position-absolute w-100" style="bottom: 20px; left: 0;">
      <!-- Pengaturan -->
      <li class="nav-item" style="position: relative;">
        <a class="nav-link {{ request()->routeIs('user.pengaturan') ? 'active' : '' }}" href="{{ route('user.pengaturan') }}">
          <div class="fa-solid fa-gear icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
               style="background-color: {{ request()->routeIs('user.pengaturan') ? '#3243fd' : '#ffffff' }} !important; color: {{ request()->routeIs('user.pengaturan') ? '#ffffff' : '#000000' }} !important;">
          </div>
          <span class="nav-link-text ms-1">Pengaturan</span>
          @if(request()->routeIs('user.pengaturan'))
            <div style="position: absolute; left: 0; top: 0; width: 4px; height: 100%; background-color: #3243fd; border-radius: 0 6px 6px 0;"></div>
          @endif
        </a>
      </li>
      
      <!-- Profile -->
      <li class="nav-item" style="position: relative;">
        <a class="nav-link {{ request()->routeIs('profile.index') ? 'active' : '' }}" href="{{ route('profile.index') }}">
          <div class="fa fa-user icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
               style="background-color: {{ request()->routeIs('profile.index') ? '#3243fd' : '#ffffff' }} !important; color: {{ request()->routeIs('profile.index') ? '#ffffff' : '#000000' }} !important;">
          </div>
          <span class="nav-link-text ms-1">Profile</span>
          @if(request()->routeIs('profile.index'))
            <div style="position: absolute; left: 0; top: 0; width: 4px; height: 100%; background-color: #3243fd; border-radius: 0 6px 6px 0;"></div>
          @endif
        </a>
      </li>

      <!-- Logout -->
      <li class="nav-item" style="position: relative;">
        <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <div class="fa fa-sign-out-alt icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
               style="background-color: #ffffff !important; color: #dc3545 !important;">
          </div>
          <span class="nav-link-text ms-1">Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </div>
</aside>

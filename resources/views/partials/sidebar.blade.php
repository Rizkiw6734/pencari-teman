<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand d-flex align-items-center m-0 px-4" href="{{ route('dashboard') }}">
        <img src="/assets/img/logo.png" class="navbar-brand-img h-100" alt="main_logo" style="height: 50px; width: auto;">
        <span class="ms-1 font-weight-bold">AROUND YOU</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <div class="fa fa-home icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                 style="background-color: {{ request()->routeIs('dashboard') ? '#0d6efd' : '#ffffff' }} !important; color: {{ request()->routeIs('dashboard') ? '#ffffff' : '#000000' }} !important;">
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}" href="{{ route('laporan.index') }}">
            <div class="fa fa-file-alt icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
                 style="background-color: {{ request()->routeIs('laporan.index') ? '#0d6efd' : '#ffffff' }} !important; color: {{ request()->routeIs('laporan.index') ? '#ffffff' : '#000000' }} !important;">
            </div>
            <span class="nav-link-text ms-1">Laporan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('pinalti.index') ? 'active' : '' }}" href="{{ route('pinalti.index') }}">
              <div class="fa fa-exclamation-triangle icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
                   style="background-color: {{ request()->routeIs('pinalti.index') ? '#0d6efd' : '#ffffff' }} !important; color: {{ request()->routeIs('pinalti.index') ? '#ffffff' : '#000000' }} !important;">
              </div>
              <span class="nav-link-text ms-1">Pinalti</span>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#lokasiCollapse" role="button" aria-expanded="false" aria-controls="lokasiCollapse">
                <div class="fa fa-map-marker-alt icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                     style="background-color: #ffffff; color: #000000;">
                </div>
                <span class="nav-link-text ms-1">Lokasi</span>
            </a>
            <div class="collapse" id="lokasiCollapse">
                <ul class="nav nav-sm flex-column ms-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kabupaten.index') ? 'active' : '' }}" href="{{ route('kabupaten.index') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <span class="nav-link-text">Kabupaten</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kecamatan.index') ? 'active' : '' }}" href="{{ route('kecamatan.index') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <span class="nav-link-text">Kecamatan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('desa.index') ? 'active' : '' }}" href="{{ route('desa.index') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <span class="nav-link-text">Desa</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer mx-3">
        <div class="card card-background shadow-none card-background-mask-secondary" id="sidenavCard">
          <div class="full-background" style="background-image: url('/assets/img/map-background.jpg'); background-size: cover; background-position: center;"></div>
          <div class="card-body text-start p-3 w-100">
            <div class="icon icon-shape icon-sm bg-white shadow text-center mb-3 d-flex align-items-center justify-content-center border-radius-md">
              <i class="fas fa-location-dot text-dark text-gradient text-lg top-0" aria-hidden="true" id="sidenavCardIcon"></i>
            </div>
            <div class="docs-info">
              <h6 class="text-white up mb-0">Lokasi</h6>
              <p class="text-xs font-weight-bold mb-3">Lihat persebaran pengguna.</p> <!-- Added margin-bottom here -->
              <a href="#" class="btn btn-white btn-sm w-100 mb-0">Lihat</a>
            </div>
          </div>
        </div>
        <a href="#" class="btn btn-primary mt-3 w-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="background: #0D6EFD">Logout</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>
@extends('layouts.app')
@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg mt-3 px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center w-100" id="navbar">
                <div class="input-group d-flex" style="width: 725px; height: 40px; box-shadow: 0 0 3px 0 rgba(0, 0, 0, 0.25); margin: 3.2px 37px 2px 0;">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Mencari apa?">
                </div>

                <ul class="navbar-nav d-flex align-items-center" style="margin-left: -15px;">
                <li class="nav-item dropdown pe-2 d-flex align-items-center justify-content-center" 
                    style="width: 45px; height: 45px; flex-grow: 0; margin: 3.2px 12px 0 0; padding: 7px; border-radius: 15px; background-color: rgba(45, 156, 219, 0.15);">
                    <a href="javascript:;" class="nav-link text-body p-0 d-flex align-items-center justify-content-center" 
                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell cursor-pointer" style="font-size: 20px; color: #2970ff;"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                    <li class="mb-2">
                        <a class="dropdown-item border-radius-md" href="/laporan/detail/1">
                        <div class="d-flex py-1">
                            <div class="my-auto">
                            <img src="/assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-sm font-weight-normal mb-1">
                                <span class="font-weight-bold">New message</span> from Laur
                            </h6>
                            <p class="text-xs text-secondary mb-0">
                                <i class="fa fa-clock me-1"></i>
                                13 minutes ago
                            </p>
                            </div>
                        </div>
                        </a>
                    </li>
                    </ul>
                </li>
                <div class="d-flex align-items-center">
                    <li class="nav-item px-3 d-flex align-items-center justify-content-center" 
                        style="width: 45px; height: 45px; flex-grow: 0; padding: 9px; border-radius: 15px; background-color: rgba(255, 91, 91, 0.15);">
                        <a href="javascript:;" class="nav-link text-body p-0 d-flex align-items-center justify-content-center">
                            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer" style="font-size: 20px; color: #ff5b5b;"></i>
                        </a>
                    </li>

                    <div style="width: 1px; height: 45px; background-color: #ddd; margin: 0 10px;"></div>
                
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link text-body font-weight-bold px-0 d-flex align-items-center" 
                            id="adminMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->foto_profil ?? '/images/marie.jpg' }}" 
                                class="rounded-circle me-2" alt="Profile Image" width="45" height="45">
                            <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
                            <i class="fa fa-chevron-down ms-2"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminMenuButton">
                            <li class="dropdown-item-text px-3 py-2">
                                <strong>{{ Auth::user()->name }}</strong><br>
                                <small>{{ Auth::user()->role }}</small>
                            </li>
                            <hr class="my-2">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fa fa-user me-2"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out-alt me-2"></i> Logout
                                </a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </div>           
                </ul>        
            </div>
        </div>    
    </nav>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4" style="background: #d1e0ff; border: none;">
                    <div class="card-header" style="background: inherit; border: none; padding: 0;"></div>
                    <div style="display: flex; align-items: center;">
                        <div style="flex: 1; text-indent: 20px;">
                            <p class="mb-0 text-xs" style="color: #000000;">{{ Auth::user()->name }}, Kamu Sedang Dihalaman</p>
                            <h4 class="mb-0">Management Pinalti</h4>
                        </div>
                        <div style="flex-shrink: 0;">
                            <img src="{{ asset('images/header.svg') }}" alt="Welcome Image" 
                                 style="max-width: 150px; height: auto; object-fit: cover; border-radius: 10px;">
                        </div>
                    </div>                
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <label for="data-count" style="margin-right: 10px;">Show</label>
                <select id="data-count" class="form-select" style="background-color: #d1e0ff; width: auto; padding-right: 25px;">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select>                
            </div>            
    
            <script>
                document.getElementById('data-count').addEventListener('change', function() {
                    var perPage = this.value;
                    window.location.search = '?per_page=' + perPage;
                });
            </script>
        </div>
    </div>
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <table class="table table-hover rounded-table text-center"
                       style="font-size: 15px; width: 100%; background-color: white;">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jenis Hukuman</th>
                            <th>Pesan</th>
                            <th>Durasi</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pinalti as $data)
                            <tr>
                                <td>{{ optional($data->laporan->terlapor)->name ?? 'Pengguna tidak ditemukan' }}</td>
                                <td>{{ $data->jenis_hukuman }}</td>
                                <td>{{ $data->pesan }}</td>
                                <td>{{ $data->durasi }}</td>
                                <td>{{ $data->start_date }}</td>
                                <td>{{ $data->end_date ? $data->end_date : 'Belum selesai' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-lg">
                {{ $pinalti->links('pagination::bootstrap-4') }}
            </ul>
        </nav>
    </div>    
  
    <footer class="footer pt-3">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted">
                        <p>Copyright &copy; by around.you
                            <script>
                            document.write(new Date().getFullYear())
                            </script>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</main>
@endsection

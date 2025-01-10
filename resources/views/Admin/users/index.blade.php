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
                            <h4 class="mb-0">Pengguna</h4>
                        </div>
                        <div style="flex-shrink: 0;">
                            <img src="{{ asset('images/header.svg') }}" alt="Welcome Image" 
                                 style="max-width: 150px; height: auto; object-fit: cover; border-radius: 10px;">
                        </div>
                    </div>                
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-between mb-3">
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
        
            <div>
                <button type="button" class="btn btn-transparent" style="border: solid 1px #c9c1ff; color: #624de3b3;" id="filter-toggle">
                    Filter <i class="fa fa-filter" style="margin-left: 5px;"></i>
                </button>
            </div>
        </div>
                  
        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterModalLabel">Filter Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="GET" action="{{ route('admin.users.index') }}">
                            <div class="mb-3">
                                <label for="kabupaten" class="form-label">Kabupaten</label>
                                <select name="kabupaten" id="kabupaten" class="form-select">
                                    <option value="">-- Pilih Kabupaten --</option>
                                    <option value="Kabupaten A" {{ request('kabupaten') == 'Kabupaten A' ? 'selected' : '' }}>Kabupaten A</option>
                                    <option value="Kabupaten B" {{ request('kabupaten') == 'Kabupaten B' ? 'selected' : '' }}>Kabupaten B</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="form-select">
                                    <option value="">-- Pilih Kecamatan --</option>
                                    <option value="Kecamatan X" {{ request('kecamatan') == 'Kecamatan X' ? 'selected' : '' }}>Kecamatan X</option>
                                    <option value="Kecamatan Y" {{ request('kecamatan') == 'Kecamatan Y' ? 'selected' : '' }}>Kecamatan Y</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="desa" class="form-label">Desa</label>
                                <select name="desa" id="desa" class="form-select">
                                    <option value="">-- Pilih Desa --</option>
                                    <option value="Desa 1" {{ request('desa') == 'Desa 1' ? 'selected' : '' }}>Desa 1</option>
                                    <option value="Desa 2" {{ request('desa') == 'Desa 2' ? 'selected' : '' }}>Desa 2</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 

        <script>
            document.getElementById('filter-toggle').addEventListener('click', function() {
            var filterModal = new bootstrap.Modal(document.getElementById('filterModal'));
            filterModal.show();
            });
        </script>
    
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped rounded-table text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Umur</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="align-middle">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->umur }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>
                                    <span 
                                        class="badge align-items-center justify-content-center 
                                        {{ $user->status === 'banned' ? 'status-banned' : 'status-active' }}">
                                        @if($user->status === 'banned')
                                            <i class="fa fa-ban me-1 mt-2"></i> Banned
                                        @else
                                            <i class="fa fa-check-square me-1 mt-2"></i> Aktif
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    @if($user->status !== 'banned')
                                        <form action="{{ route('admin.users.block', $user->id) }}" method="POST" class="d-inline" id="block-form-{{ $user->id }}">
                                            @csrf
                                            <button type="button" class="btn btn-block-user btn-sm" onclick="confirmBan('{{ $user->id }}')" style="margin-top: 10px !important;">
                                                <i class="fa fa-ban" style="font-size: 18px;"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" id="delete-form-{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-delete-user btn-sm" onclick="confirmDelete('{{ $user->id }}')" style="margin-top: 10px !important;">
                                            <i class="fa fa-trash" style="font-size: 18px;"></i>
                                        </button>
                                    </form>
                                </td>
                                
                                <script>
                                    function confirmBan(userId) {
                                        Swal.fire({
                                            title: 'Apakah Anda yakin?',
                                            text: "Pengguna ini akan diblokir.",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Ya, blokir!',
                                            cancelButtonText: 'Batal'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                document.getElementById('block-form-' + userId).submit();
                                            }
                                        });
                                    }
                                
                                    function confirmDelete(userId) {
                                        Swal.fire({
                                            title: 'Apakah Anda yakin?',
                                            text: "Pengguna ini akan dihapus.",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Ya, hapus!',
                                            cancelButtonText: 'Batal'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                document.getElementById('delete-form-' + userId).submit();
                                            }
                                        });
                                    }
                                </script>                                                             
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data pengguna.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
    
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-lg">
                {{ $users->links('pagination::bootstrap-4') }}
            </ul>
        </nav>
    </div>
    
    <style>
        .pagination-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            align-items: center;
        }

        .pagination {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 10px;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination a, .pagination span {
            text-decoration: none;
            font-weight: bold;
            color: #007bff;
        }

        .pagination .disabled span,
        .pagination .active span {
            font-weight: bold;
        }

        .pagination .active span {
            background-color: #3243fd;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .pagination a:not(.page-link), 
        .pagination .disabled:not(.page-link) span {
            background: none;
            padding: 0;
            border-radius: 0;
            color: inherit;
        }

        .pagination .page-link {
            background-color: #eff4ff;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #dee2e6;
            color: #3243fd;
        }

        .pagination .page-link:hover {
            background-color: #e2e6ea;
        }
    </style>
  
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

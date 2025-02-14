@extends('layouts.admin')
@section('content')
{{-- <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <nav class="navbar navbar-main navbar-expand-lg mt-3 px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true"> --}}
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg" style="padding-top: 80px;">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-sm border-radius-xl"
            id="navbarBlur" navbar-scroll="true"
            style="position: fixed; top: 15px; width: 74.9%; background-color: white; z-index: 100; height: 70px;">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center w-100" id="navbar">
                    <div class="nav-control d-flex align-items-center" style="width: 725px; height: 40px; margin: 3.2px 37px 2px 0;">
                        <div class="hamburger">
                          <span class="toggle-icon" style="cursor: pointer;"><i class="fas fa-bars fa-lg"></i></span>
                        </div>
                    </div>

                    <ul class="navbar-nav d-flex align-items-center" style="margin-left: -15px;">
                        <li class="nav-item dropdown pe-2 d-flex align-items-center justify-content-center"
                            style="width: 45px; height: 45px; flex-grow: 0; margin: 3.2px 12px 0 0; padding: 7px; border-radius: 15px; background-color: rgba(45, 156, 219, 0.15);">
                            <a href="javascript:;"
                                class="nav-link text-body p-0 d-flex align-items-center justify-content-center"
                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer" style="font-size: 20px; color: #2970ff;"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">
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
                                <a href="javascript:;"
                                    class="nav-link text-body p-0 d-flex align-items-center justify-content-center">
                                    <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"
                                        style="font-size: 20px; color: #ff5b5b;"></i>
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
                                <p class="mb-0 text-xs" style="color: #000000;">{{ Auth::user()->name }}, Kamu Sedang
                                    Dihalaman</p>
                                <h4 class="mb-0">Banned Pengguna</h4>
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
                <div class="d-flex justify-content-between align-items-center" style="gap: 20px;">
                    <div class="d-flex align-items-center">
                        <label for="data-count" style="margin-right: 10px;">Show</label>
                        <select id="data-count" class="form-select" style="background-color: #d1e0ff; width: auto; padding-right: 25px; cursor: pointer;">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                            <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                    </div>
                
                    <div class="input-group" style="width: 300px;">
                        <form action="{{ route('admin.users.banned') }}" method="GET" style="display: flex; width: 100%;">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" name="search" class="form-control" placeholder="Mencari apa?" value="{{ request('search') }}">
                            </div>
                        </form>
                    </div>
                </div>
    
                <script>
                    document.getElementById('data-count').addEventListener('change', function() {
                        var perPage = this.value;
                        window.location.search = '?per_page=' + perPage;
                    });
                </script>

                <div class="d-flex align-items-center" style="gap: 10px;">
                    <!-- Dropdown untuk Provinsi -->
                    <select id="provinces" class="form-select"
                        style="background-color: transparent; width: auto; padding-right: 33px; border: 1px solid #C9C1FF;">
                        <option value="">Provinsi</option>
                    </select>

                    <!-- Dropdown untuk Kabupaten -->
                    <select id="regencies" class="form-select"
                        style="background-color: transparent; width: auto; padding-right: 33px; border: 1px solid #C9C1FF;">
                        <option value="">Kabupaten</option>
                    </select>

                    <!-- Dropdown untuk Kecamatan -->
                    <select id="districts" class="form-select"
                        style="background-color: transparent; width: auto; padding-right: 33px; border: 1px solid #C9C1FF;">
                        <option value="">Kecamatan</option>
                    </select>

                    <!-- Dropdown untuk Desa -->
                    <select id="villages" class="form-select"
                        style="background-color: transparent; width: auto; padding-right: 33px; border: 1px solid #C9C1FF;">
                        <option value="">Desa</option>
                    </select>
                </div>
                
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        fetch('/locations/provinsi')
                            .then(response => response.json())
                            .then(data => {
                                let provinsiSelect = document.getElementById('provinces');
                                updateDropdown(provinsiSelect, data, "Provinsi");
                            })
                            .catch(error => console.error('Error:', error));
                    });
                
                    document.getElementById('provinces').addEventListener('change', function() {
                        let provinsiId = this.value;
                        let regenciesSelect = document.getElementById('regencies');
                        let districtsSelect = document.getElementById('districts');
                        let villagesSelect = document.getElementById('villages');
                
                        resetDropdown(regenciesSelect, "Kabupaten");
                        resetDropdown(districtsSelect, "Kecamatan");
                        resetDropdown(villagesSelect, "Desa");
                
                        if (!provinsiId) return;
                
                        fetch(`/locations/kabupaten?provinsi_id=${provinsiId}`)
                            .then(response => response.json())
                            .then(data => updateDropdown(regenciesSelect, data, "Kabupaten"))
                            .catch(error => console.error('Error:', error));
                    });
                
                    document.getElementById('regencies').addEventListener('change', function() {
                        let kabupatenId = this.value;
                        let districtsSelect = document.getElementById('districts');
                        let villagesSelect = document.getElementById('villages');
                
                        resetDropdown(districtsSelect, "Kecamatan");
                        resetDropdown(villagesSelect, "Desa");
                
                        if (!kabupatenId) return;
                
                        fetch(`/locations/kecamatan?kabupaten_id=${kabupatenId}`)
                            .then(response => response.json())
                            .then(data => updateDropdown(districtsSelect, data, "Kecamatan"))
                            .catch(error => console.error('Error:', error));
                    });
                
                    document.getElementById('districts').addEventListener('change', function() {
                        let kecamatanId = this.value;
                        let villagesSelect = document.getElementById('villages');
                
                        resetDropdown(villagesSelect, "Desa");
                
                        if (!kecamatanId) return;
                
                        fetch(`/locations/desa?kecamatan_id=${kecamatanId}`)
                            .then(response => response.json())
                            .then(data => updateDropdown(villagesSelect, data, "Desa"))
                            .catch(error => console.error('Error:', error));
                    });
                
                    function updateDropdown(selectElement, data, defaultText) {
                        let width = window.getComputedStyle(selectElement).width; // Ambil lebar sebelum di-update
                        resetDropdown(selectElement, defaultText);
                        selectElement.style.width = width; // Set lebar agar tidak berubah

                        data.forEach(item => {
                            let option = document.createElement('option');
                            option.value = item.id;
                            option.textContent = item.name;
                            option.title = item.name; // Tambahkan tooltip
                            selectElement.appendChild(option);
                        });
                    }

                    document.querySelectorAll('select').forEach(select => {
                        select.addEventListener('mouseover', function () {
                            this.title = this.options[this.selectedIndex].text;
                        });
                    });
                
                    function resetDropdown(selectElement, defaultText) {
                        while (selectElement.firstChild) {
                            selectElement.removeChild(selectElement.firstChild);
                        }
                        let defaultOption = document.createElement('option');
                        defaultOption.value = "";
                        defaultOption.textContent = defaultText;
                        selectElement.appendChild(defaultOption);
                    }
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
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bannedUsers as $user)
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span
                                            class="badge align-items-center justify-content-center
                                        {{ $user->status === 'banned' ? 'status-banned' : 'status-active' }}">
                                            @if ($user->status === 'banned')
                                                <i class="fa fa-ban me-1 mt-2"></i> Banned
                                            @else
                                                <i class="fa fa-check-square me-1 mt-2"></i> Aktif
                                            @endif
                                        </span>
                                    </td>
                                    <td style="max-width: 200px; word-wrap: break-word; white-space: normal;">
                                        {!! collect([
                                            $user->provinsis ? 'Provinsi ' . $user->provinsis->name : null,
                                            $user->kabupatens ? 'Kabupaten ' . $user->kabupatens->name : null,
                                            $user->kecamatans ? 'Kecamatan ' . $user->kecamatans->name : null,
                                            $user->desas ? 'Desa ' . $user->desas->name : null,
                                        ])->filter()->implode(',<br>') !!}
                                    </td>  
                                    <td>
                                        <form action="{{ route('admin.users.unblock', $user->id) }}" method="POST"
                                            class="d-inline" id="unblock-form-{{ $user->id }}">
                                            @csrf
                                            <button type="button" class="btn btn-sm text-white"
                                                style="background-color: #5D87FF; margin-top: 10px !important;"
                                                onclick="confirmUnblock('{{ $user->id }}')">
                                                Buka Banned
                                            </button>
                                        </form>
                                    </td>

                                    <script>
                                        function confirmUnblock(userId) {
                                            Swal.fire({
                                                title: 'Apakah Anda yakin?',
                                                text: "Pengguna ini akan dibuka banned-nya.",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Ya, buka banned!',
                                                cancelButtonText: 'Batal'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('unblock-form-' + userId).submit();
                                                }
                                            });
                                        }
                                    </script>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada pengguna yang dibanned.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-lg">
                {{ $users->links('pagination::bootstrap-4') }}
            </ul>
        </nav>
    </div> --}}

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

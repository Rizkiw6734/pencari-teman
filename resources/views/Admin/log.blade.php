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
                        <a href="javascript:;" class="nav-link text-body p-0 d-flex align-items-center justify-content-center"
                           id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell cursor-pointer" style="font-size: 20px; color: #2970ff;"></i>
                            @if($notifications->count() > 0)
                                <span class="badge text-white" style="width: 20px; height: 20px; border-radius: 50%; position: absolute; top: -3px; left: -8px; background-color: #2D9CDB; display: flex; align-items: center; justify-content: center; font-size: 10px; line-height: 20px; text-align: center;">
                                    {{ $notifications->count() }}
                                </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            <div style="height: 300px; overflow-y: scroll; solid #ccc;">
                            @forelse($notifications as $notif)
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md notif-item" href="{{ $notif->link }}" data-id="{{ $notif->id }}">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="{{ $notif->foto_profil ? asset('storage/' . $notif->foto_profil) : asset('images/marie.jpg') }}" class="avatar avatar-sm me-3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">{{ $notif->judul }}</span>
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    {{ $notif->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="text-center py-2">
                                    <p class="text-xs text-secondary mb-0">Tidak ada notifikasi</p>
                                </li>
                            @endforelse
                            </div>
                        </ul>
                        <script>
                            $(document).ready(function () {
                                $(document).on("click", ".notif-item", function (e) {
                                    e.preventDefault(); // Jangan langsung pindah halaman
                                    let notifId = $(this).data("id");
                                    let notifLink = $(this).attr("href");

                                    $.ajax({
                                        url: "/notifikasi/read/" + notifId,
                                        type: "POST",
                                        headers: {
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        success: function (response) {
                                            if (response.success) {
                                                // Ubah tampilan notifikasi jadi "read" (opsional)
                                                $(`a[data-id="${notifId}"]`).removeClass("unread").addClass("read");

                                                // Redirect setelah status diperbarui
                                                window.location.href = notifLink;
                                            }
                                        },
                                        error: function () {
                                            console.error("Gagal memperbarui notifikasi.");
                                        }
                                    });
                                });
                            });
                        </script>
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
                                <p class="mb-0 text-xs" style="color: #000000;">{{ Auth::user()->name }}, Kamu Sedang Dihalaman</p>
                                <h4 class="mb-0">Log Aktivitas</h4>
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
                        <form action="{{ route('admin.log') }}" method="GET" style="display: flex; width: 100%;">
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

                <div class="d-flex align-items-center">
                    <div class="input-group" style="width: auto; align-items: center; position: relative; margin-right: 5px;">
                        <span class="input-group-text"
                            style="background-color: transparent; border: 1px solid #C9C1FF; cursor: pointer; display: flex; align-items: center; justify-content: center; border-radius: 7px; padding: 10px 15px;">
                            <i class="fa fa-calendar" style="font-size: 18.5px; margin-right: 10px;"></i>
                            <i class="fa fa-caret-down" style="font-size: 18.5px;"></i>
                        </span>
                        <input type="date" id="dateFilter" class="form-control"
                            style="background-color: transparent; border: none; position: absolute; top: 0; left: 0; width: 100%; height: 40px; opacity: 0; cursor: pointer;">
                    </div>

                    <script>
                        document.getElementById('dateFilter').addEventListener('change', function() {
                            var selectedDate = this.value; // Mendapatkan tanggal yang dipilih
                            var rows = document.querySelectorAll('table tbody tr'); // Menemukan semua baris tabel
                            rows.forEach(function(row) {
                                var dateCell = row.cells[3].textContent.trim();
                                var formattedDate = new Date(dateCell.split('-').reverse().join('-')).toISOString().split('T')[0]; // Format ulang tanggal ke YYYY-MM-DD

                                if (formattedDate === selectedDate) {
                                    row.style.display = ''; // Tampilkan baris jika tanggal cocok
                                } else {
                                    row.style.display = 'none'; // Sembunyikan baris jika tidak cocok
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>

        {{-- <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <table class="table table-hover rounded-table text-center"
                        style="font-size: 15px; width: 100%; background-color: white;">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Admin</th>
                                <th>Aktivitas Admin</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($log->user)->name ?? 'Pengguna tidak ditemukan' }}</td>
                                    <td style="max-width: 220px; word-wrap: break-word; white-space: normal;">{{ ucwords($log->aktivitas ?? 'Aktivitas tidak ada') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d-m-Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        <style>
            .nav-tabs .nav-link.active {
                background-color: #8979FF !important;
                color: white !important;
                border-color: #8979FF #8979FF #fff !important;
            }

            .nav-tabs .nav-link {
                color: #000000 !important;
            }

        </style>

        <div class="container mt-4">
            <!-- Navigasi Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab">Aktivitas Admin</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="user-tab" data-bs-toggle="tab" data-bs-target="#user" type="button" role="tab">Notifikasi User</button>
                </li>
            </ul>

            <!-- Konten Tabs -->
            <div class="tab-content mt-3">
                <div class="tab-pane fade show active" id="admin" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-hover rounded-table text-center"
                                style="font-size: 15px; width: 100%; background-color: white;">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Admin</th>
                                        <th>Aktivitas Admin</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($logs as $log)
                                        <tr class="align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ optional($log->user)->name ?? 'Pengguna tidak ditemukan' }}</td>
                                            <td style="max-width: 220px; word-wrap: break-word; white-space: normal;">{{ ucwords($log->aktivitas ?? 'Aktivitas tidak ada') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d-m-Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-hover rounded-table text-center"
                                style="font-size: 15px; width: 100%; background-color: white;">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama User</th>
                                        <th>Notifikasi User</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($notifikasis as $index => $notifikasi)
                                    <tr>
                                        <td>{{ $index + 1 }}.</td>
                                        <td>{{ $notifikasi->laporan->pelapor->name ?? 'Tidak diketahui' }}</td>
                                        <td>{{ $notifikasi->pesan }}</td>
                                        <td>{{ $notifikasi->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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

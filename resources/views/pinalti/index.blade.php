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
                            <span class="badge bg-danger text-white" style="position: absolute; top: 5px; right: 5px; font-size: 10px;">
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
                                            <img src="/assets/img/team-2.jpg" class="avatar avatar-sm me-3">
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
                    <form action="{{ route('laporan.index') }}" method="GET" style="display: flex; width: 100%;">
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

                <div class="input-group text-dark" style="width: auto; align-items: center; position: relative; margin-left: 5px;">
                    <select id="jenisHukumanFilter" class="form-control"
                        style="background-color: transparent; border: 1px solid #C9C1FF; cursor: pointer; appearance: none; -moz-appearance: none; -webkit-appearance: none; padding-right: 25px;">
                        <option value="">Hukuman</option>
                        <option value="peringatan">Peringatan</option>
                        <option value="suspend">Suspend</option>
                        <option value="banned">Banned</option>
                    </select>
                    <i class="fa fa-caret-down" style="font-size: 18.5px; position: absolute; right: 10px; pointer-events: none;"></i>
                </div>

                <script>
                    document.getElementById('dateFilter').addEventListener('change', function() {
                        var selectedDate = this.value; // Mendapatkan tanggal yang dipilih
                        var rows = document.querySelectorAll('table tbody tr'); // Menemukan semua baris tabel
                        rows.forEach(function(row) {
                            var dateCell = row.cells[5].textContent.trim(); // Mengambil tanggal dari kolom ke-4 (Tanggal)
                            var formattedDate = new Date(dateCell.split('-').reverse().join('-')).toISOString().split('T')[0]; // Format ulang tanggal ke YYYY-MM-DD

                            if (formattedDate === selectedDate) {
                                row.style.display = ''; // Tampilkan baris jika tanggal cocok
                            } else {
                                row.style.display = 'none'; // Sembunyikan baris jika tidak cocok
                            }
                        });
                    });
                </script>

                <script>
                    document.getElementById('jenisHukumanFilter').addEventListener('change', function () {
                        var selectedHukuman = this.value; // Ambil nilai hukuman yang dipilih
                        var rows = document.querySelectorAll('table tbody tr'); // Semua baris tabel

                        rows.forEach(function (row) {
                            var jenisHukumanCell = row.cells[2];
                            var jenisHukumanText = jenisHukumanCell ? jenisHukumanCell.textContent.trim().toLowerCase() : ''; // Ambil teks dalam kolom

                            // Tampilkan atau sembunyikan baris tergantung pada apakah jenis hukuman cocok
                            if (selectedHukuman === '' || jenisHukumanText.includes(selectedHukuman)) {
                                row.style.display = ''; // Tampilkan baris
                            } else {
                                row.style.display = 'none'; // Sembunyikan baris
                            }
                        });
                    });
                </script>

            </div>
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
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ optional($data->laporan->terlapor)->name ?? 'Pengguna tidak ditemukan' }}</td>
                                <td>{{ ucwords($data->jenis_hukuman) }}</td>
                                <td>{{ $data->pesan }}</td>
                                <td>{{ $data->durasi ? $data->durasi . ' hari' : '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->start_date)->format('d-m-Y') }}</td>
                                <td>{{ $data->end_date ? \Carbon\Carbon::parse( $data->end_date)->format('d-m-Y') : '-' }}</td>
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

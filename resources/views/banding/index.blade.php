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
                                <h4 class="mb-0">Management Aju Banding</h4>
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
                        <select id="jenisPinaltiFilter" class="form-control"
                            style="background-color: transparent; border: 1px solid #C9C1FF; cursor: pointer; appearance: none; -moz-appearance: none; -webkit-appearance: none; padding-right: 25px;">
                            <option value="">Pinalti</option>
                            <option value="peringatan">Peringatan</option>
                            <option value="suspend">Suspend</option>
                            <option value="banned">Banned</option>
                        </select>
                        <i class="fa fa-caret-down" style="font-size: 18.5px; position: absolute; right: 10px; pointer-events: none;"></i>
                    </div>

                    <div class="input-group text-dark" style="width: auto; align-items: center; position: relative; margin-left: 5px;">
                        <select id="statusFilter" class="form-control"
                            style="background-color: transparent; border: 1px solid #C9C1FF; cursor: pointer; appearance: none; -moz-appearance: none; -webkit-appearance: none; padding-right: 25px;">
                            <option value="">Status</option>
                            <option value="proses">Proses</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="diterima">Diterima</option>
                        </select>
                        <i class="fa fa-caret-down" style="font-size: 18.5px; position: absolute; right: 10px; pointer-events: none;"></i>
                    </div>

                    <script>
                        document.getElementById('dateFilter').addEventListener('change', function() {
                            var selectedDate = this.value; // Mendapatkan tanggal yang dipilih
                            var rows = document.querySelectorAll('table tbody tr'); // Menemukan semua baris tabel
                            rows.forEach(function(row) {
                                var dateCell = row.cells[4].textContent.trim();
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
                        document.getElementById('jenisPinaltiFilter').addEventListener('change', function () {
                            var selectedPinalti = this.value; // Ambil nilai Pinalti yang dipilih
                            var rows = document.querySelectorAll('table tbody tr'); // Semua baris tabel

                            rows.forEach(function (row) {
                                var jenisPinaltiCell = row.cells[2];
                                var jenisPinaltiText = jenisPinaltiCell ? jenisPinaltiCell.textContent.trim().toLowerCase() : ''; // Ambil teks dalam kolom

                                // Tampilkan atau sembunyikan baris tergantung pada apakah jenis Pinalti cocok
                                if (selectedPinalti === '' || jenisPinaltiText.includes(selectedPinalti)) {
                                    row.style.display = ''; // Tampilkan baris
                                } else {
                                    row.style.display = 'none'; // Sembunyikan baris
                                }
                            });
                        });
                    </script>

                    <script>
                        document.getElementById('statusFilter').addEventListener('change', function() {
                            var selectedStatus = this.value; // Mendapatkan status yang dipilih
                            var rows = document.querySelectorAll('table tbody tr'); // Menemukan semua baris tabel
                            rows.forEach(function(row) {
                                var statusCell = row.cells[5]; // Menemukan kolom status (kolom ke-5)
                                var statusBadge = statusCell.querySelector('.badge'); // Menemukan elemen badge status
                                var statusText = statusBadge ? statusBadge.textContent.trim().toLowerCase() : ''; // Mengambil status teks

                                // Menampilkan atau menyembunyikan baris tergantung pada apakah status cocok
                                if (selectedStatus === '' || statusText.includes(selectedStatus)) {
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
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Pinalti</th>
                                <th>Alasan Banding</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bandings as $banding)
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($banding->user)->name ?? 'Pengguna tidak ditemukan' }}</td>
                                    <td>{{ ucwords($banding->jenis_hukuman) }}</td>
                                    <td>{{ $banding->alasan_banding }}</td>
                                    <td>{{ \Carbon\Carbon::parse($banding->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        <span class="badge align-items-center justify-content-center
                                            @if($banding->status == 'proses') status-proses
                                            @elseif($banding->status == 'ditolak') status-ditolak
                                            @elseif($banding->status == 'diterima') status-diterima
                                            @endif">
                                            @if($banding->status == 'proses')
                                                <i class="fa fa-spinner me-1 mt-2"></i> Proses
                                            @elseif($banding->status == 'ditolak')
                                                <i class="fa fa-times me-1 mt-2"></i> Ditolak
                                            @elseif($banding->status == 'diterima')
                                                <i class="fa fa-check me-1 mt-2"></i> Diterima
                                            @endif
                                        </span>
                                    </td>

                                    <td>
                                        <form id="form-terima-{{ $banding->id }}" action="{{ route('banding.terima', $banding->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="action" id="action-{{ $banding->id }}" value="">
                                            <button type="button" class="btn btn-trm btn-sm"
                                                data-id="{{ $banding->id }}" data-jenis="{{ $banding->jenis_hukuman }}" style="margin-top: 10px !important;">
                                                <i class="fa fa-check" style="font-size: 18px;"></i>
                                            </button>
                                        </form>
                                        <form id="form-tolak-{{ $banding->id }}" action="{{ route('banding.tolak', $banding->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="button" class="btn btn-tlk btn-sm"
                                                data-id="{{ $banding->id }}" style="margin-top: 10px !important;">
                                                <i class="fa fa-times " style="font-size: 18px;"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            // Event untuk tombol "Terima"
                                            document.querySelectorAll('.btn-trm').forEach(button => {
                                                button.addEventListener('click', function () {
                                                    const bandingId = this.getAttribute('data-id');
                                                    const jenisHukuman = this.getAttribute('data-jenis');

                                                    if (jenisHukuman === 'suspend') {
                                                        Swal.fire({
                                                            title: 'Pilih Tindakan',
                                                            text: "Hukuman suspend ini bisa dihapus atau dikurangi.",
                                                            icon: 'question',
                                                            showDenyButton: true,
                                                            showCancelButton: true,
                                                            confirmButtonText: 'Hapus Suspend',
                                                            denyButtonText: 'Kurangi Suspend',
                                                            cancelButtonText: 'Batal'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                // Set action menjadi "hapus"
                                                                document.getElementById(`action-${bandingId}`).value = 'hapus';
                                                                document.getElementById(`form-terima-${bandingId}`).submit();
                                                            } else if (result.isDenied) {
                                                                Swal.fire({
                                                                    title: 'Kurangi Suspend',
                                                                    text: "Masukkan durasi yang akan dikurangi (dalam hari):",
                                                                    input: 'number',
                                                                    inputAttributes: {
                                                                        min: 1,
                                                                        step: 1
                                                                    },
                                                                    inputPlaceholder: 'Masukkan jumlah hari',
                                                                    showCancelButton: true,
                                                                    confirmButtonText: 'Kurangi',
                                                                    cancelButtonText: 'Batal',
                                                                    preConfirm: (durasi) => {
                                                                        if (!durasi || durasi <= 0) {
                                                                            Swal.showValidationMessage('Durasi harus lebih dari 0');
                                                                        }
                                                                        return durasi;
                                                                    }
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        const durasi = result.value;
                                                                        const form = document.getElementById(`form-terima-${bandingId}`);

                                                                        const inputDurasi = document.createElement('input');
                                                                        inputDurasi.type = 'hidden';
                                                                        inputDurasi.name = 'durasi';
                                                                        inputDurasi.value = durasi;
                                                                        form.appendChild(inputDurasi);

                                                                        document.getElementById(`action-${bandingId}`).value = 'kurangi';
                                                                        form.submit();
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    } else {
                                                        Swal.fire({
                                                            title: 'Apakah Anda yakin?',
                                                            text: "Data akan diterima!",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Ya, Terima!',
                                                            cancelButtonText: 'Batal'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                document.getElementById(`form-terima-${bandingId}`).submit();
                                                            }
                                                        });
                                                    }
                                                });
                                            });

                                            // Event untuk tombol "Tolak"
                                            document.querySelectorAll('.btn-tlk').forEach(button => {
                                                button.addEventListener('click', function () {
                                                    const bandingId = this.getAttribute('data-id');
                                                    Swal.fire({
                                                        title: 'Apakah Anda yakin?',
                                                        text: "Data akan ditolak!",
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#3085d6',
                                                        cancelButtonColor: '#d33',
                                                        confirmButtonText: 'Ya, Tolak!',
                                                        cancelButtonText: 'Batal'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            document.getElementById(`form-tolak-${bandingId}`).submit();
                                                        }
                                                    });
                                                });
                                            });
                                        });
                                    </script>
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

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

                <ul class="navbar-nav d-flex align-items-center" style="marqgin-left: -15px;">
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
                        <li class="nav-item px-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; flex-grow: 0; padding: 9px; border-radius: 15px; background-color: rgba(255, 91, 91, 0.15);">
                            <a href="javascript:;" class="nav-link text-body p-0 d-flex align-items-center justify-content-center">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer" style="font-size: 20px; color: #ff5b5b;"></i>
                            </a>
                        </li>

                        <div style="width: 1px; height: 45px; background-color: #ddd; margin: 0 10px;"></div>

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link text-body font-weight-bold px-0 d-flex align-items-center" id="adminMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Auth::user()->foto_profil ?? '/images/marie.jpg' }}" class="rounded-circle me-2" alt="Profile Image" width="45" height="45">
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
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                            <h4 class="mb-0">Management Laporan</h4>
                        </div>
                        <div style="flex-shrink: 0;">
                            <img src="{{ asset('images/header.svg') }}" alt="Welcome Image" style="max-width: 150px; height: auto; object-fit: cover; border-radius: 10px;">
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
                    <select id="statusFilter" class="form-control"
                        style="background-color: transparent; border: 1px solid #C9C1FF; cursor: pointer; appearance: none; -moz-appearance: none; -webkit-appearance: none; padding-right: 25px;">
                        <option value="">Status</option>
                        <option value="proses">Proses</option>
                        <option value="dibanned">Dibanned</option>
                        <option value="peringatan">Peringatan</option>
                        <option value="disuspend">Disuspend</option>
                        <option value="diterima">Diterima</option>
                        <option value="selesai">Selesai</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                    <i class="fa fa-caret-down" style="font-size: 18.5px; position: absolute; right: 10px; pointer-events: none;"></i>
                </div>

                <script>
                    document.getElementById('dateFilter').addEventListener('change', function() {
                        var selectedDate = this.value; // Mendapatkan tanggal yang dipilih
                        var rows = document.querySelectorAll('table tbody tr'); // Menemukan semua baris tabel
                        rows.forEach(function(row) {
                            var dateCell = row.cells[3].textContent.trim(); // Mengambil tanggal dari kolom ke-4 (Tanggal)
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
                    document.getElementById('statusFilter').addEventListener('change', function() {
                        var selectedStatus = this.value; // Mendapatkan status yang dipilih
                        var rows = document.querySelectorAll('table tbody tr'); // Menemukan semua baris tabel
                        rows.forEach(function(row) {
                            var statusCell = row.cells[4]; // Menemukan kolom status (kolom ke-5)
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
                            <th>Pelapor</th>
                            <th>Terlapor</th>
                            <th>Jenis Pelanggaran</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $laporan)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $laporan->pelapor->name }}</td>
                                <td>{{ $laporan->terlapor->name }}</td>
                                <td>{{ $laporan->pelanggaran }}</td>
                                <td>{{ \Carbon\Carbon::parse($laporan->created_at)->format('d-m-Y') }}</td>
                                <td>
                                    <span class="badge d-inline-flex align-items-center justify-content-center px-3 py-2
                                        @if($laporan->status == 'proses') status-proses
                                        @elseif($laporan->status == 'dibanned') status-banned
                                        @elseif($laporan->status == 'peringatan') status-peringatan
                                        @elseif($laporan->status == 'disuspend') status-suspend
                                        @elseif($laporan->status == 'diterima') status-diterima
                                        @elseif($laporan->status == 'selesai') status-diterima
                                        @elseif($laporan->status == 'ditolak') status-ditolak
                                        @endif">

                                        @if($laporan->status == 'proses')
                                            Proses
                                        @elseif($laporan->status == 'dibanned')
                                            Dibanned
                                        @elseif($laporan->status == 'peringatan')
                                            Peringatan
                                        @elseif($laporan->status == 'disuspend')
                                            Disuspend
                                        @elseif($laporan->status == 'diterima')
                                            Diterima
                                        @elseif($laporan->status == 'selesai')
                                            Selesai
                                        @elseif($laporan->status == 'ditolak')
                                            Ditolak
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-detail btn-sm" data-bs-toggle="modal" data-bs-target="#laporanModal{{ $laporan->id }}"
                                        data-id="{{ $laporan->id }}" style="margin-top: 15px !important;">
                                        <i class="fa fa-eye" style="font-size: 18px;"></i>
                                    </button>
                                </td>
                                <!-- Modal Detail Laporan -->
                                <div class="modal fade" id="laporanModal{{ $laporan->id }}" data-bs-backdrop="false" tabindex="-1" aria-labelledby="laporanModalLabel{{ $laporan->id }}" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5) !important;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex align-items-center justify-content-between w-100">
                                                <h5 class="modal-title" id="laporanModalLabel{{ $laporan->id }}">Detail Laporan</h5>

                                                <div class="d-flex align-items-center gap-3">
                                                    <button type="button" class="btn-clos p-0 border-0 btn-per" style="background-color: transparent !important; border: none;" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="fa fa-times fa-lg"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="modal-body">
                                                <div class="col-lg-12 col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <!-- Bagian Detail -->
                                                                <div class="col-6 mt-1 detail-laporan">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <p class="text-dark text-bold">Pelapor</p>
                                                                            <p>{{ $laporan->pelapor->name }}</p>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <p class="text-dark text-bold">Terlapor</p>
                                                                            <p>{{ $laporan->terlapor->name }}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <p class="text-dark text-bold">Jenis Pelanggaran</p>
                                                                        <p>{{ $laporan->pelanggaran }}</p>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-10">
                                                                            <p class="text-dark text-bold">Alasan</p>
                                                                            <p>{{ $laporan->alasan }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-1 text-center border-divider">
                                                                    <div class="vertical-line"></div>
                                                                </div>

                                                                <!-- Bagian Bukti -->
                                                                <div class="col-5 bukti-laporan">
                                                                    <div class="d-flex justify-content-between align-items-center gap-3">
                                                                        <p class="text-dark text-bold mb-0">Bukti</p>
                                                                        <p class="mb-0">{{ \Carbon\Carbon::parse($laporan->created_at)->format('d-m-Y') }}</p>
                                                                    </div>

                                                                    <div class="d-flex justify-content-center mt-4">
                                                                        @if ($laporan->bukti)
                                                                            <div class="position-relative">
                                                                                <img src="{{ asset('assets/img/laporan/' . $laporan->bukti) }}" alt="Bukti Laporan" class="img-fluid rounded bukti-laporan">

                                                                                <span class="position-absolute bottom-0 end-0 mb-2 me-2 text-dark" style="font-size: 18px; cursor: pointer; background-color: #FEFEFEE5; border-radius: 50%; padding: 8px; width: 35px; height: 35px; display: flex; justify-content: center; align-items: center;">
                                                                                    <i class="fa fa-expand bukti-laporan" data-id="{{ $laporan->id }}"></i>
                                                                                </span>
                                                                            </div>
                                                                        @else
                                                                            <span class="text-muted">Tidak ada bukti</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <!-- Modal Pop-up -->
                                                                @if ($laporan->bukti)
                                                                    <div class="modal fade" id="buktiModal{{ $laporan->id }}" data-bs-backdrop="false" tabindex="-1" aria-labelledby="modalBuktiLabel{{ $laporan->id }}" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5) !important;">
                                                                        <div class="modal-dialog modal-dialog-centered">
                                                                            <div class="modal-content bg-transparent border-0">
                                                                                <div class="modal-body text-center">
                                                                                    <div class="position-relative d-inline-block">
                                                                                        <span class="position-absolute top-0 end-0 mt-2 me-2 text-dark"
                                                                                              data-bs-dismiss="modal" aria-label="Close"
                                                                                              style="font-size: 18px; cursor: pointer; background-color: #FEFEFEE5; border-radius: 50%; padding: 6px; width: 30px; height: 30px; display: flex; justify-content: center; align-items: center;">
                                                                                            <i class="fa fa-times fa-lg"></i>
                                                                                        </span>

                                                                                        <img src="{{ asset('assets/img/laporan/' . $laporan->bukti) }}"
                                                                                             alt="Bukti Laporan" class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: cover; overflow: hidden;">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                <script>
                                                                    document.addEventListener("DOMContentLoaded", function () {
                                                                        document.querySelectorAll(".bukti-laporan").forEach(img => {
                                                                            img.addEventListener("click", function () {
                                                                                let modalId = "buktiModal" + this.getAttribute("data-id");
                                                                                let modalElement = document.getElementById(modalId);
                                                                                if (modalElement) {
                                                                                    let modal = new bootstrap.Modal(modalElement);
                                                                                    modal.show();
                                                                                }
                                                                            });
                                                                        });
                                                                    });
                                                                </script>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex align-items-center">
                                                            <div>
                                                                @if ($laporan->status === 'proses')
                                                                    <button type="button" class="btn" style="border-radius: 12px; background-color: transparent; border: 1.5px solid #151515; color: #151515; margin-right: 20px; margin-top: 3px !important;" data-bs-toggle="modal" data-bs-target="#modalBanned{{ $laporan->id }}">
                                                                        Banned User
                                                                    </button>

                                                                    <button type="button" class="btn" style="border-radius: 12px; background-color: transparent; border: 1.5px solid #FFC300; color: #FFC300; margin-top: 3px !important;" data-bs-toggle="modal" data-bs-target="#modalPeringatan{{ $laporan->id }}">
                                                                        Beri Peringatan
                                                                    </button>
                                                                @endif
                                                            </div>

                                                            <div class="flex-grow-1 text-center">
                                                                @if ($laporan->status !== 'proses')
                                                                    @if ($laporan->status === 'diterima')
                                                                        <p class="text-success">Laporan telah diterima dan diproses.</p>
                                                                    @elseif ($laporan->status === 'ditolak')
                                                                        <p class="text-danger">Laporan telah ditolak.</p>
                                                                    @elseif ($laporan->status === 'selesai')
                                                                        <p class="text-success">Laporan telah selesai.</p>
                                                                    @elseif ($laporan->status === 'dibanned')
                                                                        <p class="text-dark"><i class="fa fa-ban me-1"></i> Pengguna telah dibanned secara permanen.</p>
                                                                    @elseif ($laporan->status === 'disuspend')
                                                                        <p style="color: #FFC300;"><i class="fa fa-exclamation-triangle me-1"></i> Pengguna sedang dalam masa suspend.</p>
                                                                    @elseif ($laporan->status === 'peringatan')
                                                                        <p style="color: #FF8800;"><i class="fa fa-exclamation-circle me-1"></i> Pengguna telah diberi peringatan.</p>
                                                                    @endif
                                                                @endif
                                                            </div>

                                                            <div>
                                                                @if ($laporan->status === 'proses')
                                                                    @foreach ([
                                                                        ['label' => 'Suspend User', 'class' => 'btn', 'style' => 'border-radius: 12px; background-color: transparent; border: 1.5px solid #FF8800; color: #FF8800; margin-top: 3px !important', 'target' => "modalSuspend{$laporan->id}"],
                                                                    ] as $action)
                                                                        <button type="button" class="btn" style="{{ $action['style'] }}" data-bs-toggle="modal" data-bs-target="#{{ $action['target'] }}">
                                                                            {{ $action['label'] }}
                                                                        </button>
                                                                    @endforeach

                                                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalTolak{{ $laporan->id }}" style="border-radius: 12px; background-color: transparent; border: 1.5px solid #FF0000; color: #FF0000; margin-left: 20px; margin-top: 3px !important;" onclick="confirmTolakLaporan({{ $laporan->id }})">
                                                                        Tolak Laporan
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Kirim Peringatan -->
                                <div class="modal fade" id="modalPeringatan{{ $laporan->id }}" data-bs-backdrop="false" tabindex="-1" aria-labelledby="modalPeringatanLabel{{ $laporan->id }}" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5) !important;">
                                    <div class="modal-dialog">
                                        <form action="{{ route('laporan.hukuman', $laporan->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="jenis_hukuman" value="peringatan">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalPeringatanLabel{{ $laporan->id }}">Kirim Peringatan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="showPreviousModal()" aria-label="Close">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="pesan{{ $laporan->id }}">Pesan Peringatan</label>
                                                        <textarea name="pesan" id="pesan{{ $laporan->id }}" class="form-control" rows="3" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-between border-0 mx-4">
                                                    <button type="submit" class="btn btn-primary" style="background-color: #528BFF; color: #FFFFFF; font-size: 14px; padding: 10px 30px;">Kirim</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="showPreviousModal()" style="background-color: ##BEB9B9; color: white; font-size: 14px; padding: 10px 30px;">Batal</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Modal Suspend -->
                                <div class="modal fade" id="modalSuspend{{ $laporan->id }}" data-bs-backdrop="false" tabindex="-1" aria-labelledby="modalSuspendLabel{{ $laporan->id }}" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5) !important;">
                                    <div class="modal-dialog">
                                        <form action="{{ route('laporan.hukuman', $laporan->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="jenis_hukuman" value="suspend">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalSuspendLabel{{ $laporan->id }}">Suspend User</h5>
                                                </div>

                                                <script>
                                                    function showPreviousModal() {
                                                        // Menutup modal saat ini
                                                        var modal = document.querySelector('#modalPeringatan{{ $laporan->id }}');
                                                        var modalBackdrop = document.querySelector('.modal-backdrop');
                                                        if (modalBackdrop) {
                                                            modalBackdrop.remove();  // Menghapus backdrop agar tidak menghalangi tampilan
                                                        }

                                                        // Menampilkan modal sebelumnya
                                                        var previousModal = document.querySelector('#laporanModal{{ $laporan->id }}');
                                                        if (previousModal) {
                                                            var modalBootstrap = new bootstrap.Modal(previousModal);
                                                            modalBootstrap.show();
                                                        }
                                                    }
                                                </script>

                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="durasi">Durasi Suspend (Hari)</label>
                                                        <input type="number" name="durasi" id="durasi" class="form-control" min="1" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pesan">Pesan Suspend</label>
                                                        <textarea name="pesan" id="pesan" class="form-control" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-between border-0 mx-4">
                                                    <button type="submit" class="btn btn-primary" style="background-color: #528BFF; color: #FFFFFF; font-size: 14px; padding: 10px 30px;">Suspend</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="showPreviousModal()" style="background-color: ##BEB9B9; color: white; font-size: 14px; padding: 10px 30px;">Batal</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Modal Banned -->
                                <div class="modal fade" id="modalBanned{{ $laporan->id }}" data-bs-backdrop="false" tabindex="-1" aria-labelledby="modalBannedLabel{{ $laporan->id }}" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5) !important;">
                                    <div class="modal-dialog">
                                        <form action="{{ route('laporan.hukuman', $laporan->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="jenis_hukuman" value="banned">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title w-100 text-center" id="modalBannedLabel{{ $laporan->id }}">Banned Pengguna</h5>
                                                </div>
                                                <div class="modal-body text-black text-center fs-5 mx-auto mt-0">
                                                    Apakah Anda yakin ingin Menghentikan Akses<br>Pengguna ini Secara Permanen?
                                                </div>
                                                <div class="modal-footer d-flex justify-content-between border-0 mx-4">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="showPreviousModal()" style="background-color: #000000; color: white; font-size: 14px; padding: 10px 30px;">Batal</button>
                                                    <button type="submit" class="btn btn-primary" style="background-color: #ffffff; color: rgb(0, 0, 0); font-size: 14px; padding: 10px 30px; border:#000000 solid 1px;">Ya</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Modal Tolak Laporan -->
                                <div class="modal fade" id="modalTolak{{ $laporan->id }}" data-bs-backdrop="false" tabindex="-1" aria-labelledby="modalTolakLabel{{ $laporan->id }}" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5) !important;">
                                    <div class="modal-dialog">
                                        <form action="{{ route('laporan.tolak', $laporan->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title w-100 text-center" id="modalTolakLabel{{ $laporan->id }}">Tolak Laporan</h5>
                                                </div>
                                                <div class="modal-body text-black text-center fs-5 mx-auto mt-0">
                                                    Apakah Anda yakin ingin menolak laporan ini?<br>
                                                    Tindakan ini tidak dapat dibatalkan dan laporan<br>
                                                    akan dianggap tidak valid.
                                                </div>
                                                <div class="modal-footer d-flex justify-content-between border-0 mx-4">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="showPreviousModal()" style="background-color: #000000; color: white; font-size: 14px; padding: 10px 30px;">Batal</button>
                                                    <button type="submit" class="btn btn-primary" style="background-color: #ffffff; color: rgb(0, 0, 0); font-size: 14px; padding: 10px 30px; border:#000000 solid 1px;">Ya</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada laporan tersedia.</td>
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
                {{ $laporans->links('pagination::bootstrap-4') }}
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

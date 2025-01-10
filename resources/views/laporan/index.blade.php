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
                    <li class="nav-item dropdown pe-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; flex-grow: 0; margin: 3.2px 12px 0 0; padding: 7px; border-radius: 15px; background-color: rgba(45, 156, 219, 0.15);">
                        <a href="javascript:;" class="nav-link text-body p-0 d-flex align-items-center justify-content-center" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
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
                                                <i class="fa fa-clock me-1"></i> 13 minutes ago
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
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
        
        <div class="container-fluid py-4" style="padding-left: 0; padding-right: 0;">
            <div class="row" style="padding-left: 0; padding-right: 0;">
                @forelse ($laporans as $laporan)
                    <div class="col-lg-2 col-md-3 col-sm-6 laporan-col laporan-header">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div>
                                    @if ($laporan->bukti)
                                        <img src="{{ asset('assets/img/laporan/' . $laporan->bukti) }}" alt="Bukti" class="img-fluid rounded">
                                    @else
                                        <span class="text-muted">Tidak ada bukti</span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center laporan-header" id="laporan-{{ $laporan->id }}">
                                <div class="laporan-text">
                                    <span class="text-xs text-dark">Laporan #{{ $laporan->id }}</span>
                                </div>
                                <span class="laporan-icon" data-bs-toggle="modal" data-bs-target="#laporanModal{{ $laporan->id }}" title="Show Detail">
                                    <i class="fa fa-eye fa-thin"></i>
                                </span>
                            </div>
                            <div class="badge-container mb-3 laporan-text" 
                                style="display: flex; justify-content: center; align-items: center; height: 100%; position: relative;">
                                <span class="badge 
                                            text-{{ $laporan->status === 'diterima' ? 'success' : ($laporan->status === 'proses' ? 'warning' : 'danger') }}">
                                    <!-- Ikon dan Status -->
                                    <i class="fa 
                                                {{ $laporan->status === 'diterima' ? 'fa-check-circle' : 
                                                    ($laporan->status === 'proses' ? 'fa-spinner' : 'fa-times-circle') }} 
                                                me-2"></i>
                                    {{ ucfirst($laporan->status) }}
                                </span>
                            </div>                                             
                        </div>
                    </div>
        
                    <!-- Modal Detail Laporan -->
                    <div class="modal fade" id="laporanModal{{ $laporan->id }}" tabindex="-1" aria-labelledby="laporanModalLabel{{ $laporan->id }}" aria-hidden="true">
                        <div class="modal-dialog custom-modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="laporanModalLabel{{ $laporan->id }}">Detail Laporan</h5>
                                    <button type="button" class="btn-close" onclick="goBackToLaporan()" aria-label="Close">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    
                                    <script>
                                        function goBackToLaporan() {
                                            // Redirect ke halaman laporan
                                            window.location.href = '{{ route("laporan.index") }}';  // Ganti dengan route yang sesuai
                                        }
                                    </script>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <!-- Bagian Detail -->
                                        <div class="col-6 mt-1 detail-laporan">
                                            <p class="text-dark text-bold">Pelapor :</p>
                                            <p>{{ $laporan->pelapor->name }}</p>
                                            <p class="text-dark text-bold">Terlapor :</p>
                                            <p>{{ $laporan->terlapor->name }}</p>
                                            <p class="text-dark text-bold">Alasan :</p>
                                            <p>{{ $laporan->alasan }}</p>
                                        </div>
                                        
                                        <div class="col-1 text-center border-divider">
                                            <div class="vertical-line"></div>
                                        </div>
                                        
                                        <!-- Bagian Bukti -->
                                        <div class="col-5 bukti-laporan">
                                            <p class="text-dark text-bold">Bukti :</p>
                                            @if ($laporan->bukti)
                                                <img src="{{ asset('assets/img/laporan/' . $laporan->bukti) }}" alt="Bukti Laporan" class="img-fluid rounded">
                                            @else
                                                <span class="text-muted">Tidak ada bukti</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    @if ($laporan->status === 'proses')
                                        @foreach ([
                                            ['label' => 'Kirim Peringatan', 'class' => 'btn-warning', 'target' => "modalPeringatan{$laporan->id}"],
                                            ['label' => 'Suspend User', 'class' => 'btn-danger', 'target' => "modalSuspend{$laporan->id}"],
                                            ['label' => 'Banned User', 'class' => 'btn-dark', 'target' => "modalBanned{$laporan->id}"]
                                        ] as $action)
                                            <button type="button" class="btn {{ $action['class'] }}" data-bs-toggle="modal" data-bs-target="#{{ $action['target'] }}">
                                                {{ $action['label'] }}
                                            </button>
                                        @endforeach
                                
                                        <!-- Tombol Tolak Laporan -->
                                        <form action="{{ route('laporan.tolak', $laporan->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menolak laporan ini?')">
                                                Tolak Laporan
                                            </button>
                                        </form>
                                
                                    @elseif ($laporan->status === 'diterima')
                                        <p class="text-success">Laporan telah diterima dan diproses.</p>
                                    @elseif ($laporan->status === 'ditolak')
                                        <p class="text-danger">Laporan telah ditolak.</p>
                                    @endif
                                </div>                                
                            </div>
                        </div>
                    </div>

                    <!-- Modal Kirim Peringatan -->
                    <div class="modal fade" id="modalPeringatan{{ $laporan->id }}" tabindex="-1" aria-labelledby="modalPeringatanLabel{{ $laporan->id }}" aria-hidden="true">
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
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning">Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>                    
                    
                    <!-- Modal Suspend -->
                    <div class="modal fade" id="modalSuspend{{ $laporan->id }}" tabindex="-1" aria-labelledby="modalSuspendLabel{{ $laporan->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('laporan.hukuman', $laporan->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="jenis_hukuman" value="suspend">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalSuspendLabel{{ $laporan->id }}">Suspend User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="showPreviousModal()" aria-label="Close">
                                            <i class="fa fa-times"></i>
                                        </button>

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
                                    </div>
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
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Suspend</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal Banned -->
                    <div class="modal fade" id="modalBanned{{ $laporan->id }}" tabindex="-1" aria-labelledby="modalBannedLabel{{ $laporan->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('laporan.hukuman', $laporan->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="jenis_hukuman" value="banned">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalBannedLabel{{ $laporan->id }}">Konfirmasi Banned</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="showPreviousModal()" aria-label="Close">
                                            <i class="fa fa-times"></i>
                                        </button>

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
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin membanned pengguna ini?</p>
                                        <p class="text-danger"><strong>Catatan:</strong> Pengguna ini tidak akan bisa login setelah dibanned.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-dark">Konfirmasi Banned</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12">
                        <div class="alert alert-info" style="background: linear-gradient(90deg, #0D6EFD, #1A75FF); color: white;">
                            Tidak ada laporan tersedia.
                        </div>
                    </div>
                @endforelse
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

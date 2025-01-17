@extends('layouts.app')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg mt-3 px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center w-100" id="navbar">
                    <div class="input-group d-flex"
                        style="width: 725px; height: 40px; box-shadow: 0 0 3px 0 rgba(0, 0, 0, 0.25); margin: 3.2px 37px 2px 0;">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Mencari apa?">
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

            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <label for="data-count" style="margin-right: 10px;">Show</label>
                    <select id="data-count" class="form-select"
                        style="background-color: #d1e0ff; width: auto; padding-right: 25px;">
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

                <div class="d-flex align-items-center">
                    <!-- Dropdown untuk Provinsi -->
                    <select id="provinces" class="form-select me-2"
                        style="background-color: #d1e0ff; width: auto; padding-right: 33px;">
                        <option value="">Provinsi</option>
                    </select>

                    <!-- Dropdown untuk Kabupaten -->
                    <select id="regencies" class="form-select me-2"
                        style="background-color: #d1e0ff; width: auto; padding-right: 33px;">
                        <option value="">Kabupaten</option>
                    </select>

                    <!-- Dropdown untuk Kecamatan -->
                    <select id="districts" class="form-select me-2"
                        style="background-color: #d1e0ff; width: auto; padding-right: 33px;">
                        <option value="">Kecamatan</option>
                    </select>

                    <!-- Dropdown untuk Desa -->
                    <select id="villages" class="form-select"
                        style="background-color: #d1e0ff; width: auto; padding-right: 33px;">
                        <option value="">Desa</option>
                    </select>
                </div>
                <script>
                    // Mengisi dropdown Provinsi saat halaman dimuat
                    document.addEventListener('DOMContentLoaded', function() {
                        // Mengisi dropdown Provinsi saat halaman dimuat
                        fetch('/locations/provinsi')
                            .then(response => {
                                if (!response.ok) throw new Error('Gagal memuat data provinsi');
                                return response.json();
                            })
                            .then(data => {
                                let provinsiSelect = document.getElementById('provinces');
                                provinsiSelect.innerHTML =
                                '<option value="">Pilih Provinsi</option>'; // Tambahkan opsi default
                                data.forEach(item => {
                                    provinsiSelect.innerHTML +=
                                    `<option value="${item.id}">${item.name}</option>`; // Gunakan `item.id` untuk value
                                });
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Gagal memuat data provinsi');
                            });
                    });

                    // Ketika dropdown Provinsi berubah
                    document.getElementById('provinces').addEventListener('change', function() {
                        let provinsiId = this.value;

                        if (!provinsiId) {
                            // Reset dropdown jika tidak ada provinsi yang dipilih
                            document.getElementById('regencies').innerHTML = '<option value="">Kabupaten</option>';
                            document.getElementById('districts').innerHTML = '<option value="">Kecamatan</option>';
                            document.getElementById('villages').innerHTML = '<option value="">Desa</option>';
                            return;
                        }

                        fetch(
                            `/locations/kabupaten?provinsi_id=${provinsiId}`) // Gunakan `provinsi_id` sesuai dengan controller
                            .then(response => {
                                if (!response.ok) throw new Error('Gagal memuat data kabupaten');
                                return response.json();
                            })
                            .then(data => {
                                let kabupatenSelect = document.getElementById('regencies');
                                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                                data.forEach(item => {
                                    kabupatenSelect.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                                });
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Gagal memuat data kabupaten');
                            });

                        // Reset dropdown berikutnya
                        document.getElementById('districts').innerHTML = '<option value="">Kecamatan</option>';
                        document.getElementById('villages').innerHTML = '<option value="">Desa</option>';
                    });

                    // Ketika dropdown Kabupaten berubah
                    document.getElementById('regencies').addEventListener('change', function() {
                        let kabupatenId = this.value;

                        if (!kabupatenId) {
                            // Reset dropdown jika tidak ada kabupaten yang dipilih
                            document.getElementById('districts').innerHTML = '<option value="">Kecamatan</option>';
                            document.getElementById('villages').innerHTML = '<option value="">Desa</option>';
                            return;
                        }

                        fetch(
                            `/locations/kecamatan?kabupaten_id=${kabupatenId}`) // Gunakan `kabupaten_id` sesuai dengan controller
                            .then(response => {
                                if (!response.ok) throw new Error('Gagal memuat data kecamatan');
                                return response.json();
                            })
                            .then(data => {
                                let kecamatanSelect = document.getElementById('districts');
                                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                                data.forEach(item => {
                                    kecamatanSelect.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                                });
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Gagal memuat data kecamatan');
                            });

                        // Reset dropdown berikutnya
                        document.getElementById('villages').innerHTML = '<option value="">Desa</option>';
                    });

                    // Ketika dropdown Kecamatan berubah
                    document.getElementById('districts').addEventListener('change', function() {
                        let kecamatanId = this.value;

                        if (!kecamatanId) {
                            // Reset dropdown jika tidak ada kecamatan yang dipilih
                            document.getElementById('villages').innerHTML = '<option value="">Desa</option>';
                            return;
                        }

                        fetch(`/locations/desa?kecamatan_id=${kecamatanId}`) // Gunakan `kecamatan_id` sesuai dengan controller
                            .then(response => {
                                if (!response.ok) throw new Error('Gagal memuat data desa');
                                return response.json();
                            })
                            .then(data => {
                                let desaSelect = document.getElementById('villages');
                                desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
                                data.forEach(item => {
                                    desaSelect.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                                });
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Gagal memuat data desa');
                            });
                    });
                </script>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <table class="table table-hover rounded-table text-center"
                        style="font-size: 15px; width: 100%; background-color: white;">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Umur</th>
                                <th>Gender</th>
                                <th>Lokasi</th>
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
                                    <td>#</td>
                                    <td>
                                        <span class="badge align-items-center justify-content-center
                                            {{ $user->status === 'banned' ? 'status-banned' : 'status-active' }}">
                                            @if ($user->status === 'banned')
                                                <i class="fa fa-ban me-1 mt-2"></i> Banned
                                            @else
                                                <i class="fa fa-check-square me-1 mt-2"></i> Aktif
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        @if ($user->status !== 'banned')
                                            <!-- Block Form -->
                                            <form action="{{ route('admin.users.block', $user->id) }}" method="POST"
                                                class="d-inline" id="block-form-{{ $user->id }}">
                                                @csrf
                                                <button type="button" class="btn btn-block-user btn-sm"
                                                    onclick="confirmAction('block', '{{ $user->id }}')"
                                                    style="margin-top: 10px !important;">
                                                    <i class="fa fa-ban" style="font-size: 18px;"></i>
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Delete Form -->
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="d-inline" id="delete-form-{{ $user->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-delete-user btn-sm"
                                                onclick="confirmAction('delete', '{{ $user->id }}')"
                                                style="margin-top: 10px !important;">
                                                <i class="fa fa-trash" style="font-size: 18px;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data pengguna.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            function confirmAction(action, userId) {
                let messages = {
                    block: {
                        title: 'Apakah Anda yakin?',
                        text: 'Pengguna ini akan diblokir.',
                        confirmText: 'Ya, blokir!'
                    },
                    delete: {
                        title: 'Apakah Anda yakin?',
                        text: 'Pengguna ini akan dihapus.',
                        confirmText: 'Ya, hapus!'
                    }
                };

                let message = messages[action];

                Swal.fire({
                    title: message.title,
                    text: message.text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: message.confirmText,
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`${action}-form-${userId}`).submit();
                    }
                });
            }
        </script>


        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-lg">
                    {{ $users->links('pagination::bootstrap-4') }}
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

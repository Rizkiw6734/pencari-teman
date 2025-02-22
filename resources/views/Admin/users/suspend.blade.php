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
                                <h4 class="mb-0">Suspend Pengguna</h4>
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
                    <div class="input-group " style="width: 300px;">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" id="search" class="form-control" placeholder="Mencari apa?">
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
                        style="background-color: transparent; width: 100px; padding-right: 33px; border: 1px solid #C9C1FF;">
                        <option value="">Provinsi</option>
                    </select>

                    <!-- Dropdown untuk Kabupaten -->
                    <select id="regencies" class="form-select"
                        style="background-color: transparent; width: 120px; padding-right: 33px; border: 1px solid #C9C1FF;">
                        <option value="">Kabupaten</option>
                    </select>

                    <script>
                        $(document).ready(function () {
                            $('#provinces, #regencies').on('change', function () {
                                let selectedText = $(this).find("option:selected").text();
                                $(this).attr('title', selectedText);
                            });
                        });
                    </script>
                </div>
            </div>
        </div>


        <div class="container-fluid py-4">
            <div class="row">
                <div id="search-results" class="col-12">
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
                        <tbody id="user-table2">
                            @forelse($suspendUsers as $user)
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge d-inline-flex align-items-center justify-content-center px-3 py-2
                                            {{ $user->status === 'suspend' ? 'status-suspend' : 'status-active' }}">
                                            @if ($user->status === 'suspend')
                                                <i class="fa fa-exclamation-triangle me-1"></i> Suspend
                                            @else
                                                <i class="fa fa-check me-1"></i> Aktif
                                            @endif
                                        </span>
                                    </td>
                                    <td style="max-width: 200px; word-wrap: break-word; white-space: normal;">
                                        {!! collect([
                                            $user->provinsis ? 'Provinsi ' . $user->provinsis->name : null,
                                            $user->kabupatens ? 'Kabupaten ' . $user->kabupatens->name : null,
                                            $user->kecamatans ? 'Kecamatan ' . $user->kecamatans->name : null,
                                            $user->desas ? 'Desa ' . $user->desas->name : null,
                                        ])->filter()->isEmpty() ? '-' : collect([
                                            $user->provinsis ? 'Provinsi ' . $user->provinsis->name : null,
                                            $user->kabupatens ? 'Kabupaten ' . $user->kabupatens->name : null,
                                            $user->kecamatans ? 'Kecamatan ' . $user->kecamatans->name : null,
                                            $user->desas ? 'Desa ' . $user->desas->name : null,
                                        ])->filter()->implode(',<br>') !!}
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.users.enable', $user->id) }}" method="POST"
                                            class="d-inline" id="enable-form-{{ $user->id }}">
                                            @csrf
                                            <button type="button" class="btn btn-sm text-white"
                                                style="background-color: #5D87FF; margin-top: 12px !important;"
                                                onclick="confirmEnable('{{ $user->id }}')">
                                                Buka Suspend
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada pengguna yang disuspend.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('search').addEventListener('input', function() {
                let query = this.value.toLowerCase();
                let rows = document.querySelectorAll('#user-table2 tr');

                rows.forEach(row => {
                    let name = row.children[1].textContent.toLowerCase();
                    let email = row.children[2].textContent.toLowerCase();
                    row.style.display = (name.includes(query) || email.includes(query)) ? '' : 'none';
                });
            });
        </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
// Fetch daftar provinsi saat halaman dimuat
fetch('/provinces')
 .then(response => response.json())
 .then(data => {
     let provinceSelect = document.getElementById('provinces');
     data.forEach(province => {
         let option = document.createElement('option');
         option.value = province.id;
         option.textContent = province.name;
         provinceSelect.appendChild(option);
     });
 })
 .catch(error => console.error('Error fetching provinces:', error));

// Event listener untuk perubahan provinsi
document.getElementById('provinces').addEventListener('change', function () {
 let provinceId = this.value;
 let regencySelect = document.getElementById('regencies');

 // Jika kembali ke pilihan awal, reload halaman
 if (!provinceId) {
     location.reload();
     return;
 }

 // Reset dropdown kabupaten
 regencySelect.innerHTML = '<option value="">Pilih Kabupaten</option>';

 // Fetch daftar kabupaten berdasarkan provinsi
 fetch(`/regencies/${provinceId}`)
     .then(response => response.json())
     .then(data => {
         data.forEach(regency => {
             let option = document.createElement('option');
             option.value = regency.id;
             option.textContent = regency.name;
             regencySelect.appendChild(option);
         });
     })
     .catch(error => console.error('Error fetching regencies:', error));
});

// Event listener untuk perubahan kabupaten
document.getElementById('regencies').addEventListener('change', function () {
 let regencyId = this.value;
 let userTableBody = document.getElementById('user-table2');
 userTableBody.innerHTML = ''; // Kosongkan tabel sebelum diisi ulang

 if (regencyId) {
     fetch(`/suspend/${regencyId}`)
         .then(response => response.json())
         .then(data => {
             if (Array.isArray(data) && data.length > 0) {
                 data.forEach((user, index) => {
                     let lokasi = [
                         user.provinsis ? `Provinsi ${user.provinsis.name}` : null,
                         user.kabupatens ? `Kabupaten ${user.kabupatens.name}` : null,
                         user.kecamatans ? `Kecamatan ${user.kecamatans.name}` : null,
                         user.desas ? `Desa ${user.desas.name}` : null
                     ].filter(Boolean).join(',<br>') || '-';

                     let statusBadge = `
                         <span class="badge ${user.status === 'suspend' ? 'status-suspend' : 'status-active'}">
                             ${user.status === 'suspend'
                                 ? '<i class="fa fa-ban me-1"></i> Suspend'
                                 : '<i class="fa fa-check-square me-1"></i> Aktif'}
                         </span>`;

                     let actionButtons = user.status === 'suspend' ? `
                         <form action="/users/${user.id}/enable" method="POST" class="d-inline" id="enable-form-${user.id}">
                             <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                             <button type="button" class="btn btn-sm text-white"
                                 style="background-color: #5D87FF; margin-top: 10px !important;"
                                 onclick="confirmEnable('${user.id}')">
                                 Buka Suspend
                             </button>
                         </form>
                     ` : '';

                     let row = `
                         <tr class="align-middle">
                             <td>${index + 1}</td>
                             <td>${user.name || '-'}</td>
                             <td>${user.email || '-'}</td>
                             <td>${statusBadge}</td>
                             <td style="max-width: 200px; word-wrap: break-word; white-space: normal;">
                                 ${lokasi}
                             </td>
                             <td>${actionButtons}</td>
                         </tr>`;

                     userTableBody.insertAdjacentHTML('beforeend', row);
                 });
             } else {
                 userTableBody.innerHTML = '<tr><td colspan="6" class="text-center">Tidak ada pengguna yang disuspend.</td></tr>';
             }
         })
         .catch(error => console.error('Error fetching users:', error));
 }
});
});

   </script>

        <script>
            function confirmEnable(userId) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Pengguna ini akan dibuka suspend-nya.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, buka suspend!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('enable-form-' + userId).submit();
                    }
                });
            }
        </script>

<div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-lg">
            {{ $suspendUsers->links('pagination::bootstrap-4') }}
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

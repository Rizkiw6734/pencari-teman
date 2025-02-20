<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/logo.jpg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="/assets/img/logo.jpg">
    <title>Around You</title>
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="/assets/css/soft-ui-dashboard.css" rel="stylesheet" />
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </head>

  <style>
    select {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 250px;
    }

    .custom-modal-sm {
        max-width: 600px; /* Ubah ukuran modal sesuai kebutuhan */
    }

    .detail-laporan {
        font-size: 1rem;
        padding-right: 10px;
    }

    .bukti-laporan img {
        max-width: 100%;
        max-height: 200px; /* Batasi tinggi gambar agar tidak terlalu besar */
    }

    .border-divider {
        position: relative;
        padding: 0;
        margin: 0;
    }

    .vertical-line {
        height: 100%;
        width: 1px;
        background-color: #ccc;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .modal-header .btn-close i {
        font-size: 1.2rem; /* Ukuran ikon */
        color: #6c757d; /* Warna ikon */
    }

    .modal-header .btn-close:hover i {
        color: #dc3545; /* Warna ikon saat hover */
    }

    .rounded-table {
        border-collapse: separate; /* Pisahkan border antar sel */
        border-spacing: 0; /* Hapus jarak antar border */
        border-radius: 10px; /* Atur sudut melengkung */
        overflow: hidden; /* Agar isi tabel tetap di dalam area sudut */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Tambahkan sedikit bayangan */
    }

    .rounded-table thead {
        border-radius: 10px 10px 0 0; /* Sudut atas melengkung */
        background-color: #f8f9fa; /* Warna terang untuk header */
        border-bottom: 2px solid #dee2e6; /* Border bawah header */
    }

    .rounded-table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 10px; /* Sudut kiri bawah */
    }

    .rounded-table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 10px; /* Sudut kanan bawah */
    }

    .status-active {
        background-color: #F0FFF3; /* Warna hijau muda */
        color: #00FF37; /* Hijau teks */
        padding: 0;
        width: 100px; /* Lebar tombol */
        height: 30px; /* Tinggi tombol */
    }

    .status-suspend {
        background-color: #FFF0DE; /* Warna orange muda */
        color: #fd7e14; /* Orange teks */
        padding: 0;
        width: 100px; /* Lebar tombol */
        height: 30px; /* Tinggi tombol */
    }

    .status-banned {
        background-color: #FFF0F0; /* Warna merah muda */
        color: #FF0000; /* Merah teks */
        padding: 0;
        width: 100px; /* Lebar tombol */
        height: 30px; /* Tinggi tombol */
    }

    .status-active i,
    .status-suspend i,
    .status-banned i {
        font-size: 14px; /* Ukuran ikon */
    }

    .btn-block-user {
        background-color: #FFF0F0; /* Warna merah muda */
        color: #dc3545; /* Merah teks */
        border: 1px solid #dc3545; /* Border merah */
        padding: 0;
        width: 40px; /* Lebar tombol */
        height: 30px; /* Tinggi tombol */
    }

    .btn-block-user:hover {
        background-color: #dc3545; /* Warna merah saat hover */
        color: #fff; /* Teks putih saat hover */
    }

    .btn-tlk {
        background-color: #FFDEDE; /* Warna merah muda */
        color: #dc3545; /* Merah teks */
        border: 1px solid #dc3545; /* Border merah */
        padding: 0;
        width: 40px; /* Lebar tombol */
        height: 30px; /* Tinggi tombol */
    }

    .btn-tlk:hover {
        background-color: #dc3545; /* Warna merah saat hover */
        color: #fff; /* Teks putih saat hover */
    }

    .btn-trm {
        background-color: #F0FFF3; /* Hijau merah muda */
        color: #00FF37; /* Hijau teks */
        border: 1px solid #00FF37; /* Border hijau */
        padding: 0;
        width: 40px; /* Lebar tombol */
        height: 30px; /* Tinggi tombol */
    }

    .btn-trm:hover {
        background-color: #00FF37; /* Warna hijau saat hover */
        color: #fff; /* Teks putih saat hover */
    }

    .btn-delete-user {
        background-color: #FFF0DE; /* Warna oranye muda */
        color: #fd7e14; /* Oranye teks */
        border: 1px solid #fd7e14; /* Border oranye */
        padding: 0; /* Tombol lebih kecil */
        width: 40px; /* Lebar tombol */
        height: 30px; /* Tinggi tombol */
    }

    .btn-delete-user:hover {
        background-color: #fd7e14; /* Warna oranye saat hover */
        color: #fff; /* Teks putih saat hover */
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        align-items: center;
    }

    .status-proses {
        background-color: #E9E9E9 !important;
        color: #5D5D5D !important;
        padding: 0;
        width: 100px;
        height: 30px;
    }
    .status-ditolak {
        background-color: #FFF0F0 !important;
        color: #FF0000 !important;
        padding: 0;
        width: 100px;
        height: 30px;
    }
    .status-diterima {
        background-color: #F0FFF3 !important;
        color: #00FF37 !important;
        padding: 0;
        width: 100px;
        height: 30px;
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

  <body class="g-sidenav-show  bg-gray-100">
    @include('partials.admin-sidebar')

    @yield('content')

    <div class="fixed-plugin">
      <div class="card shadow-lg ">
        <div class="card-header pb-0 pt-3 ">
          <div class="float-start">
            <h5 class="mt-3 mb-0">Around You Konfigurasi</h5>
            <p>Pilih opsi dashboard.</p>
          </div>
          <div class="float-end mt-4">
            <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
              <i class="fa fa-close"></i>
            </button>
          </div>
          <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0">
          <!-- Sidebar Backgrounds -->
          <div>
            <h6 class="mb-0">Warna Sidebar</h6>
          </div>
          <a href="javascript:void(0)" class="switch-trigger background-color">
            <div class="badge-colors my-2 text-start">
              <span class="badge filter bg-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
              <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
              <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
              <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
              <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
              <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
            </div>
          </a>
          <!-- Sidenav Type -->
          <div class="mt-3">
            <h6 class="mb-0">Jenis Sidebar</h6>
            <p class="text-sm">Pilih di antara 2 jenis sidebar yang berbeda.</p>
          </div>
          <div class="d-flex">
            <button class="btn btn-primary w-100 px-3 mb-2" style="background: #0D6EFD;" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
            <button class="btn btn-primary w-100 px-3 mb-2 ms-2" style="background: #0D6EFD;" data-class="bg-white" onclick="sidebarType(this)">White</button>
          </div>
          <!-- Navbar Fixed -->
          {{-- <div class="mt-3">
            <h6 class="mb-0">Navbar Tetap</h6>
          </div>
          <div class="form-check form-switch ps-0">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div> --}}
        </div>
      </div>
    </div>

    <!-- JavaScript -->
    <script>
        // document.addEventListener("DOMContentLoaded", function () {
        //     const isNavbarFixed = localStorage.getItem("navbarFixed") === "true";
        //     applyNavbarFixed(isNavbarFixed);
        //     document.getElementById("navbarFixed").checked = isNavbarFixed;
        // });

        // function applyNavbarFixed(isFixed) {
        //     const navbar = document.querySelector("nav");
        //     if (!navbar) return;

        //     if (isFixed) {
        //         navbar.classList.add("fixed-top");
        //     } else {
        //         navbar.classList.remove("fixed-top");
        //     }
        // }

        // function navbarFixed(checkbox) {
        //     const isFixed = checkbox.checked;
        //     applyNavbarFixed(isFixed);
        //     localStorage.setItem("navbarFixed", isFixed);
        // }

        // Fungsi untuk menerapkan warna sidebar
        function applySidebarColor(color) {
            const sidebar = document.querySelector(".sidebar");
            if (!sidebar) return;

            document.querySelectorAll(".badge.filter").forEach(function(el) {
                el.classList.remove("active");
            });
            const selectedColor = document.querySelector([data-color="${color}"]);
            if (selectedColor) selectedColor.classList.add("active");
            sidebar.setAttribute("data-color", color);
        }

        // Fungsi untuk menerapkan jenis sidebar
        function applySidebarType(sidebarClass) {
            const sidebar = document.querySelector(".sidebar");
            if (!sidebar) return;

            sidebar.classList.remove("bg-transparent", "bg-white");
            sidebar.classList.add(sidebarClass);
        }
    </script>

    <!--   Core JS Files   -->
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/chartjs.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/assets/js/soft-ui-dashboard.min.js"></script>
    @include('sweetalert::alert')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">

            // SweetAlert Notifikasi untuk session 'success'
            @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '{{ session('success') }}',
            });
            @endif

            @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ $errors->first() }}', // Menampilkan pesan error pertama
            });
            @endif

            @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
            @endif

            $('form[id^="deleteForm"]').submit(function (e) {
                e.preventDefault(); // Mencegah form submit langsung

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Mengirimkan form jika yakin
                        }
                    });
                });
        </script>
    </body>
</html>

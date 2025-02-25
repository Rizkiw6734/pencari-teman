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
                            type: "POST", // Gunakan metode PUT untuk update
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json"
                            },
                            success: function (response) {
                                if (response.success) {
                                    // Tandai semua notifikasi terkait sebagai "read"
                                    $(".notif-item").removeClass("unread").addClass("read");

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
      <!-- Kolom Kiri -->
      <div class="col-lg-8 col-12">
        <!-- Card Utama -->
        <div class="card mb-4" style="background: #d1e0ff; border: none;">
          <div class="card-header" style="background: inherit; border: none; padding: 0;"></div>
          <div class="card-body d-flex align-items-center">
            <!-- Bagian teks di sebelah kiri -->
            <div style="flex: 1;">
              <h4 class="mb-0">Hallo, {{ Auth::user()->name }}</h4>
              <p class="mb-0" style="font-size: 18px;">Selamat datang kembali di pusat kendali aplikasi. Ayo mulai bekerja!</p>
            </div>
            <!-- Bagian gambar di sebelah kanan -->
            <div style="flex-shrink: 0;">
              <img src="images/header.svg" alt="Welcome Image" style="max-width: 150px; border-radius: 10px;">
            </div>
          </div>
        </div>

        <div class="row gx-3">
            <!-- Card Total Pengguna -->
            <div class="col-lg-4 col-md-6 col-12 mb-4">
              <div class="card" style="width: 100%; height: 286px;">
                  <span class="mask bg-white opacity-10 border-radius-lg"></span>
                  <div class="card-body p-3 position-relative">
                      <div style="position: relative; height: 120px;">
                          <canvas id="totalUsersChart" data-total="{{ $totalUsers }}" data-sisa="{{ 50 - $totalUsers }}" style="display: block; margin: 0 auto;"></canvas>
                          <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                              <div style="width: 40px; height: 40px; background-color: #e9ecf3; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                  <i class="fa fa-users" style="color: #3243FD; font-size: 16px;"></i>
                              </div>
                          </div>
                      </div>
                      <div class="row mt-3">
                          <div class="col-8 text-start">
                              <h5 class="text-dark font-weight-bolder mb-0 mt-3">{{ $totalUsers }}</h5>
                              <span class="text-dark text-sm">Total Pengguna</span>
                          </div>
                      </div>
                  </div>
              </div>
            </div>

            <!-- Card Total Laporan -->
            <div class="col-lg-4 col-md-6 col-12 mb-4">
              <div class="card" style="width: 100%; height: 286px;">
                  <span class="mask bg-white opacity-10 border-radius-lg"></span>
                  <div class="card-body p-3 position-relative">
                      <div style="position: relative; height: 120px;">
                          <canvas id="totalReportsChart" data-total="{{ $totalReports }}" data-sisa="{{ 50 - $totalReports }}" style="display: block; margin: 0 auto;"></canvas>
                          <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                              <div style="width: 40px; height: 40px; background-color: #e9ecf3; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                  <i class="fa fa-file-alt" style="color: #FF6600; font-size: 16px;"></i>
                              </div>
                          </div>
                      </div>
                      <div class="row mt-3">
                          <div class="col-8 text-start">
                              <h5 class="text-dark font-weight-bolder mb-0 mt-3">{{ $totalReports }}</h5>
                              <span class="text-dark text-sm">Total Laporan</span>
                          </div>
                      </div>
                  </div>
              </div>
            </div>

            <!-- Card Total Pinalti -->
            <div class="col-lg-4 col-md-6 col-12 mb-4">
              <div class="card" style="width: 100%; height: 286px;">
                  <span class="mask bg-white opacity-10 border-radius-lg"></span>
                  <div class="card-body p-3 position-relative">
                      <div style="position: relative; height: 120px;">
                          <canvas id="totalPenaltiesChart" data-total="{{ $totalPenalties }}" data-sisa="{{ 50 - $totalPenalties }}" style="display: block; margin: 0 auto;"></canvas>
                          <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                              <div style="width: 40px; height: 40px; background-color: #e9ecf3; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                  <i class="fa fa-exclamation-triangle" style="color: #DC3545; font-size: 16px;"></i>
                              </div>
                          </div>
                      </div>
                      <div class="row mt-3">
                          <div class="col-8 text-start">
                              <h5 class="text-dark font-weight-bolder mb-0 mt-3">{{ $totalPenalties }}</h5>
                              <span class="text-dark text-sm">Total Pinalti</span>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
      </div>

      <!-- Kolom Kanan -->
      <div class="col-lg-4 col-12">
        <div class="card shadow h-100 float-end" style="width: 100%;">
          <div class="card-header pb-0 p-3">
            <h6 class="mb-0">Reviews User</h6>
          </div>
          <div class="card-body">
            <!-- Bagian untuk ulasan positif -->
            <div class="d-flex align-items-center pb-3" style="background-color: #E9F7FF; border-radius: 10px; padding: 10px;">
              <div class="me-3" style="flex: 1;">
                <h6 class="mb-0" style="font-size: 12px">Anda telah menerima
                  <span class="mb-0" style=" font-size: 16px; font-weight: bold; color: #3243fd;">80%</span>
                  ulasan positif dari pengguna!
                </h6>
              </div>
              <div style="width: 40%; max-width: 100px; position: relative;">
                <canvas id="reviewsChart" width="100" height="100"></canvas>
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                  <div style="width: 30px; height: 30px; background-color: #e9ecf3; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa fa-user" style="color: #2b43ff; font-size: 15px;"></i>
                  </div>
                </div>
              </div>
            </div>
            <!-- Bagian untuk ulasan netral -->
            <div class="d-flex align-items-center pb-3 mt-3" style="background-color: #FFF7E5; border-radius: 10px; padding: 10px;">
              <div class="me-3" style="flex: 1;">
                <h6 class="mb-0" style="font-size: 12px">Anda telah menerima
                  <span class="mb-0" style=" font-size: 16px; font-weight: bold; color: #FFC107;">17%</span>
                  ulasan netral dari pengguna!
                </h6>
              </div>
              <div style="width: 40%; max-width: 100px; position: relative;">
                <canvas id="neutralChart" width="100" height="100"></canvas>
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                  <div style="width: 30px; height: 30px; background-color: #e9ecf3; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa fa-user" style="color: #FFC107; font-size: 15px;"></i>
                  </div>
                </div>
              </div>
            </div>
            <!-- Bagian untuk ulasan negatif -->
            <div class="d-flex align-items-center mt-3" style="background-color: #FFE9E9; border-radius: 10px; padding: 10px;">
              <div class="me-3" style="flex: 1;">
                <h6 class="mb-0" style="font-size: 12px">Anda telah menerima
                  <span class="mb-0" style=" font-size: 16px; font-weight: bold; color: #DC3545;">3%</span>
                  ulasan negatif dari pengguna!
                </h6>
              </div>
              <div style="width: 40%; max-width: 100px; position: relative;">
                <canvas id="negativeChart" width="100" height="100"></canvas>
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                  <div style="width: 30px; height: 30px; background-color: #e9ecf3; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa fa-user" style="color: #DC3545; font-size: 15px;"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid py-4">
    <div class="card z-index-2">
      <div class="card-header pb-0">
        <h6>Data Pengguna Tahun 2024</h6>
      </div>
      <div class="card-body p-3" style="padding: 1rem;">
        <div class="chart">
          <canvas id="chart-line" class="chart-canvas" style="height: 300px; width: 100%;"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Tambahkan CDN Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Chart for Total Pengguna
      const totalUsersCanvas = document.getElementById('totalUsersChart');
      const totalUsers = totalUsersCanvas.getAttribute('data-total');
      const totalUsersSisa = totalUsersCanvas.getAttribute('data-sisa');
      new Chart(totalUsersCanvas.getContext('2d'), {
        type: 'doughnut',
        data: {
          labels: ['Total Pengguna', 'Sisa'],
          datasets: [{
            data: [totalUsers, totalUsersSisa],
            backgroundColor: ['#3243FD', '#e9ecf3'],
            borderWidth: 0
          }]
        },
        options: {
          responsive: true,
          cutout: '70%',
          plugins: {
            legend: { display: false }
          }
        }
      });

      // Chart for Total Laporan
      const totalReportsCanvas = document.getElementById('totalReportsChart');
      const totalReports = totalReportsCanvas.getAttribute('data-total');
      const totalReportsSisa = totalReportsCanvas.getAttribute('data-sisa');
      new Chart(totalReportsCanvas.getContext('2d'), {
        type: 'doughnut',
        data: {
          labels: ['Total Laporan', 'Sisa'],
          datasets: [{
            data: [totalReports, totalReportsSisa],
            backgroundColor: ['#FF6600', '#e9ecf3'],
            borderWidth: 0
          }]
        },
        options: {
          responsive: true,
          cutout: '70%',
          plugins: {
            legend: { display: false }
          }
        }
      });

      // Chart for Total Pinalti
      const totalPenaltiesCanvas = document.getElementById('totalPenaltiesChart');
      const totalPenalties = totalPenaltiesCanvas.getAttribute('data-total');
      const totalPenaltiesSisa = totalPenaltiesCanvas.getAttribute('data-sisa');
      new Chart(totalPenaltiesCanvas.getContext('2d'), {
        type: 'doughnut',
        data: {
          labels: ['Total Pinalti', 'Sisa'],
          datasets: [{
            data: [totalPenalties, totalPenaltiesSisa],
            backgroundColor: ['#DC3545', '#e9ecf3'],
            borderWidth: 0
          }]
        },
        options: {
          responsive: true,
          cutout: '70%',
          plugins: {
            legend: { display: false }
          }
        }
      });

      // Reviews Pengguna
      const reviewsCtx = document.getElementById('reviewsChart').getContext('2d');
      new Chart(reviewsCtx, {
        type: 'doughnut',
        data: {
          labels: ['Positive'],
          datasets: [{
            label: 'Reviews',
            data: [80, 20],
            backgroundColor: ['#0D6EFD', '#E9ECEF'],
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false }
          },
          cutout: '70%'
        }
      });

      // Chart for Neutral Reviews
      const neutralCtx = document.getElementById('neutralChart').getContext('2d');
      new Chart(neutralCtx, {
        type: 'doughnut',
        data: {
          labels: ['Neutral'],
          datasets: [{
            label: 'Reviews',
            data: [17, 83],
            backgroundColor: ['#FFC107', '#E9ECEF'],
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false }
          },
          cutout: '70%'
        }
      });

      // Chart for Negative Reviews
      const negativeCtx = document.getElementById('negativeChart').getContext('2d');
      new Chart(negativeCtx, {
        type: 'doughnut',
        data: {
          labels: ['Negative'],
          datasets: [{
            label: 'Reviews',
            data: [3, 97],
            backgroundColor: ['#DC3545', '#E9ECEF'],
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false }
          },
          cutout: '70%'
        }
      });

      // Data Pengguna Tahun 2024
      const penggunaCtx = document.getElementById('chart-line').getContext('2d');
      const data2024 = {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        datasets: [
          {
            label: 'Pengguna Laki-laki',
            data: [70, 40, 42, 90, 31, 51, 43, 31, 85, 55, 82, 95],
            borderColor: '#8979FF',
            backgroundColor: 'rgba(137, 121, 255, 0.2)',
            tension: 0.5,
            fill: true
          },
          {
            label: 'Pengguna Perempuan',
            data: [35, 70, 85, 75, 50, 73, 16, 43, 22, 16, 30, 19],
            borderColor: '#FF928A',
            backgroundColor: 'rgba(255, 146, 138, 0.2)',
            tension: 0.5,
            fill: true
          }
        ]
      };

      const config = {
        type: 'line',
        data: data2024,
        options: {
          responsive: true,
          plugins: {
            legend: { position: 'bottom' },
            tooltip: {
              callbacks: {
                label: (context) => `${context.dataset.label}: ${context.parsed.y} pengguna`
              }
            }
          },
          scales: {
            x: {
              title: { display: true, text: 'Bulan' }
            },
            y: {
              title: { display: true, text: 'Jumlah Pengguna' },
              beginAtZero: true,
              ticks: {
                stepSize: 20,
                min: 0,
                max: 100
              }
            }
          }
        }
      };

      new Chart(penggunaCtx, config);
    });
  </script>

  <footer class="footer pt-3  ">
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

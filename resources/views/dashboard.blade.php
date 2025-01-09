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
          <li class="nav-item dropdown pe-2 d-flex align-items-center justify-content-center"
              style="width: 45px; height: 45px; flex-grow: 0; margin: 3.2px 12px 0 0; padding: 7px; border-radius: 15px; background-color: rgba(45, 156, 219, 0.15);">
            <a href="javascript:;" class="nav-link text-body p-0 d-flex align-items-center justify-content-center"
              id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
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
                            <canvas id="totalUsersChart" data-total="{{ $totalUsers }}" data-sisa="{{ 50 - $totalUsers }}"></canvas>
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
                            <canvas id="totalReportsChart" data-total="{{ $totalReports }}" data-sisa="{{ 50 - $totalReports }}"></canvas>
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
                            <canvas id="totalPenaltiesChart" data-total="{{ $totalPenalties }}" data-sisa="{{ 50 - $totalPenalties }}"></canvas>
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

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Chart for Total Pengguna
                var totalUsersCanvas = document.getElementById('totalUsersChart');
                var totalUsers = totalUsersCanvas.getAttribute('data-total');
                var totalUsersSisa = totalUsersCanvas.getAttribute('data-sisa');
                var totalUsersChart = new Chart(totalUsersCanvas.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Total Pengguna', 'Sisa'],
                        datasets: [{
                            data: [totalUsers, totalUsersSisa],
                            backgroundColor: ['#3243fd', '#e9ecf3'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        cutoutPercentage: 80
                    }
                });

                // Chart for Total Laporan
                var totalReportsCanvas = document.getElementById('totalReportsChart');
                var totalReports = totalReportsCanvas.getAttribute('data-total');
                var totalReportsSisa = totalReportsCanvas.getAttribute('data-sisa');
                var totalReportsChart = new Chart(totalReportsCanvas.getContext('2d'), {
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
                        cutoutPercentage: 80
                    }
                });

                // Chart for Total Pinalti
                var totalPenaltiesCanvas = document.getElementById('totalPenaltiesChart');
                var totalPenalties = totalPenaltiesCanvas.getAttribute('data-total');
                var totalPenaltiesSisa = totalPenaltiesCanvas.getAttribute('data-sisa');
                var totalPenaltiesChart = new Chart(totalPenaltiesCanvas.getContext('2d'), {
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
                        cutoutPercentage: 80
                    }
                });
            });
        </script>
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


    <!-- Tambahkan CDN Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      const ctx = document.getElementById('reviewsChart').getContext('2d');
      const reviewsChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['Positive'],
          datasets: [{
            label: 'Reviews',
            data: [80, 20], // 80% positif dan 20% sisa
            backgroundColor: ['#0D6EFD', '#E9ECEF'], // Warna biru untuk positif dan abu-abu untuk sisa
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
            plugins: {              legend: {
              display: false // Sembunyikan legenda
            }
          },
          cutout: '70%' // Potongan tengah lebih besar
        }
      });

      const ctxNeutral = document.getElementById('neutralChart').getContext('2d');
      const neutralChart = new Chart(ctxNeutral, {
        type: 'doughnut',
        data: {
          labels: ['Neutral'],
          datasets: [{
            label: 'Reviews',
            data: [17, 83], // 17% netral dan 83% sisa
            backgroundColor: ['#FFC107', '#E9ECEF'], // Warna kuning untuk netral dan abu-abu untuk sisa
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false // Sembunyikan legenda
            }
          },
          cutout: '70%' // Potongan tengah lebih besar
        }
      });

      const ctxNegative = document.getElementById('negativeChart').getContext('2d');
      const negativeChart = new Chart(ctxNegative, {
        type: 'doughnut',
        data: {
          labels: ['Negative'],
          datasets: [{
            label: 'Reviews',
            data: [3, 97], // 3% negatif dan 97% sisa
            backgroundColor: ['#DC3545', '#E9ECEF'], // Warna merah untuk negatif dan abu-abu untuk sisa
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false // Sembunyikan legenda
            }
          },
          cutout: '70%' // Potongan tengah lebih besar
        }
      });
    </script>

    <div class="row mt-4">
        <div class="col-lg-5 mb-lg-0 mb-4">
          <div class="card z-index-2">
            <div class="card-body p-2">
              <div class="bg-dark border-radius-md py-3 pe-1 mb-3">
                <div class="chart">
                  <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
              <h6 class="ms-2 mt-4 mb-0"> Active Users </h6>
              <p class="text-sm ms-2"> (<span class="font-weight-bolder">+23%</span>) than last week </p>
              <div class="container border-radius-lg">
                <div class="row">
                  <div class="col-3 py-3 ps-0">
                    <div class="d-flex mb-2">
                      <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-primary text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="10px" height="10px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>document</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(154.000000, 300.000000)">
                                  <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" opacity="0.603585379"></path>
                                  <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <p class="text-xs mt-1 mb-0 font-weight-bold">Users</p>
                    </div>
                    <h4 class="font-weight-bolder">36K</h4>
                    <div class="progress w-75">
                      <div class="progress-bar bg-dark w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-3 py-3 ps-0">
                    <div class="d-flex mb-2">
                      <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="10px" height="10px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>spaceship</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(4.000000, 301.000000)">
                                  <path class="color-background" d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z"></path>
                                  <path class="color-background" d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z"></path>
                                  <path class="color-background" d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z" opacity="0.598539807"></path>
                                  <path class="color-background" d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z" opacity="0.598539807"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <p class="text-xs mt-1 mb-0 font-weight-bold">Clicks</p>
                    </div>
                    <h4 class="font-weight-bolder">2m</h4>
                    <div class="progress w-75">
                      <div class="progress-bar bg-dark w-90" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-3 py-3 ps-0">
                    <div class="d-flex mb-2">
                      <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-warning text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="10px" height="10px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <p class="text-xs mt-1 mb-0 font-weight-bold">Sales</p>
                    </div>
                    <h4 class="font-weight-bolder">435$</h4>
                    <div class="progress w-75">
                      <div class="progress-bar bg-dark w-30" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-3 py-3 ps-0">
                    <div class="d-flex mb-2">
                      <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-danger text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="10px" height="10px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>settings</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(304.000000, 151.000000)">
                                  <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                                  <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                                  <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <p class="text-xs mt-1 mb-0 font-weight-bold">Items</p>
                    </div>
                    <h4 class="font-weight-bolder">43</h4>
                    <div class="progress w-75">
                      <div class="progress-bar bg-dark w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Sales overview</h6>
              <p class="text-sm">
                <i class="fa fa-arrow-up text-success"></i>
                <span class="font-weight-bold">4% more</span> in 2021
              </p>
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

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

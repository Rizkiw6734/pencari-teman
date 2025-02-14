<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AroundYou - Temukan Teman Baru</title>

    <!--
    - favicon
  -->
    <link rel="icon" type="image/png" href="/assets/img/logo.jpg">

    <!--
    - custom css link
  -->
    <link rel="stylesheet" href="./assets/css/style.custom.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&family=Poppins:wght@600;700&family=Rubik:wght@400;500&display=swap"
        rel="stylesheet">
</head>

<body id="top">
    <!--
    - #HEADER
  -->
    <header class="header" data-header>
        <div class="container-nv">
            <div class="overlay" data-overlay></div>
            <button class="menu-open-btn" data-menu-open-btn>
                <ion-icon name="menu-outline"></ion-icon>
            </button>
            <nav class="navbar" data-navbar>
                <button class="menu-close-btn" data-menu-close-btn>
                    <ion-icon name="close-outline"></ion-icon>
                </button>
                <a href="#" class="logo-nv">
                    <img src="./assets/img/logo-putih.svg" alt="">
                </a>
                <ul class="navbar-list">
                    <li>
                        <a href="#" class="navbar-link">Beranda</a>
                    </li>
                    <li>
                        <a href="#about" class="navbar-link">Tentang</a>
                    </li>
                    <li>
                        <a href="#departments" class="navbar-link">Keunggulan</a>
                    </li>
                    <li>
                        <a href="#fitur" class="navbar-link">Fitur-fitur</a>
                    </li>
                    <li>
                        <a href="#coment" class="navbar-link">Ulasan</a>
                    </li>
                    <li>
                        <a href="#footer" class="navbar-link">Kontak</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <article>
            <!--- #HERO -->
            <section class="hero">
                <div class="container">
                    <figure class="hero-banner">
                        <img src="./assets/img/map.svg" alt="">
                    </figure>
                    <div class="hero-content">
                        <h2 class="h2 hero-departments">Temukan<span class="highlight-2">Teman</span></h2>
                        <h2 class="h2 hero-departments">di<span class="highlight-2">Sekitarmu</span></h2>
                        <h2 class="h2 hero-departments">dengan sekali klik !</h2>
                        <p class="section-text">
                            Hadirkan pengalaman mencari teman yang seru dan mudah! Temukan orang-orang dengan minat yang sama dan bangun koneksi baru yang berarti.
                        </p>
                        <div class="button-container">
                            <a href="#about"><button class="btn btn-primary">Jelajahi</button></a>
                            <button class="btn btn-secondary" onclick="window.location.href='{{ route('login') }}'">Mulai Sekarang</button>
                        </div>
                    </div>
                </div>
            </section>

            <!--- #ABOUT -->
            <section id="about" class="about">
                <div class="container">
                    <div class="image-container">
                        <img src="./assets/img/handphone.svg" alt="Eduland students" class="image">
                        <img src="./assets/img/handphone.svg" alt="Eduland students" class="image highlight">
                        <img src="./assets/img/handphone.svg" alt="Eduland students" class="image">
                    </div>
                    <div class="about-content">
                        <h2 class="h2 about-title">Tentang Kami</h2>
                        <p class="section-text">
                            Around You adalah platform untuk menemukan teman baru, berbagi momen, dan terhubung dengan komunitas menyenangkan di sekitar Anda. Dengan teknologi berbasis lokasi dan fitur yang personal, kami membantu Anda memperluas jaringan sosial dan menciptakan hubungan yang bermakna. Mari bergabung dan temukan cerita baru bersama Around You!
                        </p>
                    </div>
                </div>
            </section>

            <!--- #KEUNGGULAN -->
              <section id="departments" class="departments">
                <div class="container departments-content">
                    <h2 class="h2 hero-departments">
                        Kenapa Memilih <span class="highlight-2">Around You?</span>
                    </h2>
                    <p class="section-text mr-10">
                        AroundYou memudahkan Anda menemukan teman baru, berbagi momen, dan membangun koneksi yang relevan dengan kebutuhan Anda, dengan aman dan personal.
                    </p>
                    <ul class="departments-list">
                        <li>
                            <div class="departments-card">
                                <div class="card-image">
                                    <img src="./assets/img/security.png" alt="Gambar 1">
                                </div>
                                <div class="card-content-dp">
                                    <h3 class="h3 card-title">Mudah dan Cepat</h3>
                                    <p class="card-text">
                                        Temukan teman baru hanya dengan beberapa klik berdasarkan lokasi anda.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="departments-card">
                                <div class="card-image">
                                    <img src="./assets/img/security.png" alt="Gambar 2">
                                </div>
                                <div class="card-content-dp">
                                    <h3 class="h3 card-title">Kesamaan Minat</h3>
                                    <p class="card-text">
                                        Filter pencarian yang canggih memastikan Anda terhubung dengan orang-orang yang memiliki hobi dan minat yang sama.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="departments-card">
                                <div class="card-image">
                                    <img src="./assets/img/security.png" alt="Gambar 3">
                                </div>
                                <div class="card-content-dp">
                                    <h3 class="h3 card-title">Aman dan Terpercaya</h3>
                                    <p class="card-text">
                                        Kami menjaga privasi dan keamanan Anda dengan fitur verifikasi pengguna dan kontrol lokasi yang fleksibel.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="departments-card">
                                <div class="card-image">
                                    <img src="./assets/img/security.png" alt="Gambar 4">
                                </div>
                                <div class="card-content-dp">
                                    <h3 class="h3 card-title">Komunitas dan Interaktif</h3>
                                    <p class="card-text">
                                        Bergabunglah dengan acara lokal dan kelompok komunitas yang sesuai dengan minat Anda.
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
              </section>

              <!-- #FITUR -->
              <section id="fitur" class="about">
                    <div class="wrapper">
                        <div class="container2">
                            <div class="fitur-content">
                                <h2 class="h2 about-title">Kenali Beragam Fitur Unggulan dari AroundYou</h2>
                                <p class="section-text">
                                    AroundYou menghadirkan berbagai fitur yang dirancang untuk memudahkan Anda berinteraksi, berbagi momen, dan menjalin koneksi yang lebih berarti.
                                </p>
                            </div>
                            <input type="radio" name="slide" id="c1" >
                            <label for="c1" class="card2">
                                <div class="row">
                                    <div class="description">
                                        <h2></h2>
                                        <p></p>
                                    </div>
                                </div>
                            </label>
                            <input type="radio" name="slide" id="c2">
                            <label for="c2" class="card2" >
                                <div class="row">
                                    <div class="description">
                                        <h2>Mencari Teman</h2>
                                        <p>Aplikasi Around You memiliki fitur Cari Teman yang memudahkan Anda menemukan dan terhubung dengan orang-orang baru di sekitar Anda, memperluas jaringan secara cepat dan aman.</p>
                                    </div>
                                </div>
                            </label>
                            <input type="radio" name="slide" id="c3" checked>
                            <label for="c3" class="card2" >
                                <div class="row">
                                    <div class="description">
                                        <h2>Jalinan</h2>
                                        <p>Aplikasi Around You menyediakan fitur Follow, Follback, dan Konfirmasi untuk menjalin koneksi dan memperluas relasi dengan teman baru secara mudah, cepat, dan aman.</p>
                                    </div>
                                </div>
                            </label>
                            <input type="radio" name="slide" id="c4" checked>
                            <label for="c4" class="card2" >
                                <div class="row">
                                    <div class="description">
                                        <h2>Chatting</h2>
                                        <p>Aplikasi Around You menyediakan fitur chatting aman dan intuitif untuk berkomunikasi dengan teman baru. Pengiriman pesan instan memudahkan Anda berbicara dan berbagi.</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <script>
                            document.querySelectorAll('.container2 label').forEach((label) => {
                                label.addEventListener('mouseover', () => {
                                    const inputId = label.getAttribute('for');
                                    const input = document.getElementById(inputId);

                                    if (input) {
                                        input.checked = true;
                                    }
                                });
                            });
                        </script>
                    </div>
            </section>


            <!--COMMENT-->
            <section id="coment" class="hero" style="margin-bottom: 150px;">
                <div class="container">
                    <div class="hero-content">
                        <h1 class="h1 hero-title">Apa Kata Pengguna</h1>
                        <p class="section-text">
                            Beberapa ulasan dari pengguna yang telah menggunakan AroundYou untuk berbagi momen dan menjalin koneksi.
                        </p>
                        <button id="toggle-comments" class="btn btn-primary2">Lihat semua Komentar</button>
                    </div>
                    <img src="./assets/img/ellipse.svg" alt="Vector line art" class="ellipse">

                    <div class="slider-container">
                        <div class="slider-wrapper">
                            <div class="slider-card">
                                <div class="card-content">
                                    <img src="./assets/img/team-1.jpg" alt="User" class="card-img">
                                    <div class="text-content">
                                        <h3>Andrew</h3>
                                        <div class="rating">⭐⭐⭐⭐4/5</div>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis accusamus optio molestias, hic esse, incidunt eveniet ex commodi laudantium ipsum nemo aperiam a. Ex fugiat rem qui, ipsa enim architecto.</p>
                            </div>
                            <div class="slider-card">
                                <div class="card-content">
                                    <img src="./assets/img/team-1.jpg" alt="User" class="card-img">
                                    <div class="text-content">
                                        <h3>Sarah</h3>
                                        <div class="rating">⭐⭐⭐⭐⭐5/5</div>
                                    </div>
                                </div>
                                <p>Aplikasi ini membantu saya menemukan teman baru.</p>
                            </div>
                            <div class="slider-card">
                                <div class="card-content">
                                    <img src="./assets/img/team-1.jpg" alt="User" class="card-img">
                                    <div class="text-content">
                                        <h3>Michael</h3>
                                        <div class="rating">⭐⭐⭐⭐4/5</div>
                                    </div>
                                </div>
                                <p>Fitur-fiturnya sangat lengkap dan mudah digunakan!</p>
                            </div>
                        </div>

                        <!-- Navigasi Tombol dan Dots -->
                        <div class="slider-navigation">
                            <button class="slider-btn prev-btn">❮</button>
                            <div class="slider-dots">
                                <span class="dot active"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            </div>
                            <button class="slider-btn next-btn">❯</button>
                        </div>
                    </div>
                </div>
            </section>
        </article>
    </main>

    <section id="departments" class="departments-2">
        <div class="container departments-content">
            <div id="full-comments" style="display: none;">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h1 hero-title">Semua Komentar</h1>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="user-info">
                                            <img src="/assets/img/team-2.jpg" alt="User Photo" class="user-photo">
                                            <div>
                                                <h5 class="card-title">Andrew</h5>
                                                <div class="rating-2">⭐⭐⭐⭐4/5</div>
                                            </div>
                                        </div>
                                        <p class="card-text">Saya sangat puas menggunakan AroundYou! Aplikasi ini memungkinkan saya untuk dengan mudah menjelajahi berbagai komunitas dan bertemu orang-orang baru dengan minat yang serupa. Fitur-fitur seperti pencarian teman berdasarkan lokasi atau hobi membuat pengalaman semakin personal.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="user-info">
                                            <img src="/assets/img/team-2.jpg" alt="User Photo" class="user-photo">
                                            <div>
                                                <h5 class="card-title">Andrew</h5>
                                                <div class="rating-2">⭐⭐⭐⭐ 4/5</div>
                                            </div>
                                        </div>
                                        <p class="card-text">Saya sangat puas menggunakan AroundYou! Aplikasi ini memungkinkan saya untuk dengan mudah menjelajahi berbagai komunitas dan bertemu orang-orang baru dengan minat yang serupa. Fitur-fitur seperti pencarian teman berdasarkan lokasi atau hobi membuat pengalaman semakin personal.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="user-info">
                                            <img src="/assets/img/team-2.jpg" alt="User Photo" class="user-photo">
                                            <div>
                                                <h5 class="card-title">Andrew</h5>
                                                <div class="rating-2">⭐⭐⭐⭐4/5</div>
                                            </div>
                                        </div>
                                        <p class="card-text">Saya sangat puas menggunakan AroundYou! Aplikasi ini memungkinkan saya untuk dengan mudah menjelajahi berbagai komunitas dan bertemu orang-orang baru dengan minat yang serupa. Fitur-fitur seperti pencarian teman berdasarkan lokasi atau hobi membuat pengalaman semakin personal.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="user-info">
                                            <img src="/assets/img/team-2.jpg" alt="User Photo" class="user-photo">
                                            <div>
                                                <h5 class="card-title">Andrew</h5>
                                                <div class="rating-2">⭐⭐⭐⭐ 4/5</div>
                                            </div>
                                        </div>
                                        <p class="card-text">Saya sangat puas menggunakan AroundYou! Aplikasi ini memungkinkan saya untuk dengan mudah menjelajahi berbagai komunitas dan bertemu orang-orang baru dengan minat yang serupa. Fitur-fitur seperti pencarian teman berdasarkan lokasi atau hobi membuat pengalaman semakin personal.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="user-info">
                                            <img src="/assets/img/team-2.jpg" alt="User Photo" class="user-photo">
                                            <div>
                                                <h5 class="card-title">Andrew</h5>
                                                <div class="rating-2">⭐⭐⭐⭐4/5</div>
                                            </div>
                                        </div>
                                        <p class="card-text">Saya sangat puas menggunakan AroundYou! Aplikasi ini memungkinkan saya untuk dengan mudah menjelajahi berbagai komunitas dan bertemu orang-orang baru dengan minat yang serupa. Fitur-fitur seperti pencarian teman berdasarkan lokasi atau hobi membuat pengalaman semakin personal.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="user-info">
                                            <img src="/assets/img/team-2.jpg" alt="User Photo" class="user-photo">
                                            <div>
                                                <h5 class="card-title">Andrew</h5>
                                                <div class="rating-2">⭐⭐⭐⭐ 4/5</div>
                                            </div>
                                        </div>
                                        <p class="card-text">Saya sangat puas menggunakan AroundYou! Aplikasi ini memungkinkan saya untuk dengan mudah menjelajahi berbagai komunitas dan bertemu orang-orang baru dengan minat yang serupa. Fitur-fitur seperti pencarian teman berdasarkan lokasi atau hobi membuat pengalaman semakin personal.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                          <span aria-hidden="true">&laquo; Sebelumnya </span>
                        </a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                          <span aria-hidden="true">Selanjutnya &raquo;</span>
                        </a>
                      </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>

    <section class="min-h-screen flex items-center justify-center relative">
        <div class="bg-white flex rounded-2xl shadow-lg max-w-3xl p-5 items-center relative">
            <div class="md:w-1/2 px-8 md:px-16">
                <h2 class="font-bold text-[#000000] mb-2" style="font-size: 25px">Kirim Pesan</h2>

                <style>
                    input::placeholder {
                        color: #97B1F0 !important;
                        opacity: 1;
                    }

                    input::-webkit-input-placeholder {
                        color: #97B1F0 !important;
                    }
                    input::-moz-placeholder {
                        color: #97B1F0 !important;
                    }
                    input:-ms-input-placeholder {
                        color: #97B1F0 !important;
                    }
                    input::-ms-input-placeholder {
                        color: #97B1F0 !important;
                    }

                    textarea::placeholder {
                        color: #97B1F0 !important;
                        opacity: 1;
                    }
                </style>

                <form action="{{ route('register') }}" method="post" class="flex flex-col gap-4">
                    @csrf

                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label for="name" style="color: #528BFF">Nama</label>
                        <input class="p-2 rounded-xl border" style="background-color: #F2F6FF; border-color: #F2F6FF;" id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Anda">
                        @error('name')
                        <div role="alert" class="bg-red-100 dark:bg-red-900 border-l-4 border-red-500 dark:border-red-700 text-red-900 dark:text-red-100 p-2 rounded-lg flex items-center transition duration-300 ease-in-out hover:bg-red-200 dark:hover:bg-red-800 transform hover:scale-105">
                            <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" class="h-5 w-5 flex-shrink-0 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13 16h-1v-4h1m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    stroke-width="2"
                                    stroke-linejoin="round"
                                    stroke-linecap="round">
                                </path>
                            </svg>
                            <p class="text-xs font-semibold">{{ $message }}</p>
                        </div>
                        @enderror
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label for="email" style="color: #528BFF">Email</label>
                        <input class="p-2 rounded-xl border" style="background-color: #F2F6FF; border-color: #F2F6FF;" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email Anda">
                        @error('email')
                            <div role="alert" class="bg-red-100 dark:bg-red-900 border-l-4 border-red-500 dark:border-red-700 text-red-900 dark:text-red-100 p-2 rounded-lg flex items-center transition duration-300 ease-in-out hover:bg-red-200 dark:hover:bg-red-800 transform hover:scale-105">
                                <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" class="h-5 w-5 flex-shrink-0 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 16h-1v-4h1m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                        stroke-width="2"
                                        stroke-linejoin="round"
                                        stroke-linecap="round">
                                    </path>
                                </svg>
                                <p class="text-xs font-semibold">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label for="pesan" style="color: #528BFF">Pesan</label>
                        <textarea rows="4" class="p-2 rounded-xl border" style="background-color: #F2F6FF; border-color: #F2F6FF;" id="pesan" name="pesan" placeholder="Masukkan Pesan Anda">{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <div role="alert" class="bg-red-100 dark:bg-red-900 border-l-4 border-red-500 dark:border-red-700 text-red-900 dark:text-red-100 p-2 rounded-lg flex items-center transition duration-300 ease-in-out hover:bg-red-200 dark:hover:bg-red-800 transform hover:scale-105">
                                <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" class="h-5 w-5 flex-shrink-0 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 16h-1v-4h1m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                        stroke-width="2"
                                        stroke-linejoin="round"
                                        stroke-linecap="round">
                                    </path>
                                </svg>
                                <p class="text-xs font-semibold">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <button class="bg-[#6569F6] rounded-xl text-white py-2 hover:scale-105 duration-300">Kirim</button>
                </form>

                <div class="text-xs border-b border-[#FFFFFF] py-4 text-[#FFFFFF]"></div>
            </div>

            <div class="md:block hidden w-1/2">
                <img class="rounded-2xl" src="/images/pesan.svg" alt="Location Search">
            </div>
        </div>
    </section>

    <!--- #FOOTER -->
        <footer id="footer" class="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="footer-link-box">
                        <ul class="footer-list">
                            <li class="footer-link-tittle">
                                <a href="#" class="logo-ft">
                                    <img src="./assets/img/logo-putih.svg" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#" class="footer-link">Around You adalah platform untuk mencari teman dan berbagi cerita. Temukan orang-orang dengan minat yang sama di dekat anda.</a>
                            </li>
                        </ul>
                        <ul class="footer-list">
                            <li>
                                <p class="footer-link-title">Informasi</p>
                            </li>
                            <li class="contact-item">
                                <span><ion-icon name="location-sharp"></ion-icon></span>
                                <a href="#" class="contact-link">Lokasi</a>
                                <p class="footer-link">JL. Mawar Indah No. 123, Kecamatan Lawokwaru, Kota Malang, Jawa
                                    Timur</p>
                            </li>
                            <li class="contact-item">
                                <span><ion-icon name="mail-sharp"></ion-icon></span>
                                <p class="contact-link">E-mail</p>
                                <a href="#" class="footer-link">guest@aroundyou.com</a>
                                <a href="#" class="footer-link">testaccount@aroundyou.com</a>
                            </li>
                            <li class="contact-item">
                                <span><ion-icon name="call-sharp"></ion-icon></span>
                                <p class="contact-link">Telepon</p>
                                <a href="tel:+628123456789" class="footer-link">08123456789</a>
                                <a href="tel:+628123456789" class="footer-link">08123456789</a>
                            </li>
                        </ul>
                        <ul class="footer-list">
                            <li>
                                <p class="footer-link-title">Sosial Media</p>
                            </li>
                            <li class="contact-item">
                                <span><ion-icon name="logo-instagram"></ion-icon></span>
                                <a href="#" class="contact-link">arroundyou.official</a>
                            </li>
                            <li class="contact-item">
                                <span><ion-icon name="logo-youtube"></ion-icon></span>
                                <a href="#" class="contact-link">arroundyou.official</a>
                            </li>
                            <li class="contact-item">
                                <span><ion-icon name="logo-facebook"></ion-icon></span>
                                <a href="#" class="contact-link">arroundyou.official</a>
                            </li>
                            <li class="contact-item">
                                <span><ion-icon name="logo-twitter"></ion-icon></span>
                                <a href="#" class="contact-link">arroundyou.official</a>
                            </li>
                        </ul>
                        <ul class="footer-list">
                            <li>
                                <p class="footer-link-title">Tentang</p>
                            </li>
                            <li>
                                <a href="#" class="footer-link">Tentang Kami</a>
                            </li>
                            <li>
                                <a href="#" class="footer-link">Kebijakan Privasi</a>
                            </li>
                            <li>
                                <a href="#" class="footer-link">Syarat dan Ketentuan</a>
                            </li>
                            <li>
                                <a href="#" class="footer-link">Bantuan</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

 {{-- <div class="footer-bottom">
          <div class="container">
            <p class="copyright">
              &copy; 2022 <a href="">codewithsadee</a>. All right reserved
            </p>
          </div>
        </div> --}}



    <!--
    - #GO TO TOP
  -->

    <a href="#top" class="go-top" data-go-top>
        <ion-icon name="arrow-up"></ion-icon>
    </a>





    <!--
    - custom js link
  -->
    <script src="./assets/js/script.custom.js"></script>

    <!--
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sliderWrapper = document.querySelector(".slider-wrapper");
            const cards = document.querySelectorAll(".slider-card");
            const prevBtn = document.querySelector(".prev-btn");
            const nextBtn = document.querySelector(".next-btn");
            const dots = document.querySelectorAll(".dot");

            let currentIndex = 0;

            // Fungsi untuk memperbarui slider
            function updateSlider() {
                const offset = -currentIndex * 100; // Hitung posisi slide
                sliderWrapper.style.transform = `translateX(${offset}%)`;

                // Perbarui dot active
                dots.forEach((dot, index) => {
                    dot.classList.toggle("active", index === currentIndex);
                });
            }

            // Event listener tombol Next
            nextBtn.addEventListener("click", function () {
                currentIndex = (currentIndex + 1) % cards.length;
                updateSlider();
            });

            // Event listener tombol Prev
            prevBtn.addEventListener("click", function () {
                currentIndex = (currentIndex - 1 + cards.length) % cards.length;
                updateSlider();
            });

            // Event listener untuk dots
            dots.forEach((dot, index) => {
                dot.addEventListener("click", function () {
                    currentIndex = index;
                    updateSlider();
                });
            });
        });

            document.addEventListener("DOMContentLoaded", function () {
                const toggleButton = document.getElementById("toggle-comments");
                const fullComments = document.getElementById("full-comments");

            toggleButton.addEventListener("click", function () {
            if (fullComments.style.display === "none" || fullComments.style.display === "") {
                fullComments.style.display = "block";
                toggleButton.textContent = "Tutup semua Komentar";
            } else {
                fullComments.style.display = "none";
                toggleButton.textContent = "Lihat semua Komentar";
            }
        });
    });
</script>



</body>

</html>

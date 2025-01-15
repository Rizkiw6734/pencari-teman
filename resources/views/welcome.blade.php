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
        <div class="container">
            <div class="overlay" data-overlay></div>
            <a href="#" class="logo">
                <img src="./assets/img/logo-putih.svg" alt="">
            </a>
            <button class="menu-open-btn" data-menu-open-btn>
                <ion-icon name="menu-outline"></ion-icon>
            </button>
            <nav class="navbar" data-navbar>
                <button class="menu-close-btn" data-menu-close-btn>
                    <ion-icon name="close-outline"></ion-icon>
                </button>
                <a href="#" class="logo">
                    <img src="./assets/img/logo2.svg" alt="">
                </a>
                <div class="search-container">
                    <div class="input-wrapper">
                        <ion-icon name="search-sharp"></ion-icon>
                        <input type="text" id="search-input" placeholder="Mencari apa?">
                    </div>
                </div>
                <ul class="navbar-list">
                    <li>
                        <a href="#" class="navbar-link">Beranda</a>
                    </li>
                    <li>
                        <a href="#" class="navbar-link">Tentang</a>
                    </li>
                    <li>
                        <a href="#" class="navbar-link">Keunggulan</a>
                    </li>
                    <li>
                        <a href="#" class="navbar-link">Fitur-fitur</a>
                    </li>
                    <li>
                        <a href="#" class="navbar-link">Ulasan</a>
                    </li>
                    <li>
                        <a href="#" class="navbar-link">Kontak</a>
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
                        <h1 class="h1 hero-title">Temukan <span class="highlight">Teman</span>di <span class="highlight">Sekitarmu</span>dengan Sekali Klik!.</h1>
                        <p class="section-text">
                            Hadirkan pengalaman mencari teman yang seru dan mudah! Temukan orang-orang dengan minat yang sama dan bangun koneksi baru yang berarti.
                        </p>
                        <div class="button-container">
                            <button class="btn btn-primary">Jelajahi</button>
                            <button class="btn btn-secondary" onclick="window.location.href='{{ route('login') }}'">Mulai Sekarang</button>
                        </div>
                    </div>
                </div>
            </section>

            <!--- #ABOUT -->
            <section class="about">
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

            <!--- #FITUR -->

            <section class="departments">
                <div class="container">
                  <h2 class="h2 hero-title">
                    Kenapa Memilih <span class="highlight">Around You?</span>
                  </h2>
                  <p class="section-text">
                    AroundYou memudahkan Anda menemukan teman baru, berbagi momen, dan membangun koneksi yang relevan dengan kebutuhan Anda, dengan aman dan personal.
                  </p>
                  <ul class="departments-list">
                    <li>
                      <div class="departments-card">
                        <div class="card-image">
                          <img src="./assets/img/security.png" alt="Gambar 1">
                        </div>
                        <div class="card-content">
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
                        <div class="card-content">
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
                        <div class="card-content">
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
                        <div class="card-content">
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


            <!--
- #COMMENT-->

            <section class="instructor">
                <div class="container">
                    <img src="./assets/img/instructor-vactor-1.svg" alt="Vector line art" class="vector-line">
                    <div class="title-wrapper">
                        <h2 class="h2 instructor-title">Apa Kata Pengguna?</h2>
                    </div>
                    <ul class="instructor-list">
                        <li>
                            <div class="instructor-card">
                                <figure class="card-banner">
                                    <img src="./assets/img/instructor-1.png" alt="Shaapir Prio">
                                </figure>
                                <a href="#">
                                    <h3 class="card-title">Shaapir Prio</h3>
                                </a>
                                <p class="card-subtitle">"Platform ini sangat membantu saya menemukan teman baru di
                                    sekitar."</p>
                            </div>
                        </li>
                        <li>
                            <div class="instructor-card">
                                <figure class="card-banner">
                                    <img src="./assets/img/instructor-2.png" alt="Sellina">
                                </figure>
                                <a href="#">
                                    <h3 class="card-title">Sellina</h3>
                                </a>
                                <p class="card-subtitle">"Sangat aman, saya merasa nyaman menggunakannya!"</p>
                            </div>
                        </li>
                        <li>
                            <div class="instructor-card">
                                <figure class="card-banner">
                                    <img src="./assets/img/instructor-3.png" alt="John Smith">
                                </figure>
                                <a href="#">
                                    <h3 class="card-title">John Smith</h3>
                                </a>
                                <p class="card-subtitle">"Fitur-fiturnya memudahkan saya untuk berkomunikasi dengan
                                    pengguna lain."</p>
                            </div>
                        </li>
                    </ul>
                    {{-- <img src="./assets/img/instructor-vactor-2.svg" alt="Vector line art" class="vector-line"> --}}
                </div>
            </section>

            <section class="hero">
                <div class="container">

                    <div class="hero-content">
                        <h1 class="h1 hero-title">Apa Kata Pengguna</h1>
                        <p class="section-text">
                            Beberapa ulasan dari pengguna yang telah menggunakan AroundYou untuk berbagi momen dan menjalin koneksi.
                        </p>
                        <button class="btn btn-primary2">Lihat semua Komentar</button>
                    </div>
                </div>
            </section>
            <!--- #CTA -->
        </article>
    </main>





    <!--- #FOOTER -->
        <footer class="footer">

            <div class="footer-top">
                <div class="container">

                    <div class="footer-link-box">

                        <ul class="footer-list">

                            <li class="footer-link-tittle">
                                <a href="#" class="logo">
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

            {{-- <div class="footer-bottom">
          <div class="container">
            <p class="copyright">
              &copy; 2022 <a href="">codewithsadee</a>. All right reserved
            </p>
          </div>
        </div> --}}

        </footer>






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

</body>

</html>

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
        <img src="./assets/img/logo2.svg" alt="">
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
        <ul class="navbar-list">
          <li>
            <a href="#" class="navbar-link">Home</a>
          </li>
          <li>
            <a href="#" class="navbar-link">About</a>
          </li>
          <li>
            <a href="#" class="navbar-link">Service</a>
          </li>
          <li>
            <a href="#" class="navbar-link">Blog</a>
          </li>
          <li>
            <a href="#" class="navbar-link">Contact</a>
          </li>
        </ul>
        <button class="btn btn-secondary" onclick="window.location.href='{{ route('login') }}'">Mulai Sekarang</button>
      </nav>
    </div>
  </header>

  <main>
    <article>
      <!--
        - #HERO
      -->
      <section class="hero">
        <div class="container">
          <figure class="hero-banner">
            <img src="./assets/img/map.svg" alt="">
          </figure>
          <div class="hero-content">
            <h1 class="h1 hero-title">Temukan Teman Baru di Sekitarmu</h1>
            <p class="section-text">
              Gabung dengan jutaan pengguna lain untuk menemukan teman baru berdasarkan lokasi dan minat yang sama.
            </p>
            <button class="btn btn-primary">Coba Sekarang</button>
          </div>
        </div>
      </section>

      <!--
        - #ABOUT
      -->
      <section class="about">
        <div class="container">
          <figure class="about-banner">
            <img src="./assets/img/handphone.svg" alt="Eduland students" class="handphone">
            <img src="./assets/img/about-vector.svg" alt="Vector line art" class="vector-line">
            <button class="play-btn">
              <ion-icon name="play"></ion-icon>
            </button>
          </figure>
          <div class="about-content">
            <h2 class="h2 about-title">Kami siap membantu Anda menjalin pertemanan baru di sekitar dengan aman dan mudah!</h2>
            <p class="section-text">
              Jadikan pertemanan baru lebih mudah dan aman bersama kami.
            </p>
            <button class="btn btn-primary">Mulai hari ini</button>
          </div>
        </div>
      </section>

      <!--
        - #FITUR
      -->
      <section class="departments">
        <div class="container">
          <img src="./assets/img/departmets-vector.svg" alt="Vector line art" class="vector-line">
          <h2 class="h2 departments-title">Mengapa Pilih Kami?</h2>
          <ul class="departments-list">
            <li>
              <div class="departments-card">
                <a href="#" class="card-banner">
                  <figure>
                    <img src="./assets/img/adventure.png" alt="Pencarian Teman">
                  </figure>
                </a>
                <a href="#">
                  <h3 class="h3 card-title">Pencarian Teman</h3>
                </a>
                <p class="card-text">
                  Cari teman berdasarkan lokasi, minat, dan usia dengan mudah.
                </p>
                <a href="#" class="card-link">
                  <span>Pelajari lebih lanjut</span>
                  <ion-icon name="arrow-forward"></ion-icon>
                </a>
              </div>
            </li>
            <li>
              <div class="departments-card">
                <a href="#" class="card-banner">
                  <figure>
                    <img src="./assets/img/chatting.png" alt="Chat Langsung">
                  </figure>
                </a>
                <a href="#">
                  <h3 class="h3 card-title">Chat Langsung</h3>
                </a>
                <p class="card-text">
                  Mulai percakapan langsung dengan teman baru Anda.
                </p>
                <a href="#" class="card-link">
                  <span>Pelajari lebih lanjut</span>
                  <ion-icon name="arrow-forward"></ion-icon>
                </a>
              </div>
            </li>
            <li>
              <div class="departments-card">
                <a href="#" class="card-banner">
                  <figure>
                    <img src="./assets/img/security.png" alt="Keamanan & Laporan">
                  </figure>
                </a>
                <a href="#">
                  <h3 class="h3 card-title">Keamanan & Laporan</h3>
                </a>
                <p class="card-text">
                  Laporkan aktivitas tidak pantas dengan cepat dan mudah.
                </p>
                <a href="#" class="card-link">
                  <span>Pelajari lebih lanjut</span>
                  <ion-icon name="arrow-forward"></ion-icon>
                </a>
              </div>
            </li>
          </ul>
          <button class="btn btn-primary">Lihat Semua</button>
        </div>
      </section>

      <!--
        - #COMMENT
      -->

      <section class="instructor">
        <div class="container">
          <img src="./assets/img/instructor-vactor-1.svg" alt="Vector line art" class="vector-line">
          <div class="title-wrapper">
            <h2 class="h2 instructor-title">Apa Kata Pengguna?</h2>
            <button class="btn btn-primary">Lihat Semua Komentar</button>
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
                <p class="card-subtitle">"Platform ini sangat membantu saya menemukan teman baru di sekitar."</p>
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
                <p class="card-subtitle">"Fitur-fiturnya memudahkan saya untuk berkomunikasi dengan pengguna lain."</p>
              </div>
            </li>
          </ul>
          <img src="./assets/img/instructor-vactor-2.svg" alt="Vector line art" class="vector-line">
        </div>
      </section>





      <!--
        - #CTA
      -->

      <section class="cta">
        <div class="container">

          <div class="title-wrapper">

            <h2 class="h2 cta-title">
              <span>Buat Akun Gratis & Daftar Sekarang</span>

              <img src="./assets/img/cta-vector.svg" alt="Vector arrow art" class="vector-line">
            </h2>

            <button class="btn btn-primary" onclick="window.location.href='{{ route('register') }}'">Register Now</button>

          </div>

          <div class="cta-banner"></div>

        </div>
      </section>

    </article>
  </main>





  <!--
    - #FOOTER
  -->

  <footer class="footer">

    <div class="footer-top">
      <div class="container">

        <div class="footer-brand">

          <a href="#" class="logo">
            <img src="./assets/img/logo.svg" alt="Eduland logo">
          </a>

          <p class="footer-text">
            Professionally scale cross functional human capital and extensive technology.
          </p>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-google"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-instagram"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-linkedin"></ion-icon>
              </a>
            </li>

          </ul>

        </div>

        <div class="footer-link-box">

          <ul class="footer-list">

            <li>
              <p class="footer-link-title">Services</p>
            </li>

            <li>
              <a href="#" class="footer-link">Design</a>
            </li>

            <li>
              <a href="#" class="footer-link">Development</a>
            </li>

            <li>
              <a href="#" class="footer-link">Marketing</a>
            </li>

            <li>
              <a href="#" class="footer-link">Content Writing</a>
            </li>

          </ul>

          <ul class="footer-list">

            <li>
              <p class="footer-link-title">Company</p>
            </li>

            <li>
              <a href="#" class="footer-link">About</a>
            </li>

            <li>
              <a href="#" class="footer-link">Terms</a>
            </li>

            <li>
              <a href="#" class="footer-link">Privacy Policy</a>
            </li>

            <li>
              <a href="#" class="footer-link">Careers</a>
            </li>

          </ul>

          <ul class="footer-list">

            <li>
              <p class="footer-link-title">Job Info</p>
            </li>

            <li>
              <a href="#" class="footer-link">Select</a>
            </li>

            <li>
              <a href="#" class="footer-link">Services</a>
            </li>

            <li>
              <a href="#" class="footer-link">Payment</a>
            </li>

          </ul>

          <ul class="footer-list">

            <li>
              <p class="footer-link-title">Contact</p>
            </li>

            <li class="contact-item">
              <span>Call : </span>

              <a href="tel:5463876387" class="contact-link">546 3876 387</a>
            </li>

            <li class="contact-item">
              <span>Email : </span>

              <a href="mailto:example@gmail.com" class="contact-link">example@gmail.com</a>
            </li>

            <li class="contact-item">
              <span>Address : </span>

              <a href="#" class="contact-link">
                <address>San Francisco, USA</address>
              </a>
            </li>

          </ul>

        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <p class="copyright">
          &copy; 2022 <a href="">codewithsadee</a>. All right reserved
        </p>
      </div>
    </div>

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

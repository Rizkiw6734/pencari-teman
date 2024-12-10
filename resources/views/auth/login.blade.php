<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="/assets/css/style.css" />
    <title>Login</title>
    <style>
      .input-field {
        position: relative;
        margin-bottom: 1.5rem;
      }
      .error-message {
        color: red;
        font-size: 0.8rem;
        position: absolute;
        bottom: -20px;
        left: 40px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <!-- Form Login -->
          <form action="{{ route('login') }}" method="POST" class="sign-in-form">
            @csrf
            <h2 class="title">Masuk</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input
                type="text"
                name="email"
                placeholder="Email"
                value="{{ old('email') }}"
                required
              />
              @error('email')
              <div class="error-message">Email tidak valid atau sudah terdaftar.</div>
              @enderror
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input
                type="password"
                name="password"
                placeholder="Password"
                required
              />
              @error('password')
              <div class="error-message">Password salah atau wajib diisi.</div>
              @enderror
            </div>
            <input type="submit" value="Masuk" class="btn solid" />
            <p class="social-text">Atau masuk dengan platform sosial</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>

          <!-- Form Register -->
          <form action="{{ route('register') }}" method="POST" class="sign-up-form">
            @csrf
            <h2 class="title">Daftar</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input
                type="text"
                name="name"
                placeholder="Nama Pengguna"
                value="{{ old('name') }}"
                required
              />
              @error('name')
              <div class="error-message">Nama harus valid dan belum terdaftar.</div>
              @enderror
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input
                type="text"
                name="email"
                placeholder="Email"
                value="{{ old('email') }}"
                required
              />
              @error('email')
              <div class="error-message">Email tidak valid atau sudah terdaftar.</div>
              @enderror
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input
                type="password"
                name="password"
                placeholder="Password"
                required
              />
              @error('password')
              <div class="error-message">
                Password wajib diisi dan harus sesuai dengan aturan keamanan.
              </div>
              @enderror
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input
                type="password"
                name="password_confirmation"
                placeholder="Konfirmasi Password"
                required
              />
              @error('password_confirmation')
              <div class="error-message">Konfirmasi password tidak cocok.</div>
              @enderror
            </div>
            <input type="submit" class="btn" value="Daftar" />
            <p class="social-text">Atau daftar dengan platform sosial</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Baru di sini?</h3>
            <p>
              Bergabunglah dengan komunitas kami dan nikmati layanan terbaik kami.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Daftar
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>

        <div class="panel right-panel">
          <div class="content">
            <h3>Sudah punya akun?</h3>
            <p>
              Masuk dan kelola data Anda dengan mudah di sistem kami.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Masuk
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="/assets/js/app.js"></script>
  </body>
</html>

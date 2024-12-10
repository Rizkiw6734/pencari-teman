<!DOCTYPE html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Login</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
            <form action="{{ route('login') }}" method="POST" class="sign-in-form">
                @csrf
                <h2 class="title">Sign in</h2>
                <div class="input-field">
                  <i class="fas fa-envelope"></i>
                  <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="input-field">
                  <i class="fas fa-lock"></i>
                  <input type="password" name="password" placeholder="Password" required />
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                  <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>               
                <input type="submit" value="Login" class="btn solid" />
                <p class="social-text">Or Sign in with social platforms</p>
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

            <form action="{{ route('register') }}" method="POST" class="sign-up-form">
                @csrf
                <h2 class="title">Sign up</h2>
                <div class="input-field">
                  <i class="fas fa-user"></i>
                  <input type="text" name="name" placeholder="Username" required />
                </div>
                <div class="input-field">
                  <i class="fas fa-envelope"></i>
                  <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="input-field">
                  <i class="fas fa-lock"></i>
                  <input type="password" name="password" placeholder="Password" required />
                </div>
                <div class="input-field">
                  <i class="fas fa-lock"></i>
                  <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                    required
                  />
                </div>
                <input type="submit" class="btn" value="Sign up" />
                <p class="social-text">Or Sign up with social platforms</p>
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
            <h3>New here ?</h3>
            <p>
              Bergabunglah dengan kami untuk mendapatkan akses penuh ke semua fitur. Daftar sekarang untuk memulai pengalaman Anda dengan kami.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="/assets/img/log.svg" class="image" alt=""/>
        </div>

        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Sudah memiliki akun? Masuk sekarang untuk melanjutkan dan menikmati semua fitur yang tersedia.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="/assets/img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="/assets/js/app.js"></script>
  </body>
</html>

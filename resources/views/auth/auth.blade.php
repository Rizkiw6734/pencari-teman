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
                    @include('auth.login') <!-- Form Login -->
        @include('auth.register') <!-- Form Register -->
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
          <img src="/assets/img/log.svg" class="image" alt=""/>
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
          <img src="/assets/img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>
    <script></script>
    <script src="/assets/js/app.js"></script>
  </body>
</html>

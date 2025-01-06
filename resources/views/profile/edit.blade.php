@extends('layouts.app')
@section('content')
<div class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid">
        <div class="card shadow-sm mt-4" style="max-width: 600px; margin: 0 auto;">
            <div class="card-body text-center">
                <div class="d-flex flex-column align-items-center">
                    <!-- Avatar -->
                    <div class="avatar avatar-xl position-relative mb-3">
                        <img src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : asset('images/marie.jpg') }}" alt="Foto Profil" class="w-100 border-radius-lg shadow-sm">
                    </div>

                    <!-- Informasi Pengguna -->
                    <div>
                        <h5 class="mb-1 font-weight-bolder">
                            {{ $user['name'] }}
                        </h5>
                        <p class="mb-0 text-muted">
                            Email: {{ $user['email'] }}
                        </p>
                        <p class="mb-0 text-muted">
                            Active Since: {{ date('d M Y', strtotime($user['created_at'])) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-sm h-100">
                            <div class="card-body py-6">
                                <!-- Update Profile Information -->
                                @include('profile.partials.update-profile-information-form')
                            </div>

                            <div class="card-body py-6">
                                <!-- Update Password -->
                                @include('profile.partials.update-password-form')
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
                        <p>Copyright &copy; <i class="fa fa-heart"></i> by around.you
                            <script>
                            document.write(new Date().getFullYear())
                            </script>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
            </footer>
        </div>
    </div>
</div>
@endsection

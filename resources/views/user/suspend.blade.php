<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Suspend</title>
    <link rel="icon" type="image/png" href="/assets/img/logo.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="image-container" style="text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 100vh; font-family: 'Poppins', sans-serif;">
        <img src="/assets/img/suspend.svg" alt="Descriptive Text" style="max-width: 30%; height: auto;">
        <p style="margin-top: 30px; color: #000000; font-size: 18px;">Halo <b>{{ Auth::user()->name }}</b>,</p>
        <p style="margin-top: -15px; font-size: 18px; color: #000000;">Akun Anda telah <em><b>dibekukan sementara</b></em> karena pelanggaran kebijakan.</p>
        <p style="margin-top: -15px; font-size: 18px; color: #000000;">Untuk informasi lebih lanjut, silakan hubungi tim dukungan kami.</p>        
    </div>

    <div class="d-grid gap-5 d-md-flex justify-content-center" style="margin-top: -75px;">
        <!-- Tombol Logout -->
        <button type="button" class="text-danger btn btn-sm btn-rounded me-5"
            style="box-shadow: 0 0 10px hsla(0, 0%, 0%, 0.2); border-radius: 10px; background-color: transparent; border: 2px; font-size: 16px; padding: 10px 20px;"
            onclick="confirmLogout()">
            <i class="fa fa-ban" aria-hidden="true"></i> Logout
        </button>

        <!-- Form Logout -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function confirmLogout() {
                Swal.fire({
                    title: 'LogOut',
                    html: '<i class="fas fa-sign-out-alt fa-3x mb-3" style="color: #FF1C1C;"></i><br>Anda yakin ingin keluar dari akun Anda?<br>Semua sesi yang sedang berjalan akan dihentikan, dan Anda perlu login kembali untuk mengakses aplikasi.',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'rounded-lg shadow',
                        title: 'fw-bold',
                        confirmButton: 'btn btn-danger px-4',
                        cancelButton: 'btn btn-secondary px-4'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();
                    }
                });
            }
        </script>

        @if (session('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: "{{ session('success') }}",
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif

        @if ($errors->any())
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    var bandingModal = new bootstrap.Modal(document.getElementById('bandingModal'));
                    bandingModal.show();
                });
            </script>
        @endif

        <button type="button" class="text-dark btn btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#bandingModal"
            style="box-shadow: 0 0 10px hsla(0, 0%, 0%, 0.2); border-radius: 10px; margin-left: 150px; background-color: transparent; font-size: 16px; padding: 10px 20px;">
            <i class="fa fa-balance-scale" aria-hidden="true"></i> Ajukan Banding
        </button>

        <div class="modal fade" id="bandingModal" tabindex="-1" aria-labelledby="bandingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bandingModalLabel">Ajukan Banding</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12 col-12">
                            <form action="{{ route('banding.store') }}" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="pinalti_id" class="form-label">Pinalti</label>
                                            <select name="pinalti_id" id="pinalti_id" class="form-select">
                                                <option value="">-- Pilih Pinalti --</option>
                                                @foreach ($pinaltis as $pinalti)
                                                    <option value="{{ $pinalti->id }}" {{ old('pinalti_id') == $pinalti->id ? 'selected' : '' }}>
                                                        {{ $pinalti->jenis_hukuman ?? 'Tidak ada alasan' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pinalti_id')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="alasan_banding" class="form-label">Alasan Banding</label>
                                            <textarea name="alasan_banding" id="alasan_banding" rows="4" class="form-control">{{ old('alasan_banding') }}</textarea>
                                            @error('alasan_banding')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button type="submit" class="btn btn-primary" id="submitBanding">Ajukan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                                        </div>

                                        @if ($errors->any())
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function () {
                                                var bandingModal = new bootstrap.Modal(document.getElementById('bandingModal'));
                                                bandingModal.show();
                                            });
                                        </script>
                                        @endif

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
</body>
</html>


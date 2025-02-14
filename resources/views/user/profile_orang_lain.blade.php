@extends('layouts.user')
@section('content')
    <div class="main-content position-relative min-vh-100" style="background-color: #F0F3F9;">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-5 mt-0">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center" style="box-shadow: 0px 0px 5px 1px rgba(82, 139, 255, 0.25); border-radius: 12px;">
                            <div class="avatar avatar-xxl position-relative mb-3">
                                <img src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : asset('images/marie.jpg') }}"
                                            alt="Foto Profil" class="w-100 border-radius-lg shadow-sm rounded-circle" style="width: 150px; height: 110px; border-radius: 50%; object-fit: cover;">
                            </div>
                            <div class="position-absolute top-0 start-0 m-3">
                                <a href="{{ url()->previous() }}">
                                    <i class="fa-solid fa-arrow-left text-secondary p-2 rounded-circle"
                                       style="font-size: 20px; margin-right: -10px;"></i>
                                </a>
                            </div>
                            <div class="position-absolute top-0 end-0 m-3">
                                <i class="fa-solid fa-comment-sms text-secondary p-2 rounded-circle"
                                    style="font-size: 24px; margin-right: -10px;"></i>
                                <i class="fa-solid fa-user-plus text-secondary p-2 rounded-circle"
                                    style="font-size: 20px;"></i>
                            </div>
                            <div>
                                <h5 class="mb-2"
                                    style="font-size: 27px; font-weight: 600; line-height: 45px; margin: 5px; color:black;">
                                    {{ $user['name'] }} {{ $user['last_name'] }}
                                </h5>
                                <p class="mb-4"
                                    style="font-size: 14px; font-weight: 400; line-height: 22.5px; margin: 5px; color:black;">
                                    {{ $user->bio ?? 'Tidak tersedia' }}
                                </p>
                                <div class="row">
                                    <div class="col">
                                        <p
                                            style="font-size: 14px; font-weight: 400; line-height: 24px; margin: 5px; color:black;">
                                            Pengikut
                                        </p>
                                        <p
                                            style="font-size: 16px; font-weight: 700; line-height: 24px; margin: 10px; color:black;">
                                            {{ $followersCount }}
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p
                                            style="font-size: 14px; font-weight: 400; line-height: 24px; margin: 5px; color:black;">
                                            Mengikuti
                                        <p
                                            style="font-size: 16px; font-weight: 700; line-height: 24px; margin: 10px; color:black;">
                                            {{ $followingCount }}
                                        </p>
                                    </div>
                                </div>
                                <!-- Blokir -->
                                <div class="d-grid gap-5 d-md-flex justify-content-center mt-2">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-rounded text-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" style="background-color: transparent; margin-top: 10px; border-radius: 10px;box-shadow: 0 0 10px hsla(0, 0%, 60%, 0.25);">
                                        <i class="fa-solid fa-ban" style="font-size: 14px"></i>
                                        Blokir
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-0 text-center w-100 mb-0">
                                                    <h1 class="modal-title fs-3 mx-auto">Blokir Pengguna</h1>
                                                </div>
                                                <div class="modal-body text-black text-center fs-5 mx-auto mt-0">
                                                    <img src="/assets/img/blokir.png" alt="" class="d-block mx-auto">
                                                    Tindakan ini akan memblokir pengguna.<br>
                                                    Anda yakin ingin melanjutkan?
                                                </div>
                                                <div class="modal-footer d-flex justify-content-between border-0 mx-4">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #000000; color: white; font-size: 14px; padding: 10px 30px;">Batal</button>
                                                    <button type="button" class="btn btn-primary" style="background-color: #ffffff; color: rgb(0, 0, 0); font-size: 14px; padding: 10px 30px; border:#000000 solid 1px;">Ya</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-rounded text-danger" data-bs-toggle="modal"
                                        data-bs-target="#laporkanmodal"
                                        style="background-color: transparent; margin-top: 10px; border-radius: 10px;box-shadow: 0 0 10px hsla(0, 0%, 60%, 0.25);">
                                        <i class="fa-regular fa-thumbs-down" style="font-size: 14px;"></i>
                                        Laporkan
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="laporkanmodal" tabindex="-1"
                                        aria-labelledby="laporkanmodalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h1 class="modal-title fs-4" id="laporkanmodalLabel">Laporkan Pengguna
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close" style="background-color: #000000;"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card" style="box-shadow: 0px 0px 5px 1px rgba(82, 139, 255, 0.25);">
                                                        <div class="card-body" >
                                                            <form id="laporanForm" action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="reported_id" id="reported_id" value="{{ $user->id }}">
                                                                <div class="mb-3 d-flex flex-column align-items-start">
                                                                    <label for="bukti" class="form-label first-circle fw-bold text-start" style="font-size: 15px;">
                                                                        Bukti <span class="text-muted fst-italic">(*optional)</span>
                                                                    </label>
                                                                    <img id="preview" src="" alt="Pratinjau Gambar" class="mb-2" style="max-width: 100px; display: none;">
                                                                    <input type="file" class="form-control" id="bukti" name="bukti" accept="image/*" style="border: 0px solid #cecece; box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25);">
                                                                    @error('bukti')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3 d-flex flex-column align-items-start">
                                                                    <label for="alasan" class="form-label fw-bold text-start" style="font-size: 15px;">Alasan Dilaporkan</label>
                                                                    <textarea class="form-control" id="alasan" name="alasan" rows="3" placeholder="Masukkan Alasan Anda" style="border: 0px solid #ffffff; box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25)"></textarea>
                                                                    @error('alasan')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </form>

                                                            <script>
                                                                document.getElementById('bukti').addEventListener('change', function(event) {
                                                                    const file = event.target.files[0];
                                                                    const preview = document.getElementById('preview');

                                                                    if (file) {
                                                                        const reader = new FileReader();
                                                                        reader.onload = function(e) {
                                                                            preview.src = e.target.result;
                                                                            preview.style.display = "block";
                                                                        };
                                                                        reader.readAsDataURL(file);
                                                                    } else {
                                                                        preview.style.display = "none";
                                                                    }
                                                                });

                                                                function submitLaporan() {
                                                                    document.getElementById('laporanForm').submit();
                                                                }
                                                            </script>

                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-between border-0 mx-2" style="margin-bottom: -5px; margin-top: -20px;">
                                                            <button type="button" class="btn btn-danger" onclick="submitLaporan()" style="font-size: 14px; padding: 10px 30px;">Laporkan</button>
                                                            <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal" style="font-size: 14px; padding: 10px 30px; background-color: #BEB9B9; color: white;">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-7 mt-0">
                    <div class="card shadow-sm h-100" >
                        <div class="card shadow-sm" >
                            <div class="card-body" style="box-shadow: 0px 0px 5px 1px rgba(82, 139, 255, 0.25); border-radius: 12px;">
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <p
                                        style="font-size: 18px; font-weight: 500; line-height: 30px; margin: 0; color:black;">
                                        Informasi</p>
                                </div>
                                <!-- Informasi -->
                                <div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <p style="font-size: 14px; font-weight: 400; line-height: 24px; margin: 0;">
                                                Gender
                                            </p>
                                            <p
                                                style="font-size: 14px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                {{ $user->gender == 'L' ? 'Laki-laki' : ($user->gender == 'P' ? 'Perempuan' : 'Tidak tersedia') }}
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p style="font-size: 14px; font-weight: 400; line-height: 24px; margin: 0;">
                                                Umur
                                            </p>
                                            <p
                                                style="font-size: 14px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                {{ $user->umur ?? 'Tidak tersedia' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <p style="font-size: 14px; font-weight: 400; line-height: 24px; margin: 0;">
                                                Hobi <br>
                                            <p
                                                style="font-size: 14px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                {{ $user->hobi ?? 'Tidak tersedia' }}
                                            </p>
                                            </p>
                                        </div>
                                        <div style="height: 1px; background-color: #ddd; margin: 2px 0;"></div>
                                    </div>

                                    <div class="mb-3 d-flex justify-content-between align-items-center">
                                        <p
                                            style="font-size: 18px; font-weight: 500; line-height: 30px; margin: 0; color:black;">
                                            Alamat</p>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <p style="font-size: 14px; font-weight: 400; line-height: 24px; margin: 0;">
                                                Provinsi <br>
                                            <p
                                                style="font-size: 14px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                {{ $user->provinsis ? $user->provinsis->name : 'Tidak tersedia' }}
                                            </p>
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p style="font-size: 14px; font-weight: 400; line-height: 24px; margin: 0;">
                                                Kecamatan <br>
                                            <p
                                                style="font-size: 14px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                {{ $user->kecamatans ? $user->kecamatans->name : 'Tidak tersedia' }}
                                            </p>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <p style="font-size: 14px; font-weight: 400; line-height: 24px; margin: 0;">
                                                Kabupaten <br>
                                            <p
                                                style="font-size: 14px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                {{ $user->kabupatens ? $user->kabupatens->name : 'Tidak tersedia' }}
                                            </p>
                                            </p>
                                        </div>

                                        <div class="col">
                                            <p style="font-size: 14px; font-weight: 400; line-height: 24px; margin: 0;">
                                                Desa <br>
                                            <p
                                                style="font-size: 14px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                {{ $user->desas ? $user->desas->name : 'Tidak tersedia' }}
                                            </p>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                    <h5 class="text-dark">Teman di Sekitar Anda</h5>
                    <a href="#" class="text-black" style="font-size: 12px;">Lihat Semua</a>
                </div>
                <div class="d-flex flex-nowrap" style="white-space: nowrap; gap: 12px; padding: 10px 0;">
                    <div class="card text-center p-3"
                        style="flex: 0 0 calc(100% / 8 - 10px); height: 160px; box-shadow: 0px 0px 10px 1px rgba(82, 139, 255, 0.25);">
                        <img src="/assets/img/pp.jpg" class="rounded-circle mx-auto" alt="Avatar"
                            style="width: 60px; height: 60px; object-fit: cover; margin-top: -8px;">
                        <h6 class="mt-1 mb-0 text-dark" style="font-size: 13px;">Alexandra</h6>
                        <p class="text-secondary small" style="font-size: 11px;">
                            <i class="fa-solid fa-location-dot"></i> Malang
                        </p>
                        <button class="btn btn-primary btn-sm text-dark"
                            style="font-size: 10px; padding: 3px 8px; background-color: #84ADFF; border-radius: 10px;">
                            Ikuti
                        </button>
                    </div>

                </div>



            </div>

        </div>
    </div>
    </div>
    </div>
@endsection

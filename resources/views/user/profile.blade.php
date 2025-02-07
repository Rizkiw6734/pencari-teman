@extends('layouts.user')
@section('content')
    <div class="main-content"
        style="max-width: 1200px; margin: 0 auto; margin-top: 0px; background-color: #F0F3F9;
           padding: 20px; margin-left: 260px; position: relative;">
        <div class="container-fluid">
            <!-- Card Utama -->
            <div>
                <header class="mt-3">
                    <h2 style="font-size: 32px;">
                        {{ __('Profil Saya') }}
                    </h2>
                </header>
                <div class="card-body mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card shadow-sm h-90">
                                <div class="card-body text-center">
                                    <div class="avatar avatar-xxl position-relative mb-3 mt-5">
                                        <img src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : asset('images/marie.jpg') }}"
                                            alt="Foto Profil" class="w-100 border-radius-lg shadow-sm rounded-circle" style="width: 150px; height: 110px; border-radius: 50%; object-fit: cover;">

                                        <label for="uploadProfilePhoto" class="position-absolute"
                                            style="bottom: -10px; right: 5px; background: white; padding: 6px; border-radius: 50%; box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); cursor: pointer;">
                                            <i class="fa fa-camera" style="font-size: 18px; color: #000;"></i>
                                        </label>
                                        <input type="file" id="uploadProfilePhoto" class="d-none">
                                    </div>
                                    <div>
                                        <h5 class="mb-0 mt-2"
                                            style="font-size: 30px; font-weight: 600; line-height: 45px; margin: 0; color:black;">
                                            {{ $user['name'] }} {{ $user['last_name'] }}
                                        </h5>
                                        <p class="mb-5"
                                            style="font-size: 15px; font-weight: 400; line-height: 22.5px; margin: 0; color:black;">
                                            {{ $user->bio ?? 'Tidak tersedia' }}
                                        </p>
                                        <div class="row mb-2">
                                            <div class="col">
                                                <p
                                                    style="font-size: 16px; font-weight: 400; line-height: 24px; margin: 0; color:black;">
                                                    Pengikut <br>
                                                    <span style="font-weight: 700;">4.567</span>
                                                </p>
                                            </div>
                                            <div class="col">
                                                <p
                                                    style="font-size: 16px; font-weight: 400; line-height: 24px; margin: 0; color:black;">
                                                    Mengikuti <br>
                                                    <span style="font-weight: 700;">4.567</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <div class="mb-3 d-flex justify-content-between align-items-center">
                                            <p
                                                style="font-family: 'Poppins', font-size: 20px; font-weight: 500; line-height: 30px; margin: 0; color:black;">
                                                Informasi Pribadi</p>
                                            <!-- Tombol untuk membuka modal edit -->
                                            <button type="button" class="btn btn-sm btn-rounded text-dark"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                style="background-color: transparent; border: 1px solid #84ADFF;">
                                                Edit <i class="fa fa-pencil ms-1" style="font-size: 14px"></i>
                                            </button>
                                        </div>
                                        <!-- Informasi Pribadi -->
                                        <div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">
                                                        First Name
                                                    </p>
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->name ?? 'Tidak tersedia' }}
                                                    </p>
                                                </div>
                                                <div class="col">
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">
                                                        Last Name
                                                    </p>
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->last_name ?? 'Tidak tersedia' }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col">
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">
                                                        Gender <br>
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->gender == 'L' ? 'Laki-laki' : ($user->gender == 'P' ? 'Perempuan' : 'Tidak tersedia') }}
                                                    </p>
                                                    </p>
                                                </div>
                                                <div class="col">
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">
                                                        Umur <br>
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->umur ?? 'Tidak tersedia' }}
                                                    </p>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col">
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">
                                                        Email <br>
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->email ?? 'Tidak tersedia' }}
                                                    </p>
                                                    </p>
                                                </div>
                                                <div class="col">
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">
                                                        Hobi <br>
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->hobi ?? 'Tidak tersedia' }}
                                                    </p>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">
                                                        Bio <br>
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->bio ?? 'Tidak tersedia' }}
                                                    </p>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Informasi Pribadi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="name" class="form-label">First Name</label>
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label for="last_name" class="form-label">Last Name</label>
                                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                                                        @error('last_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="gender" class="form-label">Gender</label>
                                                        <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                                            <option value="L" {{ old('gender', $user->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                            <option value="P" {{ old('gender', $user->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                        </select>
                                                        @error('gender')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label for="umur" class="form-label">Umur</label>
                                                        <input type="number" class="form-control @error('umur') is-invalid @enderror" id="umur" name="umur" value="{{ old('umur', $user->umur) }}">
                                                        @error('umur')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label for="hobi" class="form-label">Hobi</label>
                                                        <input type="text" class="form-control @error('hobi') is-invalid @enderror" id="hobi" name="hobi" value="{{ old('hobi', $user->hobi) }}">
                                                        @error('hobi')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bio" class="form-label">Bio</label>
                                                    <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
                                                    @error('bio')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" id="submitModal" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>

                                            @if ($errors->any())
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function () {
                                                    var bandingModal = new bootstrap.Modal(document.getElementById('editModal'));
                                                    bandingModal.show();
                                                });
                                            </script>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <div class="mb-3 d-flex justify-content-between align-items-center">
                                            <p
                                                style="font-family: 'Poppins', font-size: 20px; font-weight: 600; line-height: 30px; margin: 0; color:black;">
                                                Alamat</p>
                                            <a href="#" class="btn btn-sm btn-rounded text-dark"
                                                style="background-color: transparent; border: 1px solid #84ADFF;">
                                                Edit <i class="fa fa-pencil ms-1" style="font-size: 14px"></i>
                                            </a>
                                        </div>
                                        <!-- Alamat -->
                                        <div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">
                                                        Provinsi <br>
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->provinsi_id ?? 'Tidak tersedia' }}
                                                    </p>
                                                    </p>
                                                </div>
                                                <div class="col">
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">
                                                        Kabupaten/Kota <br>
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->kabupaten_id ?? 'Tidak tersedia' }}
                                                    </p>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">
                                                        Kecamatan <br>
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->kecamatan_id ?? 'Tidak tersedia' }}
                                                    </p>
                                                    </p>
                                                </div>
                                                <div class="col">
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">
                                                        Desa <br>
                                                    <p
                                                        style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->desa_id ?? 'Tidak tersedia' }}
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
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer pt-3">
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
@endsection

@section('scripts')
    <script>
        document.getElementById('uploadProfilePhoto').addEventListener('change', function () {
    let formData = new FormData();
    formData.append('_method', 'PUT'); // Menggunakan PUT untuk mengupdate foto
    formData.append('foto_profil', this.files[0]);

    fetch("{{ route('profile.update-photo') }}", {
        method: "POST", // Dengan _method=PUT, request ini diperlakukan sebagai PUT
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: formData
    })
    .then(response => {
        if (response.ok) {
            // Redirect ke halaman profil setelah foto diupdate
            window.location.href = "{{ route('profile.index') }}";
        } else {
            throw new Error('Gagal mengunggah foto.');
        }
    })
    .catch(error => {
        // Menampilkan pesan error jika gagal
        alert(error.message);
    });
});


    </script>
@endsection

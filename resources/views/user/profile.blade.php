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
                                    <div class="avatar avatar-xxl position-relative mt-3 max-height-100">
                                        <img src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : asset('images/marie.jpg') }}"
                                            alt="Foto Profil" class="w-100 border-radius-lg shadow-sm rounded-circle"
                                            style="width: 140px; height: 110px; border-radius: 50%; object-fit: cover;">

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
                                                    <span style="font-weight: 700;">{{ $followersCount }}</span>
                                                </p>
                                            </div>
                                            <div class="col">
                                                <p
                                                    style="font-size: 16px; font-weight: 400; line-height: 24px; margin: 0; color:black;">
                                                    Mengikuti <br>
                                                    <span style="font-weight: 700;">{{ $followingCount }}</span>
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
                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title" id="editModalLabel">Edit Informasi Pribadi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card"
                                                    style="box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25);">
                                                    <div class="card-body">
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <label for="name" class="form-label">First Name</label>
                                                                <input type="text"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    id="name" name="name"
                                                                    value="{{ old('name', $user->name) }}"
                                                                    style="border: 0px solid #ffffff; box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25)">
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col">
                                                                <label for="last_name" class="form-label">Last
                                                                    Name</label>
                                                                <input type="text"
                                                                    class="form-control @error('last_name') is-invalid @enderror"
                                                                    id="last_name" name="last_name"
                                                                    value="{{ old('last_name', $user->last_name) }}"
                                                                    style="border: 0px solid #ffffff; box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25)">
                                                                @error('last_name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <label for="gender" class="form-label">Gender</label>
                                                                <select
                                                                    class="form-control @error('gender') is-invalid @enderror"
                                                                    id="gender" name="gender"
                                                                    style="border: 0px solid #ffffff; box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25)">
                                                                    <option value="L"
                                                                        {{ old('gender', $user->gender) == 'L' ? 'selected' : '' }}>
                                                                        Laki-laki</option>
                                                                    <option value="P"
                                                                        {{ old('gender', $user->gender) == 'P' ? 'selected' : '' }}>
                                                                        Perempuan</option>
                                                                </select>
                                                                @error('gender')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col">
                                                                <label for="umur" class="form-label">Umur</label>
                                                                <input type="number"
                                                                    class="form-control @error('umur') is-invalid @enderror"
                                                                    id="umur" name="umur"
                                                                    value="{{ old('umur', $user->umur) }}"
                                                                    style="border: 0px solid #ffffff; box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25)">
                                                                @error('umur')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <label for="email" class="form-label">Email</label>
                                                                <input type="email"
                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                    id="email" name="email"
                                                                    value="{{ old('email', $user->email) }}"
                                                                    style="border: 0px solid #ffffff; box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25)">
                                                                @error('email')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col">
                                                                <label for="hobi" class="form-label">Hobi</label>
                                                                <input type="text"
                                                                    class="form-control @error('hobi') is-invalid @enderror"
                                                                    id="hobi" name="hobi"
                                                                    value="{{ old('hobi', $user->hobi) }}"
                                                                    style="border: 0px solid #ffffff; box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25)">
                                                                @error('hobi')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="bio" class="form-label">Bio</label>
                                                            <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3"
                                                                style="border: 0px solid #ffffff; box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25)">{{ old('bio', $user->bio) }}</textarea>
                                                            @error('bio')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-between border-0 mx-2"
                                                        style="margin-bottom: -5px; margin-top: -30px;">
                                                        <button type="submit" id="submitModal" class="btn btn-primary"
                                                            style="background-color: #528BFF; padding: 10px 30px;">Simpan</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal"
                                                            style="background-color: #BEB9B9; padding: 10px 30px;">Batal</button>
                                                    </div>
                                                    @if ($errors->any() && old('name'))
                                                        <script>
                                                            document.addEventListener("DOMContentLoaded", function() {
                                                                var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                                                                editModal.show();
                                                            });
                                                        </script>
                                                    @endif
                                        </form>
                                    </div>
                                </div>
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
                                        style="background-color: transparent; border: 1px solid #84ADFF;"
                                        data-bs-toggle="modal" data-bs-target="#editAddressModal">
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
                                                {{ $user->provinsis ? $user->provinsis->name : 'Tidak tersedia' }}
                                            </p>
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p
                                                style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">
                                                Kabupaten/Kota <br>
                                            <p
                                                style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                {{ $user->kabupatens ? $user->kabupatens->name : 'Tidak tersedia' }}
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
                                                {{ $user->kecamatans ? $user->kecamatans->name : 'Tidak tersedia' }}
                                            </p>
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p
                                                style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">
                                                Desa <br>
                                            <p
                                                style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                {{ $user->desas ? $user->desas->name : 'Tidak tersedia' }}
                                            </p>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Edit Alamat -->
                    <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('user.update.address', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header border-0">
                                        <h5 class="modal-title" id="editAddressModalLabel">Edit Alamat</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="card" style="box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25);">
                                            <div class="card-body">
                                                <!-- Provinsi -->
                                                <div class="mb-3">
                                                    <label for="provinsi_id" class="form-label">Provinsi</label>
                                                    <select id="provinsi_id" name="provinsi_id" class="form-control"
                                                        style="border: 0px solid #ffffff; box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25)">
                                                        <option value="">Pilih Provinsi</option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->id }}"
                                                                {{ $province->id == $user->provinsi_id ? 'selected' : '' }}>
                                                                {{ $province->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Kabupaten -->
                                                <div class="mb-3">
                                                    <label for="kabupaten_id" class="form-label">Kabupaten/Kota</label>
                                                    <select id="kabupaten_id" name="kabupaten_id" class="form-control"
                                                        style="border: 0px solid #ffffff; box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25)">
                                                        <option value="">Pilih Kabupaten/Kota</option>
                                                        @foreach ($regencies as $regency)
                                                            <option value="{{ $regency->id }}"
                                                                {{ $regency->id == $user->kabupaten_id ? 'selected' : '' }}>
                                                                {{ $regency->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Kecamatan -->
                                                <div class="mb-3">
                                                    <label for="kecamatan_id" class="form-label">Kecamatan</label>
                                                    <select id="kecamatan_id" name="kecamatan_id" class="form-control"
                                                        style="border: 0px solid #ffffff; box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25)">
                                                        <option value="">Pilih Kecamatan</option>
                                                        @foreach ($districts as $district)
                                                            <option value="{{ $district->id }}"
                                                                {{ $district->id == $user->kecamatan_id ? 'selected' : '' }}>
                                                                {{ $district->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Desa -->
                                                <div class="mb-3">
                                                    <label for="desa_id" class="form-label">Desa_id</label>
                                                    <select id="desa_id" name="desa_id" class="form-control"
                                                        style="border: 0px solid #ffffff; box-shadow: 0px 0px 2px 1px rgba(82, 139, 255, 0.25)">
                                                        <option value="">Pilih Desa</option>
                                                        @foreach ($villages as $village)
                                                            <option value="{{ $village->id }}"
                                                                {{ $village->id == $user->desa_id ? 'selected' : '' }}>
                                                                {{ $village->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="modal-footer d-flex justify-content-between border-0 mx-2"
                                                style="margin-bottom: -5px; margin-top: -30px;">
                                                <button type="submit" class="btn btn-primary"
                                                    style="background-color: #528BFF; padding: 10px 30px;">Simpan</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                    style="background-color: #BEB9B9; padding: 10px 30px;">Batal</button>
                                            </div>
                                </form>
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
        document.getElementById('uploadProfilePhoto').addEventListener('change', function() {
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
    <script>
        $(document).ready(function() {
            // Saat provinsi dipilih
            $('#provinsi_id').on('change', function() {
                var provinceId = $(this).val();
                $('#kabupaten_id').html('<option value="">Memuat...</option>');
                $('#kecamatan_id').html('<option value="">Pilih Kecamatan</option>');
                $('#desa_id').html('<option value="">Pilih Desa</option>');

                if (provinceId) {
                    $.ajax({
                        url: "{{ route('getRegencies') }}",
                        type: "GET",
                        data: {
                            province_id: provinceId
                        },
                        success: function(data) {
                            $('#kabupaten_id').html(
                                '<option value="">Pilih Kabupaten/Kota</option>');
                            $.each(data, function(key, value) {
                                $('#kabupaten_id').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

            // Saat kabupaten dipilih
            $('#kabupaten_id').on('change', function() {
                var regencyId = $(this).val();
                $('#kecamatan_id').html('<option value="">Memuat...</option>');
                $('#desa_id').html('<option value="">Pilih Desa</option>');

                if (regencyId) {
                    $.ajax({
                        url: "{{ route('getDistricts') }}",
                        type: "GET",
                        data: {
                            regency_id: regencyId
                        },
                        success: function(data) {
                            $('#kecamatan_id').html(
                            '<option value="">Pilih Kecamatan</option>');
                            $.each(data, function(key, value) {
                                $('#kecamatan_id').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

            // Saat kecamatan dipilih
            $('#kecamatan_id').on('change', function() {
                var districtId = $(this).val();
                $('#desa_id').html('<option value="">Memuat...</option>');

                if (districtId) {
                    $.ajax({
                        url: "{{ route('getVillages') }}",
                        type: "GET",
                        data: {
                            district_id: districtId
                        },
                        success: function(data) {
                            $('#desa_id').html('<option value="">Pilih Desa</option>');
                            $.each(data, function(key, value) {
                                $('#desa_id').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>

@endsection


{{-- @extends('layouts.user')
@section('content')
    <div class="main-content"
        style="max-width: 1200px; margin: 0 auto; margin-top: 0px; background-color: #F0F3F9;
           padding: 20px; margin-left: 260px; position: relative;">
        <div class="container-fluid">
            <!-- Pengikut -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pengikutModal">
                Pengikut
            </button>

            <!-- Modal -->
            <div class="modal fade" id="pengikutModal" tabindex="-1" aria-labelledby="pengikutModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 450px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-center w-100" id="pengikutModalLabel">Pengikut</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div
                                style="display: flex; align-items: center; margin-bottom: 10px; border: 1px solid #3243FD80; border-radius:20px; padding: 3px 10px; width: 100%; background-color: #ffffff;">
                                <span style="color: #757575; font-size: 16px; cursor: default;">
                                    <i class="fa fa-search ms-1" style="font-size: 15px"></i>
                                </span>
                                <input type="text" id="searchInput" placeholder="Cari"
                                    style="border: none; outline: none; flex: 1; font-size: 15px; background-color: transparent; padding: 5px;">
                            </div>
                            <div id="chat-container" style="height: 300px; overflow-y: scroll; solid #ccc;">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="/assets/img/pp.jpg" alt="Avatar" class="rounded-circle me-2"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <span class="d-block fw-bold"
                                                style="color: #000000; font-size: 15px;">Christ</span>
                                            <p class="m-0 font-small">@cassain</p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm me-md-3 mt-3"
                                        style="background-color: #BEB9B9">Hapus</button>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="/assets/img/pp.jpg" alt="Avatar" class="rounded-circle me-2"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <span class="d-block fw-bold"
                                                style="color: #000000; font-size: 15px;">Christ</span>
                                            <p class="m-0 font-small">@cassain</p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm me-md-3 mt-3"
                                        style="background-color: #BEB9B9">Hapus</button>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="/assets/img/pp.jpg" alt="Avatar" class="rounded-circle me-2"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <span class="d-block fw-bold"
                                                style="color: #000000; font-size: 15px;">Christ</span>
                                            <p class="m-0 font-small">@cassain</p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm me-md-3 mt-3"
                                        style="background-color: #BEB9B9">Hapus</button>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="/assets/img/pp.jpg" alt="Avatar" class="rounded-circle me-2"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <span class="d-block fw-bold"
                                                style="color: #000000; font-size: 15px;">Christ</span>
                                            <p class="m-0 font-small">@cassain</p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm me-md-3 mt-3"
                                        style="background-color: #BEB9B9">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Mengikuti -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mengikutiModal">
                Mengikuti
            </button>

            <!-- Modal -->
            <div class="modal fade" id="mengikutiModal" tabindex="-1" aria-labelledby="mengikutiModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 450px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-center w-100" id="mengikutiModalLabel">Mengikuti</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div
                                style="display: flex; align-items: center; margin-bottom: 10px; border: 1px solid #3243FD80; border-radius:20px; padding: 3px 10px; width: 100%; background-color: #ffffff;">
                                <span style="color: #757575; font-size: 16px; cursor: default;">
                                    <i class="fa fa-search ms-1" style="font-size: 15px"></i>
                                </span>
                                <input type="text" id="searchInput" placeholder="Cari"
                                    style="border: none; outline: none; flex: 1; font-size: 15px; background-color: transparent; padding: 5px;">
                            </div>
                            <div id="chat-container" style="height: 300px; overflow-y: scroll; solid #ccc;">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="/assets/img/pp.jpg" alt="Avatar" class="rounded-circle me-2"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <span class="d-block fw-bold"
                                                style="color: #000000; font-size: 15px;">Christ</span>
                                            <p class="m-0 font-small">@cassain</p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm me-md-3 mt-3"
                                        style="background-color: #528BFF">Kirim Pesan</button>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="/assets/img/pp.jpg" alt="Avatar" class="rounded-circle me-2"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <span class="d-block fw-bold"
                                                style="color: #000000; font-size: 15px;">Christ</span>
                                            <p class="m-0 font-small">@cassain</p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm me-md-3 mt-3"
                                        style="background-color: #528BFF">Kirim Pesan</button>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="/assets/img/pp.jpg" alt="Avatar" class="rounded-circle me-2"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <span class="d-block fw-bold"
                                                style="color: #000000; font-size: 15px;">Christ</span>
                                            <p class="m-0 font-small">@cassain</p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm me-md-3 mt-3"
                                        style="background-color: #528BFF">Kirim Pesan</button>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="/assets/img/pp.jpg" alt="Avatar" class="rounded-circle me-2"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <span class="d-block fw-bold"
                                                style="color: #000000; font-size: 15px;">Christ</span>
                                            <p class="m-0 font-small">@cassain</p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm me-md-3 mt-3"
                                        style="background-color: #528BFF">Kirim Pesan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


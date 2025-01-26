@extends('layouts.user')
@section('content')
<div class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid">
        <!-- Card Utama -->
        <div style="max-width: 800px; margin: 0 auto;  margin-top: 37px;">
            <header>
                <h2 style="font-size: 32px;">
                    {{ __('Profil Saya') }}
                </h2>
            </header>
            <div class="card-body mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <div class="avatar avatar-xxl position-relative mb-3">
                                    <img src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : asset('images/marie.jpg') }}"
                                         alt="Foto Profil"
                                         class="w-100 border-radius-lg shadow-sm rounded-circle">
                                </div>
                                <div>
                                    <h5 class="mb-2" style="font-family: 'Poppins', font-size: 30px; font-weight: 600; line-height: 45px; margin: 0; color:black;">
                                        {{ $user['name'] }} {{ $user['last_name']}}
                                    </h5>
                                    <p class="mb-4" style="font-family: 'Poppins', font-size: 15px; font-weight: 400; line-height: 22.5px; margin: 0; color:black;">
                                        {{ $user->bio ?? 'Tidak tersedia' }}
                                    </p>
                                    <div class="row">
                                        <div class="col">
                                            <p style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0; color:black;">Pengikut <br>
                                               <p style="font-family: 'Poppins', font-size: 16px; font-weight: 700; line-height: 24px; margin: 0; color:black;">
                                                 4.567
                                               </p>
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0; color:black;">Mengikuti <br>
                                               <p style="font-family: 'Poppins', font-size: 16px; font-weight: 700; line-height: 24px; margin: 0; color:black;">
                                                 4.567
                                               </p>
                                            </p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-rounded text-dark" data-bs-toggle="modal" data-bs-target="#editModalProfile"
                                            style="background-color: transparent; border: 1px solid #84ADFF;">
                                            Edit <i class="fa fa-pencil ms-1" style="font-size: 14px"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editModalProfile" tabindex="-1" aria-labelledby="editModalProfileModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('user.profile.updateFotoProfile') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="foto_profile">Foto Profil</label>
                                        <input type="file" name="foto_profile" id="foto_profile" class="form-control-file">
                                        @if ($user->foto_profile)
                                            <img src="{{ Storage::url($user->foto_profile) }}" alt="Foto Profil" width="100" class="mt-2">
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Foto Profil</button>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="mb-">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="mb-3 d-flex justify-content-between align-items-center">
                                        <p style="font-family: 'Poppins', font-size: 20px; font-weight: 500; line-height: 30px; margin: 0; color:black;">Informasi Pribadi</p>
                                        <!-- Tombol untuk membuka modal edit -->
                                        <button type="button" class="btn btn-sm btn-rounded text-dark" data-bs-toggle="modal" data-bs-target="#editModal"
                                            style="background-color: transparent; border: 1px solid #84ADFF;">
                                            Edit <i class="fa fa-pencil ms-1" style="font-size: 14px"></i>
                                        </button>
                                    </div>
                                    <!-- Informasi Pribadi -->
                                    <div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <p style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">
                                                    First Name
                                                </p>
                                                <p style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                    {{ $user->name ?? 'Tidak tersedia' }}
                                                </p>
                                            </div>
                                            <div class="col">
                                                <p style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">
                                                    Last Name
                                                </p>
                                                <p style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                    {{ $user->last_name ?? 'Tidak tersedia' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col">
                                                <p style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">Gender <br>
                                                    <p style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->gender == 'L' ? 'Laki-laki' : ($user->gender == 'P' ? 'Perempuan' : 'Tidak tersedia') }}
                                                    </p>
                                                </p>
                                            </div>
                                            <div class="col">
                                                <p style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;"> Umur <br>
                                                    <p style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->umur ?? 'Tidak tersedia' }}
                                                    </p>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col">
                                                <p style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">Email <br>
                                                    <p style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->email ?? 'Tidak tersedia'}}
                                                    </p>
                                                </p>
                                            </div>
                                            <div class="col">
                                                <p style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">Hobi <br>
                                                    <p style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->hobi ?? 'Tidak tersedia' }}
                                                    </p>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <p style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">Bio <br>
                                                   <p style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
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
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="name" class="form-label">First Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                                </div>
                                                <div class="col">
                                                    <label for="last_name" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="gender" class="form-label">Gender</label>
                                                    <select class="form-control" id="gender" name="gender">
                                                        <option value="L" {{ $user->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                        <option value="P" {{ $user->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label for="umur" class="form-label">Umur</label>
                                                    <input type="number" class="form-control" id="umur" name="umur" value="{{ $user->umur }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                                </div>
                                                <div class="col">
                                                    <label for="hobi" class="form-label">Hobi</label>
                                                    <input type="text" class="form-control" id="hobi" name="hobi" value="{{ $user->hobi }}">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="bio" class="form-label">Bio</label>
                                                <textarea class="form-control" id="bio" name="bio" rows="3">{{ $user->bio }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="mb-3 d-flex justify-content-between align-items-center">
                                        <p style="font-family: 'Poppins', font-size: 20px; font-weight: 600; line-height: 30px; margin: 0; color:black;">Alamat</p>
                                        <a href="#" class="btn btn-sm btn-rounded text-dark" style="background-color: transparent; border: 1px solid #84ADFF;">
                                            Edit <i class="fa fa-pencil ms-1" style="font-size: 14px"></i>
                                        </a>
                                    </div>
                                    <!-- Alamat -->
                                    <div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <p style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">Provinsi <br>
                                                    <p style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->provinsi_id ?? 'Tidak tersedia' }}
                                                    </p>
                                                </p>
                                            </div>
                                            <div class="col">
                                                <p style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">Kabupaten/Kota <br>
                                                    <p style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->kabupaten_id ?? 'Tidak tersedia' }}
                                                    </p>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <p style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">Kecamatan <br>
                                                    <p style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
                                                        {{ $user->kecamatan_id ?? 'Tidak tersedia' }}
                                                    </p>
                                                </p>
                                            </div>
                                            <div class="col">
                                                <p style="font-family: 'Poppins', font-size: 16px; font-weight: 400; line-height: 24px; margin: 0;">Desa <br>
                                                    <p style="font-family: 'Poppins', font-size: 16px; font-weight: 500; line-height: 24px; margin: 0; color:black;">
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

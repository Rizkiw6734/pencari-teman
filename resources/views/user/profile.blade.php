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
                                <div class="avatar avatar-xl position-relative mb-3">
                                    <img src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : asset('images/marie.jpg') }}" alt="Foto Profil" class="w-100 border-radius-lg shadow-sm">
                                </div>
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

                    <div class="col-md-8">
                        <div class="mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="mb-3 d-flex justify-content-between align-items-center">
                                        <h6 class="font-weight-bold">Informasi Pribadi</h6>
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
                                                <p><strong>First Name:</strong> <br> {{ $user->first_name ?? 'Tidak tersedia' }}</p>
                                            </div>
                                            <div class="col">
                                                <p><strong>Last Name:</strong> <br> {{ $user->last_name ?? 'Tidak tersedia' }}</p>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col">
                                                <p><strong>Gender:</strong> <br>
                                                    {{ $user->gender == 'M' ? 'Laki-laki' : ($user->gender == 'F' ? 'Perempuan' : 'Tidak tersedia') }}
                                                </p>
                                            </div>
                                            <div class="col">
                                                <p><strong>Umur:</strong> <br> {{ $user->umur ?? 'Tidak tersedia' }}</p>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col">
                                                <p><strong>Email:</strong> <br> {{ $user->email }}</p>
                                            </div>
                                            <div class="col">
                                                <p><strong>Hobi:</strong> <br> {{ $user->hobi ?? 'Tidak tersedia' }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <p><strong>Bio:</strong> <br> {{ $user->bio ?? 'Tidak tersedia' }}</p>
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
                                    {{-- <form action="{{ route('user.update', $user->id) }}" method="POST"> --}}
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Informasi Pribadi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="first_name" class="form-label">First Name</label>
                                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
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
                                                        <option value="M" {{ $user->gender == 'M' ? 'selected' : '' }}>Laki-laki</option>
                                                        <option value="F" {{ $user->gender == 'F' ? 'selected' : '' }}>Perempuan</option>
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
                                        <h6 class="font-weight-bold">Alamat</h6>
                                        <a href="#" class="btn btn-sm btn-rounded text-dark" style="background-color: transparent; border: 1px solid #84ADFF;">
                                            Edit <i class="fa fa-pencil ms-1" style="font-size: 14px"></i>
                                        </a>
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

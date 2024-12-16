@extends('layouts.app')

@section('title', 'Data Kecamatan')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                  <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                  <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Kecamatan</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Kecamatan</h6>
              </nav>
              <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                  <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here.">
                  </div>
                </div>
                <ul class="navbar-nav justify-content-end">
                  <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('profile.edit') }}" class="nav-link text-body font-weight-bold px-0">
                      <i class="fa fa-user me-sm-1"></i>
                      <span class="d-sm-inline d-none">Profile</span>
                    </a>
                  </li>
                  <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                      <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                      <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                  </li>
                  <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-bell cursor-pointer"></i>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                      <li class="mb-2">
                        <a class="dropdown-item border-radius-md" href="javascript:;">
                          <div class="d-flex py-1">
                            <div class="my-auto">
                              <img src="/assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="text-sm font-weight-normal mb-1">
                                <span class="font-weight-bold">New message</span> from Laur
                              </h6>
                              <p class="text-xs text-secondary mb-0 ">
                                <i class="fa fa-clock me-1"></i>
                                13 minutes ago
                              </p>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="mb-2">
                        <a class="dropdown-item border-radius-md" href="javascript:;">
                          <div class="d-flex py-1">
                            <div class="my-auto">
                              <img src="/assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="text-sm font-weight-normal mb-1">
                                <span class="font-weight-bold">New album</span> by Travis Scott
                              </h6>
                              <p class="text-xs text-secondary mb-0 ">
                                <i class="fa fa-clock me-1"></i>
                                1 day
                              </p>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item border-radius-md" href="javascript:;">
                          <div class="d-flex py-1">
                            <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                              <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>credit-card</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                      <g transform="translate(453.000000, 454.000000)">
                                        <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                        <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                      </g>
                                    </g>
                                  </g>
                                </g>
                              </svg>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="text-sm font-weight-normal mb-1">
                                Payment successfully completed
                              </h6>
                              <p class="text-xs text-secondary mb-0 ">
                                <i class="fa fa-clock me-1"></i>
                                2 days
                              </p>
                            </div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
        </nav>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <h1 class="my-4">Data Kecamatan</h1>
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambahan">+ Tambah Kecamatan</button>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered" id="kecamatanTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kabupaten</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kecamatan as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ optional($data->kabupaten)->nama ?? 'Kabupaten tidak ditemukan' }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editKecamatanModal{{ $data->id }}" aria-label="Edit Kecamatan {{ $data->nama }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <!-- Form Hapus -->
                                                <form action="{{ route('kecamatan.destroy', $data->id) }}" method="POST" class="d-inline" id="deleteForm{{ $data->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data {{ $data->nama }}?')"
                                                        aria-label="Hapus Kecamatan {{ $data->nama }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit Data -->
                                        <div class="modal fade" id="editKecamatanModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="editKecamatanModalLabel{{ $data->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editKecamatanModalLabel{{ $data->id }}">Edit Data Kecamatan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('kecamatan.update', $data->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="kabupaten_id">Nama Kabupaten</label>
                                                                <select class="form-control" id="kabupaten_id" name="kabupaten_id">
                                                                    @foreach ($kabupaten as $item)
                                                                        <option value="{{ $item->id }}" {{ $data->kabupaten_id == $item->id ? 'selected' : '' }}>
                                                                            {{ $item->nama }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('kabupaten_id')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="nama">Nama Kecamatan</label>
                                                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama }}">
                                                                @error('nama')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Tambah Data Kecamatan Modal -->
    <div class="modal fade" id="tambahan" tabindex="-1" role="dialog" aria-labelledby="tambahanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahanLabel">Tambah Data Kecamatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kecamatan.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kabupaten_id" class="form-label"> Nama Kabupaten</label>
                            <select class="form-control @error('kabupaten_id') is-invalid @enderror" name="kabupaten_id"
                                id="kabupaten_id">
                                @foreach ($kabupaten as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('kabupaten_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kabupaten_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kecamatan</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" placeholder="Masukkan Nama Kecamatan Anda" value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

        // SweetAlert Notifikasi untuk session 'success'
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '{{ session('success') }}',
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ $errors->first() }}', // Menampilkan pesan error pertama
            });
        @endif

        // SweetAlert konfirmasi hapus
        $('form[id^="deleteForm"]').submit(function (e) {
            e.preventDefault(); // Mencegah form submit langsung
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Mengirimkan form jika yakin
                }
            });
        });
    </script>
@endsection

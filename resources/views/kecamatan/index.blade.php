@extends('layouts.app')

@section('title', 'Data Kecamatan')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
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
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ optional($data->kabupaten)->nama ?? 'Kabupaten tidak ditemukan' }}
                                            </td>
                                            <td>
                                                <!--Tombol Edit -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editKecamatanModal{{ $data->id }}" aria-label="Edit Kecamatan {{ $data->nama }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <!-- Form Hapus -->
                                                <form action="{{ route('kecamatan.destroy', $data->id) }}" method="POST" class="d-inline">
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
                                                                <label for="kabupaten_id"> Nama Kabupaten</label>
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
    </script>
@endsection

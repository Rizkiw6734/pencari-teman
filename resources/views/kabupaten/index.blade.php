@extends('layouts.app')

@section('title', 'Data Kabupaten')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <h1 class="my-4">Data Kabupaten</h1>
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambahan">+ Tambah Kabupaten</button>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered" id="kabupatenTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kabupaten</th>
                                        <th>Nama Provinsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kabupaten as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ optional($data->provinsi)->nama ?? 'Provinsi tidak ditemukan' }}
                                            <td>
                                               <!--Tombil Edit -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editKabupatenModal{{ $data->id }}" aria-label="Edit Kabupaten {{ $data->nama }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <!-- Form Hapus -->
                                                <form action="{{ route('kabupaten.destroy', $data->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data {{ $data->nama }}?')"
                                                        aria-label="Hapus Kabupaten {{ $data->nama }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit Data -->
                                        <div class="modal fade" id="editKabupatenModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="editKabupatenModalLabel{{ $data->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editKabupatenModalLabel{{ $data->id }}">Edit Data Kabupaten</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('kabupaten.update', $data->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="nama">Nama Kabupaten</label>
                                                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama }}">
                                                                @error('nama')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="provinsi_id"> Nama Provinsi</label>
                                                                <select class="form-control" id="provinsi_id" name="provinsi_id">
                                                                    @foreach ($provinsi as $item)
                                                                        <option value="{{ $item->id }}" {{ $data->provinsi_id == $item->id ? 'selected' : '' }}>
                                                                            {{ $item->nama }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('provinsi_id')
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

    <!-- Tambah Data Kabupaten Modal -->
    <div class="modal fade" id="tambahan" tabindex="-1" role="dialog" aria-labelledby="tambahanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahanLabel">Tambah Data Kabupaten</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kabupaten.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kabupaten</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" placeholder="Masukkan Nama Kabupaten Anda" value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="provinsi_id" class="form-label"> Nama Provinsi</label>
                            <select class="form-control @error('provinsi_id') is-invalid @enderror" name="provinsi_id"
                                id="provinsi_id">
                                @foreach ($provinsi as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('provinsi_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('provinsi_id')
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

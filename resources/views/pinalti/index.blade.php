@extends('layouts.app')

@section('title', 'Data Pinalti')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12 col-12">
                <h1 class="my-4">Data Pinalti</h1>

                <a href="{{ route('pinalti.create') }}" class="btn btn-primary mb-3">Tambah Pinalti</a>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pengguna</th>
                                    <th>Jenis Pelanggaran</th>
                                    <th>Alasan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pinalti as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ optional($item->user)->name ?? 'Pengguna tidak ditemukan' }}</td>
                                        <td>{{ $item->jenis_pelanggaran }}</td>
                                        <td>{{ $item->alasan }}</td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm">Detail</a>
                                            <a href="{{ route('pinalti.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('pinalti.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

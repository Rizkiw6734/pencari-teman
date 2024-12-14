@extends('layouts.app')

@section('title', 'Daftar Laporan')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12 col-12">
                <h1 class="my-4">Daftar Laporan</h1>
                <a href="{{ route('laporan.create') }}" class="btn btn-info mb-3">+ Tambah Laporan</a>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Pelapor</th>
                                    <th>Terlapor</th>
                                    <th>Alasan</th>
                                    <th>Status</th>
                                    <th>Bukti</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporans as $laporan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $laporan->pelapor->name }}</td>
                                    <td>{{ $laporan->terlapor->name }}</td>
                                    <td>{{ $laporan->alasan }}</td>
                                    <td>{{ $laporan->status }}</td>
                                    <td>
                                        @if ($laporan->bukti)
                                            <img src="{{ asset('storage/' . $laporan->bukti) }}" alt="Bukti" class="img-thumbnail" style="max-width: 100px;">
                                        @else
                                            <span class="text-muted">Tidak ada bukti</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('laporan.edit', $laporan) }}" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i></a>
                                        <form action="{{ route('laporan.destroy', $laporan) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus data {{ $laporan->pelapor->name }}?')">
                                            <i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $laporans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

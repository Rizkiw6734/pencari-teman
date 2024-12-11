@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12 col-12">
                <h1 class="my-4">Edit Laporan</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="report_id" class="form-label">Pelapor</label>
                                <select name="report_id" id="report_id" class="form-select" required>
                                    <option value="">-- Pilih Pelapor --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $laporan->report_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="reported_id" class="form-label">Terlapor</label>
                                <select name="reported_id" id="reported_id" class="form-select" required>
                                    <option value="">-- Pilih Terlapor --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $laporan->reported_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="bukti" class="form-label">Bukti</label>
                                @if ($laporan->bukti)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $laporan->bukti) }}" alt="Bukti Laporan" class="img-thumbnail" style="max-width: 200px;">
                                    </div>
                                @endif
                                <input type="file" name="bukti" id="bukti" class="form-control" accept="image/*">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah bukti.</small>
                            </div>
                            <div class="mb-3">
                                <label for="alasan" class="form-label">Alasan</label>
                                <textarea name="alasan" id="alasan" rows="4" class="form-control" required>{{ $laporan->alasan }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

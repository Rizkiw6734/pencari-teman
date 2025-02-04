@extends('layouts.user')

@section('title', 'Tambah Laporan')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12 col-12">
                <h1 class="my-4">Tambah Laporan</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="reported_id" class="form-label">Terlapor</label>
                                <select name="reported_id" id="reported_id" class="form-select">
                                    <option value="">-- Pilih Terlapor --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="bukti" class="form-label">Bukti</label>
                                <input type="file" name="bukti" id="bukti" class="form-control" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="alasan" class="form-label">Alasan</label>
                                <textarea name="alasan" id="alasan" rows="4" class="form-control"></textarea>
                            </div>
                            <div class="modal-footer d-flex justify-content-between border-0 mt-2 mx-2">
                                <button type="submit" class="btn btn-danger" style="font-size: 14px; padding: 10px 30px;">Laporkan</button>
                                <button type="button" class="btn btn-secondary" onclick="window.history.back();" style="font-size: 14px; padding: 10px 30px; background-color: #BEB9B9; color: white;">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

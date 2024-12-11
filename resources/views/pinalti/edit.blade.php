@extends('layouts.app')

@section('title', 'Edit Data Pinalti')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12 col-12">
                <h1 class="my-4">Edit Data Pinalti</h1>
                <form action="{{ route('pinalti.update', $pinalti->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="users_id">Pengguna</label>
                                <select class="form-control" id="users_id" name="users_id" required>
                                    <option value="">Pilih Pengguna</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $user->id == $pinalti->users_id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jenis_pelanggaran">Jenis Pelanggaran</label>
                                <input type="text" class="form-control" id="jenis_pelanggaran" name="jenis_pelanggaran"
                                       value="{{ $pinalti->jenis_pelanggaran }}" required>
                            </div>
                            <div class="form-group">
                                <label for="alasan">Alasan</label>
                                <textarea class="form-control" id="alasan" name="alasan" rows="3" required>{{ $pinalti->alasan }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="bukti">Bukti</label>
                                <input type="text" class="form-control" id="bukti" name="bukti"
                                       value="{{ $pinalti->bukti }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_hukuman">Jenis Hukuman</label>
                                <input type="text" class="form-control" id="jenis_hukuman" name="jenis_hukuman"
                                       value="{{ $pinalti->jenis_hukuman }}" required>
                            </div>
                            <div class="form-group">
                                <label for="durasi">Durasi (hari)</label>
                                <input type="number" class="form-control" id="durasi" name="durasi"
                                       value="{{ $pinalti->durasi }}" required>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                       value="{{ $pinalti->start_date }}" required>
                            </div>
                            <div class="form-group">
                                <label for="end_date">Tanggal Berakhir</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                       value="{{ $pinalti->end_date }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('pinalti.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

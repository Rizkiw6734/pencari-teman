@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Laporan</h1>

    <p><strong>Pelapor:</strong> {{ $laporan->pelapor->name }}</p>
    <p><strong>Yang Dilaporkan:</strong> {{ $laporan->terlapor->name }}</p>
    <p><strong>Bukti:</strong> {{ $laporan->bukti }}</p>
    <p><strong>Alasan:</strong> {{ $laporan->alasan }}</p>

    <hr>
    <h2>Berikan Hukuman</h2>

    <!-- Tombol untuk membuka modal -->
    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalPeringatan">
        Kirim Peringatan
    </button>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalSuspend">
        Suspend User
    </button>

    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalBanned">
        Banned User
    </button>

    <!-- Modal Peringatan -->
    <div class="modal fade" id="modalPeringatan" tabindex="-1" aria-labelledby="modalPeringatanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('laporan.hukuman', $laporan->id) }}" method="POST">
                @csrf
                <input type="hidden" name="jenis_hukuman" value="peringatan">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPeringatanLabel">Kirim Peringatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pesan">Pesan Peringatan</label>
                            <textarea name="pesan" id="pesan" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Suspend -->
    <div class="modal fade" id="modalSuspend" tabindex="-1" aria-labelledby="modalSuspendLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('laporan.hukuman', $laporan->id) }}" method="POST">
                @csrf
                <input type="hidden" name="jenis_hukuman" value="suspend">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalSuspendLabel">Suspend User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="durasi">Durasi Suspend (Hari)</label>
                            <input type="number" name="durasi" id="durasi" class="form-control" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="pesan">Pesan Suspend</label>
                            <textarea name="pesan" id="pesan" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Suspend</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Banned -->
    <div class="modal fade" id="modalBanned" tabindex="-1" aria-labelledby="modalBannedLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('laporan.hukuman', $laporan->id) }}" method="POST">
                @csrf
                <input type="hidden" name="jenis_hukuman" value="banned">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBannedLabel">Konfirmasi Banned</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin membanned pengguna ini?</p>
                        <p class="text-danger"><strong>Catatan:</strong> Pengguna ini tidak akan bisa login setelah dibanned.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-dark">Konfirmasi Banned</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pinalti</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Data Pinalti</h1>
        <form action="{{ route('pinalti.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="users_id">Pengguna</label>
                <select class="form-control" id="users_id" name="users_id" required>
                    <option value="">Pilih Pengguna</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jenis_pelanggaran">Jenis Pelanggaran</label>
                <input type="text" class="form-control" id="jenis_pelanggaran" name="jenis_pelanggaran" required>
            </div>
            <div class="form-group">
                <label for="alasan">Alasan</label>
                <textarea class="form-control" id="alasan" name="alasan" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="bukti">Bukti</label>
                <input type="text" class="form-control" id="bukti" name="bukti" required>
            </div>
            <div class="form-group">
                <label for="jenis_hukuman">Jenis Hukuman</label>
                <input type="text" class="form-control" id="jenis_hukuman" name="jenis_hukuman" required>
            </div>
            <div class="form-group">
                <label for="durasi">Durasi (hari)</label>
                <input type="number" class="form-control" id="durasi" name="durasi" required>
            </div>
            <div class="form-group">
                <label for="start_date">Tanggal Mulai</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">Tanggal Berakhir</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pinalti.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>

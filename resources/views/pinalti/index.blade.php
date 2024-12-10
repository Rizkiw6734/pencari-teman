<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pinalti</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Data Pinalti</h1>
        <a href="{{ route('pinalti.create') }}" class="btn btn-primary">Tambah Pinalti</a>
        <table class="table">
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
                            <a href="#" class="btn btn-info">Detail</a>
                            <a href="{{ route('pinalti.edit', $item->id)}}" class="btn btn-warning">Edit</a>
                            <form action="#" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

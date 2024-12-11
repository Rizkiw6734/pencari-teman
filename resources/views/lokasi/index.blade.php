<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi Terdekat AroundYou</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <h1>Lokasi Terdekat AroundYou</h1>

    @foreach($nearbyLocations as $location)
        <div>
            <strong>Provinsi:</strong> {{ $location['provinsi'] }} <br>
            <strong>Kabupaten:</strong> {{ $location['kabupaten'] }} <br>
            <strong>Kecamatan:</strong> {{ $location['kecamatan'] }} <br>
            <strong>Desa:</strong> {{ $location['desa'] }} <br>
            <strong>Jarak:</strong> {{ $location['distance'] }} <br>

            <button onclick="showAlert('{{ $location['desa'] }}', '{{ $location['distance'] }}')">View Location</button>
            <br><br>
        </div>
    @endforeach

    <script>
        function showAlert(desa, distance) {
            Swal.fire({
                title: 'Lokasi Terdekat',
                text: `Desa: ${desa}, Jarak: ${distance}`,
                icon: 'info',
            });
        }
    </script>

</body>
</html>

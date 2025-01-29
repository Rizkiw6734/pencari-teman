<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="image-container" style="text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 100vh; font-family: 'Poppins', sans-serif;">
        <img src="/assets/img/suspend.svg" alt="Descriptive Text" style="max-width: 35%; height: auto;">
        <p style="margin-top: 40px; color: #000000; font-size: 22px;">Halo <b>Alifio Galang</b>,</p>
        <p style="margin-top:-18px; font-size: 22px; color: #000000;">Akun Anda telah <em><b>dibekukan sementara</b></em> karena pelanggaran kebijakan.</p>
        <p style="margin-top:-18px; font-size: 22px; color: #000000;">Untuk informasi lebih lanjut, silakan hubungi tim dukungan kami.</p>
    </div>

    <div class="d-grid gap-5 d-md-flex justify-content-center" style="margin-top:-45px;">
        <button type="button" class="text-danger btn btn-sm btn-rounded me-5"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            style="box-shadow: 0 0 10px hsla(0, 0%, 0%, 0.2); border-radius: 10px; background-color: transparent; border: 2px; font-size: 16px; padding: 10px 20px;">
            <i class="fa fa-ban" aria-hidden="true"></i> Logout
        </button>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <button type="button" class="text-dark btn btn-sm btn-rounded"
            style="box-shadow: 0 0 10px hsla(0, 0%, 0%, 0.2); border-radius: 10px; margin-left: 150px; background-color: transparent; border: 1px; font-size: 16px; padding: 10px 20px;">
            <i class="fa fa-balance-scale" aria-hidden="true"></i> Ajukan Banding
        </button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
</body>
</html>


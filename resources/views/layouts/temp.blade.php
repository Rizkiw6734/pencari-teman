<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Around You</title>
    <link rel="icon" type="image/png" href="/assets/img/logo.jpg">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">
    <!-- Wrapper Container -->
    <div class="min-h-screen flex flex-col">

        <!-- Main Content -->
        @yield('content')

    </div>
    @vite('resources/js/app.js')
</body>
</html>

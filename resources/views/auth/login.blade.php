@extends('layouts.temp')
@section('content')
<section class="min-h-screen flex items-center justify-center relative bg-cover bg-center" style="background-image: url('/images/bg1.svg');">
    <div class="bg-white flex rounded-2xl shadow-lg max-w-3xl p-5 items-center relative bg-cover bg-center" style="background-image: url('/images/vector-log.svg');">
        <div class="md:block hidden w-1/2">
            <img class="rounded-2xl transform scale-x-[-1]" src="/images/bg.svg" alt="Location Search">
        </div>

        <div class="md:w-1/2 px-8 md:px-16">
            <p class="text-[#FFFFFF]">Selamat Datang!</p>
            <h2 class="font-bold text-[#FFFFFF]" style="font-size: 19px">Masuk untuk Melanjutkan</h2>

            <form action="{{ route('login') }}" method="post" class="flex flex-col gap-4">
                @csrf
                <input class="p-2 mt-8 rounded-xl border" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                @error('email')
                <div role="alert" class="bg-red-100 dark:bg-red-900 border-l-4 border-red-500 dark:border-red-700 text-red-900 dark:text-red-100 p-2 rounded-lg flex items-center transition duration-300 ease-in-out hover:bg-red-200 dark:hover:bg-red-800 transform hover:scale-105">
                    <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" class="h-5 w-5 flex-shrink-0 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13 16h-1v-4h1m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            stroke-width="2"
                            stroke-linejoin="round"
                            stroke-linecap="round">
                        </path>
                    </svg>
                    <p class="text-xs font-semibold">{{ $message }}</p>
                </div>
                @enderror

                <div x-data="{ show: false }" class="relative">
                    <input :type="show ? 'text' : 'password'" class="p-2 rounded-xl border w-full" name="password" placeholder="Password">

                    <svg @click="show = !show" :class="{'hidden': !show, 'block': show}"
                        class="h-4 text-purple-700 absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path fill="gray"
                            d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                    </path>
                    </svg>

                    <svg @click="show = !show" :class="{'block': !show, 'hidden': show}"
                        class="h-4 text-purple-700 absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <path fill="gray"
                            d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                    </path>
                    </svg>
                </div>
                @error('password')
                <div role="alert" class="bg-red-100 dark:bg-red-900 border-l-4 border-red-500 dark:border-red-700 text-red-900 dark:text-red-100 p-2 rounded-lg flex items-center transition duration-300 ease-in-out hover:bg-red-200 dark:hover:bg-red-800 transform hover:scale-105">
                    <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" class="h-5 w-5 flex-shrink-0 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13 16h-1v-4h1m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            stroke-width="2"
                            stroke-linejoin="round"
                            stroke-linecap="round">
                        </path>
                    </svg>
                    <p class="text-xs font-semibold">{{ $message }}</p>
                </div>
                @enderror

                <button class="bg-[#2970FF] rounded-xl text-white py-2 hover:scale-105 duration-300">Login</button>
            </form>

            <div class="mt-5 text-xs border-b border-[#FFFFFF] py-4 text-[#FFFFFF]">
                <a href="#">Lupa Kata Sandi?</a>
            </div>

            <div class="mt-3 text-xs flex justify-between items-center">
                <p class="text-[#FFFFFF]">Belum Punya Akun?</p>
                <a href="{{ route('register') }}" class="py-2 px-5 bg-white border rounded-xl hover:scale-110 duration-300 text-[#1E1E1E]">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
    <script>
        @auth
            // Menyertakan token API dari session jika user login
            const userToken = "{{ auth()->user()->createToken('PencariTeman')->plainTextToken }}";
            console.log('User sedang login:', userToken);
        @else
            const userToken = null;  // Jika user belum login, tidak ada token
            console.log('User belum login');
        @endauth

        // Jika ada token dan pengguna login
        if (userToken) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Kirim data ke backend untuk memperbarui lokasi user
                    fetch('/update-location', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${userToken}`  // Menggunakan token yang telah diambil
                        },
                        body: JSON.stringify({ latitude, longitude })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal memperbarui lokasi');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Lokasi diperbarui:', data);
                        // Anda bisa menambahkan sesuatu setelah lokasi diperbarui
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memperbarui lokasi.');
                    });
                },
                function (error) {
                    console.error('Error mendapatkan lokasi:', error);
                    alert('Tidak dapat memperoleh lokasi Anda.');
                }
            );
        }
    </script>
</section>
@endsection

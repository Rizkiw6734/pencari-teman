@extends('layouts.temp')
@section('content')
<section class="min-h-screen flex items-center justify-center relative bg-cover bg-center" style="background-image: url('/images/bg1.svg');">
    <div class="bg-white flex rounded-2xl shadow-lg max-w-3xl p-5 items-center relative bg-cover bg-center" style="background-image: url('/images/vector-reg.svg');">     
        <div class="md:w-1/2 px-8 md:px-16">
            <p class="text-[#FFFFFF]">Selamat Datang!</p>
            <h2 class="font-bold text-[#FFFFFF]" style="font-size: 19px">Silahkan Daftar Akun</h2>
    
            <form action="{{ route('register') }}" method="post" class="flex flex-col gap-4">
                @csrf
                <input class="p-2 mt-8 rounded-xl border" id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Full Name">
                @error('name')
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

                <input class="p-2 rounded-xl border" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
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

                <input class="p-2 rounded-xl border" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password">
                @error('password_confirmationl')
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

                <button class="bg-[#2970FF] rounded-xl text-white py-2 hover:scale-105 duration-300">Daftar</button>
            </form>
    
            <div class="text-xs border-b border-[#FFFFFF] py-4 text-[#FFFFFF]"></div>
    
            <div class="mt-3 text-xs flex justify-between items-center">
                <p class="text-[#FFFFFF]">Sudah Punya Akun?</p>
                <a href="{{ route('login') }}" class="py-2 px-5 bg-white border rounded-xl hover:scale-110 duration-300 text-[#1E1E1E]">
                    Masuk Sekarang
                </a>
            </div>
        </div>

        <div class="md:block hidden w-1/2">
            <img class="rounded-2xl" src="/images/bg.svg" alt="Location Search">
        </div>
    </div>    
</section>
@endsection

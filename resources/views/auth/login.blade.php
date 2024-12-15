@extends('layouts.temp')
@section('content')
<section class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5 items-center">
        <div class="md:w-1/2 px-8 md:px-16">
            <h2 class="font-bold text-center text-2xl text-[#002D74]">Sign In</h2>
            <p class="text-xs text-center mt-4 text-[#002D74]">If you are already a member, easily log in</p>

            <form action="{{ route('login') }}" method="post" class="flex flex-col gap-4">
                @csrf
                <input class="p-2 mt-8 rounded-xl border" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
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
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                
                <button class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300">Sign In</button>
            </form>
        
            <div class="mt-6 grid grid-cols-3 items-center text-gray-400">
                <hr class="border-gray-400">
                <p class="text-center text-sm">OR</p>
                <hr class="border-gray-400">
            </div>
        
            <button class="bg-white border py-2 w-full rounded-xl mt-5 flex justify-center items-center text-sm hover:scale-105 duration-300 text-[#002D74]">
                <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="25px">
                    <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z" />
                    <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z" />
                    <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z" />
                    <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z" />
                </svg>
                Login with Google
            </button>
        
            <div class="mt-5 text-xs border-b border-[#002D74] py-4 text-[#002D74]">
                <a href="#">Forgot your password?</a>
            </div>
        
            <div class="mt-3 text-xs flex justify-between items-center text-[#002D74]">
                <p>Don't have an account?</p>
                <a href="{{ route('register') }}" class="py-2 px-5 bg-white border rounded-xl hover:scale-110 duration-300">
                    Sign Up
                </a>
            </div>                
        </div>

        <div class="md:block hidden w-1/2">
            <img class="rounded-2xl" src="/images/bg.svg" alt="Location Search">
        </div>     
    </div>
</section>
@endsection

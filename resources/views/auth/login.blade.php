@extends('layout.app')

@section('content')
<section class="h-screen">
    <div class="h-full flex flex-wrap items-center">
        <!-- Left column container with two stacked images (visible on medium screens and up) -->
        <div class="relative hidden lg:w-1/2 lg:block h-full">
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="{{ asset('assets/image/Background-pola.jpg') }}" alt="Background Image" class="w-full h-full object-cover">
            </div>

            <!-- Foreground Image -->
            <div class="absolute inset-0 flex justify-center items-center">
                <img src="{{ asset('assets/image/img-index.png') }}" alt="Centered Image" class="w-1/2 h-auto">
            </div>
        </div>

        <!-- Right column container (Login Form) -->
        <div class="w-full lg:w-5/12 xl:w-5/12 p-5">
            <img src="{{asset('assets/image/icon-karawang.png')}}" class="" alt="" srcset="">
            <h1 class="mt-4 font-bold text-lg">Login Ke Sistem</h1>
            <h5 class="mt-2 font-medium text-sm">Masukkan email dan password Anda</h5>

            @if ($errors->any())
                <div class="mb-4 bg-red-500 rounded p-3  text-white ">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            
            <form method="POST" action="{{ route('authenticate') }}" class="mt-4">
                @csrf
                <!-- Email input -->
                <div class="mb-5">
                    <label for="email" class="block hidden mb-2 text-sm font-semibold text-gray-900 dark:text-white">Email</label>
                    <input type="email" id="email" name="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan Email" value="{{ old('email') }}" required />
                </div>

                <!-- Password input -->
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white hidden">Password</label>
                    <input type="password" id="password" name="password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan Password" required />
                </div>

                <!-- Remember me checkbox and Forgot password link -->
                <div class="mb-6 flex items-center justify-between">
                    <div class="mb-2">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display(['data-size' => 'normal']) !!}
                    </div>
                   
                </div>
                
                <!-- Login button -->
                
                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold text-sm py-2.5 rounded-lg hover:bg-blue-700">
                    Login
                </button>

                <!-- Register link -->
                <p class="mt-4 text-sm">
                    Belum punya akun? <a href="{{url('register')}}" class="text-blue-600 hover:underline">Daftar</a>
                </p>
            </form>
        </div>
    </div>
</section>

@endsection

@extends('layout.app')

@section('content')
    <section class="h-screen">
        <div class="h-full flex flex-wrap items-center">
            <!-- Left column container with two stacked images (visible on medium screens and up) -->
            <div class="relative hidden lg:w-1/2 lg:block h-full">
                <div class="absolute inset-0">
                    <img src="{{ asset('assets/image/Background-pola.jpg') }}" alt="Background Image"
                        class="w-full h-full object-cover">
                </div>
                <div class="absolute inset-0 flex justify-center items-center">
                    <img src="{{ asset('assets/image/img-index.png') }}" alt="Centered Image" class="w-1/2 h-auto">
                </div>
            </div>

            <!-- Right column container (Login Form) -->
            <div class="w-full lg:w-5/12 xl:w-5/12 px-10">
                <img src="{{ asset('assets/image/icon-karawang.png') }}" class="" alt="" srcset="">
                <h1 class="my-4 font-bold text-lg ">Buat Akun</h1>

                <form action="{{ url('register') }}" method="POST">
                    @csrf
                    <!-- Username -->
                    <div class="mb-5">
                        <label for="nama_lengkap"
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white hidden">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap"
                            class="bg-gray-50 border @error('nama_lengkap') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Nama Lengkap" required>
                        @error('nama_lengkap')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-5">
                        <label for="email"
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white hidden">Email</label>
                        <input type="email" id="email" name="email"
                            class="shadow-sm bg-gray-50 border @error('email') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Masukan Email" required />
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label for="password"
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white hidden">Password</label>
                        <input type="password" id="password" name="password"
                            class="shadow-sm bg-gray-50 border @error('password') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Masukan Password" required />
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="mb-5">
                        <label for="password_confirmation"
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white hidden">Konfirmasi
                            Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Konfirmasi Password" required />
                    </div>
                    <div class="mb-2">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display(['data-size' => 'normal']) !!}
                    </div>

                    @error('g-recaptcha-response')
                        <p class="text-red-500 text-sm my-1">{{ $message }}</p>
                    @enderror
                    <!-- Submit button -->
                    <button type="submit"
                        class="w-full bg-blue-600 text-white font-semibold text-sm py-2.5 rounded-lg hover:bg-blue-700">
                        Daftar
                    </button>
                    <a href="{{url('login')}}"
                        class="my-2 flex justify-center font-semibold text-sm items-center bg-slate-600 rounded-lg text-white py-2.5">
                        kembali
                </a>
                </form>
            </div>
        </div>
    </section>
@endsection

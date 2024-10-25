@extends('layout.app')

@section('content')
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar styling for WebKit browsers */
        .scrollbar-custom::-webkit-scrollbar {
            width: 2px;
            border-radius: 30px;
        }

        .scrollbar-custom::-webkit-scrollbar-track {
            background: none;
            /* Background color of the track */
            border-radius: 50px;
            /* Radius of the track */
        }

        .scrollbar-custom::-webkit-scrollbar-thumb {
            background-color: #00aaff;
            /* Light blue color of the scrollbar thumb */
            border-radius: 10px;
            /* Radius of the thumb */
        }

        .scrollbar-custom::-webkit-scrollbar-thumb:hover {
            background-color: #007acc;
            /* Darker blue color of the thumb on hover */
        }

        /* Firefox scrollbar styling */
        .scrollbar-custom {
            scrollbar-width: thin;
            /* Thin scrollbar */
            scrollbar-color: #169de0 #00000000;
            /* Light blue thumb color and black track color */
            border-radius: 20px
        }

        .responsive-nav {
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .responsive-img {
                max-width: 47%;
            }

            .responsive-button {
                width: 27%;
                height: 6%;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 0.875rem;
            }

            .responsive-nav {
                font-size: 10px;
            }

            .text-index {
                font-size: 14px
            }

            .icon {
                width: 20%;
            }

            .link {
                justify-content: end;
            }
        }

        @media (max-width: 480px) {
            .responsive-img {
                max-width: 75%;
            }

            .responsive-button {
                width: 44%;
                height: 4%;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 0.75rem;
                padding: 0.5rem;
            }

            .text-index {
                font-size: 12px;
            }

            .responsive-nav {
                font-size: 0.75rem;
            }

            .responsive-navbar {
                padding: 0.5rem;
                display: flex;
                justify-content: center;
            }

            .icon {
                display: none;
            }

            .img-icon {
                display: none;
            }

            .link {
                justify-content: start;
            }

            .video {
                padding: none
            }

            .text-video {
                font-size: 14px
            }
        }

        /* Media query for screens 1024px and larger */
        @media (max-width: 1024px) {
            .link {
                justify-content: end;
                padding: 20px;
            }
        }

        /* Ensure video covers full container height */
        .video-container {
            height: 100vh;
        }
    </style>


    @if (session('logout_message'))
        <div id="logoutMessage" class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 md:w-1/3">
                <h2 class="text-lg font-semibold mb-4">Informasi</h2>
                <p>{{ session('logout_message') }}</p>
                <div class="mt-4 flex justify-end">
                    <button id="closeButton" class="bg-blue-500 text-white py-2 px-4 rounded">Tutup</button>
                </div>
            </div>
        </div>
    @endif



    <script>
        document.getElementById('closeButton')?.addEventListener('click', function() {
            document.getElementById('logoutMessage').style.display = 'none'; // Menyembunyikan modal
        });
    </script>


    <div class="relative w-full h-auto max-w-full video-container">
        <!-- Video -->
        <video class="w-full h-full object-cover" autoplay muted loop>
            <source src="{{ asset('assets/video/projek-index.mp4') }}" type="video/mp4">
        </video>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/95 to-transparent z-10"></div>

        <!-- Navbar -->
        <nav class="absolute top-0 left-0 w-full flex flex-row justify-center items-center p-3 z-40 responsive-navbar">
            <d class="img-icon flex justify-center w-1/2 mr-28 p-1">
                <img src="{{ asset('assets/image/icon-karawang.png') }}"
                    class="icon m-1 h-13 flex justify-center items-center">
                <img src="{{ asset('assets/image/icon-paud.png') }}" alt=""
                    class="icon m-1 h-13 flex justify-center items-center">
            </d>

            <div class="container flex justify-start ml-28 link">
                <ul class="flex space-x-4 sm:space-x-6 md:space-x-8">
                    <a href=""
                        class="responsive-nav text-slate-400 text-xs sm:text-base md:text-lg hover:underline select-none flex justify-center items-center">Beranda</a>
                    <a href="#artikel"
                        class="responsive-nav text-slate-400 text-sm sm:text-base md:text-lg hover:underline select-none flex justify-center items-center">Artikel</a>
                </ul>
            </div>
        </nav>

        <!-- Image and button vertically aligned -->
        <div
            class="absolute inset-0 flex flex-col justify-center items-center z-20 space-y-4 sm:space-y-6 md:space-y-8 p-3">
            <d class="flex flex-col justify-center items-center mt-2">
                <h2 class="text-index text-white text-xl font-semibold select-none">Aplikasi Paud</h2>
                <h3 class="text-index text-white text-sm select-none">Aplikasi Ijin Pendirian Pendidikan Anak Usia Dini</h3>
            </d>

            <img src="{{ asset('assets/image/img-index.png') }}" alt="Image" class="responsive-img w-96 h-auto mt-20">
            <a href="{{ url('login') }}"
                class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 responsive-button w-48 h-8 flex justify-center items-center select-none">
                Masuk
            </a>
        </div>
    </div>


    <div class="container mt-20 mx-auto">
        <!-- Bagian judul artikel -->
        <div class="flex flex-col justify-center text-center mb-6" id="artikel">
            <h1 class="text-2xl font-bold">Artikel Terbaru</h1>
            <h5 class="text-sm font-medium">Beberapa artikel terbaru terkait Paud</h5>
        </div>

        <!-- Card Carousel -->
        <div class="container mx-auto">
            <div class="scrollbar-custom flex overflow-x-auto space-x-4 px-10">
                <!-- Card 1 -->
                <a href="">
                    <div
                        class="min-w-[350px] max-w-[350px] h-[400px] bg-white shadow-lg rounded-lg overflow-hidden flex-shrink-0 flex flex-col">
                        <img src="{{ asset('assets/image/news.jpg') }}" alt="image" class="w-full h-auto object-cover">
                        <div class="p-4 flex-grow">
                            <h2 class="font-bold" style="font-size: 18px">Kak Seto sebut pentingnya TK-Paud untuk
                                Perkembangan Anak</h2>
                            <p class="text-sm mt-2 font-semibold">Seto Mulyadi, menjelaskan pentingnya TK dan Paud bagi
                                perkembangan anak.</p>
                            <p class="text-xs mt-2 font-medium">Ditulis oleh: editorPaud</p>
                            <p class="text-xs font-medium">Dipublikasikan: Rabu, 10 Jul 2024 14:00 WIB</p>
                        </div>
                    </div>
                </a>

                <!-- Card 2 -->
                <a href="">
                    <div
                        class="min-w-[350px] max-w-[350px] h-[400px] bg-white shadow-lg rounded-lg overflow-hidden flex-shrink-0 flex flex-col">
                        <img src="{{ asset('assets/image/news.jpg') }}" alt="image" class="w-full h-auto object-cover">
                        <div class="p-4 flex-grow">
                            <h2 class="font-bold" style="font-size: 18px">Kak Seto sebut pentingnya TK-Paud untuk
                                Perkembangan Anak</h2>
                            <p class="text-sm mt-2 font-semibold">Seto Mulyadi, menjelaskan pentingnya TK dan Paud bagi
                                perkembangan anak.</p>
                            <p class="text-xs mt-2 font-medium">Ditulis oleh: editorPaud</p>
                            <p class="text-xs font-medium">Dipublikasikan: Rabu, 10 Jul 2024 14:00 WIB</p>
                        </div>
                    </div>
                </a>

                <a href="">
                    <div
                        class="min-w-[350px] max-w-[350px] h-[400px] bg-white shadow-lg rounded-lg overflow-hidden flex-shrink-0 flex flex-col">
                        <img src="{{ asset('assets/image/news.jpg') }}" alt="image" class="w-full h-auto object-cover">
                        <div class="p-4 flex-grow">
                            <h2 class="font-bold" style="font-size: 18px">Kak Seto sebut pentingnya TK-Paud untuk
                                Perkembangan Anak</h2>
                            <p class="text-sm mt-2 font-semibold">Seto Mulyadi, menjelaskan pentingnya TK dan Paud bagi
                                perkembangan anak.</p>
                            <p class="text-xs mt-2 font-medium">Ditulis oleh: editorPaud</p>
                            <p class="text-xs font-medium">Dipublikasikan: Rabu, 10 Jul 2024 14:00 WIB</p>
                        </div>
                    </div>
                </a>

                <a href="">
                    <div
                        class="min-w-[350px] max-w-[350px] h-[400px] bg-white shadow-lg rounded-lg overflow-hidden flex-shrink-0 flex flex-col">
                        <img src="{{ asset('assets/image/news.jpg') }}" alt="image" class="w-full h-auto object-cover">
                        <div class="p-4 flex-grow">
                            <h2 class="font-bold" style="font-size: 18px">Kak Seto sebut pentingnya TK-Paud untuk
                                Perkembangan Anak</h2>
                            <p class="text-sm mt-2 font-semibold">Seto Mulyadi, menjelaskan pentingnya TK dan Paud bagi
                                perkembangan anak.</p>
                            <p class="text-xs mt-2 font-medium">Ditulis oleh: editorPaud</p>
                            <p class="text-xs font-medium">Dipublikasikan: Rabu, 10 Jul 2024 14:00 WIB</p>
                        </div>
                    </div>
                </a>



                <a href="">
                    <div
                        class="min-w-[350px] max-w-[350px] h-[400px] bg-white shadow-lg rounded-lg overflow-hidden flex-shrink-0 flex flex-col">
                        <img src="{{ asset('assets/image/news.jpg') }}" alt="image" class="w-full h-auto object-cover">
                        <div class="p-4 flex-grow">
                            <h2 class="font-bold" style="font-size: 18px">Kak Seto sebut pentingnya TK-Paud untuk
                                Perkembangan Anak</h2>
                            <p class="text-sm mt-2 font-semibold">Seto Mulyadi, menjelaskan pentingnya TK dan Paud bagi
                                perkembangan anak.</p>
                            <p class="text-xs mt-2 font-medium">Ditulis oleh: editorPaud</p>
                            <p class="text-xs font-medium">Dipublikasikan: Rabu, 10 Jul 2024 14:00 WIB</p>
                        </div>
                    </div>
                </a>


                <a href="">
                    <div
                        class="min-w-[350px] max-w-[350px] h-[400px] bg-white shadow-lg rounded-lg overflow-hidden flex-shrink-0 flex flex-col">
                        <img src="{{ asset('assets/image/news.jpg') }}" alt="image" class="w-full h-auto object-cover">
                        <div class="p-4 flex-grow">
                            <h2 class="font-bold" style="font-size: 18px">Kak Seto sebut pentingnya TK-Paud untuk
                                Perkembangan Anak</h2>
                            <p class="text-sm mt-2 font-semibold">Seto Mulyadi, menjelaskan pentingnya TK dan Paud bagi
                                perkembangan anak.</p>
                            <p class="text-xs mt-2 font-medium">Ditulis oleh: editorPaud</p>
                            <p class="text-xs font-medium">Dipublikasikan: Rabu, 10 Jul 2024 14:00 WIB</p>
                        </div>
                    </div>
                </a>

                <!-- Tambahkan card lainnya jika diperlukan -->
            </div>
        </div>
    </div>



    <div class="container mt-5 p-14 video">
        <div class="flex flex-col justify-center text-center mb-9">
            <h1 class="text-2xl font-bold text-video">Video</h1>
            <h5 class="text-sm font-medium text-video">Recomended videos about Pre-school Education</h5>
        </div>
        <div class="flex flex-col md:flex-row justify-center space-y-5 md:space-y-0 md:space-x-5">
            <!-- Video 1 -->
            <div class="w-full md:w-1/2 flex justify-center">
                <div class="relative w-full h-0 pb-[56.25%]">
                    <iframe class="absolute top-0 left-0 w-full h-full rounded-xl"
                        src="https://www.youtube.com/embed/eYc9t0SnTJA?si=nxArkJGOJKQ4Szdf" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>

            <!-- Video 2 -->
            <div class="w-full md:w-1/2 flex justify-center">
                <div class="relative w-full h-0 pb-[56.25%]">
                    <iframe class="absolute top-0 left-0 w-full h-full rounded-xl"
                        src=https://www.youtube.com/embed/isx48MpkQNg?si=1k_kYWXk5rUPqzOY" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>








    <div class="container mt-20 mx-auto p-5">
        <div class="flex flex-col justify-center text-center mb-6">
            <h1 class="text-2xl font-bold">Saran & Masukan</h1>
            <h5 class="text-sm font-medium">Berikan masukan & saran untuk layanan Aplikasi Pendirian PAUD</h5>
        </div>

        <form class="max-w-sm mx-auto">
            <div class="mb-5">
                <input type="text" id="base-input"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Masukan Emal">
            </div>
            <div class="mb-5">
                <textarea id="message" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Saran/Masukan"></textarea>
            </div>
            <button type="button"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kirim</button>
        </form>

    </div>



    <div class="flex flex-col justify-center text-center m-10">
        <h1 class="text-2xl font-bold">Survey Kepuasan</h1>
        <h5 class="text-sm font-medium">Isi survey kepuasan layanan Aplikasi Pendirian Pendidikan Anak Usia Dini <a
                href="https://example.com" class="text-blue-500 hover:underline">DISINI</a> </h5>
    </div>

    <footer class="bg-indigo-950 text-white py-8">
        <div class="flex flex-col md:flex-row justify-center items-center p-4">
            <div class="flex flex-col items-center">
                <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-1">
                    <!-- Content Links -->
                    <div>
                        <h4 class="font-bold mb-4">Content</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:underline text-sm text-slate-400">Beranda</a></li>
                            <li><a href="#artikel" class="hover:underline text-sm text-slate-400">Article</a></li>
                        </ul>
                    </div>

                    <!-- Legal Links -->
                    <div>
                        <h4 class="font-bold mb-4">Legal</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:underline text-sm text-slate-400">Terms of Service</a></li>
                            <li><a href="#" class="hover:underline text-sm text-slate-400">Privacy Policy</a></li>
                        </ul>
                    </div>

                    <!-- Other Websites -->
                    <div>
                        <h4 class="font-bold mb-4">Other Websites</h4>
                        <ul class="space-y-2">
                            <li><a href="https://siketan.id/" class="hover:underline text-sm text-slate-400">Siketan</a>
                            </li>
                            <li><a href="https://jdih.karawangkab.go.id/"
                                    class="hover:underline text-sm text-slate-400">JDIH Karawang</a></li>
                            <li><a href="https://tangkas.karawangkab.go.id/"
                                    class="hover:underline text-sm text-slate-400">TANGKAS Karawang</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Address and Map -->
                <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                    <div>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <i class="fa-sharp-duotone fa-solid fa-location-dot fa-xl"
                                    style="--fa-primary-color: #2e4e84; margin-right:10px; --fa-secondary-color: #010a18;"></i>
                                Jl. Jenderal Ahmad Yani No.1, Nagasari, Kec. Karawang Bar., Karawang, Jawa Barat 41314
                            </li>
                            <li class="flex items-center">
                                <i class="fa-sharp-duotone fa-solid fa-envelope fa-lg" style=" margin-right:10px;"></i>
                                distan@karawangkab.go.id
                            </li>
                            <li class="flex items-center">
                                <i class="fa-sharp-duotone fa-solid fa-phone fa-lg" style=" margin-right:10px;"></i>
                                (0267) 413085
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Live Google Map -->
            <div class="w-full md:w-auto mt-8 md:mt-0 md:ml-4">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3020.753733141047!2d107.30277237355556!3d-6.302115061674703!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e697759c746debb%3A0xe82f1338f5903b48!2sDinas%20Komunikasi%20dan%20Informatika%20Kab%20Karawang!5e1!3m2!1sid!2sid!4v1726022035636!5m2!1sid!2sid"
                    class="w-full h-64 md:w-[500px] md:h-[300px]" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="container mx-auto text-center border-t border-white mt-8 p-4 text-sm">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0 flex justify-center items-center mx-4">
                    <img src="{{ asset('assets/image/icon-karawang.png') }}"
                        class="icon m-1 h-13 flex justify-center items-center">
                    <div class="text-start flex flex-col mx-2">
                        <p>APLIKASI PENDIRIAN PENDIDIKAN ANAK USIA DINI (PAUD)</p>
                        <p> Hasil Sinergi DPKP & DISKOMINFO Karawang</p>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="hover:opacity-75"><img src="{{ asset('assets/icons/facebook.svg') }}"
                            alt="Facebook"></a>
                    <a href="#" class="hover:opacity-75"><img src="{{ asset('assets/icons/twitter.svg') }}"
                            alt="Twitter"></a>
                    <a href="#" class="hover:opacity-75"><img src="{{ asset('assets/icons/instagram.svg') }}"
                            alt="Instagram"></a>
                    <a href="#" class="hover:opacity-75"><img src="{{ asset('assets/icons/linkedin.svg') }}"
                            alt="LinkedIn"></a>
                </div>
            </div>
            <div class="mt-4">
                ©2024 PAUD Hak Cipta Dilindungi.
            </div>
            <div class="mt-2">
                v1.0.0
            </div>
        </div>
    </footer>
@endsection

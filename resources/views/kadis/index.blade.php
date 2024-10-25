@extends('layout.app')

@section('content')
    @include('layout.nav.sidebarkadis.sidebar')


    @if (session('login_message'))
        <div id="loginPopup"
            class="fixed z-50 inset-0 flex items-center justify-center bg-black bg-opacity-50 transition-opacity duration-300 ease-out">
            <div class="bg-white p-6 rounded-lg shadow-lg transform transition-transform duration-500 ease-out scale-95 opacity-0"
                id="popupContent">
                <div class="text-lg font-semibold mb-6 text-center text-gray-800">Success!</div>

                <!-- Icon checklist dengan animasi bounce dan transform -->
                <div class="flex justify-center mb-4">
                    <i class="fa-solid fa-check fa-xl text-2xl text-green-500 animate-checkmark" style="font-size: 60px"></i>
                </div>

                <p class="text-gray-600 text-center my-5">{{ session('login_message') }}</p>

                <!-- Tombol dengan delay muncul setelah animasi checklist selesai -->
                <div class="text-center opacity-0 transition-opacity delay-700" id="popupButton">
                    <button onclick="closePopup()"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-10 rounded focus:outline-none focus:shadow-outline">Tutup</button>
                </div>
            </div>
        </div>

        <style>
            /* Animasi checklist bounce dan scale yang lebih hidup */
            @keyframes checkmarkBounce {
                0% {
                    transform: scale(0);
                    opacity: 0;
                }

                40% {
                    transform: scale(1.2);
                    opacity: 1;
                    color: #22c55e;
                    /* hijau cerah */
                }

                60% {
                    transform: scale(0.9);
                    color: #16a34a;
                    /* hijau lebih gelap */
                }

                100% {
                    transform: scale(1);
                    color: #10b981;
                    /* hijau stabil */
                }
            }

            /* Terapkan animasi pada icon checklist */
            .animate-checkmark {
                animation: checkmarkBounce 1s cubic-bezier(0.68, -0.55, 0.27, 1.55) forwards;
                /* Lebih smooth dan elastis */
            }

            /* Animasi fade-in popup */
            .animate-popup {
                opacity: 0;
                transform: scale(0.9);
                animation: popupFade 0.5s ease-out forwards;
            }

            /* Keyframes untuk animasi popup */
            @keyframes popupFade {
                0% {
                    opacity: 0;
                    transform: scale(0.9);
                }

                100% {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            /* Tombol delay muncul setelah animasi checklist selesai */
            .animate-button {
                animation: buttonFade 0.7s ease-out forwards;
            }

            @keyframes buttonFade {
                0% {
                    opacity: 0;
                    transform: scale(0.9);
                }

                100% {
                    opacity: 1;
                    transform: scale(1);
                }
            }
        </style>

        <script>
            // Membuat animasi fade-in ketika popup muncul
            document.addEventListener('DOMContentLoaded', function() {
                const popup = document.getElementById('popupContent');
                const button = document.getElementById('popupButton');
                setTimeout(function() {
                    popup.classList.remove('opacity-0', 'scale-95');
                    popup.classList.add('opacity-100', 'scale-100', 'animate-popup');
                }, 100); // Delay untuk memastikan transisi terlihat

                // Tombol muncul setelah animasi checklist selesai
                setTimeout(function() {
                    button.classList.add('opacity-100', 'animate-button');
                }, 1000); // Delay lebih lama agar tombol muncul setelah checklist selesai
            });

            function closePopup() {
                const popup = document.getElementById('loginPopup');
                popup.classList.add('opacity-0'); // Animasi fade-out
                setTimeout(function() {
                    popup.style.display = 'none'; // Hilangkan setelah animasi selesai
                }, 300);
            }
        </script>
    @endif



    <div class="p-4 sm:ml-64">
        <div class="py-24 mt-14">
            <div class="flex justify-center items-center h-[65vh] px-8 pt-10">
                <div class="text-center w-full">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                        @foreach ($statuses as $status)
                            @php
                                // Pilih warna acak dari array colors (biru, merah, hijau)
                                $randomColor = $colors[array_rand($colors)];
                            @endphp
                            <!-- Gabungkan color dan pakai string class -->
                            <div
                                class="bg-{{ $randomColor }} text-white p-6 rounded-lg shadow-md flex flex-col items-center justify-center h-32">
                                <div class="text-sm font-semibold">{{ $status->name }}</div>
                                <div class="text-2xl font-bold">{{ $statusCounts[$status->id] ?? 0 }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

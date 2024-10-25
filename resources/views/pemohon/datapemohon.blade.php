@extends('layout.app')

@section('content')
    @if (session('login_message'))
        <div id="loginPopup"
            class="fixed z-50 inset-0 flex items-center justify-center bg-black bg-opacity-50 transition-opacity duration-300 ease-out">
            <div class="bg-white p-6 rounded-lg shadow-lg transform transition-transform duration-500 ease-out scale-95 opacity-0 max-w-md w-full lg:max-w-lg"
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
            document.addEventListener('DOMContentLoaded', function() {
                const popup = document.getElementById('popupContent');
                const button = document.getElementById('popupButton');
                setTimeout(function() {
                    popup.classList.remove('opacity-0', 'scale-95');
                    popup.classList.add('opacity-100', 'scale-100', 'animate-popup');
                }, 100);

                setTimeout(function() {
                    button.classList.add('opacity-100', 'animate-button');
                }, 1000);
            });

            function closePopup() {
                const popup = document.getElementById('loginPopup');
                popup.classList.add('opacity-0');
                setTimeout(function() {
                    popup.style.display = 'none';
                }, 300);
            }
        </script>
    @endif

    <div class="flex justify-center items-center mx-5 md:mx-16 lg:mx-32 xl:mx-40 py-10">
        <div class="p-5 w-full max-w-4xl mx-auto border rounded-lg shadow-md">
            <div class="w-full border-b-8 border-blue-600 p-7">
                <h1 class="text-lg md:text-xl lg:text-2xl font-semibold">Data Pemohon</h1>
            </div>
            <div class="bg-red-500 p-4 mt-8 rounded-lg">
                <h1 class="text-lg font-bold text-white">PERHATIAN</h1>
                <p class="text-white text-sm md:text-base">Dalam pengajuan permohonan Surat Izin Operasional Satuan PAUD, mohon untuk
                    mengisi data dengan akurat dan lengkap. Informasi yang tepat sangat penting untuk kelancaran proses
                    verifikasi dan persetujuan. Kesalahan atau kekurangan data dapat menyebabkan keterlambatan atau
                    penolakan permohonan. Dan jangan lupa untuk periksa kembali setiap kolom formulir sebelum mengirimkan.
                </p>
            </div>

            <form method="POST" action="{{ route('user.update') }}" class="mt-10 w-full mx-auto">
                @csrf
                @method('PATCH')

                <!-- Form fields here -->
                @foreach ([
            'no_ktp_paspor_kitas' => 'No KTP/PASSPOR/KITAS',
            'no_npwp' => 'No NPWP',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'provinsi' => 'Provinsi',
            'kota_kab' => 'Kota/Kabupaten',
            'desa_kelurahan' => 'Desa/Kelurahan',
            'handphone' => 'Nomor Handphone',
        ] as $field => $label)
                    <div class="mb-5">
                        <label for="{{ $field }}"
                            class="block mb-2 text-sm font-medium text-gray-900">{{ $label }}</label>
                        <input type="{{ $field === 'tanggal_lahir' ? 'date' : 'text' }}" id="{{ $field }}"
                            name="{{ $field }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full sm:w-3/4 md:w-1/2 lg:w-2/3 p-2.5"
                            value="{{ old($field, $user->$field) }}">
                        @error($field)
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach

                <div class="text-center mt-6">
                    <button type="submit"
                        class="bg-blue-600 text-white font-semibold text-sm px-5 md:px-10 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

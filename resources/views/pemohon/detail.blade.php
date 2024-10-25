@extends('layout.app')

@section('content')
    <div class="p-5 sm:p-10 lg:p-20 bg-slate-100">

        <div class="container mx-auto p-5 sm:p-10 shadow-xl border bg-white rounded-xl">
            <a class="bg-slate-600 text-white py-2 px-4 sm:px-7 rounded-sm mt-2 inline-block"
                href="{{ url()->previous() }}">Back</a>
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold my-6">Detail Permohonan Izin Operasional PAUD</h1>

            <!-- Status Permohonan -->
            <div class="bg-gray-100 p-4 sm:p-6 rounded-lg mb-6">
                <span class="font-bold">Status Permohonan:</span>
                <span class="text-orange-500">{{ $permohonan->status->name }}</span>
            </div>

            <!-- Detail Informasi -->
            <div class="bg-white p-4 sm:p-6 rounded-lg shadow-lg space-y-4">
                <p><strong>Tanggal Verifikasi:</strong>
                    {{ \Carbon\Carbon::parse($permohonan->tanggal_verifikasi)->format('d F Y h:i A') }}</p>
                <p><strong>Luas Tanah:</strong> {{ $permohonan->luas_tanah }} meter persegi</p>
                <p><strong>Pemilik Bangunan:</strong> {{ $permohonan->pemilik_bangunan }} </p>
                <p><strong>Lokasi Permohonan:</strong> {{ $permohonan->lokasi_permohonan }}</p>
                <p><strong>Jenis Bangunan:</strong> {{ $permohonan->jenis_bangunan }}</p>
                <p><strong>Tanggal Rencana Lokasi:</strong>
                    {{ \Carbon\Carbon::parse($permohonan->tanggal_rencana_lokasi)->format('d F Y') }}</p>
                <p><strong>No Izin Lokasi:</strong> {{ $permohonan->nomor_izin_lokasi }}</p>
            </div>

            <!-- Surat dan Dokumen -->
            <div class="bg-gray-100 p-4 sm:p-6 rounded-lg shadow-lg space-y-4 mt-4">
                <h2 class="text-lg sm:text-xl font-bold mb-2">Dokumen Permohonan</h2>

                <div class="mb-4">
                    @php
                        $missingFiles = [];
                        if (!$permohonanGallery || !$permohonanGallery->surat_permohonan_perpanjang) {
                            $missingFiles[] = 'Surat Permohonan Perpanjang';
                        }
                        if (!$permohonanGallery || !$permohonanGallery->surat_pernyataan_keabsahan) {
                            $missingFiles[] = 'Surat Pernyataan Keabsahan';
                        }
                        if (!$permohonanGallery || !$permohonanGallery->surat_izin_pendirian) {
                            $missingFiles[] = 'Surat Izin Pendirian';
                        }
                        if (!$permohonanGallery || !$permohonanGallery->peninjauan_lokasi) {
                            $missingFiles[] = 'Peninjauan Lokasi';
                        }
                    @endphp

                    @if (count($missingFiles) > 0)
                        <p class="text-red-500 text-sm sm:text-base">File yang tidak tersedia:
                            {{ implode(', ', $missingFiles) }}. Pastikan terisi atau akan ditolak dan tidak akan diproses,
                            segera buat permohonan baru.</p>
                    @endif
                </div>

                <ul class="space-y-4">
                    <!-- Tombol untuk membuka modal -->
                    <li>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded w-full sm:w-auto"
                            data-modal-target="#modalPermohonanPerpanjang">Lihat Surat Permohonan Perpanjang</button>
                    </li>
                    <li>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded w-full sm:w-auto"
                            data-modal-target="#modalPernyataanKeabsahan">Lihat Surat Pernyataan Keabsahan</button>
                    </li>
                    <li>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded w-full sm:w-auto"
                            data-modal-target="#modalIzinPendirian">Lihat Surat Izin Pendirian</button>
                    </li>
                    <li>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded w-full sm:w-auto"
                            data-modal-target="#modalPeninjauanLokasi">Lihat Peninjauan Lokasi</button>
                    </li>
                </ul>

            </div>
        </div>
        <div class="text-center mt-10">
            @if ($role->role == 'PEMOHON')
                <!-- Memperbaiki operator perbandingan -->
                <h1 class="text-sm sm:text-base">Masuk Sebagai PEMOHON</h1>
                &copy; 2024, Ijin Pendirian Pendidikan Anak Usia Dini Kab. Karawang <!-- Menampilkan role pengguna -->
            @endif
        </div>

    </div>


    <!-- Modals -->
    <!-- Modal Surat Permohonan Perpanjang -->
    <div id="modalPermohonanPerpanjang" class="fixed z-10 inset-0 overflow-y-auto hidden bg-gray-800 bg-opacity-75">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Surat Permohonan Perpanjang</h3>
                    @if ($permohonanGallery && $permohonanGallery->surat_permohonan_perpanjang)
                        <iframe src="{{ asset('storage/' . $permohonanGallery->surat_permohonan_perpanjang) }}"
                            class="w-full h-96" frameborder="0"></iframe>
                    @else
                        <p class="text-red-500">File tidak tersedia.</p>
                    @endif
                    <button class="mt-4 text-blue-500" data-modal-close="modalPermohonanPerpanjang">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Surat Pernyataan Keabsahan -->
    <div id="modalPernyataanKeabsahan" class="fixed z-10 inset-0 overflow-y-auto hidden bg-gray-800 bg-opacity-75">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Surat Pernyataan Keabsahan</h3>
                    @if ($permohonanGallery && $permohonanGallery->surat_pernyataan_keabsahan)
                        <iframe src="{{ asset('storage/' . $permohonanGallery->surat_pernyataan_keabsahan) }}"
                            class="w-full h-96" frameborder="0"></iframe>
                    @else
                        <p class="text-red-500">File tidak tersedia.</p>
                    @endif
                    <button class="mt-4 text-blue-500" data-modal-close="modalPernyataanKeabsahan">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Surat Izin Pendirian -->
    <div id="modalIzinPendirian" class="fixed z-10 inset-0 overflow-y-auto hidden bg-gray-800 bg-opacity-75">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Surat Izin Pendirian</h3>
                    @if ($permohonanGallery && $permohonanGallery->surat_izin_pendirian)
                        <iframe src="{{ asset('storage/' . $permohonanGallery->surat_izin_pendirian) }}"
                            class="w-full h-96" frameborder="0"></iframe>
                    @else
                        <p class="text-red-500">File tidak tersedia.</p>
                    @endif
                    <button class="mt-4 text-blue-500" data-modal-close="modalIzinPendirian">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Peninjauan Lokasi -->
    <div id="modalPeninjauanLokasi" class="fixed z-10 inset-0 overflow-y-auto hidden bg-gray-800 bg-opacity-75">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Peninjauan Lokasi</h3>
                    @if ($permohonanGallery && $permohonanGallery->peninjauan_lokasi)
                        <iframe src="{{ asset('storage/' . $permohonanGallery->peninjauan_lokasi) }}" class="w-full h-96"
                            frameborder="0"></iframe>
                    @else
                        <p class="text-red-500">File tidak tersedia.</p>
                    @endif
                    <button class="mt-4 text-blue-500" data-modal-close="modalPeninjauanLokasi">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Membuka modal
        document.querySelectorAll('[data-modal-target]').forEach(button => {
            button.addEventListener('click', event => {
                const targetModal = document.querySelector(button.getAttribute('data-modal-target'));
                if (targetModal) {
                    targetModal.classList.remove('hidden');
                }
            });
        });

        // Menutup modal
        document.querySelectorAll('[data-modal-close]').forEach(button => {
            button.addEventListener('click', event => {
                const targetModal = button.closest('.fixed');
                if (targetModal) {
                    targetModal.classList.add('hidden');
                }
            });
        });

        // Menutup modal dengan klik di luar modal
        window.addEventListener('click', event => {
            if (event.target.classList.contains('bg-opacity-75')) {
                event.target.classList.add('hidden');
            }
        });
    </script>
@endsection

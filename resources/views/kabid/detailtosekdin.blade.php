@extends('layout.app')

@section('content')
    <div class="p-20 bg-slate-200">


        <div class="container mx-auto p-10 shadow-xl border bg-white rounded-xl ">
            <a class="bg-slate-600 text-white py-2 px-7 rounded-sm mt-2" href="{{ url()->previous() }}">Back</a>
            <h1 class="text-2xl font-bold my-6">Detail Permohonan Izin Operasional PAUD</h1>

            <!-- Status Permohonan -->
            <div class="bg-gray-100 p-4 rounded-lg mb-6">
                <span class="font-bold">Status Permohonan:</span>
                <span class="text-orange-500">{{ $permohonan->status->name }}</span>
            </div>

            <div class="bg-gray-100  flex flex-col p-4 rounded-lg mb-6">
                <span class="font-bold text-xl">Perhatian</span>
                <span class="text-sm text-teal-700">Untuk meneruskan permohonan, silahkan periksa terlebih dahulu data
                    pengajuan permohonan PAUD. Anda harus melihat berkas-berkas lampiran terlebih dahulu dengan menekan
                    tombol Lihat File agar dapat menindaklanjuti permohonan ini.</span>
            </div>

            <!-- Detail Informasi -->
            <div class="bg-white p-6 rounded-lg shadow-lg space-y-4">
                <p><strong>Tanggal Verifikasi:</strong>
                    {{ \Carbon\Carbon::parse($permohonan->tanggal_verifikasi)->format('d F Y h:i A') }}</p>
                <p><strong>Luas Tanah:</strong> {{ $permohonan->luas_tanah }} meter persegi</p>
                <p><strong>Lokasi Permohonan:</strong> {{ $permohonan->lokasi_permohonan }}</p>
                <p><strong>Jenis Bangunan:</strong> {{ $permohonan->jenis_bangunan }}</p>
                <p><strong>Tanggal Rencana Lokasi:</strong>
                    {{ \Carbon\Carbon::parse($permohonan->tanggal_rencana_lokasi)->format('d F Y') }}</p>
                <p><strong>No Izin Lokasi:</strong> {{ $permohonan->nomor_izin_lokasi }}</p>
            </div>

            <div class=" bg-slate-200 p-6 rounded-lg mt-4 shadow-lg space-y-4">
                <h1 class="text-2xl mb-4 font-bold">DATA USER</h1>
                <p><strong>Nama Lengkap: </strong> {{ $users->nama_lengkap }}</p>
                <p><strong>No Ktp/Passpor/Kitas:</strong> {{ $users->no_ktp_paspor_kitas }}</p>
                <p><strong>No Npwp:</strong> {{ $users->no_npwp }}</p>
                <p><strong>Provinsi:</strong> {{ $users->provinsi }}</p>
                <p><strong>Kota Kab:</strong> {{ $users->kota_kab }}</p>
                <p><strong>Desa Kelurahan:</strong> {{ $users->desa_kelurahan }}</p>
                <p><strong>Tempat Lahir:</strong> {{ $users->tempat_lahir }}</p>
                <p><strong>Tanggal Lahir:</strong>
                    {{ \Carbon\Carbon::parse($users->tanggal_lahir)->format('d F Y') }}</p>
                <p><strong>Handphone:</strong> {{ $users->handphone }}</p>
                <p><strong>Email:</strong> {{ $users->email }}</p>
            </div>


            <!-- Surat dan Dokumen -->
            <div class="bg-gray-100 p-6 rounded-lg shadow-lg space-y-4 mt-4">
                <h2 class="text-lg font-bold mb-2">Dokumen Permohonan</h2>
                <ul class="space-y-4">
                    <!-- Tombol untuk membuka modal -->
                    <li>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded"
                            data-modal-target="#modalPermohonanPerpanjang">Lihat Surat Permohonan Perpanjang</button>
                    </li>
                    <li>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded"
                            data-modal-target="#modalPernyataanKeabsahan">Lihat Surat Pernyataan Keabsahan</button>
                    </li>
                    <li>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded"
                            data-modal-target="#modalIzinPendirian">Lihat
                            Surat Izin Pendirian</button>
                    </li>
                    <li>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded"
                            data-modal-target="#modalPeninjauanLokasi">Lihat Peninjauan Lokasi</button>
                    </li>
                </ul>

                <form action="{{ route('kabid.update.tosekdin', $permohonan->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <!-- Radio button untuk status -->
                    <div class="flex items-center mb-4">
                        <input type="radio" id="diteruskan" name="status_id" value="10" class="mr-2" required>
                        <label for="diteruskan" class="text-gray-700">Teruskan Ke Sekdin</label>
                    </div>
                    <div class="flex items-center mb-4">
                        <input type="radio" id="diteruskan" name="status_id" value="12" class="mr-2" required>
                        <label for="diteruskan" class="text-gray-700">kembalikan ke JPT/JFU</label>
                    </div>

                    <button class="bg-green-500 text-white rounded py-1 w-full my-10">
                        Lanjutkan
                    </button>
                </form>


            </div>

        </div>
        <div class="text-center mt-10">
            @if ($role->role = 'KABID')
                <h1 class="text-m">Masuk Sebagai KEPALA BIDANG</h1>
                Copyright 2024, Ijin Pendirian Pendidikan Anak Usia Dini Kab. Karawang <!-- Menampilkan role pengguna -->
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

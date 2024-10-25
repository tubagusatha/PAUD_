@extends('layout.app')

@section('content')



    <div class="container mx-auto px-4 py-10">

        <form action="{{ route('permohonan.store') }}" method="POST"
            class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto">
            @csrf
            <div class="text-xl mb-8">Permohonan Baru</div>



            <div class="mb-5">
                <label for="tipe_permohonan" class="block mb-2 text-sm font-medium text-gray-700">Tipe Permohonan</label>
                <select id="tipe_permohonan" name="tipe_permohonan" required
                    class="form-select w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500">
                    <option value="" disabled selected>Pilih Tipe Permohonan</option>
                    <option value="1">Izin Operasional Paud</option>
                    <option value="0">Izin Satuan Paud</option>
                </select>

            </div>

            <div class="mb-5">
                <label for="status_pengajuan" class="block mb-2 text-sm font-medium text-gray-700">Status Pengajuan</label>
                <select id="status_pengajuan" name="status_pengajuan" required
                    class="form-select w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500">
                    <option value="" disabled selected>Pilih Status Pengajuan</option>
                    <option value="1">Pengajuan Baru</option>
                    <option value="0">Pengajuan Perpanjangan</option>
                </select>
            </div>

            <div class="mb-5">
                <label for="lokasi_permohonan" class="block mb-2 text-sm font-medium text-gray-700">Lokasi
                    Permohonan</label>
                <input type="text" id="lokasi_permohonan" name="lokasi_permohonan" required
                    class="form-input w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500" />
            </div>

            <div class="mb-5">
                <label for="jenis_bangunan" class="block mb-2 text-sm font-medium text-gray-700">Jenis Bangunan</label>
                <input type="text" id="jenis_bangunan" name="jenis_bangunan" required
                    class="form-input w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500" />
            </div>

            <div class="mb-5">
                <label for="tanggal_rencana_lokasi" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Rencana
                    Lokasi</label>
                <input type="date" id="tanggal_rencana_lokasi" name="tanggal_rencana_lokasi" required
                    class="form-input w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500" />
            </div>

            <div class="mb-5">
                <label for="luas_tanah" class="block mb-2 text-sm font-medium text-gray-700">Luas Tanah Per Meter Persegi
                </label>
                <input type="number" id="luas_tanah" name="luas_tanah" required
                    class="form-input w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500" />
            </div>

            <div class="mb-5">
                <label for="pemilik_bangunan" class="block mb-2 text-sm font-medium text-gray-700">Pemilik Bangunan</label>
                <input type="text" id="pemilik_bangunan" name="pemilik_bangunan" required
                    class="form-input w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500" />
            </div>

            <div class="mb-5">
                <label for="nomor_izin_lokasi" class="block mb-2 text-sm font-medium text-gray-700">Nomor Izin
                    Lokasi</label>
                <input type="text" id="nomor_izin_lokasi" name="nomor_izin_lokasi" required
                    class="form-input w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500" />
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white font-bold py-2.5 rounded-lg shadow-lg hover:bg-indigo-700 transition duration-300">Selanjutnya</button>
        </form>
    </div>
@endsection

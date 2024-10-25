@extends('layout.app')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <form action="{{ route('permohonan.update', $permohonan->id) }}" method="POST"
            class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto">
            @csrf
            @method('PATCH')
            <div class="text-xl mb-2">Perlu Perbaikan</div>
            <div class="text-sm mb-8">Yang Perlu di Perbaiki : {{ $permohonan->jptjfu->notes }}</div>

            <!-- Tipe Permohonan -->
            <div class="mb-5">
                <label for="tipe_permohonan" class="block mb-2 text-sm font-medium text-gray-700">Tipe Permohonan</label>
                <select id="tipe_permohonan" name="tipe_permohonan" required
                    class="form-select w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500">
                    <option value="" disabled>Pilih Tipe Permohonan</option>
                    <option value="1"
                        {{ (old('tipe_permohonan') ?? $permohonan->tipe_permohonan) == '1' ? 'selected' : '' }}>Izin
                        Operasional Paud</option>
                    <option value="0"
                        {{ (old('tipe_permohonan') ?? $permohonan->tipe_permohonan) == '0' ? 'selected' : '' }}>Izin Satuan
                        Paud</option>
                </select>
                @error('tipe_permohonan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status Pengajuan -->
            <div class="mb-5">
                <label for="status_pengajuan" class="block mb-2 text-sm font-medium text-gray-700">Status Pengajuan</label>
                <select id="status_pengajuan" name="status_pengajuan" required
                    class="form-select w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500">
                    <option value="" disabled>Pilih Status Pengajuan</option>
                    <option value="1"
                        {{ (old('status_pengajuan') ?? $permohonan->status_pengajuan) == '1' ? 'selected' : '' }}>Pengajuan
                        Baru</option>
                    <option value="0"
                        {{ (old('status_pengajuan') ?? $permohonan->status_pengajuan) == '0' ? 'selected' : '' }}>Pengajuan
                        Perpanjangan</option>
                </select>
                @error('status_pengajuan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Lokasi Permohonan -->
            <div class="mb-5">
                <label for="lokasi_permohonan" class="block mb-2 text-sm font-medium text-gray-700">Lokasi
                    Permohonan</label>
                <input type="text" id="lokasi_permohonan" name="lokasi_permohonan"
                    value="{{ old('lokasi_permohonan') ?? $permohonan->lokasi_permohonan }}" required
                    class="form-input w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500" />
                @error('lokasi_permohonan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jenis Bangunan -->
            <div class="mb-5">
                <label for="jenis_bangunan" class="block mb-2 text-sm font-medium text-gray-700">Jenis Bangunan</label>
                <input type="text" id="jenis_bangunan" name="jenis_bangunan"
                    value="{{ old('jenis_bangunan') ?? $permohonan->jenis_bangunan }}" required
                    class="form-input w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500" />
                @error('jenis_bangunan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal Rencana Lokasi -->
            <div class="mb-5">
                <label for="tanggal_rencana_lokasi" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Rencana
                    Lokasi</label>
                <input type="date" id="tanggal_rencana_lokasi" name="tanggal_rencana_lokasi"
                    value="{{ old('tanggal_rencana_lokasi') ?? $permohonan->tanggal_rencana_lokasi }}" required
                    class="form-input w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500" />
                @error('tanggal_rencana_lokasi')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Luas Tanah -->
            <div class="mb-5">
                <label for="luas_tanah" class="block mb-2 text-sm font-medium text-gray-700">Luas Tanah</label>
                <input type="number" id="luas_tanah" name="luas_tanah"
                    value="{{ old('luas_tanah') ?? $permohonan->luas_tanah }}" required
                    class="form-input w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500" />
                @error('luas_tanah')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Pemilik Bangunan -->
            <div class="mb-5">
                <label for="pemilik_bangunan" class="block mb-2 text-sm font-medium text-gray-700">Pemilik Bangunan</label>
                <input type="text" id="pemilik_bangunan" name="pemilik_bangunan"
                    value="{{ old('pemilik_bangunan') ?? $permohonan->pemilik_bangunan }}" required
                    class="form-input w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500" />
                @error('pemilik_bangunan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nomor Izin Lokasi -->
            <div class="mb-5">
                <label for="nomor_izin_lokasi" class="block mb-2 text-sm font-medium text-gray-700">Nomor Izin
                    Lokasi</label>
                <input type="text" id="nomor_izin_lokasi" name="nomor_izin_lokasi"
                    value="{{ old('nomor_izin_lokasi') ?? $permohonan->nomor_izin_lokasi }}" required
                    class="form-input w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500" />
                @error('nomor_izin_lokasi')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Button Submit -->
            <button type="submit"
                class="w-full bg-indigo-600 text-white font-bold py-2.5 rounded-lg shadow-lg hover:bg-indigo-700 transition duration-300">
                Selanjutnya
            </button>
        </form>
    </div>
@endsection

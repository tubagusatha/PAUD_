@extends('layout.app')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-semibold mb-6">Update Akun Saya</h2>
    
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- Nama Lengkap -->
                <div>
                    <label for="nama_lengkap" class="block text-gray-600 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" class="w-full border border-gray-300 p-2 rounded" required>
                </div>

                <!-- No KTP/Paspor/KITAS -->
                <div>
                    <label for="no_ktp_paspor_kitas" class="block text-gray-600 mb-2">No. KTP/Paspor/KITAS</label>
                    <input type="text" name="no_ktp_paspor_kitas" value="{{ old('no_ktp_paspor_kitas', $user->no_ktp_paspor_kitas) }}" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <!-- No NPWP -->
                <div>
                    <label for="no_npwp" class="block text-gray-600 mb-2">No. NPWP</label>
                    <input type="text" name="no_npwp" value="{{ old('no_npwp', $user->no_npwp) }}" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <!-- Tempat Lahir -->
                <div>
                    <label for="tempat_lahir" class="block text-gray-600 mb-2">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $user->tempat_lahir) }}" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label for="tanggal_lahir" class="block text-gray-600 mb-2">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <!-- Provinsi -->
                <div>
                    <label for="provinsi" class="block text-gray-600 mb-2">Provinsi</label>
                    <input type="text" name="provinsi" value="{{ old('provinsi', $user->provinsi) }}" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <!-- Kota/Kabupaten -->
                <div>
                    <label for="kota_kab" class="block text-gray-600 mb-2">Kota/Kabupaten</label>
                    <input type="text" name="kota_kab" value="{{ old('kota_kab', $user->kota_kab) }}" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <!-- Desa/Kelurahan -->
                <div>
                    <label for="desa_kelurahan" class="block text-gray-600 mb-2">Desa/Kelurahan</label>
                    <input type="text" name="desa_kelurahan" value="{{ old('desa_kelurahan', $user->desa_kelurahan) }}" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <!-- Handphone -->
                <div>
                    <label for="handphone" class="block text-gray-600 mb-2">No. Handphone</label>
                    <input type="text" name="handphone" value="{{ old('handphone', $user->handphone) }}" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-600 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 p-2 rounded" required>
                </div>

            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Simpan Perubahan</button>
            </div>

        </form>
    </div>
</div>
@endsection

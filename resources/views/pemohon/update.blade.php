@extends('layout.app')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <div class="m-10 flex flex-col">
            <div class="text-3xl font-bold my-5 text-center">Persyaratan</div>
            <div class="text-sm mb-1">1. Unggah data syarat dalam bentuk PDF, maksimal file 10MB.</div>
            <div class="text-sm mb-1">2. Jika terdapat dokumen yang memiliki tanda tangan atau cap, cetak terlebih dahulu, kemudian tanda tangani atau cap dokumen tersebut dan lakukan scan dokumen dalam bentuk PDF.</div>
            <div class="text-sm mb-1">3. Pastikan data yang telah diisi sesuai dengan perizinan yang diajukan oleh Anda.</div>
        </div>

        <form action="{{ route('permohonan.gallery.store', ['id' => $permohonan->id]) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg max-w-5xl mx-auto w-full md:w-[900px]">
            @csrf
        
            <!-- Surat Permohonan Perpanjang -->
            <div class="mb-6">
                <div class="flex flex-col md:flex-row justify-between items-center bg-gray-100 p-4 rounded-lg shadow-sm">
                    <label for="surat_permohonan_perpanjang" class="text-sm font-medium text-gray-700 mb-2 md:mb-0">Surat permohonan perpanjangan ijin operasional PAUD dari ketua yayasan</label>
                    <div class="flex items-center">
                        <input type="file" name="surat_permohonan_perpanjang" accept=".pdf" required class="hidden" id="surat_permohonan_perpanjang" onchange="updateFileName('surat_permohonan_perpanjang', 'filename1')">
                        <span id="filename1" class="mr-4 text-sm text-gray-600"></span>
                        <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300" onclick="document.getElementById('surat_permohonan_perpanjang').click()">Unggah file</button>
                    </div>
                </div>
            </div>

            <!-- Surat Pernyataan Keabsahan -->
            <div class="mb-6">
                <div class="flex flex-col md:flex-row justify-between items-center bg-gray-100 p-4 rounded-lg shadow-sm">
                    <label for="surat_pernyataan_keabsahan" class="text-sm font-medium text-gray-700 mb-2 md:mb-0">Surat pernyataan keabsahan, kebenaran dokumen dari ketua yayasan</label>
                    <div class="flex items-center">
                        <input type="file" name="surat_pernyataan_keabsahan" accept=".pdf" required class="hidden" id="surat_pernyataan_keabsahan" onchange="updateFileName('surat_pernyataan_keabsahan', 'filename2')">
                        <span id="filename2" class="mr-4 text-sm text-gray-600"></span>
                        <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300" onclick="document.getElementById('surat_pernyataan_keabsahan').click()">Unggah file</button>
                    </div>
                </div>
            </div>

            <!-- Surat Ijin Pendirian -->
            <div class="mb-6">
                <div class="flex flex-col md:flex-row justify-between items-center bg-gray-100 p-4 rounded-lg shadow-sm">
                    <label for="surat_izin_pendirian" class="text-sm font-medium text-gray-700 mb-2 md:mb-0">Surat Ijin Pendirian dari DPMPTSP</label>
                    <div class="flex items-center">
                        <input type="file" name="surat_izin_pendirian" accept=".pdf" required class="hidden" id="surat_izin_pendirian" onchange="updateFileName('surat_izin_pendirian', 'filename3')">
                        <span id="filename3" class="mr-4 text-sm text-gray-600"></span>
                        <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300" onclick="document.getElementById('surat_izin_pendirian').click()">Unggah file</button>
                    </div>
                </div>
            </div>

            <!-- Peninjauan Lokasi -->
            <div class="mb-6">
                <div class="flex flex-col md:flex-row justify-between items-center bg-gray-100 p-4 rounded-lg shadow-sm">
                    <label for="peninjauan_lokasi" class="text-sm font-medium text-gray-700 mb-2 md:mb-0">Peninjauan Lokasi</label>
                    <div class="flex items-center">
                        <input type="file" name="peninjauan_lokasi" accept=".pdf" required class="hidden" id="peninjauan_lokasi" onchange="updateFileName('peninjauan_lokasi', 'filename4')">
                        <span id="filename4" class="mr-4 text-sm text-gray-600"></span>
                        <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300" onclick="document.getElementById('peninjauan_lokasi').click()">Unggah file</button>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-green-600 text-white font-bold py-2 w-full rounded-lg shadow-lg hover:bg-green-700 transition duration-300">Ajukan Permohonan</button> 
            </div>
        </form>
    </div>

    <script>
        function updateFileName(inputId, fileLabelId) {
            var input = document.getElementById(inputId);
            var fileName = input.files[0].name;
            var shortFileName = fileName.length > 6 ? fileName.substring(0, 15,) + '...' : fileName;
            document.getElementById(fileLabelId).innerText = shortFileName;
        }
    </script>
    
@endsection

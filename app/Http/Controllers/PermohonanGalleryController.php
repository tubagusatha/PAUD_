<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Models\PermohonanGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermohonanGalleryController extends Controller
{
    public function store(Request $request, $permohonanId)
    {
        $user = Auth::user();

        // Validasi file yang diupload
        $request->validate([
            'surat_permohonan_perpanjang' => 'nullable|mimes:jpeg,png,jpg,pdf|max:10240',
            'surat_pernyataan_keabsahan' => 'nullable|mimes:jpeg,png,jpg,pdf|max:10240',
            'surat_izin_pendirian' => 'nullable|mimes:jpeg,png,jpg,pdf|max:10240',
            'peninjauan_lokasi' => 'nullable|mimes:jpeg,png,jpg,pdf|max:10240',
        ]);

        // Cari permohonan berdasarkan ID
        $permohonan = Permohonan::findOrFail($permohonanId);

        // Buat instance baru untuk PermohonanGallery
        $permohonanGallery = new PermohonanGallery();
        $permohonanGallery->permohonan_id = $permohonan->id;

        // Simpan file ke public/storage/permohonan
        if ($request->hasFile('surat_permohonan_perpanjang')) {
            $file = $request->file('surat_permohonan_perpanjang');
            $path = $file->storeAs('public/permohonan', 'surat_permohonan_perpanjang_' . time() . '.' . $file->getClientOriginalExtension());
            $permohonanGallery->surat_permohonan_perpanjang = str_replace('public/', '', $path);
        }

        if ($request->hasFile('surat_pernyataan_keabsahan')) {
            $file = $request->file('surat_pernyataan_keabsahan');
            $path = $file->storeAs('public/permohonan', 'surat_pernyataan_keabsahan_' . time() . '.' . $file->getClientOriginalExtension());
            $permohonanGallery->surat_pernyataan_keabsahan = str_replace('public/', '', $path);
        }

        if ($request->hasFile('surat_izin_pendirian')) {
            $file = $request->file('surat_izin_pendirian');
            $path = $file->storeAs('public/permohonan', 'surat_izin_pendirian_' . time() . '.' . $file->getClientOriginalExtension());
            $permohonanGallery->surat_izin_pendirian = str_replace('public/', '', $path);
        }

        if ($request->hasFile('peninjauan_lokasi')) {
            $file = $request->file('peninjauan_lokasi');
            $path = $file->storeAs('public/permohonan', 'peninjauan_lokasi_' . time() . '.' . $file->getClientOriginalExtension());
            $permohonanGallery->peninjauan_lokasi = str_replace('public/', '', $path);
        }

        // Simpan data ke database
        $permohonanGallery->save();

        // Redirect dengan pesan sukses
        return redirect()->route('permohonan.user', ['uuid' => $user->uuid])->with('success', 'Files successfully uploaded.');
    }

    

    public function update(Request $request, $permohonanId)
    {
        $user = Auth::user();

        // Validasi file yang diupload
        $request->validate([
            'surat_permohonan_perpanjang' => 'nullable|mimes:jpeg,png,jpg,pdf|max:10240',
            'surat_pernyataan_keabsahan' => 'nullable|mimes:jpeg,png,jpg,pdf|max:10240',
            'surat_izin_pendirian' => 'nullable|mimes:jpeg,png,jpg,pdf|max:10240',
            'peninjauan_lokasi' => 'nullable|mimes:jpeg,png,jpg,pdf|max:10240',
        ]);

        // Cari permohonan berdasarkan ID
        $permohonan = Permohonan::findOrFail($permohonanId);

        // Cari atau buat instance PermohonanGallery
        $permohonanGallery = PermohonanGallery::where('permohonan_id', $permohonan->id)->first();

        // Perbarui file yang diupload dan simpan ke storage/permohonan
        if ($request->hasFile('surat_permohonan_perpanjang')) {
            $file = $request->file('surat_permohonan_perpanjang');
            $path = $file->storeAs('public/permohonan', 'surat_permohonan_perpanjang_' . time() . '.' . $file->getClientOriginalExtension());
            $permohonanGallery->surat_permohonan_perpanjang = str_replace('public/', '', $path);
        }

        if ($request->hasFile('surat_pernyataan_keabsahan')) {
            $file = $request->file('surat_pernyataan_keabsahan');
            $path = $file->storeAs('public/permohonan', 'surat_pernyataan_keabsahan_' . time() . '.' . $file->getClientOriginalExtension());
            $permohonanGallery->surat_pernyataan_keabsahan = str_replace('public/', '', $path);
        }

        if ($request->hasFile('surat_izin_pendirian')) {
            $file = $request->file('surat_izin_pendirian');
            $path = $file->storeAs('public/permohonan', 'surat_izin_pendirian_' . time() . '.' . $file->getClientOriginalExtension());
            $permohonanGallery->surat_izin_pendirian = str_replace('public/', '', $path);
        }

        if ($request->hasFile('peninjauan_lokasi')) {
            $file = $request->file('peninjauan_lokasi');
            $path = $file->storeAs('public/permohonan', 'peninjauan_lokasi_' . time() . '.' . $file->getClientOriginalExtension());
            $permohonanGallery->peninjauan_lokasi = str_replace('public/', '', $path);
        }

        // Simpan perubahan
        $permohonanGallery->save();

        // Redirect dengan pesan sukses
        return redirect()->route('permohonan.user', ['uuid' => $user->uuid])->with('success', 'Files successfully updated.');
    }
}

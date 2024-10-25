<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Models\PermohonanGallery;
use App\Models\status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermohonanDataController extends Controller
{
    public function index($uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        $permohonans = Permohonan::where('user_id', $user->id)->get(); // Menambahkan filter berdasarkan user
        return view('pemohon.permohonan', compact('user', 'permohonans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemohon.buat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'tipe_permohonan' => 'required|boolean',
            'status_pengajuan' => 'required|boolean',
            'lokasi_permohonan' => 'required|string|max:255',
            'jenis_bangunan' => 'required|string|max:255',
            'tanggal_rencana_lokasi' => 'required|date',
            'luas_tanah' => 'required|integer',
            'pemilik_bangunan' => 'required|string|max:255',
            'nomor_izin_lokasi' => 'required|string|max:255',
        ]);

        // Generate No Resi
        $latest = Permohonan::latest('id')->first();
        $latestId = $latest ? (int) substr($latest->no_resi, -3) : 0;
        $newId = str_pad($latestId + 1, 3, '0', STR_PAD_LEFT);
        $currentYear = date('Y');
        $noResi = "NR-$currentYear-$newId";

        // Ambil ID status dari tabel `statuses`
        $statusId = status::where('name', 'Menunggu Diterima oleh Front Office')->firstOrFail()->id;

        // Buat permohonan
        $permohonan = Permohonan::create([
            'user_id' => Auth::user()->id,
            'tipe_permohonan' => $validated['tipe_permohonan'],
            'status_pengajuan' => $validated['status_pengajuan'],
            'lokasi_permohonan' => $validated['lokasi_permohonan'],
            'jenis_bangunan' => $validated['jenis_bangunan'],
            'tanggal_rencana_lokasi' => $validated['tanggal_rencana_lokasi'],
            'luas_tanah' => $validated['luas_tanah'],
            'pemilik_bangunan' => $validated['pemilik_bangunan'],
            'nomor_izin_lokasi' => $validated['nomor_izin_lokasi'],
            'status_id' => $statusId,
            'no_resi' => $noResi,
        ]);

        // Kirim permohonan ke front office dengan method assignToFrontOffice
        $frontOfficeController = new FrontOfficeController();
        $frontOfficeController->assignToFrontOffice($permohonan->id);

        // Redirect ke halaman update
        return redirect('permohonan/' . $permohonan->id . '/edit');
    }


    public function perluPerbaikanFile($id)
    {
        // Temukan permohonan berdasarkan ID
        $permohonan = Permohonan::findOrFail($id);

        // Kirim data permohonan ke view
        return view('pemohon.perluperbaikanfile', compact('permohonan'));
    }


    public function perluPerbaikan($id)
    {
        // Temukan permohonan berdasarkan ID
        $permohonan = Permohonan::findOrFail($id);

        // Kirim data permohonan ke view
        return view('pemohon.perluperbaikan', compact('permohonan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang akan diupdate
        $validated = $request->validate([
            'tipe_permohonan' => 'required|boolean',
            'status_pengajuan' => 'required|boolean',
            'lokasi_permohonan' => 'required|string|max:255',
            'jenis_bangunan' => 'required|string|max:255',
            'tanggal_rencana_lokasi' => 'required|date',
            'luas_tanah' => 'required|integer',
            'pemilik_bangunan' => 'required|string|max:255',
            'nomor_izin_lokasi' => 'required|string|max:255',
        ]);

        // Temukan permohonan berdasarkan ID
        $permohonan = Permohonan::findOrFail($id);

        // Update data permohonan
        $permohonan->update([
            'tipe_permohonan' => $validated['tipe_permohonan'],
            'status_pengajuan' => $validated['status_pengajuan'],
            'lokasi_permohonan' => $validated['lokasi_permohonan'],
            'jenis_bangunan' => $validated['jenis_bangunan'],
            'tanggal_rencana_lokasi' => $validated['tanggal_rencana_lokasi'],
            'luas_tanah' => $validated['luas_tanah'],
            'pemilik_bangunan' => $validated['pemilik_bangunan'],
            'nomor_izin_lokasi' => $validated['nomor_izin_lokasi'],
            // Update status ID ke "Sudah Diperbaiki"
            'status_id' => status::where('name', 'Sudah di Perbaiki')->firstOrFail()->id,
        ]);

        // Redirect ke halaman perluperbaikanfile
        return redirect()->route('permohonan.perluperbaikanfile', $permohonan->id)
            ->with('success', 'Permohonan berhasil diperbarui dan diarahkan ke halaman perbaikan file.');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $permohonan = Permohonan::with('galleries')->findOrFail($id);

        $permohonan = Permohonan::findOrFail($id);

        $user = User::where('id', $id)->firstOrFail();

        $role = Auth::user();

        // Ambil data gallery terkait permohonan
        $permohonanGallery = PermohonanGallery::where('permohonan_id', $id)->first();


        return view('pemohon.detail', compact('permohonan', 'permohonanGallery', 'user', 'role'));
    }



    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        return view('pemohon.update', compact('permohonan'));
    }

    /**
     * Update the specified resource in storage.
//      */
    //     public function update(Request $request, $id)
    // {
    //     $permohonan = Permohonan::findOrFail($id);

    //     // Validasi file uploads
    //     $validated = $request->validate([
    //         'surat_permohonan_perpanjang' => 'nullable|file|mimes:pdf|max:2048',
    //         'surat_pernyataan_keabsahan' => 'nullable|file|mimes:pdf|max:2048',
    //         'surat_izin_pendirian' => 'nullable|file|mimes:pdf|max:2048',
    //         'peninjauan_lokasi' => 'nullable|file|mimes:pdf|max:2048',
    //     ]);

    //     // Debugging: Check if files are present
    //     if ($request->hasFile('surat_permohonan_perpanjang')) {
    //         $file = $request->file('surat_permohonan_perpanjang');
    //         $fileName = time() . '_surat_permohonan_perpanjang.' . $file->getClientOriginalExtension();
    //         $filePath = $file->storeAs('public/permohonan', $fileName);
    //         $permohonan->surat_permohonan_perpanjang = 'storage/permohonan/' . $fileName;
    //         dd('File stored at: ' . $filePath); // Debug path
    //     }
    //     if ($request->hasFile('surat_pernyataan_keabsahan')) {
    //         $file = $request->file('surat_pernyataan_keabsahan');
    //         $fileName = time() . '_surat_pernyataan_keabsahan.' . $file->getClientOriginalExtension();
    //         $filePath = $file->storeAs('public/permohonan', $fileName);
    //         $permohonan->surat_pernyataan_keabsahan = 'storage/permohonan/' . $fileName;
    //         dd('File stored at: ' . $filePath); // Debug path
    //     }
    //     if ($request->hasFile('surat_izin_pendirian')) {
    //         $file = $request->file('surat_izin_pendirian');
    //         $fileName = time() . '_surat_izin_pendirian.' . $file->getClientOriginalExtension();
    //         $filePath = $file->storeAs('public/permohonan', $fileName);
    //         $permohonan->surat_izin_pendirian = 'storage/permohonan/' . $fileName;
    //         dd('File stored at: ' . $filePath); // Debug path
    //     }
    //     if ($request->hasFile('peninjauan_lokasi')) {
    //         $file = $request->file('peninjauan_lokasi');
    //         $fileName = time() . '_peninjauan_lokasi.' . $file->getClientOriginalExtension();
    //         $filePath = $file->storeAs('public/permohonan', $fileName);
    //         $permohonan->peninjauan_lokasi = 'storage/permohonan/' . $fileName;
    //         dd('File stored at: ' . $filePath); // Debug path
    //     }

    //     $permohonan->status = 'Diteruskan ke Front Office oleh Pemohon'; // Update status
    //     $permohonan->save();

    //     return redirect()->route('permohonan.index')->with('success', 'Permohonan berhasil diajukan.');
    // }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permohonan $permohonan)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\FrontOffice;
use App\Models\Permohonan;
use App\Models\PermohonanGallery;
use App\Models\status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontOfficeController extends Controller
{
    public function index()
    {
        // Ambil ID pengguna yang sedang login
        $id = Auth::id();

        // Ambil data user berdasarkan ID
        $user = User::findOrFail($id);

        // Mengecek apakah pengguna memiliki role "Front Office"
        if ($user->role == 'FO') {
            // Ambil semua permohonan tanpa memfilter user_id, karena semua Front Office bisa melihat semua permohonan
            $permohonans = Permohonan::with('status')->get();
        } else {
            // Jika bukan Front Office, tampilkan permohonan milik user tersebut
            $permohonans = Permohonan::with('status')->where('user_id', $user->id)->get();
        }

        $statusCounts = Permohonan::select('status_id', DB::raw('count(*) as total'))
            ->groupBy('status_id')
            ->pluck('total', 'status_id');

        // Mengambil nama status dari tabel statuses
        $statuses = status::all();
        $colors = ['blue-500', 'red-500', 'green-500'];


        // Tampilkan ke view dengan data yang sudah diambil
        return view('frontoffice.index', compact('permohonans', 'user', 'statusCounts', 'statuses', 'colors'));
    }


    // public function proses($id)
    // {
    //     $frontOffice = FrontOffice::findOrFail($id);
    //     // Logika untuk memproses permohonan, misalnya, mengupdate status atau menambahkan catatan
    //     // Misalnya, mengupdate status menjadi 'Diteruskan ke Kepala Dinas'
    //     $frontOffice->status = 'Diteruskan ke Kepala Dinas';
    //     $frontOffice->forwarded_at = now();
    //     $frontOffice->save();

    //     // Redirect atau return response sesuai kebutuhan
    //     return redirect()->route('front_office.index')->with('success', 'Permohonan telah diproses.');
    // }

    public function store(Request $request)
    {
        // Validasi data permohonan (optional, tambahkan sesuai kebutuhan)

        // Simpan data permohonan
        $permohonan = new Permohonan;
        $permohonan->tipe_permohonan = $request->tipe_permohonan;
        $permohonan->status_pengajuan = $request->status_pengajuan;
        // Simpan data lainnya jika ada...
        $permohonan->user_id = auth()->user()->id; // User yang membuat permohonan
        $permohonan->save();

        // Ambil semua user yang memiliki peran Front Office
        $frontOffices = User::where('role', 'frontoffice')->get();

        // Lakukan tindakan untuk front office (misalnya kirim notifikasi atau relasi lain)
        foreach ($frontOffices as $frontOffice) {
            // Jika ada tabel pivot atau relasi antara permohonan dan front office, tambahkan di sini.
            // Misalnya, untuk notifikasi:
            // Notification::send($frontOffice, new PermohonanCreatedNotification($permohonan));
        }

        // Redirect setelah berhasil
        return redirect()->back()->with('success', 'Permohonan berhasil dibuat.');
    }


    public function assignToFrontOffice($permohonanId)
    {
        // Cari permohonan berdasarkan ID
        $permohonan = Permohonan::findOrFail($permohonanId);

        // Ambil semua user yang memiliki peran Front Office
        $frontOffices = User::where('role', 'frontoffice')->get();

        // Lakukan tindakan untuk front office (misalnya kirim notifikasi atau relasi lain)
        foreach ($frontOffices as $frontOffice) {
            // Jika ada tabel pivot atau relasi antara permohonan dan front office, tambahkan di sini.
            // Contoh pengiriman notifikasi:
            // Notification::send($frontOffice, new PermohonanCreatedNotification($permohonan));
        }

        // Tidak ada perlu redirect atau return di sini, karena metode ini dipanggil dalam store() pada controller lain
    }


    public function permohonan($uuid)
    {
        // Ambil user berdasarkan UUID
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Cek apakah user memiliki role Front Office
        if ($user->role == 'FO') {
            // Ambil semua permohonan jika user adalah Front Office
            $permohonans = Permohonan::with('status')->get();
        } else {
            // Jika bukan Front Office, hanya ambil permohonan yang dibuat oleh user tersebut
            $permohonans = Permohonan::with('status')->where('user_id', $user->id)->get();
        }
        
        // Tampilkan data permohonan ke view
        return view('frontoffice.permohonan', compact('permohonans', 'user'));
    }

    public function update(Request $request, $id)
    {
        $permohonan = Permohonan::findOrFail($id);

        // Update status_id sesuai dengan nilai yang diterima dari form
        $permohonan->status_id = $request->input('status_id');
        $permohonan->save();

        // Menambahkan data ke tabel Kadis
        $this->assignToKadis($permohonan->id);

        // Dapatkan UUID dari pengguna yang terkait dengan permohonan
        $userUuid = $permohonan->user->uuid;

        // Redirect ke URL dengan parameter uuid pengguna
        $url = url('/frontoffice/permohonan/' . $userUuid);
        return redirect($url)->with('success', 'Status berhasil diupdate dan diteruskan ke Kepala Dinas.');
    }

    public function assignToKadis($permohonanId)
    {
        // Cek apakah data Kadis untuk permohonan ini sudah ada
        $existingKadis = \App\Models\Kadis::where('permohonan_id', $permohonanId)->first();

        if (!$existingKadis) {
            // Jika belum ada, buat data baru untuk Kadis
            $kadis = new \App\Models\Kadis();
            $kadis->permohonan_id = $permohonanId;
            $kadis->received_at = now(); // Waktu saat Kadis menerima permohonan dari Front Office
            $kadis->save();
        }
    }


    public function show($id)
    {
        // Ambil permohonan beserta gambar-gambar yang terkait
        $permohonan = Permohonan::with('galleries')->findOrFail($id);

        $permohonan = Permohonan::findOrFail($id);

        $user = User::where('id', $id)->firstOrFail();

        $users = User::findOrFail($permohonan->user_id);

        $role = Auth::user();

        // Ambil data gallery terkait permohonan
        $permohonanGallery = PermohonanGallery::where('permohonan_id', $id)->first();

        return view('frontoffice.detail', compact('permohonan', 'users', 'permohonanGallery', 'user', 'role'));

    }
}

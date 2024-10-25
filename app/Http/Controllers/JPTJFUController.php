<?php

namespace App\Http\Controllers;

use App\Models\jptjfu;
use App\Models\Permohonan;
use App\Models\PermohonanGallery;
use App\Models\status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JPTJFUController extends Controller
{
    // Menampilkan permohonan yang perlu diverifikasi oleh JPT/JFU
    public function index()
    {
        // Ambil semua permohonan yang diteruskan ke Kadis
        $id = Auth::id();

        // Ambil data user berdasarkan ID
        $user = User::findOrFail($id);

        // Mengecek apakah pengguna memiliki role "Front Office"
        if ($user->role == 'JPTJFU') {
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
        return view('jptjfu.index', compact('permohonans', 'user', 'statusCounts', 'statuses', 'colors'));
    }

    public function permohonan($uuid)
    {
        // Ambil data Kadis berdasarkan UUID user
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Ambil semua permohonan yang telah diteruskan ke Kadis
        $permohonans = Permohonan::with('status')
            ->whereHas('jptjfu')
            ->get();

        return view('jptjfu.permohonan', compact('permohonans', 'user'));
    }

    public function update(Request $request, $id)

    {
        $permohonan = Permohonan::findOrFail($id);

        // Update status_id sesuai dengan nilai yang diterima dari form
        $permohonan->status_id = $request->input('status_id');
        $permohonan->save();

        // Update Kadis's notes or other fields
        $jptjfu = jptjfu::where('permohonan_id', $id)->firstOrFail();
        $jptjfu->notes = $request->input('notes');
        $jptjfu->forwarded_at = now();
        $jptjfu->save();

        // Pastikan relasi user sudah ada dan ambil uuid-nya
        return redirect()->route('jptjfu.permohonan', $permohonan->user->uuid)
            ->with('success', 'Permohonan berhasil diupdate oleh Kepala Dinas.');
    }


    public function show($id)
    {
        // Ambil permohonan beserta gambar-gambar yang terkait
        $permohonan = Permohonan::with('galleries')->findOrFail($id);


        $permohonan = Permohonan::findOrFail($id);

        $user = User::where('id', $id)->firstOrFail();

        $role = Auth::user();

        $users = User::findOrFail($permohonan->user_id);

        // Ambil data gallery terkait permohonan
        $permohonanGallery = PermohonanGallery::where('permohonan_id', $id)->first();
        return view('jptjfu.detail', compact('permohonan','users', 'permohonanGallery', 'user', 'role'));
    }
}

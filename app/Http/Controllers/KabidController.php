<?php

namespace App\Http\Controllers;

use App\Models\kabid;
use App\Models\Permohonan;
use App\Models\PermohonanGallery;
use App\Models\sekdin;
use App\Models\status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KabidController extends Controller
{
    public function index()
    {
        // Ambil semua permohonan yang diteruskan ke Kadis
        $id = Auth::id();

        // Ambil data user berdasarkan ID
        $user = User::findOrFail($id);

        // Mengecek apakah pengguna memiliki role "Front Office"
        if ($user->role == 'KABID') {
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
        return view('kabid.index', compact('permohonans', 'user', 'statusCounts', 'statuses', 'colors'));
    }

    public function permohonan($uuid)
    {
        // Ambil data Kadis berdasarkan UUID user
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Ambil semua permohonan yang telah diteruskan ke Kadis
        $permohonans = Permohonan::with('status')
            ->whereHas('kabid')
            ->get();

        return view('kabid.permohonan', compact('permohonans', 'user'));
    }

    public function update(Request $request, $id)

    {
        $permohonan = Permohonan::findOrFail($id);

        // Update status_id sesuai dengan nilai yang diterima dari form
        $permohonan->status_id = $request->input('status_id');
        $permohonan->save();

        $this->assignToKasi($permohonan->id);

        // Update Kadis's notes or other fields
        $kadis = kabid::where('permohonan_id', $id)->firstOrFail();
        $kadis->notes = $request->input('notes');
        $kadis->forwarded_at = now();
        $kadis->save();

        // Pastikan relasi user sudah ada dan ambil uuid-nya
        return redirect()->route('kabid.permohonan', $permohonan->user->uuid)
            ->with('success', 'Permohonan berhasil diupdate oleh Kepala Dinas.');
    }


    public function assignToKasi($permohonanId)
    {
        // Cek apakah data Kadis untuk permohonan ini sudah ada
        $existingKasi = \App\Models\kasi::where('permohonan_id', $permohonanId)->first();

        if (!$existingKasi) {
            // Jika belum ada, buat data baru untuk Kadis
            $kasi = new \App\Models\kasi();
            $kasi->permohonan_id = $permohonanId;
            $kasi->received_at = now(); // Waktu saat Kadis menerima permohonan dari Front Office
            $kasi->save();
        }
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

        return view('kabid.detail', compact('permohonan', 'users','permohonanGallery', 'user', 'role'));
    }


    public function showtosekdin($id)
    {
        // Ambil permohonan beserta gambar-gambar yang terkait
        $permohonan = Permohonan::with('galleries')->findOrFail($id);

        
        $permohonan = Permohonan::findOrFail($id);

        $user = User::where('id', $id)->firstOrFail();
        $role = Auth::user();
        $users = User::findOrFail($permohonan->user_id);
        
        // Ambil data gallery terkait permohonan
        $permohonanGallery = PermohonanGallery::where('permohonan_id', $id)->first();

        return view('kabid.detailtosekdin', compact('permohonan', 'users','permohonanGallery', 'user', 'role'));
    }

    public function updatetosekdin(Request $request, $id)

    {
        $permohonan = Permohonan::findOrFail($id);

        // Update status_id sesuai dengan nilai yang diterima dari form
        $permohonan->status_id = $request->input('status_id');
        $permohonan->save();

        $this->assignTosekdin($permohonan->id);

        // Update Kadis's notes or other fields
        $sekdin = sekdin::where('permohonan_id', $id)->firstOrFail();
        $sekdin->notes = $request->input('notes');
        $sekdin->forwarded_at = now();
        $sekdin->save();

        // Pastikan relasi user sudah ada dan ambil uuid-nya
        return redirect()->route('kabid.permohonan', $permohonan->user->uuid)
            ->with('success', 'Permohonan berhasil diupdate oleh Kepala Dinas.');
    }


    public function assignTosekdin($permohonanId)
    {
        // Cek apakah data Kadis untuk permohonan ini sudah ada
        $existingSekdin = \App\Models\sekdin::where('permohonan_id', $permohonanId)->first();

        if (!$existingSekdin) {
            // Jika belum ada, buat data baru untuk Kadis
            $sekdin = new \App\Models\sekdin();
            $sekdin->permohonan_id = $permohonanId;
            $sekdin->received_at = now(); // Waktu saat Kadis menerima permohonan dari Front Office
            $sekdin->save();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('index');
    }


    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }
    public function user_dashboard($uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        return view('pemohon.index', compact('user'));
    }


    public function isidata()
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();
        return view('pemohon.datapemohon', compact('user'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'g-recaptcha-response' => 'required|captcha' // Pastikan ada konfirmasi password
        ]);

        // Buat pengguna baru
        $user = User::create([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            // Set default role atau atribut lain jika diperlukan
        ]);

        // Arahkan pengguna ke halaman login atau halaman lain setelah registrasi
        return redirect('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function logout()
    {
        Session::flush();
        Session::flash('logout_message', 'Anda telah berhasil logout.');
        Auth::logout();


        return redirect('/');
    }


    public function showAkun($id) {

        $user = User::where('id', $id)->firstOrFail();

        return view('pemohon.profile.akun', compact('user'));
    }


    public function update(Request $request)
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Validasi data
        $request->validate([
            'no_ktp_paspor_kitas' => 'required',
            'no_npwp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'provinsi' => 'required',
            'kota_kab' => 'required',
            'desa_kelurahan' => 'required',
            'handphone' => 'required',
        ]);

        // Update data user berdasarkan ID
        User::where('id', $user->id)->update([
            'no_ktp_paspor_kitas' => $request->no_ktp_paspor_kitas,
            'no_npwp' => $request->no_npwp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'provinsi' => $request->provinsi,
            'kota_kab' => $request->kota_kab,
            'desa_kelurahan' => $request->desa_kelurahan,
            'handphone' => $request->handphone,
        ]);

        // Redirect ke dashboard user dan bawa ID user
        return redirect()->route('dashboard.user', ['uuid' => $user->uuid])->with('success', 'Data berhasil diperbarui.');
    }


    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            \Log::info('Logged in user role: ' . $user->role); // Log role untuk debugging

            // Simpan pesan flash untuk popup yang akan ditampilkan di halaman berikutnya
            session()->flash('login_message', 'Kamu login sebagai ' . $user->role);

            if ($user->role == 'FO') {
                return redirect()->route('front_office.index')->with('success', 'Login berhasil!');
            } elseif ($user->role == 'PEMOHON') {
                return redirect()->route('datapemohon')->with('success', 'Login berhasil!');
            } elseif ($user->role == 'KADIS') {
                return redirect()->route('kadis.index')->with('success', 'Login berhasil!');
            } elseif ($user->role == 'KABID') {
                return redirect()->route('kabid.index')->with('success', 'Login berhasil!');
            } elseif ($user->role == 'KASI') {
                return redirect()->route('kasi.index')->with('success', 'Login berhasil!');
            } elseif ($user->role == 'JPTJFU') {
                return redirect()->route('jptjfu.index')->with('success', 'Login berhasil!');
            } elseif ($user->role == 'SEKDIN') {
                return redirect()->route('sekdin.index')->with('success', 'Login berhasil!');
            }

            // Default redirect jika tidak ada peran yang sesuai
            return redirect()->route('dashboard.user', $user->uuid)->with('success', 'Login berhasil!');
        } else {
            // Not authenticated
            return redirect('login')->withErrors(['email' => 'Email atau password yang Anda masukkan salah.']);
        }
    }
}

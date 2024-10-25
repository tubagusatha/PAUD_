<?php

use App\Http\Middleware\isPemohon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasiController;
use App\Http\Controllers\KabidController;
use App\Http\Controllers\JPTJFUController;
use App\Http\Controllers\SekdinController;
use App\Http\Controllers\FrontOfficeController;
use App\Http\Controllers\KepalaDinasController;
use App\Http\Controllers\PermohonanDataController;
use App\Http\Controllers\PermohonanGalleryController;
use App\Http\Middleware\isFrontOffice;
use App\Http\Middleware\isJptjfu;
use App\Http\Middleware\IsKabid;
use App\Http\Middleware\IsKadis;
use App\Http\Middleware\isKasi;
use App\Http\Middleware\isSekdin;
use App\Models\FrontOffice;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [HomeController::class, 'index']);
Route::get('login', [HomeController::class, 'login']);
Route::post('login', [HomeController::class, 'authenticate'])->name('authenticate');
Route::get('register', [HomeController::class, 'register']);
Route::post('register', [HomeController::class, 'store']);
Route::get('/logout', [HomeController::class, 'logout']);


Route::middleware([isPemohon::class])->group(function () {
    Route::get('isidata', [HomeController::class, 'isidata'])->name('datapemohon');
    Route::get('dashboard/user/{uuid}', [HomeController::class, 'user_dashboard'])->name('dashboard.user');
    Route::get('akun/user/{id}', [HomeController::class, 'showAkun'])->name('akun');
    Route::patch('isidata/update', [HomeController::class, 'update'])->name('user.update');
    
    // Tidak memerlukan parameter
    // Menampilkan daftar permohonan berdasarkan UUID pengguna
    Route::get('permohonan/user/{uuid}', [PermohonanDataController::class, 'index'])->name('permohonan.user');

    // Route untuk menampilkan form pembuatan permohonan
    Route::get('permohonan/create', [PermohonanDataController::class, 'create'])->name('permohonan.create');

    Route::patch('/permohonan/gallery/update/{id}', [PermohonanGalleryController::class, 'update'])->name('permohonan.gallery.update');

    Route::patch('permohonan/{id}/update', [PermohonanDataController::class, 'update'])->name('permohonan.update');

    Route::get('permohonan/{id}/perluperbaikan', [PermohonanDataController::class, 'perluPerbaikan'])->name('permohonan.perluperbaikan');

    Route::get('permohonan/{id}/perluperbaikanfile', [PermohonanDataController::class, 'perluPerbaikanFile'])->name('permohonan.perluperbaikanfile');

    Route::patch('/permohonan/gallery/update/{id}', [PermohonanGalleryController::class, 'update'])->name('permohonan.gallery.update');

    // Route untuk menyimpan permohonan baru
    Route::post('permohonan/post', [PermohonanDataController::class, 'store'])->name('permohonan.store');

    // Route untuk menampilkan daftar permohonan
    Route::get('permohonan', [PermohonanDataController::class, 'index'])->name('permohonan.index');

    // Route untuk menampilkan detail permohonan tertentu
    Route::get('permohonan/detail/{id}', [PermohonanDataController::class, 'show'])->name('permohonan.show');

    // Route untuk menampilkan form edit permohonan
    Route::get('permohonan/{id}/edit', [PermohonanDataController::class, 'edit'])->name('permohonan.edit');

    // Route untuk menghapus permohonan
    Route::delete('permohonan/{id}', [PermohonanDataController::class, 'destroy'])->name('permohonan.destroy');


    Route::post('permohonan/{id}/gallery', [PermohonanGalleryController::class, 'store'])->name('permohonan.gallery.store');
});




// Route untuk Front Office
Route::middleware([isFrontOffice::class])->group(function () {
    Route::get('frontoffice/dashboard/', [FrontOfficeController::class, 'index'])->name('front_office.index');
    Route::get('frontoffice/permohonan/{uuid}', [FrontOfficeController::class, 'permohonan'])->name('front_office.permohonan');
    Route::get('frontoffice/detail/{id}', [FrontOfficeController::class, 'show'])->name('front_office.show');
    Route::post('front_office/store/{permohonanId}', [FrontOfficeController::class, 'store'])->name('front_office.store');
    Route::patch('frontoffice/update/{id}', [FrontOfficeController::class, 'update'])->name('front_office.update');
});

Route::middleware([IsKadis::class])->group(function () {
    Route::get('kadis/dashboard/', [KepalaDinasController::class, 'index'])->name('kadis.index');
    Route::get('kadis/permohonan/{uuid}', [KepalaDinasController::class, 'permohonan'])->name('kadis.permohonan');
    Route::get('kadis/detail/{id}', [KepalaDinasController::class, 'show'])->name('kadis.show');
    Route::get('kadis/detail/finish/{id}', [KepalaDinasController::class, 'showfinish'])->name('kadis.show.finish');
    Route::patch('kadis/update/{id}', [KepalaDinasController::class, 'update'])->name('kadis.update');
});


Route::middleware([IsKabid::class])->group(function () {
    Route::get('kabid/dashboard/', [KabidController::class, 'index'])->name('kabid.index');
    Route::get('kabid/permohonan/{uuid}', [KabidController::class, 'permohonan'])->name('kabid.permohonan');
    Route::get('kabid/detail/{id}', [KabidController::class, 'show'])->name('kabid.show');
    Route::get('kabid/detail/tosekdin/{id}', [KabidController::class, 'showtosekdin'])->name('kabid.show.tosekdin');
    Route::patch('kabid/update/{id}', [KabidController::class, 'update'])->name('kabid.update');
    Route::patch('kabid/update/tosekdin/{id}', [KabidController::class, 'updatetosekdin'])->name('kabid.update.tosekdin');
});


Route::middleware([isKasi::class])->group(function () {
    Route::get('kasi/dashboard/', [KasiController::class, 'index'])->name('kasi.index');
    Route::get('kasi/permohonan/{uuid}', [KasiController::class, 'permohonan'])->name('kasi.permohonan');
    Route::get('kasi/detail/{id}', [KasiController::class, 'show'])->name('kasi.show');
    Route::get('kasi/detail/tokabid/{id}', [KasiController::class, 'showtokabid'])->name('kasi.show.tokabid');
    Route::patch('kasi/update/{id}', [KasiController::class, 'update'])->name('kasi.update');
});


Route::middleware([isJptjfu::class])->group(function () {
    Route::get('jptjfu/dashboard/', [JPTJFUController::class, 'index'])->name('jptjfu.index');
    Route::get('jptjfu/permohonan/{uuid}', [JPTJFUController::class, 'permohonan'])->name('jptjfu.permohonan');
    Route::get('jptjfu/detail/{id}', [JPTJFUController::class, 'show'])->name('jptjfu.show');
    Route::patch('jptjfu/update/{id}', [JPTJFUController::class, 'update'])->name('jptjfu.update');
});


// Route::get('/viewpdf', function () {
//     return response()->file(storage_path('app/permohonan/surat_pernyataan_keabsahan_1728525461.pdf'));
// });




Route::middleware([isSekdin::class])->group(function () {
    Route::get('sekdin/dashboard/', [SekdinController::class, 'index'])->name('sekdin.index');
    Route::get('sekdin/permohonan/{uuid}', [SekdinController::class, 'permohonan'])->name('sekdin.permohonan');
    Route::get('sekdin/detail/{id}', [SekdinController::class, 'show'])->name('sekdin.show');
    Route::patch('sekdin/update/{id}', [SekdinController::class, 'update'])->name('sekdin.update');
});
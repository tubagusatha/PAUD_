<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Permohonan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipe_permohonan',
        'status_pengajuan',
        'lokasi_permohonan',
        'jenis_bangunan',
        'tanggal_rencana_lokasi',
        'luas_tanah',
        'pemilik_bangunan',
        'nomor_izin_lokasi',
        'status_id',
        'no_resi'
    ];

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke FrontOffice
    public function frontOffice(): HasOne
    {
        return $this->hasOne(FrontOffice::class, 'permohonan_id');
    }

    // Relasi ke Status
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function kadis(): HasOne
    {
        return $this->hasOne(Kadis::class, 'permohonan_id');
    }

    public function kabid(): HasOne
    {
        return $this->hasOne(kabid::class, 'permohonan_id');
    }

    public function kasi(): HasOne
    {
        return $this->hasOne(kasi::class, 'permohonan_id');
    }


    public function jptjfu(): HasOne
    {
        return $this->hasOne(jptjfu::class, 'permohonan_id');
    }

    public function sekdin(): HasOne
    {
        return $this->hasOne(sekdin::class, 'permohonan_id');
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(PermohonanGallery::class, 'permohonan_id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PermohonanGallery extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'permohonan_id',
        'surat_permohonan_perpanjang',
        'surat_pernyataan_keabsahan',
        'surat_izin_pendirian',
        'peninjauan_lokasi',
    ];

    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(Permohonan::class);
    }
}

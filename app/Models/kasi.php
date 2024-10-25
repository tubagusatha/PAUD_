<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class kasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'permohonan_id',
        'status',
        'received_at',
        'forwarded_at',
        'notes',
    ];

    // Mendefinisikan relasi dengan model Permohonan
    public function permohonan() :BelongsTo
    {
        return $this->belongsTo(Permohonan::class, 'permohonan_id');
    }
}

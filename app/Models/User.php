<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'no_ktp_paspor_kitas',
        'no_npwp',
        'tempat_lahir',
        'tanggal_lahir',
        'provinsi',
        'kota_kab',
        'desa_kelurahan',
        'handphone',
        'email',
        'password',
        'role'
    ];

    protected static function boot()
{
    parent::boot();

    // Set UUID saat pengguna baru dibuat
    static::creating(function ($user) {
        $user->uuid = Str::uuid();
    });
}

    // Relasi ke Permohonan
    public function permohonans(): HasMany
    {
        return $this->hasMany(Permohonan::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

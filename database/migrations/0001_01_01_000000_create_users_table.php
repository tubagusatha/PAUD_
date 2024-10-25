<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ID unik untuk user
            $table->string('nama_lengkap')->nullable(); // Nama lengkap user
            $table->string('no_ktp_paspor_kitas')->nullable(); // Nomor KTP/Paspor/Kitas bisa kosong 
            $table->uuid('uuid')->unique()->nullable();
            $table->string('no_npwp')->nullable(); // Nomor NPWP bisa kosong
            $table->string('tempat_lahir')->nullable(); // Tempat lahir bisa kosong
            $table->date('tanggal_lahir')->nullable(); // Tanggal lahir bisa kosong
            $table->string('provinsi')->nullable(); // Provinsi bisa kosong
            $table->string('kota_kab')->nullable(); // Kota atau kabupaten bisa kosong
            $table->string('desa_kelurahan')->nullable(); // Desa atau kelurahan bisa kosong
            $table->string('handphone')->nullable(); // Nomor handphone bisa kosong
            $table->string('email')->unique(); // Email harus unik
            $table->string('password');
            $table->string('role')->enum('PEMOHON', 'FO', 'KADIS', 'KABID', 'KASI', 'JPTJFU', 'SEKDIN')->default('PEMOHON');
            $table->timestamps(); // Timestamps created_at dan updated_at
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

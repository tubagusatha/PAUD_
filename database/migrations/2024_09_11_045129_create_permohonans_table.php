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
        Schema::create('permohonans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users
            $table->boolean('tipe_permohonan'); // Tipe permohonan (boolean)
            $table->boolean('status_pengajuan'); // Status pengajuan
            $table->string('lokasi_permohonan'); // Lokasi permohonan
            $table->string('jenis_bangunan'); // Jenis bangunan
            $table->date('tanggal_rencana_lokasi'); // Tanggal rencana lokasi
            $table->integer('luas_tanah'); // Luas tanah
            $table->string('pemilik_bangunan'); // Pemilik bangunan
            $table->string('nomor_izin_lokasi'); // Nomor izin lokasi
            $table->string('no_resi')->unique()->nullable();
            $table->timestamps(); // Timestamps
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key ke tabel users
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};

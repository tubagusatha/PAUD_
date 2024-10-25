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
        Schema::create('front_office', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonan_id')->constrained('permohonans')->onDelete('cascade'); // Perbaiki nama tabel dari 'permohonan' menjadi 'permohonans'
            $table->timestamp('received_at')->nullable();
            $table->timestamp('forwarded_at')->nullable();
            $table->text('notes')->nullable(); // Catatan atau komentar dari Front Office
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('front_office'); // Sesuaikan nama tabel dengan nama yang digunakan di method up
    }
};

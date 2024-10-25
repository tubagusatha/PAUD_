<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            // Pastikan kolom ini belum ada, jika ada hapus terlebih dahulu dengan rollback
            if (!Schema::hasColumn('permohonans', 'status_id')) {
                $table->unsignedBigInteger('status_id')->default(1); // Default bisa disesuaikan
                $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });
    }
};

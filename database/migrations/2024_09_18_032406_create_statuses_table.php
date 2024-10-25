<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Kolom untuk nama status
            $table->timestamps();
        });

        // Insert predefined statuses
        DB::table('statuses')->insert([
            ['name' => 'Menunggu Diterima oleh Front Office'],
            ['name' => 'Di terima oleh Front Office dan diteruskan ke Kepala Dinas'],
            ['name' => 'Disposisi ke Kabid oleh Kadis'],
            ['name' => 'Disposisi ke Kasi oleh Kabid'],
            ['name' => 'Disposisi ke JPT/JFU'],
            ['name' => 'Perlu Perbaikan'],
            ['name' => 'Sudah di Perbaiki'],
            ['name' => 'Diteruskan ke Kasi oleh JPT/JFU'],
            ['name' => 'Diteruskan ke Kabid oleh Kasi'],
            ['name' => 'Diteruskan ke Sekdin oleh Kabid'],
            ['name' => 'Diteruskan ke Kadis oleh Sekdin'],
            ['name' => 'Dikembalikan ke JPT/JFU'],
            ['name' => 'Disetujui Kadis'],
            
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};

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
        Schema::create('prodi_statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('total_mahasiswa')->default(450);
            $table->integer('jumlah_alumni')->default(1200);
            $table->integer('jurnal_terpublikasi')->default(320);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi_statistics');
    }
};

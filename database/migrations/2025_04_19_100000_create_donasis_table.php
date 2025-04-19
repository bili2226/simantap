<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->enum('jenis_donasi', [
                'Bencana Alam',
                'Yatim Piatu',
                'Infrastruktur Masjid',
                'Fakir Miskin',
                'Sahur dan Berbuka',
                'Listrik Masjid'
            ]);
            $table->bigInteger('nominal');
            $table->string('keterangan')->nullable();
            $table->string('bukti_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};

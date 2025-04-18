<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nomor_hp');
            $table->string('email');
            $table->string('instansi')->nullable();
            $table->string('alamat');
            $table->json('nama_kegiatan'); // array kegiatan
            $table->string('nama_pengantin_pria')->nullable();
            $table->string('nama_pengantin_wanita')->nullable();
            $table->string('tanggal_kegiatan');
            $table->string('jumlah_peserta')->nullable();
            $table->string('waktu_kegiatan');
            $table->string('ktp_path')->nullable();
            $table->boolean('persetujuan');
            $table->enum('kesediaan', ['bersedia', 'tidak']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};

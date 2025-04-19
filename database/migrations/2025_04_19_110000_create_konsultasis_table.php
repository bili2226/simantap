<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konsultasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nomor_hp');
            $table->string('email');
            $table->enum('kategori', ['Fiqih', 'Aqidah', 'Muamalah', 'Keluarga', 'Dll']);
            $table->text('pertanyaan');
            $table->string('gambar_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konsultasis');
    }
};

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
        Schema::create('mualafs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nomor_hp');
            $table->string('email');
            $table->string('alamat');
            $table->date('tanggal_kegiatan');
            $table->string('waktu_kegiatan');
            $table->text('catatan')->nullable();
            $table->boolean('persetujuan');
            $table->enum('kesediaan', ['bersedia', 'tidak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mualafs');
    }
};

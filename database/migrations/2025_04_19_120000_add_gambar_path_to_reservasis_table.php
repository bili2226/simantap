<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->string('gambar_path')->nullable()->after('ktp_path');
        });
    }

    public function down(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropColumn('gambar_path');
        });
    }
};

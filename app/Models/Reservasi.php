<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_lengkap',
        'nomor_hp',
        'email',
        'instansi',
        'alamat',
        'nama_kegiatan',
        'nama_pengantin_pria',
        'nama_pengantin_wanita',
        'tanggal_kegiatan',
        'jumlah_peserta',
        'waktu_kegiatan',
        'ktp_path',
        'gambar_path',
        'persetujuan',
        'kesediaan',
    ];
    protected $casts = [
        'nama_kegiatan' => 'array',
    ];
}

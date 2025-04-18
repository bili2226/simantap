<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mualaf extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_lengkap',
        'nomor_hp',
        'email',
        'alamat',
        'tanggal_kegiatan',
        'waktu_kegiatan',
        'catatan',
        'persetujuan',
        'kesediaan',
    ];
}

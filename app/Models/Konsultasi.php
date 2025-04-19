<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_lengkap',
        'nomor_hp',
        'email',
        'kategori',
        'pertanyaan',
        'gambar_path',
    ];
}

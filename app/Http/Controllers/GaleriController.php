<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;

class GaleriController extends Controller
{
    public function index()
    {
        $acara = Reservasi::orderBy('tanggal_kegiatan', 'desc')->get();
        return view('layouts.galeri', compact('acara'));
    }
}

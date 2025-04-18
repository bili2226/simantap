<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mualaf;

class InformasiController extends Controller
{
    public function index()
    {
        $mualafs = Mualaf::orderBy('created_at', 'desc')->get();
        $reservasis = \App\Models\Reservasi::orderBy('created_at', 'desc')->get();
        return view('layouts.informasi', compact('mualafs', 'reservasis'));
    }
}

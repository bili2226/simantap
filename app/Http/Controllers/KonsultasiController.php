<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsultasi;

class KonsultasiController extends Controller
{
    public function index()
    {
        $konsultasis = Konsultasi::orderBy('created_at', 'desc')->get();
        $kategori_list = ['Fiqih', 'Aqidah', 'Muamalah', 'Keluarga', 'Dll'];
        return view('layouts.konsultasi', compact('konsultasis', 'kategori_list'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'kategori' => 'required|in:Fiqih,Aqidah,Muamalah,Keluarga,Dll',
            'pertanyaan' => 'required|string',
            'gambar_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        if ($request->hasFile('gambar_path')) {
            $validated['gambar_path'] = $request->file('gambar_path')->store('konsultasi_gambar', 'public');
        }
        Konsultasi::create($validated);
        return redirect()->back()->with('success', 'Pertanyaan berhasil dikirim!');
    }
}

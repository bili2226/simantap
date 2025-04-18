<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mualaf;

class MualafController extends Controller
{
    public function create()
    {
        return view('layouts.mualaf');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'waktu_kegiatan' => 'required|string|max:20',
            'catatan' => 'nullable|string',
            'persetujuan' => 'required|boolean',
            'kesediaan' => 'required|in:bersedia,tidak',
        ]);
        Mualaf::create($validated);
        return redirect()->back()->with('success', 'Pendaftaran berhasil disimpan!');
    }
}

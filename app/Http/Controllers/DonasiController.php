<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;

class DonasiController extends Controller
{
    public function index()
    {
        $donasi_types = [
            'Bencana Alam',
            'Yatim Piatu',
            'Infrastruktur Masjid',
            'Fakir Miskin',
            'Sahur dan Berbuka',
            'Listrik Masjid'
        ];
        return view('layouts.donasi', compact('donasi_types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_donasi' => 'required|in:Bencana Alam,Yatim Piatu,Infrastruktur Masjid,Fakir Miskin,Sahur dan Berbuka,Listrik Masjid',
            'nominal' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string|max:255',
            'bukti_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        if ($request->hasFile('bukti_path')) {
            $validated['bukti_path'] = $request->file('bukti_path')->store('bukti_donasi', 'public');
        }
        Donasi::create($validated);
        return redirect()->back()->with('success', 'Donasi berhasil disimpan!');
    }
}

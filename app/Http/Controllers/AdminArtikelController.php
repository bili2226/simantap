<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class AdminArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::orderBy('created_at', 'desc')->get();
        return view('admin.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('admin.artikel.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }
        Artikel::create($validated);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('admin.artikel.form', compact('artikel'));
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($artikel->gambar && \Storage::disk('public')->exists($artikel->gambar)) {
                \Storage::disk('public')->delete($artikel->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }
        $artikel->update($validated);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diupdate!');
    }

    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->delete();
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}

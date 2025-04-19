@extends('layouts.admin.admin')
@section('content')
<div class="mb-4 flex justify-between items-center">
    <h2 class="text-xl font-bold">Manajemen Berita</h2>
    <a href="{{ route('admin.berita.create') }}" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">+ Tambah Berita</a>
</div>
@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">{{ session('success') }}</div>
@endif
<table class="min-w-full bg-white rounded shadow">
    <thead class="bg-[#f5f5f2]">
        <tr>
            <th class="p-2">Judul</th>
            <th class="p-2">Tanggal</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($beritas as $berita)
        <tr class="border-t">
            <td class="p-2">{{ $berita->judul }}</td>
            <td class="p-2">{{ $berita->created_at->format('d M Y') }}</td>
            <td class="p-2 flex gap-2">
                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="bg-yellow-400 px-2 py-1 rounded text-xs">Edit</a>
                <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Yakin hapus berita?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection

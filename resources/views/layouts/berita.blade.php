<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'berita') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-700 bg-[#f5f5f2] antialiased">
  <header class="bg-white shadow-sm">
    <div class="max-w-6xl mx-auto flex items-center justify-between py-2 px-4">
      <div class="flex items-center gap-3">
        <a href="/home" class="flex items-center gap-3">
          <img src="{{ asset('aset/logoMasjid.svg') }}" alt="Logo" class="w-16 h-16 object-contain">
          <span class="text-xl font-bold text-gray-700">Masjid Jami Tangkubanperahu</span>
        </a>
      </div>
      <nav class="flex gap-2 md:gap-4">
        <a href="/home" class="bg-[#d2cc8c] rounded-full px-3 py-1 text-xs md:text-sm font-semibold shadow hover:bg-[#c6be7b] transition">Home</a>
        <a href="/agenda" class="bg-[#d2cc8c] rounded-full px-3 py-1 text-xs md:text-sm font-semibold shadow hover:bg-[#c6be7b] transition">Agenda</a>
        <a href="/artikel" class="bg-[#d2cc8c] rounded-full px-3 py-1 text-xs md:text-sm font-semibold shadow hover:bg-[#c6be7b] transition">Artikel</a>
        <a href="/berita" class="bg-[#d2cc8c] rounded-full px-3 py-1 text-xs md:text-sm font-semibold shadow hover:bg-[#a5a15a] transition font-bold">Berita</a>
        <a href="/informasi" class="bg-[#d2cc8c] rounded-full px-3 py-1 text-xs md:text-sm font-semibold shadow hover:bg-[#c6be7b] transition">Informasi</a>
      </nav>
    </div>
  </header>

  <main class="max-w-4xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-blue-700 mb-6 text-center">Berita Masjid</h1>
    <div class="grid gap-8">
      @forelse($beritas as $berita)
        <div class="bg-white rounded-xl shadow p-6 flex flex-col gap-3">
          <h2 class="text-xl font-bold text-[#4b4b2e] mb-2">{{ $berita->judul }}</h2>
          <div class="text-xs text-gray-500 mb-2">{{ $berita->created_at->format('d M Y') }}</div>
          @if($berita->gambar)
            <img src="{{ asset('storage/'.$berita->gambar) }}" alt="Gambar Berita" class="w-full max-h-64 object-cover rounded mb-3">
          @endif
          <div class="text-gray-800 text-base">{!! nl2br(e($berita->isi)) !!}</div>
        </div>
      @empty
        <div class="text-center text-gray-500 py-8">Belum ada berita.</div>
      @endforelse
    </div>
  </main>
</body>
</html>

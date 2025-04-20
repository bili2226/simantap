<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi | Masjid Jami Tangkubanperahu</title>
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
          <a href="/berita" class="bg-[#d2cc8c] rounded-full px-3 py-1 text-xs md:text-sm font-semibold shadow hover:bg-[#c6be7b] transition">Berita</a>
          <a href="/informasi" class="bg-[#d2cc8c] rounded-full px-3 py-1 text-xs md:text-sm font-semibold shadow hover:bg-[#c6be7b] transition">Informasi</a>
          <span id="currentTimeHome" class="font-mono text-xs text-gray-700 bg-white px-3 py-1 rounded-full ml-1"></span>

        </nav>
      </div>
    </header>

    <main class="max-w-2xl mx-auto py-8 px-4">
      <h1 class="text-2xl font-bold text-center mb-4">Konsultasi</h1>
      <div class="text-xs text-gray-800 text-center mb-6">
        Setiap insan pasti menghadapi ujian dan pertanyaan dalam hidup-baik tentang ibadah, keluarga, pekerjaan, hingga persoalan hati yang rumit. Dalam Islam, mencari ilmu dan meminta nasihat adalah bagian dari kebaikan. Melalui layanan konsultasi Islami ini, kami mengundang Anda untuk berbagi dan bertanya seputar permasalahan kehidupan dengan bimbingan dari para ustadz yang amanah dan berpengalaman. Jangan ragu untuk mencari jalan keluar yang diridhai Allah. InsyaAllah, setiap langkah menuju kebaikan akan dibalas dengan pahala dan ketenangan hati.
      </div>
      @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
          {{ session('success') }}
        </div>
      @endif
      <form method="POST" action="{{ route('konsultasi.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl shadow p-6 space-y-4 mb-8">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="w-full border border-gray-300 rounded px-3 py-2" required>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Nomor HP</label>
            <input type="text" name="nomor_hp" class="w-full border border-gray-300 rounded px-3 py-2" required>
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Email <span class='text-gray-400'>(opsional)</span></label>
            <input type="email" name="email" class="w-full border border-gray-300 rounded px-3 py-2">
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Kategori Pertanyaan</label>
          <div class="flex flex-wrap gap-6">
            @foreach($kategori_list as $kategori)
              <label class="inline-flex items-center gap-1">
                <input type="radio" name="kategori" value="{{ $kategori }}" class="accent-[#b7b36e]" required> {{ $kategori }}
              </label>
            @endforeach
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Pertanyaan</label>
          <textarea name="pertanyaan" class="w-full border border-gray-300 rounded px-3 py-2" rows="3" required></textarea>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Upload Gambar (opsional, JPG/JPEG/PNG/PDF)</label>
          <input type="file" name="gambar_path" accept=".jpg,.jpeg,.png,.pdf" class="w-full border border-gray-300 rounded px-3 py-2">
          <span class="text-xs text-gray-500">Maksimal 2MB.</span>
        </div>
        <button type="submit" class="w-full bg-[#b7b36e] text-white font-semibold py-2 rounded mt-2 hover:bg-[#a5a15a] transition">Ajukan Pertanyaan</button>
      </form>

      <h2 class="text-lg font-bold mb-4 text-center">Daftar Pertanyaan Konsultasi</h2>
      <div class="overflow-x-auto bg-white rounded-xl shadow p-4">
        <table class="min-w-full divide-y divide-gray-200 text-xs md:text-sm">
          <thead class="bg-[#e8e8e3]">
            <tr>
              <th class="px-2 py-2 font-semibold">No</th>
              <th class="px-2 py-2 font-semibold">Nama</th>
              <th class="px-2 py-2 font-semibold">Kategori</th>
              <th class="px-2 py-2 font-semibold">Pertanyaan</th>
              <th class="px-2 py-2 font-semibold">File</th>
              <th class="px-2 py-2 font-semibold">Tanggal</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            @forelse($konsultasis as $konsultasi)
            <tr>
              <td class="px-2 py-2">{{ $loop->iteration }}</td>
              <td class="px-2 py-2">{{ $konsultasi->nama_lengkap }}</td>
              <td class="px-2 py-2">{{ $konsultasi->kategori }}</td>
              <td class="px-2 py-2">{{ $konsultasi->pertanyaan }}</td>
              <td class="px-2 py-2">
                @if($konsultasi->gambar_path)
                  <a href="{{ asset('storage/'.$konsultasi->gambar_path) }}" target="_blank" class="text-blue-600 underline">Lihat File</a>
                @else
                  -
                @endif
              </td>
              <td class="px-2 py-2">{{ $konsultasi->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center py-4 text-gray-500">Belum ada pertanyaan konsultasi.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </main>

    <footer class="mt-10 bg-[#e8e8e3] border-t border-gray-200 relative overflow-hidden">
      <img src="{{ asset('aset/imagemasjid.svg') }}" alt="Footer Background" class="absolute inset-0 w-full h-full object-cover opacity-30 pointer-events-none select-none" />
      <div class="relative max-w-6xl mx-auto py-8 px-4 grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
        <div class="flex flex-col items-center md:items-start gap-2">
          <img src="{{ asset('aset/logoMasjid.svg') }}" alt="Logo" class="w-21 h-21 object-contain">
          <p class="text-sm font-semibold">Selamat Datang Di Website Resmi Masjid Jami<br>Tangkubanperahu, Jakarta</p>
        </div>
        <div class="md:col-span-2 flex justify-center">
          <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=106.833574%2C-6.208285%2C106.835574%2C-6.206285&layer=mapnik&marker=-6.207285,106.834574" class="w-full h-96 rounded-xl border border-gray-300 shadow" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </footer>
</body>
</html>

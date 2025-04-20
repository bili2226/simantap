@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'artikel') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

   <!-- Scripts -->
   @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-700 bg-[#f5f5f2] antialiased">
  <!-- Header & Navbar -->
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

  <!-- Main Artikel Section -->
  <main class="max-w-4xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-green-700 mb-6 text-center">Artikel Masjid</h1>
    <div class="grid gap-8">
      @forelse($artikels as $artikel)
        <div class="bg-white rounded-xl shadow p-6 flex flex-col gap-3">
          <h2 class="text-xl font-bold text-[#4b4b2e] mb-2">{{ $artikel->judul }}</h2>
          <div class="text-xs text-gray-500 mb-2">{{ $artikel->created_at->format('d M Y') }}</div>
          @if($artikel->gambar)
            <img src="{{ asset('storage/'.$artikel->gambar) }}" alt="Gambar Artikel" class="w-full max-h-64 object-cover rounded mb-3">
          @endif
          <div class="text-gray-800 text-base">{!! nl2br(e($artikel->isi)) !!}</div>
        </div>
      @empty
        <div class="text-center text-gray-500 py-8">Belum ada artikel.</div>
      @endforelse
    </div>
  </main>
  <main class="max-w-6xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-center mb-6">Artikel Islam</h1>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
      <!-- Sidebar Kiri: Artikel Terbaru -->
      <aside class="md:col-span-1 col-span-1">
        <button class="bg-[#b7b36e] text-white px-4 py-2 rounded mb-4 w-full font-semibold">Artikel Terbaru</button>
        <ul class="space-y-2 text-xs md:text-sm">
          <li>Kajian Tafsir QS Al Asr: Pentingnya Waktu sebagai Amanah Ilahi</li>
          <li>Mimbar Ramadhan: Kolaborasi Negara dan Masyarakat dalam Pembentukan Masyarakat Madani</li>
          <li>Kajian Subuh Istiqal: Keutamaan Membaca Alquran di Bulan Ramadhan</li>
          <li>Hikmah: Ramadhan dan Muhasabah yang Menyapa Umat Islam</li>
        </ul>
      </aside>
      <!-- Artikel Utama dan List -->
      <section class="md:col-span-3 col-span-1">
        <div class="grid md:grid-cols-3 gap-6">
          <!-- Artikel Utama -->
          <div class="md:col-span-2 col-span-1">
            @if($artikels->count())
              <!-- Artikel Utama (artikel terbaru) -->
              @php $utama = $artikels->first(); @endphp
              <div class="bg-white rounded-xl shadow p-4 mb-6">
                @if($utama->gambar)
                  <img src="{{ asset('storage/'.$utama->gambar) }}" class="w-full h-48 object-cover rounded mb-4" alt="{{ $utama->judul }}">
                @endif
                <h2 class="font-bold text-lg mb-2">{{ $utama->judul }}</h2>
                <div class="text-xs text-gray-500 mb-1">{{ $utama->created_at->format('d M Y') }}</div>
                <div class="text-gray-800 text-sm mb-2">{!! Str::limit(strip_tags($utama->isi), 150) !!}</div>
              </div>
              <!-- List Artikel Lainnya -->
              <div class="space-y-4">
                @foreach($artikels->skip(1) as $artikel)
                  <div class="flex gap-3 bg-white rounded-lg shadow p-2">
                    @if($artikel->gambar)
                      <img src="{{ asset('storage/'.$artikel->gambar) }}" class="w-20 h-16 object-cover rounded" alt="{{ $artikel->judul }}">
                    @endif
                    <div>
                      <div class="font-semibold text-sm">{{ $artikel->judul }}</div>
                      <div class="text-xs text-gray-500">{{ Str::limit(strip_tags($artikel->isi), 70) }}</div>
                      <div class="text-xs text-gray-400">{{ $artikel->created_at->format('d M Y') }}</div>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <div class="text-center text-gray-500 py-8">Belum ada artikel.</div>
            @endif
              </div>
            </div>
          </div>
          <!-- Artikel Samping (Ringkasan) -->
          <div class="space-y-4">
            <div class="bg-white rounded-lg shadow p-2 flex gap-2">
              <img src="{{ asset('aset/artikel5.jpg') }}" class="w-16 h-12 object-cover rounded" alt="Fatwa Syaikh Shalih">
              <div>
                <div class="font-semibold text-xs">Fatwa Syaikh Shalih Al Fauzan Seputar Kerjasama Dengan Negara Kafir</div>
                <div class="text-[11px] text-gray-500">6 April 2015</div>
              </div>
            </div>
            <div class="bg-white rounded-lg shadow p-2 flex gap-2">
              <img src="{{ asset('aset/artikel6.jpg') }}" class="w-16 h-12 object-cover rounded" alt="Tiada Nabi Lagi Sesudah Beliau">
              <div>
                <div class="font-semibold text-xs">Tiada Nabi Lagi Sesudah Beliau</div>
                <div class="text-[11px] text-gray-500">21 Februari 2014</div>
              </div>
            </div>
            <div class="bg-white rounded-lg shadow p-2 flex gap-2">
              <img src="{{ asset('aset/artikel7.jpg') }}" class="w-16 h-12 object-cover rounded" alt="Atasi Corona dengan Bertauhid">
              <div>
                <div class="font-semibold text-xs">Atasi Corona dengan Bertauhid yang Sempurna (Bag. 4)</div>
                <div class="text-[11px] text-gray-500">6 April 2020</div>
              </div>
            </div>
            <div class="bg-white rounded-lg shadow p-2 flex gap-2">
              <img src="{{ asset('aset/artikel8.jpg') }}" class="w-16 h-12 object-cover rounded" alt="Kedudukan Ulama">
              <div>
                <div class="font-semibold text-xs">Kedudukan Ulama Di Tengah Umat</div>
                <div class="text-[11px] text-gray-500">12 Januari 2016</div>
              </div>
            </div>
            <div class="bg-white rounded-lg shadow p-2 flex gap-2">
              <img src="{{ asset('aset/artikel9.jpg') }}" class="w-16 h-12 object-cover rounded" alt="Serial 24 Alam Jin">
              <div>
                <div class="font-semibold text-xs">Serial 24 Alam Jin: Jin yang Beriman pada Al Quran</div>
                <div class="text-[11px] text-gray-500">17 September 2014</div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

  <!-- Footer dengan peta -->
  <footer class="mt-10 bg-[#e8e8e3] border-t border-gray-200 relative overflow-hidden">
    <img src="{{ asset('aset/imagemasjid.svg') }}" alt="Footer Background" class="absolute inset-0 w-full h-full object-cover opacity-30 pointer-events-none select-none" />
    <div class="relative max-w-6xl mx-auto py-8 px-4 grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
      <div class="flex flex-col items-center md:items-start gap-2">
        <img src="{{ asset('aset/logoMasjid.svg') }}" alt="Logo" class="w-21 h-21 object-contain">
        <p class="text-sm font-semibold">Selamat Datang Di Website Resmi Masjid Jami<br>Tangkubanperahu, Jakarta</p>
      </div>
      <div class="md:col-span-2 flex justify-center">
  <div class="relative w-full">
    <button id="toggleMapFullscreen" type="button" class="absolute z-20 top-2 right-2 bg-[#d2cc8c] hover:bg-[#c6be7b] text-gray-800 px-3 py-1 rounded shadow-md text-xs font-semibold transition focus:outline-none focus:ring-2 focus:ring-yellow-400">
      <span id="fullscreenIcon">⛶</span> Fullscreen
    </button>
    <iframe id="mapFrame" src="https://www.openstreetmap.org/export/embed.html?bbox=106.833574%2C-6.208285%2C106.835574%2C-6.206285&layer=mapnik&marker=-6.207285,106.834574" class="w-full h-96 rounded-xl border border-gray-300 shadow transition-all duration-300" allowfullscreen loading="lazy"></iframe>
  </div>
</div>
    </div>
  </footer>
</body>
<script>
// Toggle fullscreen untuk map (sama seperti home.blade.php)
const toggleMapFullscreenBtn = document.getElementById('toggleMapFullscreen');
const mapFrame = document.getElementById('mapFrame');
const fullscreenIcon = document.getElementById('fullscreenIcon');

if (toggleMapFullscreenBtn && mapFrame) {
  toggleMapFullscreenBtn.addEventListener('click', function() {
    const mapContainer = mapFrame.parentElement;
    if (!document.fullscreenElement) {
      if (mapContainer.requestFullscreen) {
        mapContainer.requestFullscreen();
      } else if (mapContainer.webkitRequestFullscreen) { /* Safari */
        mapContainer.webkitRequestFullscreen();
      } else if (mapContainer.msRequestFullscreen) { /* IE11 */
        mapContainer.msRequestFullscreen();
      }
    } else {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.webkitExitFullscreen) { /* Safari */
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) { /* IE11 */
        document.msExitFullscreen();
      }
    }
  });

  document.addEventListener('fullscreenchange', function() {
    const mapContainer = mapFrame.parentElement;
    if (document.fullscreenElement === mapContainer) {
      fullscreenIcon.textContent = '🗗';
      toggleMapFullscreenBtn.innerHTML = '<span id="fullscreenIcon">🗗</span> Exit Fullscreen';
      toggleMapFullscreenBtn.classList.add('bg-yellow-300');
      // Ubah map agar benar-benar fullscreen
      mapContainer.style.position = 'fixed';
      mapContainer.style.top = '0';
      mapContainer.style.left = '0';
      mapContainer.style.width = '100vw';
      mapContainer.style.height = '100vh';
      mapContainer.style.zIndex = '9999';
      mapContainer.style.background = '#fff';
      mapFrame.style.width = '100vw';
      mapFrame.style.height = '100vh';
      mapFrame.classList.remove('rounded-xl','border','border-gray-300','shadow');
    } else {
      fullscreenIcon.textContent = '⛶';
      toggleMapFullscreenBtn.innerHTML = '<span id="fullscreenIcon">⛶</span> Fullscreen';
      toggleMapFullscreenBtn.classList.remove('bg-yellow-300');
      // Kembalikan ke semula
      mapContainer.style.position = '';
      mapContainer.style.top = '';
      mapContainer.style.left = '';
      mapContainer.style.width = '';
      mapContainer.style.height = '';
      mapContainer.style.zIndex = '';
      mapContainer.style.background = '';
      mapFrame.style.width = '';
      mapFrame.style.height = '';
      mapFrame.classList.add('rounded-xl','border','border-gray-300','shadow');
    }
  });
}
</script>
</html>

<div class="bg-white rounded-xl shadow p-4 mb-6 w-full">
  <div class="flex items-center justify-between mb-2">
    <h3 class="font-bold text-lg text-green-700">Jadwal Sholat</h3>
    <span class="text-xs text-gray-500">Jakarta, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
  </div>
  <table class="w-full text-sm">
    <tbody>
      @php
        $jadwal = [
          'Imsak' => '04:25',
          'Subuh' => '04:35',
          'Dzuhur' => '11:50',
          'Ashar' => '15:13',
          'Maghrib' => '17:48',
          'Isya' => '18:59',
        ];
        // $now dihilangkan, highlight akan dihandle oleh JS
        $highlight = null; // default, JS akan handle highlight
        // foreach jadwal tetap, highlight diisi JS nanti
      @endphp
      @foreach($jadwal as $nama => $jam)
        <tr data-sholat="{{ $nama }}" data-jam="{{ $jam }}">
          <td class="py-1 font-semibold text-gray-700">{{ $nama }}</td>
          <td class="py-1 text-right">{{ $jam }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
    <div id="highlightInfo" class="mt-2 text-xs text-green-700 font-semibold text-center animate-pulse"></div>

    <script>
    function pad(n){return n<10?'0'+n:n;}
    function getNowHM() {
      const now = new Date();
      return pad(now.getHours()) + ':' + pad(now.getMinutes());
    }
    function highlightSholatNext() {
      const now = getNowHM();
      let next = null, nextTime = null;
      let found = false;
      const rows = document.querySelectorAll('tr[data-sholat]');
      rows.forEach(row => {
        row.classList.remove('bg-green-50','font-bold');
      });
      rows.forEach(row => {
        const jam = row.getAttribute('data-jam');
        const nama = row.getAttribute('data-sholat');
        if (!found && now < jam) {
          next = nama;
          nextTime = jam;
          row.classList.add('bg-green-50','font-bold');
          found = true;
        }
      });
      if (!found && rows.length) {
        // Setelah Isya, highlight Isya
        const last = rows[rows.length-1];
        next = last.getAttribute('data-sholat');
        nextTime = last.getAttribute('data-jam');
        last.classList.add('bg-green-50','font-bold');
      }
      const info = document.getElementById('highlightInfo');
      if (info && next && nextTime) {
        info.innerHTML = `Waktu berikutnya: ${next} (${nextTime})`;
      }
    }
    setInterval(highlightSholatNext, 1000);
    highlightSholatNext();
    </script>
</div>

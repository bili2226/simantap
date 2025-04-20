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
        $now = '10:49'; // current time dari metadata
        $highlight = null;
        foreach ($jadwal as $nama => $jam) {
          if ($now < $jam) { $highlight = $nama; break; }
        }
        if (!$highlight) $highlight = 'Isya';
      @endphp
      @foreach($jadwal as $nama => $jam)
        <tr @if($nama == $highlight) class="bg-green-50 font-bold" @endif>
          <td class="py-1 font-semibold text-gray-700">{{ $nama }}</td>
          <td class="py-1 text-right">{{ $jam }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  @if($highlight)
    <div class="mt-2 text-xs text-green-700 font-semibold text-center animate-pulse">
      Waktu berikutnya: {{ $highlight }} ({{ $jadwal[$highlight] }})
    </div>
  @endif
</div>

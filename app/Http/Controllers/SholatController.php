<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SholatController extends Controller
{
    public function jadwal(Request $request)
    {
        $url = "https://jadwalsholat.org/adzan/ajax/next/ajax.daily.php?id=81";
        try {
            $response = Http::timeout(5)->get($url);
            $data = $response->body();
            // API ini mengembalikan JSON, tapi kadang ada karakter aneh di awal, jadi perlu dibersihkan
            $data = trim($data);
            if (strpos($data, '{') !== 0) {
                $data = substr($data, strpos($data, '{'));
            }
            $json = json_decode($data, true);
            $jadwal = [
                'imsak' => $json['imsak'] ?? '-',
                'subuh' => $json['shubuh'] ?? '-',
                'dzuhur' => $json['dzuhur'] ?? '-',
                'ashar' => $json['ashr'] ?? '-',
                'maghrib' => $json['maghrib'] ?? '-',
                'isya' => $json['isya'] ?? '-',
            ];
        } catch (\Exception $e) {
            $jadwal = [];
        }
        return view('layouts.sholat', compact('jadwal'));

    }
}

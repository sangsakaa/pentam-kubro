<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $prov = 'https://wilayah.id/api/provinces.json';

        // Menggunakan facade Http untuk melakukan GET request
        $response = Http::get($prov);

        // Memastikan response berhasil
        if ($response->successful()) {
            $provinces = $response->json()['data'];

            // Mengirim data ke view 'dashboard'
            return view('dashboard', compact('provinces'));
        } else {
            // Jika terjadi error, kembalikan response error
            return response()->json(['error' => 'Tidak dapat mengambil data wilayah'], $response->status());
        }
    }
    public function getKabupaten($provinceCode)
    {
        $kab = "https://wilayah.id/api/regencies/{$provinceCode}.json";

        $response = Http::get($kab);

        if ($response->successful()) {
            return response()->json($response->json()['data']);
        } else {
            return response()->json(['error' => 'Tidak dapat mengambil data kabupaten'], $response->status());
        }
    }
}

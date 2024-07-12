<?php

namespace App\Http\Controllers;

use App\Models\Rombongan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class LaporanController extends Controller
{
    public function LaporanGelombang()
    {

        $prov = 'https://wilayah.id/api/provinces.json';
        $responseProv = Http::get($prov);

        if ($responseProv->successful()) {
            $provinsi = $responseProv->json(); // Asumsikan $provinsi berisi array kode dan nama provinsi

            // Buat array untuk memetakan kode provinsi ke nama provinsi
            $provinsiMap = [];

            // Extract the provinces data
            foreach ($provinsi['data'] as $prov) {
                $provinsiMap[$prov['code']] = $prov['name'];
            }

            // Ambil semua data dari model Rombongan
            $grafikPeserta = Rombongan::orderby('created_at', 'desc')->get();

            // Iterate through $grafikPeserta and translate province codes to province names
            foreach ($grafikPeserta as $peserta) {
                if (isset($provinsiMap[$peserta->province])) {
                    $peserta->province_name = $provinsiMap[$peserta->province];
                } else {
                    $peserta->province_name = 'Unknown';
                }

                // Ambil kode kabupaten
                $provinceCode = $peserta->province;
                $kab = "https://wilayah.id/api/regencies/{$provinceCode}.json";
                $responseKab = Http::get($kab);

                if ($responseKab->successful()) {
                    $kabupaten = $responseKab->json(); // Asumsikan $kabupaten berisi array kode dan nama kabupaten
                    $kabupatenMap = [];

                    // Extract the regencies data
                    foreach ($kabupaten['data'] as $kab) {
                        $kabupatenMap[$kab['code']] = $kab['name'];
                    }

                    // Translate regency codes to regency names
                    if (isset($kabupatenMap[$peserta->kabupaten])) { // Ubah $peserta->regency menjadi $peserta->kabupaten
                        $peserta->regency_name = $kabupatenMap[$peserta->kabupaten];
                    } else {
                        $peserta->regency_name = 'Unknown';
                    }

                    // Ambil kode kecamatan
                    $regencyCode = $peserta->kabupaten;
                    $kec = "https://wilayah.id/api/districts/{$regencyCode}.json";
                    $responseKec = Http::get($kec);

                    if ($responseKec->successful()) {
                        $kecamatan = $responseKec->json(); // Asumsikan $kecamatan berisi array kode dan nama kecamatan
                        $kecamatanMap = [];

                        // Extract the districts data
                        foreach ($kecamatan['data'] as $kec) {
                            $kecamatanMap[$kec['code']] = $kec['name'];
                        }

                        // Translate district codes to district names
                        if (isset($kecamatanMap[$peserta->kecamatan])) {
                            $peserta->district_name = $kecamatanMap[$peserta->kecamatan];
                        } else {
                            $peserta->district_name = 'Unknown';
                        }
                    } else {
                        $peserta->district_name = 'Unknown';
                    }
                } else {
                    $peserta->regency_name = 'Unknown';
                    $peserta->district_name = 'Unknown';
                }
            }

            // Mengirim data ke view 'dashboard'
            return view('admin.laporan.gelombang', compact('grafikPeserta'));
        } else {
            // Jika terjadi error, kembalikan response error
            return response()->json(['error' => 'Tidak dapat mengambil data wilayah'], $responseProv->status());
        }
    }
}

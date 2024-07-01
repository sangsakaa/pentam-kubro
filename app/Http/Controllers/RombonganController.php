<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Rombongan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class RombonganController extends Controller
{
    public function store(Request $request)
 {
        // dd($request->all());
        $request->validate([
            'province' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'nama' => 'required',
        ]);
        $date = Carbon::now()->format('d-m'); // Format the date as 'd-m-Y'
        $year = Carbon::now()->year; // Get the current year

        // Get the last registration record ordered by 'id' in descending order
        $lastRegistration = Rombongan::orderBy('id', 'desc')->first();

        if ($lastRegistration) {
            // Extract the last 9 digits of the registration code and convert to an integer
            $lastNumber = (int) substr($lastRegistration->kode_pendaftaran, -9);
        } else {
            // If no registration exists, start from 0
            $lastNumber = 0;
        }

        // Increment the last number by 1
        $number = $lastNumber + 1;

        // Pad the number with leading zeros to make it 9 digits long
        $formattedNumber = str_pad($number, 9, '0', STR_PAD_LEFT);

        // Create the new registration code
        $kode_pendaftaran = "{$date}-{$year}-{$formattedNumber}";

        // Create a new Rombongan instance and save the data
        $rombongan = new Rombongan();
        $rombongan->kode_pendaftaran = $kode_pendaftaran;
        $rombongan->province = $request->input('province');
        $rombongan->kabupaten = $request->input('kabupaten');
        $rombongan->kecamatan = $request->input('kecamatan');
        $rombongan->nama = $request->input('nama');
        $rombongan->jumlah_peserta_remaja = $request->input('jumlah_peserta_remaja');
        $rombongan->jumlah_peserta_kanak = $request->input('jumlah_peserta_kanak');
        $rombongan->jumlah_peserta_ibu = $request->input('jumlah_peserta_ibu');
        $rombongan->jumlah_peserta_bapak = $request->input('jumlah_peserta_bapak');
        $rombongan->gelombang_acara = json_encode($request->input('gelombang_acara')); // Simpan sebagai JSON string
        $rombongan->tempat_acara = $request->input('tempat_acara');
        $rombongan->saran = $request->input('saran');
        $rombongan->kendaraan = $request->input('kendaraan');
        $rombongan->nama_lokasi = $request->input('nama_lokasi');
        $rombongan->jenis_lokasi = $request->input('jenis_lokasi');
        $rombongan->biaya = $request->input('biaya');
        $rombongan->no_hp_ketua = $request->input('no_hp_ketua');
        $rombongan->tanggal_berangkat = $request->input('tanggal_berangkat');
        $rombongan->tanggal_pulang = $request->input('tanggal_pulang');
        $rombongan->save();
        return redirect('/notifikasi/' . $kode_pendaftaran)->with('success', 'pengisian berhasil');
    }
    public function create()
    {
        // dd('ok');
        $prov = 'https://wilayah.id/api/provinces.json';

        // Menggunakan facade Http untuk melakukan GET request
        $response = Http::get($prov);

        // Memastikan response berhasil
        if ($response->successful()) {
            $provinces = $response->json()['data'];

            // Mengirim data ke view 'dashboard'
            return view('admin.rombongan.create', compact('provinces'));
        } else {
            // Jika terjadi error, kembalikan response error
            return response()->json(['error' => 'Tidak dapat mengambil data wilayah'], $response->status());
        }
        return view('admin.rombongan.create');
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
    public function getKecamatan($kabupatenCode)
    {
        $url = "https://wilayah.id/api/districts/{$kabupatenCode}.json";
        $response = Http::get($url);

        if ($response->successful()) {
            $kecamatanData = $response->json();
            return response()->json($kecamatanData);
        } else {
            return response()->json(['error' => 'Unable to fetch data'], 500);
        }
        dd($response);
    }
    
    public function Notif($kode_pendaftaran)
    {
        // dd($kode_pendaftaran);
        $kode_pendaftaran = Rombongan::where('kode_pendaftaran', $kode_pendaftaran)->first();
        return view('admin.rombongan.notifikasi', compact('kode_pendaftaran'));
    }
    public function LayoutKartu($kode_pendaftaran)
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
            $grafikPeserta = Rombongan::where('kode_pendaftaran', $kode_pendaftaran)->get();

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
                } else {
                    $peserta->regency_name = 'Unknown';
                }
            }
            // Mengirim data ke view 'dashboard'
            return view('admin.rombongan.kartupeserta', compact('grafikPeserta'));
        } else {
            // Jika terjadi error, kembalikan response error
            return response()->json(['error' => 'Tidak dapat mengambil data wilayah'], $responseProv->status());
        }
    }
    public function downloadKPK($kode_pendaftaran)
    {
        // Initialize Dompdf
        $dompdf = new Dompdf();

        // Fetch provinces data
        $prov = 'https://wilayah.id/api/provinces.json';
        $responseProv = Http::get($prov);

        if ($responseProv->successful()) {
            $provinsi = $responseProv->json(); // Assume $provinsi contains an array of province codes and names

            // Create an array to map province codes to province names
            $provinsiMap = [];

            // Extract the provinces data
            foreach ($provinsi['data'] as $prov) {
                $provinsiMap[$prov['code']] = $prov['name'];
            }

            // Fetch all data from Rombongan model
            $grafikPeserta = Rombongan::where('kode_pendaftaran', $kode_pendaftaran)->get();

            // Iterate through $grafikPeserta and translate province codes to province names
            foreach ($grafikPeserta as $peserta) {
                if (isset($provinsiMap[$peserta->province])) {
                    $peserta->province_name = $provinsiMap[$peserta->province];
                } else {
                    $peserta->province_name = 'Unknown';
                }

                // Fetch regency data based on province code
                $provinceCode = $peserta->province;
                $kab = "https://wilayah.id/api/regencies/{$provinceCode}.json";
                $responseKab = Http::get($kab);

                if ($responseKab->successful()) {
                    $kabupaten = $responseKab->json(); // Assume $kabupaten contains an array of regency codes and names
                    $kabupatenMap = [];

                    // Extract the regencies data
                    foreach ($kabupaten['data'] as $kab) {
                        $kabupatenMap[$kab['code']] = $kab['name'];
                    }

                    // Translate regency codes to regency names
                    if (isset($kabupatenMap[$peserta->kabupaten])) {
                        $peserta->regency_name = $kabupatenMap[$peserta->kabupaten];
                    } else {
                        $peserta->regency_name = 'Unknown';
                    }
                } else {
                    $peserta->regency_name = 'Unknown';
                }
            }

            // Send data to the 'kartupeserta' view
            $html = view('admin.rombongan.kartupeserta', compact('grafikPeserta'))->render();

            // Load HTML content into Dompdf
            $dompdf->loadHtml($html);

            // Set paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            // Render the PDF
            $dompdf->render();

            // Output the generated PDF to browser for download
            return $dompdf->stream($kode_pendaftaran . ".pdf", ["Attachment" => true]);
        } else {
            // If there is an error, return a JSON response with the error message
            return response()->json(['error' => 'Tidak dapat mengambil data wilayah'], $responseProv->status());
        }

    }
}

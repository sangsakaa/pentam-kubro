<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rombongan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class RombonganController extends Controller
{
    public function store(Request $request)
 {
        $request->validate([
            'province' => 'required',
            'kabupaten' => 'required',
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
        $rombongan->nama = $request->input('nama');
        $rombongan->jumlah_peserta_remaja = $request->input('jumlah_peserta_remaja');
        $rombongan->jumlah_peserta_kanak = $request->input('jumlah_peserta_kanak');
        $rombongan->jumlah_peserta_ibu = $request->input('jumlah_peserta_ibu');
        $rombongan->jumlah_peserta_bapak = $request->input('jumlah_peserta_bapak');
        $rombongan->gelombang_acara = json_encode($request->input('gelombang_acara')); // Simpan sebagai JSON string
        $rombongan->tempat_acara = $request->input('tempat_acara');
        $rombongan->saran = $request->input('saran');
        $rombongan->kendaraan = $request->input('kendaraan');
        $rombongan->tanggal_berangkat = $request->input('tanggal_berangkat');
        $rombongan->save();
        return redirect()->back();
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
}

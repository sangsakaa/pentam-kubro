<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rombongan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RombonganController extends Controller
{
 public function index(Request $request)
 {
        $request->validate([
            'province' => 'required',
            'kabupaten' => 'required',
            'nama' => 'required',
        ]);
        $date = Carbon::now()->format('d-m-Y'); // Format the date as 'd-m-Y'
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
        $rombongan->jumlah_peserta = $request->input('jumlah_peserta');
        $rombongan->gelombang_acara = $request->input('gelombang_acara');
        $rombongan->tampat_acara = $request->input('tampat_acara');
        $rombongan->saran = $request->input('saran');
        $rombongan->save();

        return redirect('dashboard');

 }
}

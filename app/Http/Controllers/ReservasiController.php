<?php

namespace App\Http\Controllers;


use App\Models\Rombongan;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservasiController extends Controller
{
    public function checkin()
    {
        $reservation = reservation::all();
        return view('admin.reservasi.checkin', compact('reservation'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'qrCode' => 'required|string',
        ]);
        // Check if a reservation with the same qr_code already exists
        $existingReservation = Reservation::where('qr_code', $request->input('qrCode'))->first();

        if ($existingReservation) {
            // Handle the case where the reservation already exists
            return response()->json(['error' => 'Reservation with this QR code already exists.'], 400);
        }
        // Create a new reservation
        $reservation = new Reservation();
        $reservation->qr_code = $request->input('qrCode');
        // Add other necessary fields here
        $reservation->save();

        return response()->json(['success' => 'Reservation created successfully.'], 201);
    }
    public function generateQR()
    {
        $grafikPeserta = Rombongan::get();

        foreach ($grafikPeserta as $peserta) {
            try {
                // Generate the QR code for each participant
                $qrCode = QrCode::format('png')->size(300)->generate($peserta->kode_pendaftaran);

                // Define the path to save the QR code image
                $path = public_path('img-qr-peserta/' . $peserta->kode_pendaftaran . '.png');

                // Save the QR code image to the specified path
                file_put_contents($path, $qrCode);
            } catch (\Exception $e) {
                // Handle exceptions if needed
                continue;
            }
        }


        // return redirect('reservasi');
    }
    public function index()
    {
        $reservation = reservation::query()
            ->join('rombongan', 'rombongan.kode_pendaftaran', 'reservations.qr_code')
            ->select(
                'rombongan.kode_pendaftaran',
                'rombongan.nama',
                'rombongan.jumlah_peserta',
                'rombongan.jumlah_peserta_remaja',
                'rombongan.jumlah_peserta_kanak',
                'rombongan.jumlah_peserta_ibu',
                'rombongan.jumlah_peserta_bapak',
                'rombongan.province',
                'rombongan.kabupaten',
                'rombongan.kecamatan',
                'rombongan.tanggal_pulang',
                'rombongan.jenis_lokasi',
                'rombongan.nama_lokasi',
                'rombongan.biaya',
                'rombongan.no_hp_ketua',
                'rombongan.gelombang_acara',
                'rombongan.tempat_acara',
                'rombongan.saran',
                'rombongan.kendaraan',
                'rombongan.tanggal_berangkat',
                'reservations.id'
            )
            ->get();


        return view('admin.reservasi.index', compact('reservation'));
    }
    public function destroy(Reservation $reservation)
    {
        Reservation::destroy($reservation->id);
        return redirect()->back();
    }
}

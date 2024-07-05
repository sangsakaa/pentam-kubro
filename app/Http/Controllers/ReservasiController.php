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
                $path = public_path('iqcode_peserta/' . $peserta->kode_pendaftaran . '.png');

                // Save the QR code image to the specified path
                file_put_contents($path, $qrCode);
            } catch (\Exception $e) {

                continue;
            }
        }

        return redirect('reservasi');

    }
}

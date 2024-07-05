<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


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
}

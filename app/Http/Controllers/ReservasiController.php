<?php

namespace App\Http\Controllers;


use App\Models\Rombongan;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
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
        return redirect()->back()->with('success', 'Data berhasil diupdate');

        // return response()->json(['success' => 'Reservation created successfully.'], 201)->with('success');
    }
    public function generateQR()
    {
        $grafikPeserta = Rombongan::get();

        // Define the directory path for QR codes
        $qrCodeDirectory = storage_path('app/public/qrcodes');

        // Check if the directory exists, if not, create it
        if (!File::exists($qrCodeDirectory)) {
            File::makeDirectory($qrCodeDirectory, 0755, true);
        }

        // Array to hold file paths of generated QR codes
        $filePaths = [];

        // Loop through each participant and generate a QR code
        foreach ($grafikPeserta as $peserta) {
            // Get the kode_pendaftaran for the current participant
            $kodePendaftaran = $peserta->kode_pendaftaran;

            // Define the file path for the QR code SVG
            $filePath = 'qrcodes/' . $kodePendaftaran . '.svg';

            // Generate the QR code and save it as an SVG in public storage
            QrCode::format('svg')->size(300)->errorCorrection('L')->generate($kodePendaftaran, storage_path('app/public/' . $filePath));

            // Add the file path to the array
            $filePaths[] = asset('storage/' . $filePath);
        }

        // Return a JSON response with a success message and the file paths of generated QR codes
        // return response()->json([
        //     'message' => 'QR codes generated successfully',
        //     'file_paths' => $filePaths
        // ])->back();
        return redirect()->back();
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
    public function checkKode(Request $request)
    {
        $kode_pendaftaran = Rombongan::where('kode_pendaftaran', $request->kode_pendaftaran)->first();
        return view('admin.reservasi.check_kode_pendaftaran', compact('kode_pendaftaran'));
    }
}

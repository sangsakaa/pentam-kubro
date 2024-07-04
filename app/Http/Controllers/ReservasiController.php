<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function checkin()
    {
        return view('admin.reservasi.checkin');
    }
}

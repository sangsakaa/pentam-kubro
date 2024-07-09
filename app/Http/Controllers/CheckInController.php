<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckInController extends Controller
{
    public function index()
    {
        return view('admin.reservasi.checkout');
    }
}

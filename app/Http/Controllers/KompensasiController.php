<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KompensasiController extends Controller
{
    public function index()
    {
        return view('kompensasi.index');
    }
}

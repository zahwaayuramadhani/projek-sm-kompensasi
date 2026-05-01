<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanBandingController extends Controller
{
    public function index()
    {
        return view('pengajuan_banding.index');
    }
}


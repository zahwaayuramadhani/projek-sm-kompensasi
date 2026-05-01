<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataProdiController extends Controller
{
    public function index()
    {
        return view('data_prodi.index');
    }
}


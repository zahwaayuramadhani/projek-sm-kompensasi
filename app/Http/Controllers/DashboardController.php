<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        // return view('admin.dashboard');

        if (Auth::user()->level == 2) {
        return view('mahasiswa.dashboard');
        }

    return view('admin.dashboard');
}
}

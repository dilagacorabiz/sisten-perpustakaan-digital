<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return view('siswa.dashboard');
    }

    public function peminjaman()
    {
        return view('siswa.peminjaman');
    }

    public function riwayat()
    {
        return view('siswa.riwayat');
    }
}
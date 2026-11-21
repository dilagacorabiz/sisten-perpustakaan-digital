<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        return view('petugas.dashboard');
    }

    public function peminjaman()
    {
        return view('petugas.peminjaman');
    }

    public function pengembalian()
    {
        return view('petugas.pengembalian');
    }

    public function laporan()
    {
        return view('petugas.laporan');
    }
}
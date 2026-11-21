<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function riwayat()
    {
        $peminjaman = Peminjaman::where(
            'user_id',
            auth()->id()
        )->get();

        return view('peminjaman.riwayat', compact('peminjaman'));
    }
}
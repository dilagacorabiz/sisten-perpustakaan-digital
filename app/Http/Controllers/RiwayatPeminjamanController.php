<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatPeminjamanController extends Controller
{
    public function index()
    {
        $anggota = auth()->user()->anggota;

        if (!$anggota) {
            abort(403, 'Data anggota belum terhubung dengan akun ini.');
        }

        $peminjaman = $anggota->peminjamans()
            ->with('buku')
            ->get();

        return view('peminjaman.riwayat', compact('peminjaman'));
    }
}
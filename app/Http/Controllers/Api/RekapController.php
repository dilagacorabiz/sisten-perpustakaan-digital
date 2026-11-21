<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;

class RekapController extends Controller
{
    // GET /api/rekap/buku-per-kategori
    public function bukuPerKategori()
    {
        $data = Kategori::withCount('bukus')
            ->get()
            ->map(function ($kategori) {
                return [
                    'kategori_id' => $kategori->id,
                    'kategori' => $kategori->nama,
                    'jumlah_buku' => $kategori->bukus_count,
                ];
            });

        return response()->json([
            'message' => 'Rekap buku per kategori berhasil diambil.',
            'data' => $data,
        ], 200);
    }

    // GET /api/rekap/peminjaman-per-buku
    public function peminjamanPerBuku()
    {
        $data = Buku::withCount('peminjamans')
            ->get()
            ->map(function ($buku) {
                return [
                    'buku_id' => $buku->id,
                    'judul' => $buku->judul,
                    'total_peminjaman' => $buku->peminjamans_count,
                ];
            });

        return response()->json([
            'message' => 'Rekap peminjaman per buku berhasil diambil.',
            'data' => $data,
        ], 200);
    }
}
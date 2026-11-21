<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LoanController extends Controller
{
    // Menampilkan daftar peminjaman untuk admin dan petugas
    public function index()
    {
        $peminjamans = Peminjaman::with([
            'anggota.user',
            'buku'
        ])->latest()->paginate(10);

        return view('loans.index', compact('peminjamans'));
    }

    // Menampilkan form pengajuan peminjaman
    public function create()
    {
        $bukus = Buku::all();

        return view('loans.create', compact('bukus'));
    }

    // Menyimpan pengajuan peminjaman
    public function store(Request $request)
    {
        $validated = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $anggota = Anggota::where('user_id', auth()->id())->firstOrFail();

        Peminjaman::create([
            'anggota_id' => $anggota->id,
            'buku_id' => $validated['buku_id'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'status' => 'menunggu',
        ]);

        return back()->with('success', 'Pengajuan peminjaman berhasil.');
    }

    // Melihat detail peminjaman
    public function show($id)
    {
        $peminjaman = Peminjaman::with([
            'anggota.user',
            'buku'
        ])->findOrFail($id);

        Gate::authorize('view', $peminjaman);

        return view('loans.show', compact('peminjaman'));
    }

    // Melihat peminjaman milik sendiri
    public function mine()
    {
        $anggota = Anggota::where('user_id', auth()->id())->firstOrFail();

        $peminjamans = Peminjaman::with('buku')
            ->where('anggota_id', $anggota->id)
            ->latest()
            ->paginate(10);

        return view('loans.mine', compact('peminjamans'));
    }

    // Menyetujui peminjaman
    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'disetujui'
        ]);

        return back()->with('success', 'Peminjaman berhasil disetujui.');
    }

    // Mencatat pengembalian
    public function return($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'dikembalikan'
        ]);

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }
}
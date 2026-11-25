<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LoanController extends Controller
{
    // Daftar peminjaman untuk Admin dan Petugas
    public function index()
    {
        $peminjamans = Peminjaman::with([
            'anggota.user',
            'buku'
        ])->latest()->paginate(10);

        return view('loans.index', compact('peminjamans'));
    }

    // Form pengajuan peminjaman untuk Siswa
    public function create()
    {
        $bukus = Buku::with('kategori')->get();

        return view('loans.create', compact('bukus'));
    }

    // Menyimpan pengajuan peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $anggota = Anggota::where('user_id', Auth::id())->first();

        if (!$anggota) {
            return back()->with('error', 'Data anggota belum terhubung dengan akun kamu.');
        }

        $sudahMeminjam = Peminjaman::where('anggota_id', $anggota->id)
            ->where('buku_id', $request->buku_id)
            ->whereIn('status', ['menunggu', 'dipinjam'])
            ->exists();

        if ($sudahMeminjam) {
            return back()->with('error', 'Buku ini masih dalam proses peminjaman.');
        }

        Peminjaman::create([
            'anggota_id' => $anggota->id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali' => null,
            'status' => 'menunggu',
        ]);

        return redirect()->route('loans.mine')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim.');
    }

    // Riwayat peminjaman milik pengguna yang login
    public function mine()
    {
        $anggota = Anggota::where('user_id', Auth::id())->first();

        if (!$anggota) {
            return view('loans.mine', [
                'peminjamans' => collect(),
                'error' => 'Data anggota belum terhubung dengan akun kamu.',
            ]);
        }

        $peminjamans = Peminjaman::with('buku')
            ->where('anggota_id', $anggota->id)
            ->latest()
            ->paginate(10);

        return view('loans.mine', compact('peminjamans'));
    }

    // Detail peminjaman
    public function show($id)
{
    $peminjaman = Peminjaman::with([
        'anggota.user',
        'buku'
    ])->findOrFail($id);

    // Gate::authorize('view', $peminjaman);

    return view('loans.show', compact('peminjaman'));
}

    // Persetujuan peminjaman oleh Admin/Petugas
    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Peminjaman ini tidak dapat diproses.');
        }

        $peminjaman->update([
            'status' => 'dipinjam',
        ]);

        return back()->with('success', 'Peminjaman berhasil disetujui.');
    }

    // Mencatat pengembalian buku
    public function return($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Buku ini tidak dalam status dipinjam.');
        }

        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()->toDateString(),
        ]);

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }
}
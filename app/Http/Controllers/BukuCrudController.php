<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuCrudController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->get();
        $kategoris = Kategori::all();

        return view('buku.index', compact('bukus', 'kategoris'));
    }

    
public function create()
{
    $kategoris = Kategori::all();

    return view('buku.create', compact('kategoris'));
}

public function store(Request $request)
{
    $request->validate([
        'kategori_id' => 'required|exists:kategoris,id',
        'judul' => 'required|string|min:3|max:150',
        'penulis' => 'required|string|min:3|max:100',
        'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
    ]);

    Buku::create([
        'kategori_id' => $request->kategori_id,
        'judul' => $request->judul,
        'penulis' => $request->penulis,
        'tahun_terbit' => $request->tahun_terbit,
    ]);

    return redirect()->route('books.index')
        ->with('success', 'Buku berhasil ditambahkan!');
}

    public function show(Buku $buku)
    {
        $buku->load('kategori');

        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        $kategoris = Kategori::all();

        return view('buku.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|digits:4',
        ]);

        $buku->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }

    // PENGUJIAN SQL INJECTION MODUL 6 (A2)

public function cariRentan(Request $request)
{
    $judul = $request->query('judul');

    $bukus = DB::select(
        "SELECT * FROM bukus WHERE judul = ?",
        [$judul]
    );

    return response()->json($bukus);
}
}
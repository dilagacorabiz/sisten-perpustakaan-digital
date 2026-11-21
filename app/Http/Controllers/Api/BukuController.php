<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use App\Http\Resources\BukuResource;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // GET /api/buku
   public function index()
{
    $bukus = Buku::with('kategori')->get();

    return BukuResource::collection($bukus);
}

    // POST /api/buku
    public function store(StoreBukuRequest $request)
    {
        $validated = $request->validated();

        $buku = Buku::create($validated);

        return new BukuResource(
            $buku->load('kategori')
        );
    }

    // GET /api/buku/{buku}
    public function show(Buku $buku)
    {
        $buku->load('kategori', 'peminjamans');
        $buku->loadCount('peminjamans');

        return new BukuResource($buku);
    }

    // PUT/PATCH /api/buku/{buku}
    public function update(UpdateBukuRequest $request, Buku $buku)
    {
        $validated = $request->validated();

        $buku->update($validated);

        return new BukuResource(
            $buku->load('kategori')
        );
    }

    // DELETE /api/buku/{buku}
    public function destroy(Buku $buku)
    {
        $buku->delete();

        return response()->json([
            'message' => 'Buku berhasil dihapus'
        ], 200);
    }
}
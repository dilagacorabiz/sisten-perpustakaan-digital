<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $romance = Kategori::where('nama', 'Romance')->first()->id;
        $sejarah = Kategori::where('nama', 'Sejarah')->first()->id;
        $fiksi = Kategori::where('nama', 'Fiksi')->first()->id;

        Buku::factory()->create([
            'kategori_id' => $romance,
            'judul' => 'Dilan 1990',
            'penulis' => 'Pidi Baiq',
            'tahun_terbit' => 2014,
        ]);

        Buku::factory()->create([
            'kategori_id' => $romance,
            'judul' => 'Perahu Kertas',
            'penulis' => 'Dee Lestari',
            'tahun_terbit' => 2009,
        ]);

        Buku::factory()->create([
            'kategori_id' => $sejarah,
            'judul' => 'Bumi Manusia',
            'penulis' => 'Pramoedya Ananta Toer',
            'tahun_terbit' => 1980,
        ]);

        Buku::factory()->create([
            'kategori_id' => $fiksi,
            'judul' => 'Laskar Pelangi',
            'penulis' => 'Andrea Hirata',
            'tahun_terbit' => 2005,
        ]);

        Buku::factory()->create([
            'kategori_id' => $fiksi,
            'judul' => 'Sang Pemimpi',
            'penulis' => 'Andrea Hinata',
            'tahun_terbit' => 2006,
        ]);
    }
}
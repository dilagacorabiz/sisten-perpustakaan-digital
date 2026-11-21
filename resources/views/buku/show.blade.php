@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')

@if ($buku)

    <div class="book-detail">

        <h1>{{ $buku->judul }}</h1>

        <p>
            <strong>ID Buku:</strong>
            {{ $buku->id }}
        </p>

        <p>
            <strong>Penulis:</strong>
            {{ $buku->penulis }}
        </p>

        <p>
            <strong>Tahun Terbit:</strong>
            {{ $buku->tahun_terbit }}
        </p>

        <p>
            <strong>Kategori:</strong>
            {{ $buku->kategori->nama }}
        </p>

        <a href="{{ route('buku.index') }}">
            Kembali ke Daftar Buku
        </a>

    </div>

@else

    <div class="book-detail">

        <h1>Buku Tidak Ditemukan</h1>

        <p>
            Maaf, data buku yang kamu cari tidak tersedia.
        </p>

        <a href="{{ route('buku.index') }}">
            ← Kembali ke Daftar Buku
        </a>

    </div>

@endif

@endsection
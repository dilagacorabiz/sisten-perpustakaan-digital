@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<div class="hero">
    <span class="badge">PERPUSTAKAAN</span>

    <h1>Selamat Datang di Perpustakaan</h1>

    <p>
        Temukan berbagai koleksi buku yang tersedia
        di perpustakaan kami.
    </p>

    <a href="{{ route('buku.index') }}" class="btn">
        Lihat Daftar Buku
    </a>
</div>

@endsection
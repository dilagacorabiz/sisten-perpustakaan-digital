
@extends('layouts.library')

@section('title', 'Dashboard Siswa')
@section('page-title', 'Dashboard Siswa')

@section('content')

<div class="mb-8 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 p-8 text-white shadow-lg">
    <p class="text-sm text-blue-100">Selamat datang di Perpustakaan Digital!</p>
    <h1 class="mt-2 text-3xl font-bold">
        Halo, {{ auth()->user()->name }} 👋
    </h1>
    <p class="mt-3 text-sm text-blue-100">
        Temukan buku favoritmu dan nikmati kemudahan peminjaman.
    </p>
</div>

<h2 class="mb-5 text-xl font-bold text-slate-800">
    Menu Siswa
</h2>

<div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">

    <a href="{{ route('books.index') }}"
       class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 hover:shadow-lg transition">
        <div class="text-3xl">📚</div>
        <h3 class="mt-4 font-bold text-slate-800">Katalog Buku</h3>
        <p class="mt-2 text-sm text-slate-500">Jelajahi koleksi buku perpustakaan.</p>
    </a>

    <a href="{{ route('loans.mine') }}"
       class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 hover:shadow-lg transition">
        <div class="text-3xl">📋</div>
        <h3 class="mt-4 font-bold text-slate-800">Peminjaman Saya</h3>
        <p class="mt-2 text-sm text-slate-500">Lihat status dan riwayat peminjaman.</p>
    </a>

    <a href="{{ route('loans.create') }}"
       class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 hover:shadow-lg transition">
        <div class="text-3xl">📖</div>
        <h3 class="mt-4 font-bold text-slate-800">Pinjam Buku</h3>
        <p class="mt-2 text-sm text-slate-500">Ajukan peminjaman buku baru.</p>
    </a>

</div>

@endsection
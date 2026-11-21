
@extends('layouts.library')

@section('title', 'Dashboard Petugas')
@section('page-title', 'Dashboard Petugas')

@section('content')

<div class="mb-8 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 p-8 text-white shadow-lg">
    <p class="text-sm text-blue-100">Selamat datang kembali, Petugas!</p>
    <h1 class="mt-2 text-3xl font-bold">
        Halo, {{ auth()->user()->name }} 👋
    </h1>
    <p class="mt-3 text-sm text-blue-100">
        Kelola aktivitas perpustakaan dengan mudah.
    </p>
</div>

<h2 class="mb-5 text-xl font-bold text-slate-800">
    Menu Pengelolaan
</h2>

<div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">

    <a href="{{ route('books.index') }}"
       class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 hover:shadow-lg transition">
        <div class="text-3xl">📚</div>
        <h3 class="mt-4 font-bold text-slate-800">Data Buku</h3>
        <p class="mt-2 text-sm text-slate-500">Lihat dan kelola koleksi buku.</p>
    </a>

    <a href="{{ route('loans.index') }}"
       class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 hover:shadow-lg transition">
        <div class="text-3xl">📋</div>
        <h3 class="mt-4 font-bold text-slate-800">Peminjaman</h3>
        <p class="mt-2 text-sm text-slate-500">Proses pengajuan peminjaman buku.</p>
    </a>

    <a href="{{ route('loans.index') }}"
       class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 hover:shadow-lg transition">
        <div class="text-3xl">↩️</div>
        <h3 class="mt-4 font-bold text-slate-800">Pengembalian</h3>
        <p class="mt-2 text-sm text-slate-500">Catat pengembalian buku.</p>
    </a>

</div>

@endsection
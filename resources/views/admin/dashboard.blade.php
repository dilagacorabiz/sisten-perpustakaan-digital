
@extends('layouts.library')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')

{{-- WELCOME --}}
<div class="relative mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-600 p-8 text-white shadow-xl">
    <div class="relative z-10">
        <p class="text-sm font-medium text-blue-100">Selamat datang kembali,</p>
        <h1 class="mt-2 text-3xl font-extrabold">
            Halo, {{ auth()->user()->name }}! 👋
        </h1>
        <p class="mt-3 max-w-xl text-sm leading-relaxed text-blue-100">
            Selamat bekerja! Kelola seluruh aktivitas perpustakaan digital melalui dashboard administrator.
        </p>
    </div>
    <div class="absolute -right-10 -top-16 h-64 w-64 rounded-full bg-white/10"></div>
    <div class="absolute -bottom-24 right-28 h-52 w-52 rounded-full bg-white/10"></div>
    <div class="absolute right-8 top-8 hidden text-7xl opacity-30 md:block">📚</div>
</div>

{{-- SECTION TITLE --}}
<div class="mb-5">
    <h2 class="text-xl font-extrabold text-slate-800">Menu Pengelolaan</h2>
    <p class="mt-1 text-sm text-slate-500">Pilih menu untuk mengelola sistem perpustakaan.</p>
</div>

{{-- MENU CARDS --}}
<div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">

    <a href="{{ route('books.index') }}"
       class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-blue-300 hover:shadow-xl">
        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-3xl transition group-hover:bg-blue-600">
            <span class="group-hover:scale-110">📚</span>
        </div>
        <p class="mt-6 text-sm font-medium text-slate-500">Koleksi Perpustakaan</p>
        <h3 class="mt-1 text-xl font-extrabold text-slate-800">Data Buku</h3>
        <p class="mt-3 text-sm font-semibold text-blue-600">Lihat koleksi buku →</p>
    </a>

    <a href="{{ route('admin.users.index') }}"
       class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-purple-300 hover:shadow-xl">
        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-100 text-3xl">
            👥
        </div>
        <p class="mt-6 text-sm font-medium text-slate-500">Manajemen Akun</p>
        <h3 class="mt-1 text-xl font-extrabold text-slate-800">Data Pengguna</h3>
        <p class="mt-3 text-sm font-semibold text-purple-600">Kelola pengguna →</p>
    </a>

    <a href="{{ route('loans.index') }}"
       class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-amber-300 hover:shadow-xl">
        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-100 text-3xl">
            📋
        </div>
        <p class="mt-6 text-sm font-medium text-slate-500">Transaksi Perpustakaan</p>
        <h3 class="mt-1 text-xl font-extrabold text-slate-800">Peminjaman</h3>
        <p class="mt-3 text-sm font-semibold text-amber-600">Lihat peminjaman →</p>
    </a>

    <a href="{{ route('loans.index') }}"
       class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-emerald-300 hover:shadow-xl">
        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-3xl">
            ↩️
        </div>
        <p class="mt-6 text-sm font-medium text-slate-500">Transaksi Perpustakaan</p>
        <h3 class="mt-1 text-xl font-extrabold text-slate-800">Pengembalian</h3>
        <p class="mt-3 text-sm font-semibold text-emerald-600">Buka daftar transaksi →</p>
    </a>

</div>

{{-- INFORMATION --}}
<div class="mt-8 rounded-2xl border border-blue-100 bg-blue-50 p-6">
    <div class="flex items-start gap-4">
        <div class="text-3xl">💡</div>
        <div>
            <h3 class="font-bold text-blue-900">Informasi Administrator</h3>
            <p class="mt-2 text-sm leading-relaxed text-blue-700">
                Kamu memiliki akses untuk mengelola data buku, akun pengguna,
                hak akses, dan transaksi peminjaman perpustakaan.
                Pastikan seluruh data dikelola dengan benar.
            </p>
        </div>
    </div>
</div>

@endsection
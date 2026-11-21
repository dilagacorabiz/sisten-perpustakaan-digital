
@extends('layouts.library')

@section('title', 'Detail Peminjaman')
@section('page-title', 'Detail Peminjaman')

@section('content')

<div class="mx-auto max-w-4xl">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">
            Detail Peminjaman
        </h1>
        <p class="mt-2 text-sm text-slate-500">
            Informasi lengkap data peminjaman buku.
        </p>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-800">
                Informasi Peminjaman
            </h2>

            <span class="rounded-full bg-blue-50 px-4 py-2 text-xs font-bold text-blue-700">
                ID #{{ $peminjaman->id }}
            </span>
        </div>

        <div class="space-y-5">

            <div>
                <p class="text-sm text-slate-500">Nama Anggota</p>
                <p class="mt-1 font-semibold text-slate-800">
                    {{ $peminjaman->anggota->nama ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Judul Buku</p>
                <p class="mt-1 font-semibold text-slate-800">
                    {{ $peminjaman->buku->judul ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Tanggal Pinjam</p>
                <p class="mt-1 font-semibold text-slate-800">
                    {{ $peminjaman->tanggal_pinjam ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Tanggal Kembali</p>
                <p class="mt-1 font-semibold text-slate-800">
                    {{ $peminjaman->tanggal_kembali ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Status</p>
                <p class="mt-1 font-semibold text-slate-800">
                    {{ $peminjaman->status ?? '-' }}
                </p>
            </div>

        </div>

        <div class="mt-8 border-t border-slate-100 pt-5">
            <a href="{{ url()->previous() }}"
               class="inline-flex rounded-xl bg-slate-100 px-5 py-3 text-sm font-bold text-slate-700 hover:bg-slate-200">
                Kembali
            </a>
        </div>

    </div>

</div>

@endsection
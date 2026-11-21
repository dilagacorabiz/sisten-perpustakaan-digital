
@extends('layouts.app')

@section('title', 'Peminjaman Saya')
@section('page-title', 'Peminjaman Saya')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-wrap items-center justify-between gap-4">

        <div>
            <h1 class="text-2xl font-extrabold text-slate-800">
                Riwayat Peminjaman 📚
            </h1>
            <p class="mt-2 text-sm text-slate-500">
                Pantau status pengajuan dan riwayat buku yang kamu pinjam.
            </p>
        </div>

        <a href="{{ route('books.index') }}"
           class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-blue-200 transition hover:bg-blue-700">
            + Cari Buku
        </a>

    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(isset($error))
        <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-700">
            {{ $error }}
        </div>
    @endif

    {{-- RINGKASAN --}}
    <div class="grid gap-4 sm:grid-cols-3">

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Peminjaman</p>
            <h2 class="mt-2 text-3xl font-extrabold text-blue-600">
                {{ $peminjamans->total() }}
            </h2>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Menunggu</p>
            <h2 class="mt-2 text-3xl font-extrabold text-amber-500">
                {{ $peminjamans->getCollection()->where('status', 'menunggu')->count() }}
            </h2>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Sedang Dipinjam</p>
            <h2 class="mt-2 text-3xl font-extrabold text-green-600">
                {{ $peminjamans->getCollection()->where('status', 'dipinjam')->count() }}
            </h2>
        </div>

    </div>

    {{-- DAFTAR PEMINJAMAN --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 p-5">
            <h2 class="font-bold text-slate-800">
                Daftar Buku yang Dipinjam
            </h2>
            <p class="mt-1 text-xs text-slate-500">
                Seluruh transaksi peminjaman akun kamu.
            </p>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-5 py-4">No</th>
                        <th class="px-5 py-4">Judul Buku</th>
                        <th class="px-5 py-4">Tanggal Pinjam</th>
                        <th class="px-5 py-4">Tanggal Kembali</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Detail</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($peminjamans as $index => $peminjaman)

                        <tr class="transition hover:bg-slate-50">

                            <td class="px-5 py-4 font-semibold text-slate-500">
                                {{ $peminjamans->firstItem() + $index }}
                            </td>

                            <td class="px-5 py-4">
                                <p class="font-bold text-slate-800">
                                    {{ $peminjaman->buku?->judul ?? 'Buku tidak ditemukan' }}
                                </p>
                            </td>

                            <td class="px-5 py-4 text-slate-600">
                                {{ $peminjaman->tanggal_pinjam }}
                            </td>

                            <td class="px-5 py-4 text-slate-600">
                                {{ $peminjaman->tanggal_kembali ?? '-' }}
                            </td>

                            <td class="px-5 py-4">

                                @if($peminjaman->status === 'menunggu')
                                    <span class="rounded-full bg-amber-100 px-3 py-1.5 text-xs font-bold text-amber-700">
                                        Menunggu
                                    </span>

                                @elseif($peminjaman->status === 'dipinjam')
                                    <span class="rounded-full bg-blue-100 px-3 py-1.5 text-xs font-bold text-blue-700">
                                        Dipinjam
                                    </span>

                                @else
                                    <span class="rounded-full bg-green-100 px-3 py-1.5 text-xs font-bold text-green-700">
                                        Dikembalikan
                                    </span>
                                @endif

                            </td>

                            <td class="px-5 py-4">
                                <a href="{{ route('loans.show', $peminjaman->id) }}"
                                   class="inline-block rounded-lg bg-blue-50 px-3 py-2 text-xs font-bold text-blue-600 transition hover:bg-blue-100">
                                    Lihat Detail →
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center">
                                <div class="text-5xl">📚</div>

                                <p class="mt-3 font-bold text-slate-700">
                                    Belum Ada Peminjaman
                                </p>

                                <p class="mt-1 text-sm text-slate-400">
                                    Kamu belum mengajukan peminjaman buku.
                                </p>

                                <a href="{{ route('books.index') }}"
                                   class="mt-4 inline-block rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white hover:bg-blue-700">
                                    Jelajahi Buku
                                </a>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="border-t border-slate-100 p-5">
            {{ $peminjamans->links() }}
        </div>

    </div>

</div>

@endsection
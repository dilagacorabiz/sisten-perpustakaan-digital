
@extends('layouts.app')

@section('title', 'Data Peminjaman')
@section('page-title', 'Data Peminjaman')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-extrabold text-slate-800">
            Data Peminjaman Buku
        </h1>
        <p class="mt-2 text-sm text-slate-500">
            Kelola pengajuan, persetujuan, dan pengembalian buku perpustakaan.
        </p>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            {{ session('error') }}
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
            <p class="text-sm text-slate-500">Menunggu Persetujuan</p>
            <h2 class="mt-2 text-3xl font-extrabold text-amber-500">
                {{ $peminjamans->where('status', 'menunggu')->count() }}
            </h2>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Sedang Dipinjam</p>
            <h2 class="mt-2 text-3xl font-extrabold text-green-600">
                {{ $peminjamans->where('status', 'dipinjam')->count() }}
            </h2>
        </div>

    </div>

    {{-- TABEL --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 p-5">
            <h2 class="font-bold text-slate-800">
                Daftar Transaksi Peminjaman
            </h2>
            <p class="mt-1 text-xs text-slate-500">
                Informasi seluruh transaksi peminjaman buku.
            </p>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-5 py-4">No</th>
                        <th class="px-5 py-4">Anggota</th>
                        <th class="px-5 py-4">Buku</th>
                        <th class="px-5 py-4">Tanggal Pinjam</th>
                        <th class="px-5 py-4">Tanggal Kembali</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Aksi</th>
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
                                    {{ $peminjaman->anggota?->nama ?? $peminjaman->anggota?->user?->name ?? 'Tidak diketahui' }}
                                </p>
                                <p class="mt-1 text-xs text-slate-400">
                                    {{ $peminjaman->anggota?->email ?? '-' }}
                                </p>
                            </td>

                            <td class="px-5 py-4 font-medium text-slate-700">
                                {{ $peminjaman->buku?->judul ?? 'Buku tidak ditemukan' }}
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
                                <div class="flex flex-wrap items-center gap-2">

                                    <a href="{{ route('loans.show', $peminjaman->id) }}"
                                       class="rounded-lg bg-slate-100 px-3 py-2 text-xs font-bold text-slate-700 hover:bg-slate-200">
                                        Detail
                                    </a>

                                    @if($peminjaman->status === 'menunggu')
                                        <form action="{{ route('loans.approve', $peminjaman->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                onclick="return confirm('Setujui peminjaman ini?')"
                                                class="rounded-lg bg-blue-600 px-3 py-2 text-xs font-bold text-white hover:bg-blue-700">
                                                Setujui
                                            </button>
                                        </form>
                                    @endif

                                    @if($peminjaman->status === 'dipinjam')
                                        <form action="{{ route('loans.return', $peminjaman->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                onclick="return confirm('Catat pengembalian buku ini?')"
                                                class="rounded-lg bg-green-600 px-3 py-2 text-xs font-bold text-white hover:bg-green-700">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center">
                                <div class="text-4xl">📚</div>
                                <p class="mt-3 font-bold text-slate-700">
                                    Belum ada data peminjaman
                                </p>
                                <p class="mt-1 text-sm text-slate-400">
                                    Data pengajuan peminjaman akan muncul di sini.
                                </p>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="border-t border-slate-100 p-5">
            {{ $peminjamans->links() }}
        </div>

    </div>

</div>

@endsection
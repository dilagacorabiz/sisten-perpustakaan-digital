
@extends('layouts.library')

@section('title', 'Data Buku')
@section('page-title', 'Data Buku')

@section('content')

<div class="mx-auto max-w-7xl">

    {{-- HEADER HALAMAN --}}
    <div class="mb-8 flex flex-col justify-between gap-5 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm font-semibold text-blue-600">
                Manajemen Perpustakaan
            </p>

            <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">
                Data Buku Perpustakaan
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Kelola dan lihat seluruh koleksi buku perpustakaan.
            </p>
        </div>

        @can('kelola-buku')
            <a href="{{ route('books.create') }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-blue-200 transition hover:-translate-y-0.5 hover:bg-blue-700">
                <span class="text-lg">+</span>
                Tambah Buku
            </a>
        @endcan
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-700">
            <span class="text-xl">✓</span>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <p class="mb-2 font-bold">Terjadi kesalahan:</p>
            <ul class="list-inside list-disc">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- RINGKASAN --}}
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-2xl">
                    📚
                </div>
                <div>
                    <p class="text-sm text-slate-500">Total Koleksi Buku</p>
                    <h2 class="mt-1 text-2xl font-extrabold text-slate-800">
                        {{ $bukus->count() }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-100 text-2xl">
                    🗂️
                </div>
                <div>
                    <p class="text-sm text-slate-500">Kategori Buku</p>
                    <h2 class="mt-1 text-2xl font-extrabold text-slate-800">
                        {{ $bukus->pluck('kategori_id')->unique()->filter()->count() }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL BUKU --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="flex flex-col justify-between gap-2 border-b border-slate-200 p-6 sm:flex-row sm:items-center">
            <div>
                <h2 class="text-lg font-bold text-slate-800">
                    Daftar Koleksi Buku
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Informasi lengkap koleksi buku perpustakaan.
                </p>
            </div>

            <span class="w-fit rounded-full bg-blue-50 px-4 py-2 text-xs font-bold text-blue-700">
                {{ $bukus->count() }} Buku
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">

                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="whitespace-nowrap px-6 py-4">No</th>
                        <th class="whitespace-nowrap px-6 py-4">Judul Buku</th>
                        <th class="whitespace-nowrap px-6 py-4">Kategori</th>
                        <th class="whitespace-nowrap px-6 py-4">Penulis</th>
                        <th class="whitespace-nowrap px-6 py-4">Tahun</th>
                        <th class="whitespace-nowrap px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($bukus as $buku)
                        <tr class="transition hover:bg-blue-50/40">

                            <td class="whitespace-nowrap px-6 py-4 text-slate-500">
                                {{ $loop->iteration }}
                            </td>

                            <td class="min-w-48 px-6 py-4">
                                <p class="font-bold text-slate-800">
                                    {{ $buku->judul }}
                                </p>
                            </td>

                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="rounded-lg bg-purple-50 px-3 py-1.5 text-xs font-semibold text-purple-700">
                                    {{ $buku->kategori?->nama ?? '-' }}
                                </span>
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-slate-600">
                                {{ $buku->penulis }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-slate-600">
                                {{ $buku->tahun_terbit }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('books.show', $buku->id) }}"
                                       class="rounded-lg bg-blue-50 px-3 py-2 text-xs font-bold text-blue-700 transition hover:bg-blue-100">
                                        Detail
                                    </a>

                                        @can('kelola-buku')

                                        <a href="{{ route('books.edit', $buku->id) }}"
                                           class="rounded-lg bg-amber-50 px-3 py-2 text-xs font-bold text-amber-700 transition hover:bg-amber-100">
                                            Edit
                                        </a>

                                        <form action="{{ route('books.destroy', $buku->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="rounded-lg bg-red-50 px-3 py-2 text-xs font-bold text-red-700 transition hover:bg-red-100">
                                                Hapus
                                            </button>
                                        </form>

                                    @endcan

                                </div>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-3xl">
                                    📚
                                </div>

                                <h3 class="mt-4 font-bold text-slate-800">
                                    Belum Ada Data Buku
                                </h3>

                                <p class="mt-2 text-sm text-slate-500">
                                    Koleksi buku belum tersedia di perpustakaan.
                                </p>

                                @can('kelola-buku')
                                    <a href="{{ route('books.create') }}"
                                       class="mt-5 inline-flex rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white hover:bg-blue-700">
                                        + Tambahkan Buku Pertama
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- PAGINATION JIKA MENGGUNAKAN PAGINATE --}}
        @if(method_exists($bukus, 'links'))
            <div class="border-t border-slate-100 p-5">
                {{ $bukus->links() }}
            </div>
        @endif

    </div>

</div>

@endsection
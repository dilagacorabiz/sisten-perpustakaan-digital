
@extends('layouts.app')

@section('title', 'Tambah Buku')
@section('page-title', 'Tambah Buku')

@section('content')

<div class="mx-auto max-w-4xl">

    <div class="mb-6">
        <a href="{{ route('books.index') }}"
           class="text-sm font-semibold text-blue-600 hover:text-blue-800">
            ← Kembali ke Data Buku
        </a>

        <h1 class="mt-3 text-2xl font-extrabold text-slate-800">
            Tambah Buku Baru
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Masukkan informasi buku yang akan ditambahkan ke perpustakaan.
        </p>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm md:p-8">

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="mb-2 font-bold">Periksa kembali data berikut:</p>
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.store') }}" method="POST">
            @csrf

            <div class="space-y-5">

                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700">
                        Judul Buku
                    </label>
                    <input
                        type="text"
                        name="judul"
                        value="{{ old('judul') }}"
                        placeholder="Masukkan judul buku"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700">
                        Penulis
                    </label>
                    <input
                        type="text"
                        name="penulis"
                        value="{{ old('penulis') }}"
                        placeholder="Masukkan nama penulis"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700">
                        Kategori Buku
                    </label>

                   
<select
    name="kategori_id"
    required
    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
>
    <option value="">-- Pilih Kategori --</option>

    @foreach ($kategoris as $kategori)
        <option
            value="{{ $kategori->id }}"
            {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}
        >
            {{ $kategori->nama }}
        </option>
    @endforeach
</select>

                </div>

                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700">
                        Tahun Terbit
                    </label>
                    <input
                        type="number"
                        name="tahun_terbit"
                        value="{{ old('tahun_terbit') }}"
                        min="1900"
                        max="{{ date('Y') }}"
                        placeholder="Contoh: 2024"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >
                </div>

            </div>

            <div class="mt-8 flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">

                <a href="{{ route('books.index') }}"
                   class="rounded-xl border border-slate-300 px-6 py-3 text-center text-sm font-bold text-slate-600 hover:bg-slate-50">
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-blue-200 transition hover:bg-blue-700"
                >
                    + Simpan Buku
                </button>

            </div>

        </form>
    </div>
</div>

@endsection
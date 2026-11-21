
@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')
@section('page-title', 'Ajukan Peminjaman')

@section('content')

<div class="mx-auto max-w-4xl space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-extrabold text-slate-800">
            Ajukan Peminjaman Buku 📚
        </h1>
        <p class="mt-2 text-sm text-slate-500">
            Pilih buku yang ingin kamu pinjam dari koleksi perpustakaan.
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

    @if($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
            <ul class="list-inside list-disc text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-white">
            <h2 class="text-lg font-bold">
                Formulir Peminjaman
            </h2>
            <p class="mt-1 text-sm text-blue-100">
                Lengkapi pilihan buku yang ingin dipinjam.
            </p>
        </div>

        <form action="{{ route('loans.store') }}" method="POST" class="space-y-6 p-6">
            @csrf

            <div>
                <label for="buku_id" class="mb-2 block text-sm font-bold text-slate-700">
                    Pilih Buku
                </label>

                <select
                    name="buku_id"
                    id="buku_id"
                    required
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                >
                    <option value="">-- Pilih Buku --</option>

                    @forelse($bukus as $buku)
                        <option
                            value="{{ $buku->id }}"
                            {{ old('buku_id') == $buku->id ? 'selected' : '' }}
                        >
                            {{ $buku->judul }} - {{ $buku->penulis }}
                        </option>
                    @empty
                        <option value="" disabled>
                            Belum ada buku tersedia
                        </option>
                    @endforelse

                </select>

                @error('buku_id')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">
                <div class="flex gap-3">
                    <span class="text-xl">💡</span>
                    <div>
                        <p class="text-sm font-bold text-blue-800">
                            Informasi Peminjaman
                        </p>
                        <p class="mt-1 text-xs leading-relaxed text-blue-700">
                            Setelah mengajukan peminjaman, permintaan akan
                            berstatus menunggu sampai disetujui oleh Admin
                            atau Petugas perpustakaan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap justify-end gap-3">

                <a href="{{ route('loans.mine') }}"
                   class="rounded-xl border border-slate-300 px-5 py-3 text-sm font-bold text-slate-600 transition hover:bg-slate-50">
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-blue-200 transition hover:bg-blue-700"
                    {{ $bukus->isEmpty() ? 'disabled' : '' }}
                >
                    Ajukan Peminjaman →
                </button>

            </div>

        </form>
    </div>

</div>

@endsection
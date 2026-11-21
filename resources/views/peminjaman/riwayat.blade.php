
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Riwayat Peminjaman Saya
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <h3 class="text-lg font-bold mb-4">
                    Daftar Peminjaman
                </h3>

                @forelse ($peminjaman as $item)
                    <div class="border-b py-3">
                        <p>
                            Buku:
                            {{ $item->buku->judul ?? 'Tidak diketahui' }}
                        </p>

                        <p>
                            Tanggal Pinjam:
                            {{ $item->tanggal_pinjam }}
                        </p>

                        <p>
                            Tanggal Kembali:
                            {{ $item->tanggal_kembali ?? 'Belum dikembalikan' }}
                        </p>
                    </div>
                @empty
                    <p>Belum ada riwayat peminjaman.</p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
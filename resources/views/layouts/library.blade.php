
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') - Perpustakaan Digital</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800 antialiased">

@php
    $user = auth()->user();

    if (!$user) {
        abort(403);
    }

    // MENU BERDASARKAN ROLE
    if ($user->hasRole('admin')) {

        $role = 'Administrator';

        $menus = [
            [
                'label' => 'Dashboard',
                'icon' => '▦',
                'url' => route('admin.dashboard'),
                'active' => request()->routeIs('admin.dashboard')
            ],
            [
                'label' => 'Data Buku',
                'icon' => '▤',
                'url' => route('books.index'),
                'active' => request()->routeIs('books.*')
            ],
            [
                'label' => 'Data Pengguna',
                'icon' => '♙',
                'url' => route('admin.users.index'),
                'active' => request()->routeIs('admin.users.*')
            ],
            [
                'label' => 'Peminjaman',
                'icon' => '⇄',
                'url' => route('loans.index'),
                'active' => request()->routeIs('loans.index')
            ],
            [
                'label' => 'Pengembalian',
                'icon' => '↩',
                'url' => route('loans.index'),
                'active' => false
            ],
        ];

    } elseif ($user->hasRole('petugas')) {

        $role = 'Petugas';

        $menus = [
            [
                'label' => 'Dashboard',
                'icon' => '▦',
                'url' => route('petugas.dashboard'),
                'active' => request()->routeIs('petugas.dashboard')
            ],
            [
                'label' => 'Data Buku',
                'icon' => '▤',
                'url' => route('books.index'),
                'active' => request()->routeIs('books.*')
            ],
            [
                'label' => 'Peminjaman',
                'icon' => '⇄',
                'url' => route('loans.index'),
                'active' => request()->routeIs('loans.index')
            ],
            [
                'label' => 'Pengembalian',
                'icon' => '↩',
                'url' => route('loans.index'),
                'active' => false
            ],
        ];

    } elseif ($user->hasRole('siswa')) {

        $role = 'Siswa';

        $menus = [
            [
                'label' => 'Dashboard',
                'icon' => '▦',
                'url' => route('siswa.dashboard'),
                'active' => request()->routeIs('siswa.dashboard')
            ],
            [
                'label' => 'Katalog Buku',
                'icon' => '▤',
                'url' => route('books.index'),
                'active' => request()->routeIs('books.*')
            ],
            [
                'label' => 'Peminjaman Saya',
                'icon' => '⇄',
                'url' => route('loans.mine'),
                'active' => request()->routeIs('loans.mine')
            ],
        ];

    } else {
        abort(403, 'Role pengguna tidak dikenali.');
    }
@endphp

<div class="min-h-screen lg:flex">

    {{-- SIDEBAR DESKTOP --}}
    <aside class="hidden w-72 shrink-0 flex-col bg-slate-950 text-white lg:flex">

        {{-- LOGO --}}
        <div class="flex h-24 items-center gap-3 border-b border-slate-800 px-7">

            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-2xl font-black shadow-lg shadow-blue-900/50">
                P
            </div>

            <div>
                <h1 class="text-lg font-extrabold tracking-wider">
                    PERPUS DIGITAL
                </h1>

                <p class="text-xs text-slate-400">
                    Library Management System
                </p>
            </div>

        </div>

        {{-- MENU --}}
        <div class="flex-1 px-5 py-8">

            <p class="mb-5 px-3 text-xs font-bold uppercase tracking-widest text-slate-500">
                Menu Utama
            </p>

            <nav class="space-y-2">

                @foreach ($menus as $menu)

                    <a href="{{ $menu['url'] }}"
                       class="group flex items-center gap-4 rounded-xl px-4 py-3.5 text-sm font-semibold transition duration-200
                       {{ $menu['active']
                            ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/40'
                            : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">

                        <span class="flex h-9 w-9 items-center justify-center rounded-lg text-xl
                            {{ $menu['active']
                                ? 'bg-white/15'
                                : 'bg-slate-900 group-hover:bg-slate-700' }}">

                            {{ $menu['icon'] }}

                        </span>

                        {{ $menu['label'] }}

                        @if ($menu['active'])
                            <span class="ml-auto h-2 w-2 rounded-full bg-white"></span>
                        @endif

                    </a>

                @endforeach

            </nav>

        </div>

        {{-- PROFIL USER --}}
        <div class="border-t border-slate-800 p-5">

            <div class="mb-4 flex items-center gap-3 rounded-xl bg-slate-900 p-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-blue-600 text-lg font-bold">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div class="min-w-0">

                    <p class="truncate text-sm font-bold">
                        {{ $user->name }}
                    </p>

                    <p class="text-xs text-slate-400">
                        {{ $role }}
                    </p>

                </div>

            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="w-full rounded-xl border border-slate-700 px-4 py-3 text-sm font-semibold text-slate-300 transition hover:border-red-500 hover:bg-red-500 hover:text-white">

                    ↪ Keluar dari Akun

                </button>
            </form>

        </div>

    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="min-w-0 flex-1">

        {{-- HEADER --}}
        <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 shadow-sm backdrop-blur">

            <div class="flex min-h-20 items-center justify-between gap-4 px-5 py-4 md:px-8">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-blue-600">
                        Sistem Informasi Perpustakaan
                    </p>

                    <h2 class="mt-1 text-xl font-extrabold text-slate-800">
                        @yield('page-title', 'Dashboard')
                    </h2>

                </div>

                <div class="flex items-center gap-3">

                    <div class="hidden text-right sm:block">

                        <p class="text-sm font-bold">
                            {{ $user->name }}
                        </p>

                        <p class="text-xs text-slate-500">
                            {{ $role }}
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-full border-4 border-blue-100 bg-blue-600 font-bold text-white">

                        {{ strtoupper(substr($user->name, 0, 1)) }}

                    </div>

                </div>

            </div>

            {{-- MENU MOBILE --}}
            <div class="border-t border-slate-100 px-4 py-3 lg:hidden">

                <nav class="flex gap-2 overflow-x-auto pb-1">

                    @foreach ($menus as $menu)

                        <a href="{{ $menu['url'] }}"
                           class="shrink-0 rounded-xl px-4 py-2.5 text-xs font-bold transition
                           {{ $menu['active']
                                ? 'bg-blue-600 text-white shadow-md'
                                : 'bg-slate-100 text-slate-600 hover:bg-blue-50 hover:text-blue-700' }}">

                            {{ $menu['icon'] }}
                            {{ $menu['label'] }}

                        </a>

                    @endforeach

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="shrink-0 rounded-xl bg-red-50 px-4 py-2.5 text-xs font-bold text-red-600 hover:bg-red-100">

                            Keluar

                        </button>

                    </form>

                </nav>

            </div>

        </header>

        {{-- ISI HALAMAN --}}
        <div class="min-h-[calc(100vh-150px)] p-5 md:p-8 lg:p-10">

            <div class="mx-auto max-w-7xl">

                @if (session('success'))
                    <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')

            </div>

        </div>

        {{-- FOOTER --}}
        <footer class="border-t border-slate-200 bg-white px-5 py-6 text-center">

            <p class="text-xs font-medium text-slate-400">
                © {{ date('Y') }} Perpustakaan Digital.
                All rights reserved.
            </p>

        </footer>

    </main>

</div>

</body>
</html>
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuCrudController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SiswaController;

Route::get('/', function () {
    return redirect()->route('login');
});

// SEMUA ROUTE YANG MEMERLUKAN LOGIN
Route::middleware(['auth'])->group(function () {

    // =====================================
    // REDIRECT DASHBOARD SESUAI ROLE
    // =====================================

    // A4 - Pengujian IDOR (sementara rentan)

    Route::get('/dashboard', function () {

        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('petugas')) {
            return redirect()->route('petugas.dashboard');
        }

        if ($user->hasRole('siswa')) {
            return redirect()->route('siswa.dashboard');
        }

        abort(403, 'Role pengguna belum ditentukan.');

    })->name('dashboard');


    // =====================================
    // DASHBOARD ADMIN
    // =====================================

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })
    ->middleware('role:admin')
    ->name('admin.dashboard');


    // =====================================
    // DASHBOARD PETUGAS
    // =====================================

    Route::get('/petugas/dashboard', function () {
        return view('petugas.dashboard');
    })
    ->middleware('role:petugas')
    ->name('petugas.dashboard');


    // =====================================
    // DASHBOARD SISWA
    // =====================================

    Route::get('/siswa/dashboard', [SiswaController::class, 'index'])
        ->middleware('role:siswa')
        ->name('siswa.dashboard');


    // =====================================
    // PENGUJIAN SQL INJECTION (A2)
    // =====================================

    Route::get('/buku-cari', [BukuCrudController::class, 'cariRentan'])
        ->name('buku.cari.rentan');


    // =====================================
    // DATA BUKU
    // ADMIN, PETUGAS, SISWA
    // =====================================

    Route::get('/books', [BukuCrudController::class, 'index'])
        ->middleware('permission:lihat-daftar-buku')
        ->name('books.index');


    // =====================================
    // KELOLA BUKU
    // ADMIN DAN PETUGAS
    // =====================================

    Route::middleware('can:kelola-buku')->group(function () {



        Route::get('/books/create', [BukuCrudController::class, 'create'])
            ->name('books.create');

        Route::post('/books', [BukuCrudController::class, 'store'])
            ->name('books.store');

        Route::get('/books/{book}/edit', [BukuCrudController::class, 'edit'])
            ->name('books.edit');

        Route::put('/books/{book}', [BukuCrudController::class, 'update'])
            ->name('books.update');

        Route::delete('/books/{book}', [BukuCrudController::class, 'destroy'])
            ->name('books.destroy');

        // A3 - ROUTE RENTAN (SEMENTARA)
// Route::get('/buku/{book}/hapus', [BukuCrudController::class, 'destroy'])
//     ->name('books.hapus.rentan');

    });


    // =====================================
    // DETAIL BUKU
    // ADMIN, PETUGAS, SISWA
    // =====================================

    Route::get('/books/{book}', [BukuCrudController::class, 'show'])
        ->middleware('permission:lihat-daftar-buku')
        ->name('books.show');


    // =====================================
    // DATA PENGGUNA
    // KHUSUS ADMIN
    // =====================================

    Route::prefix('admin/users')
        ->name('admin.users.')
        ->middleware('role:admin')
        ->group(function () {

            Route::get('/', [UserController::class, 'index'])
                ->middleware('permission:kelola-data-pengguna')
                ->name('index');

            Route::delete('/{user}', [UserController::class, 'destroy'])
                ->middleware('permission:kelola-data-pengguna')
                ->name('destroy');

            Route::patch('/{user}/role', [UserController::class, 'updateRole'])
                ->middleware('permission:kelola-role-pengguna')
                ->name('role');

        });


    // =====================================
    // PEMINJAMAN ADMIN DAN PETUGAS
    // =====================================

    Route::get('/loans', [LoanController::class, 'index'])
        ->middleware('permission:kelola-peminjaman')
        ->name('loans.index');


    // =====================================
    // FORM PENGAJUAN PEMINJAMAN SISWA
    // =====================================

    Route::get('/loans/create', [LoanController::class, 'create'])
        ->middleware('permission:mengajukan-peminjaman-buku')
        ->name('loans.create');


    // SIMPAN PENGAJUAN PEMINJAMAN

    Route::post('/loans', [LoanController::class, 'store'])
        ->middleware('permission:mengajukan-peminjaman-buku')
        ->name('loans.store');


    // =====================================
    // PERSETUJUAN PEMINJAMAN
    // ADMIN DAN PETUGAS
    // =====================================

    Route::patch('/loans/{loan}/approve', [LoanController::class, 'approve'])
        ->middleware('permission:memproses-persetujuan-peminjaman')
        ->name('loans.approve');


    // =====================================
    // PENGEMBALIAN BUKU
    // ADMIN DAN PETUGAS
    // =====================================

    Route::patch('/loans/{loan}/return', [LoanController::class, 'return'])
        ->middleware('permission:mencatat-pengembalian-buku')
        ->name('loans.return');


    // =====================================
    // RIWAYAT PEMINJAMAN SISWA
    // =====================================

    Route::get('/my-loans', [LoanController::class, 'mine'])
        ->middleware('permission:melihat-riwayat-peminjaman-sendiri')
        ->name('loans.mine');


    // =====================================
    // DETAIL PEMINJAMAN
    // AKSES DIPERIKSA OLEH LOAN POLICY
    // =====================================

    Route::get('/peminjaman/{id}', [LoanController::class, 'show'])
        ->name('peminjaman.show.rentan');

    Route::get('/loans/{loan}', [LoanController::class, 'show'])
        ->name('loans.show');

    // =====================================
    // PROFIL PENGGUNA
    // =====================================

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->middleware('permission:lihat-profil-sendiri')
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->middleware('permission:ubah-profil-sendiri')
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->middleware('permission:ubah-profil-sendiri')
        ->name('profile.destroy');

});


// AUTHENTICATION ROUTES
require __DIR__.'/auth.php';
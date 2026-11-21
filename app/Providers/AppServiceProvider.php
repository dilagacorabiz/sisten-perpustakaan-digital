<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Peminjaman;
use App\Policies\LoanPolicy;
use App\Policies\PeminjamanPolicy;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
{
    Gate::define('kelola-buku', function ($user) {
        return $user->hasRole(['admin', 'petugas']);
    });
    
    Gate::policy(Peminjaman::class, PeminjamanPolicy::class);
}
}

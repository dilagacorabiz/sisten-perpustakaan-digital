<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\{Permission, Role};
use Spatie\Permission\PermissionRegistrar;
use App\Models\Anggota;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
{
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    Permission::query()->delete();

    $map = [
            'akses-dashboard-admin'            => ['admin'],
            'akses-dashboard-petugas'          => ['petugas'],
            'lihat-daftar-buku'                => ['admin','petugas','siswa'],
            'kelola-data-buku'                 => ['admin','petugas'],
            'kelola-data-pengguna'             => ['admin'],
            'kelola-role-pengguna'             => ['admin'],
            'kelola-peminjaman'                => ['admin','petugas'],
            'kelola-pengembalian'              => ['admin','petugas'],
            'mengajukan-peminjaman-buku'       => ['admin','petugas','siswa'],
            'memproses-persetujuan-peminjaman' => ['admin','petugas'],
            'mencatat-pengembalian-buku'       => ['admin','petugas'],
            'melihat-status-peminjaman-sendiri'  => ['admin','petugas','siswa'],
            'melihat-riwayat-peminjaman-sendiri' => ['admin','petugas','siswa'],
            'lihat-laporan-perpustakaan'       => ['admin','petugas'],
            'lihat-profil-sendiri'             => ['admin','petugas','siswa'],
            'ubah-profil-sendiri'              => ['admin','petugas','siswa'],
        ];

        foreach (['admin','petugas','siswa'] as $r) {
            Role::firstOrCreate(['name' => $r]);
        }

        foreach ($map as $perm => $roles) {
            $p = Permission::firstOrCreate(['name' => $perm]);
            foreach ($roles as $r) {
                Role::findByName($r)->givePermissionTo($p);
            }
        }

        // Akun awal untuk pengujian
       // Akun awal untuk pengujian
        foreach ([
            ['Admin', 'admin@perpus.test', 'admin'],
            ['Petugas', 'petugas@perpus.test', 'petugas'],
            ['Siswa', 'siswa@perpus.test', 'siswa'],
        ] as [$name, $email, $role]) {

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make('password'),
            ]
        );

        $user->syncRoles($role);

        if ($role === 'siswa') {
            Anggota::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nama' => $name,
                    'email' => $email,
                    'no_telepon' => '081234567890',
                ]
            );
        }
    }
}
}
<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Kriteria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
      
        $users = [
            [
                'name'     => 'Admin Kebersihan',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ],
            [
                'name'     => 'OSIS',
                'email'    => 'osis@gmail.com',
                'password' => Hash::make('osisstemdja123'),
                'role'     => 'osis',
            ],
            [
                'name'     => 'Guru',
                'email'    => 'guru@gmail.com',
                'password' => Hash::make('guru123'),
                'role'     => 'guru',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

       
        $kelas = [
            ['nama_kelas' => 'XII RPL 1', 'wali_kelas' => 'Budi Santoso'],
            ['nama_kelas' => 'XII RPL 2', 'wali_kelas' => 'Siti Aminah'],
            ['nama_kelas' => 'XI RPL 1', 'wali_kelas' => 'Agus Setiawan'],
            ['nama_kelas' => 'X RPL 1', 'wali_kelas' => 'Dewi Lestari'],
        ];

        foreach ($kelas as $k) {
            Kelas::create($k);
        }

       
        $kriteria = [
            ['nama_kriteria' => 'Kebersihan Lantai', 'bobot' => 25],
            ['nama_kriteria' => 'Kerapihan Meja & Kursi', 'bobot' => 25],
            ['nama_kriteria' => 'Kebersihan Kaca Jendela', 'bobot' => 25],
            ['nama_kriteria' => 'Kebersihan Papan Tulis', 'bobot' => 25],
        ];

        foreach ($kriteria as $krit) {
            Kriteria::create($krit);
        }
    }
}
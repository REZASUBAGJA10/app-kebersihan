<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        Kriteria::insert([
            ['nama_kriteria' => 'Kebersihan Lantai', 'bobot_nilai' => 25],
            ['nama_kriteria' => 'Kerapihan Meja & Kursi', 'bobot_nilai' => 25],
            ['nama_kriteria' => 'Kebersihan Kaca & Jendela', 'bobot_nilai' => 25],
            ['nama_kriteria' => 'Kelengkapan Atribut Kelas', 'bobot_nilai' => 25],
        ]);
    }
}

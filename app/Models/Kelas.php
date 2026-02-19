<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penilaian;

class Kelas extends Model
{
    protected $fillable = [
        'nama_kelas',
        'jurusan',
        'wali_kelas'
    ];

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}


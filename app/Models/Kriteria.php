<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    
    protected $table = 'kriterias';

   
    protected $fillable = [
        'nama_kriteria',
        'bobot'
    ];

    
    public function detailPenilaians()
    {
        return $this->hasMany(DetailPenilaian::class);
    }
}
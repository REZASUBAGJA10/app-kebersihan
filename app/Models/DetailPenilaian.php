<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenilaian extends Model
{
    
    protected $table = 'detail_penilaians';

    protected $fillable = ['penilaian_id', 'kriteria_id', 'skor'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
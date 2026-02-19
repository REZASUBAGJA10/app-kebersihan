<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penilaian extends Model
{
    use HasFactory;

   
    protected $table = 'penilaians'; 

    protected $fillable = [
        'user_id', 
        'kelas_id', 
        'tanggal_penilaian', 
        'skor_total', 
        'foto',
        'catatan'
    ];

    
    protected $casts = [
        'tanggal_penilaian' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

   
    public function details()
    {
        return $this->hasMany(DetailPenilaian::class, 'penilaian_id');
    }

   
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
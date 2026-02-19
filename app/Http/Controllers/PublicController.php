<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        // Ambil data yang sama seperti di laporan admin
        $penilaian = Penilaian::with(['kelas', 'user'])
            ->join('kelas', 'penilaians.kelas_id', '=', 'kelas.id')
            ->orderBy('penilaians.tanggal_penilaian', 'desc')
            ->select('penilaians.*')
            ->get();

        return view('public.dashboard', compact('penilaian'));
    }
}
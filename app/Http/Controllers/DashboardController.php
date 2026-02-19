<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Penilaian;
use App\Models\Kriteria;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        
        $total_kelas = Kelas::count();
        $total_penilaian = Penilaian::count();
        $total_kriteria = Kriteria::count();
        $total_user = User::count();

       
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

       
        $recent_penilaian = Penilaian::with('kelas')->latest()->take(5)->get();

       
        $kelasTerbersih = Penilaian::with('kelas')
            ->whereBetween('tanggal_penilaian', [$startOfWeek, $endOfWeek])
            ->orderByDesc('skor_total')
            ->orderByDesc('id') 
            ->first();

       
        $top_kelas_data = Penilaian::with('kelas')
            ->select('kelas_id', DB::raw('MAX(skor_total) as skor_tertinggi'), DB::raw('MAX(id) as latest_id'))
            ->whereBetween('tanggal_penilaian', [$startOfWeek, $endOfWeek])
            ->groupBy('kelas_id')
            ->orderByDesc('skor_tertinggi')
            ->orderByDesc('latest_id')
            ->take(3)
            ->get();

        $chart_labels = [];
        $chart_data = [];
        foreach ($top_kelas_data as $item) {
            $chart_labels[] = $item->kelas->nama_kelas ?? 'N/A';
            $chart_data[] = (float) $item->skor_tertinggi;
        }

       
        $tren_penilaian = Penilaian::with('kelas')
            ->select('kelas_id', DB::raw('MAX(skor_total) as max_skor'), DB::raw('MAX(tanggal_penilaian) as tgl'))
            ->whereBetween('tanggal_penilaian', [$startOfWeek, $endOfWeek])
            ->groupBy('kelas_id')
            ->orderByDesc('max_skor') 
            ->take(7) 
            ->get()
            ->sortBy('tgl') 
            ->values();

        $tren_labels = $tren_penilaian->map(function($item) {
            return $item->kelas->nama_kelas ?? 'N/A';
        });

        $tren_data = $tren_penilaian->map(function($item) {
            return $item->max_skor;
        });

        return view('dashboard', compact(
            'total_kelas', 
            'total_penilaian', 
            'total_kriteria', 
            'total_user', 
            'recent_penilaian', 
            'chart_labels', 
            'chart_data',
            'kelasTerbersih',
            'tren_labels',
            'tren_data'
        ));
    }
}
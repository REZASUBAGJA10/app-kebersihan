<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\DetailPenilaian;
use App\Models\Kelas;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PenilaianExport; 

class PenilaianController extends Controller
{
  
    public function index()
    {
        $penilaian = Penilaian::with(['kelas', 'user'])
            ->join('kelas', 'penilaians.kelas_id', '=', 'kelas.id')
           
            ->orderBy('penilaians.skor_total', 'desc') 
           
            ->orderBy('penilaians.tanggal_penilaian', 'desc')
            ->select('penilaians.*')
            ->get();

        return view('laporan.index', compact('penilaian'));
    }

   
    public function exportExcel()
    {
        if (ob_get_contents()) ob_end_clean();
        
        return Excel::download(new PenilaianExport, 'Laporan-Penilaian-' . date('d-m-Y') . '.xlsx');
    }

    
    public function exportPdf()
    {
        $penilaian = Penilaian::with(['kelas', 'user'])
            ->join('kelas', 'penilaians.kelas_id', '=', 'kelas.id')
            ->orderBy('penilaians.skor_total', 'desc') // Urutan PDF disamakan dengan Index
            ->select('penilaians.*')
            ->get();

        $pdf = Pdf::loadView('laporan.pdf_view', compact('penilaian'))
                  ->setPaper('a4', 'landscape')
                  ->setOptions([
                      'isHtml5ParserEnabled' => true,
                      'isRemoteEnabled' => false 
                  ]); 

        return $pdf->download('Laporan-Penilaian-' . date('d-m-Y') . '.pdf');
    }

    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        $kriteria = Kriteria::all();
        return view('penilaian.create', compact('kelas', 'kriteria'));
    }

    public function show($id)
    {
        $penilaian = Penilaian::with(['kelas', 'user', 'details.kriteria'])->findOrFail($id);
        return view('laporan.show', compact('penilaian'));
    }

   
    private function hitungSkorTotal($inputNilai)
    {
        $totalPoin = 0;
        $kriterias = Kriteria::all();
        $totalBobotDB = $kriterias->sum('bobot'); 

        if ($totalBobotDB <= 0) return 0;

        foreach ($inputNilai as $id => $skor) {
            $kri = $kriterias->find($id);
            if ($kri) {
                $bobotRelatif = $kri->bobot / $totalBobotDB;
                $totalPoin += ($skor / 25) * $bobotRelatif * 100;
            }
        }

        $hasilAkhir = round($totalPoin);
        return $hasilAkhir > 100 ? 100 : $hasilAkhir;
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal_penilaian' => 'required|date',
            'nilai' => 'required|array',
            'foto' => 'nullable|image|max:2048',
            'catatan' => 'nullable|string'
        ]);

        return DB::transaction(function () use ($request) {
            $skorTotal = $this->hitungSkorTotal($request->nilai);
            
            $foto = null;
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto')->store('bukti', 'public');
            }

            $penilaian = Penilaian::create([
                'user_id' => auth()->id(),
                'kelas_id' => $request->kelas_id,
                'tanggal_penilaian' => $request->tanggal_penilaian,
                'skor_total' => $skorTotal,
                'foto' => $foto,
                'catatan' => $request->catatan
            ]);

            foreach ($request->nilai as $k_id => $skor) {
                DetailPenilaian::create([
                    'penilaian_id' => $penilaian->id,
                    'kriteria_id' => $k_id,
                    'skor' => $skor
                ]);
            }

            return redirect()->route('laporan.index')->with('success', 'Data Penilaian Berhasil Disimpan!');
        });
    }

    public function edit($id)
    {
        $penilaian = Penilaian::with('details')->findOrFail($id);
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        $kriteria = Kriteria::all();
        return view('laporan.edit', compact('penilaian', 'kelas', 'kriteria'));
    }

    public function update(Request $request, $id)
    {
        $penilaian = Penilaian::findOrFail($id);

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal_penilaian' => 'required|date',
            'nilai' => 'required|array',
            'foto' => 'nullable|image|max:2048',
            'catatan' => 'nullable|string'
        ]);

        return DB::transaction(function () use ($request, $penilaian) {
            $skorTotal = $this->hitungSkorTotal($request->nilai);

            if ($request->hasFile('foto')) {
                if ($penilaian->foto) {
                    Storage::disk('public')->delete($penilaian->foto);
                }
                $penilaian->foto = $request->file('foto')->store('bukti', 'public');
            }

            $penilaian->update([
                'kelas_id' => $request->kelas_id,
                'tanggal_penilaian' => $request->tanggal_penilaian,
                'skor_total' => $skorTotal,
                'foto' => $penilaian->foto,
                'catatan' => $request->catatan
            ]);

            foreach ($request->nilai as $k_id => $skor) {
                DetailPenilaian::updateOrCreate(
                    ['penilaian_id' => $penilaian->id, 'kriteria_id' => $k_id],
                    ['skor' => $skor]
                );
            }

            return redirect()->route('laporan.index')->with('success', 'Laporan Berhasil Diperbarui!');
        });
    }

    public function destroy($id)
    {
        $p = Penilaian::findOrFail($id);
        
        if ($p->foto) {
            Storage::disk('public')->delete($p->foto);
        }

        $p->details()->delete();
        $p->delete();

        return back()->with('success', 'Data Berhasil Dihapus!');
    }
}
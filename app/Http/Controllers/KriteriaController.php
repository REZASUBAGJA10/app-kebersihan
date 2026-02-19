<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all(); // Mengambil data sesuai Bab 4.3 [cite: 21]
        return view('kriteria.index', compact('kriteria'));
    }

    public function create()
    {
        return view('kriteria.create'); // Form sesuai Bab 4.2 [cite: 20]
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'bobot' => 'required|integer',
        ]);

        Kriteria::create($request->all());

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil ditambahkan');
    }

    // Pastikan parameter ini 'kriterium' jika Route resource Anda menghasilkan {kriterium}
    public function edit(Kriteria $kriterium)
    {
        $kriteria = $kriterium; 
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriterium)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'bobot' => 'required|integer',
        ]);

        $kriterium->update($request->all());

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil diupdate');
    }

    public function destroy(Kriteria $kriterium)
    {
        $kriterium->delete();
        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil dihapus');
    }
}
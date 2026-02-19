<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Menampilkan daftar semua kelas.
     */
    public function index()
    {
        $kelas = Kelas::latest()->get();
        return view('kelas.index', compact('kelas'));
    }

    /**
     * Menampilkan form tambah kelas.
     */
    public function create()
    {
        return view('kelas.create');
    }

    /**
     * Menyimpan data kelas baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'wali_kelas' => 'required|string|max:255',
        ]);

        Kelas::create($request->only(['nama_kelas', 'wali_kelas']));

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit kelas.
     * Menggunakan $id untuk memastikan data ditemukan dan dikirim ke view.
     */
    public function edit($id)
    {
        // Mencari data berdasarkan ID dari URL
        $kelas = Kelas::findOrFail($id); 
        
        // Mengirim variabel $kelas ke view kelas/edit.blade.php
        return view('kelas.edit', compact('kelas'));
    }

    /**
     * Memperbarui data kelas di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'wali_kelas' => 'required|string|max:255',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->only(['nama_kelas', 'wali_kelas']));

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil diupdate');
    }

    /**
     * Menghapus data kelas.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil dihapus');
    }
}
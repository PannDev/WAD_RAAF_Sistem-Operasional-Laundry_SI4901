<?php

namespace App\Http\Controllers;

use App\Models\KategoriMesin;
use App\Models\Mesin;
use Illuminate\Http\Request;

class MesinController extends Controller
{
    public function index()
    {
        $data_mesin = Mesin::with('kategori')->latest()->get();
        $kategoris = KategoriMesin::all();
        $edit_data = null;

        return view('mesin.index', compact('data_mesin', 'kategoris', 'edit_data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori_mesins,id',
            'kode'        => 'required|string|max:100',
            'merek'       => 'required|string|max:100',
            'kapasitas'   => 'required|integer|min:1',
            'status'      => 'required|in:Ready,Sedang Digunakan,Maintenance',
        ]);

        Mesin::create($validated);

        return redirect()->route('mesin.index')->with('success', 'Data mesin berhasil ditambahkan.');
    }

    public function edit(Mesin $mesin)
    {
        $data_mesin = Mesin::with('kategori')->latest()->get();
        $kategoris = KategoriMesin::all();
        $edit_data = $mesin;

        return view('mesin.index', compact('data_mesin', 'kategoris', 'edit_data'));
    }

    public function update(Request $request, Mesin $mesin)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori_mesins,id',
            'kode'        => 'required|string|max:100',
            'merek'       => 'required|string|max:100',
            'kapasitas'   => 'required|integer|min:1',
            'status'      => 'required|in:Ready,Sedang Digunakan,Maintenance',
        ]);

        $mesin->update($validated);

        return redirect()->route('mesin.index')->with('success', 'Data mesin berhasil diperbarui.');
    }

    public function destroy(Mesin $mesin)
    {
        $mesin->delete();

        return redirect()->route('mesin.index')->with('success', 'Data mesin berhasil dihapus.');
    }
}
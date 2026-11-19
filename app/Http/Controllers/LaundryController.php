<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laundry;

class LaundryController extends Controller
{
    // POV Pembeli
    public function index(Request $request)
    {
        $semuaKiloan = Laundry::where('kategori', 'Kiloan')->get();
        $semuaSatuan = Laundry::where('kategori', 'Satuan')->get();

        return view('laundry', compact('semuaKiloan', 'semuaSatuan'));
    }

    // POV Admin
    public function pengaturan()
    {
        $semuaKiloan = Laundry::where('kategori', 'Kiloan')->get();
        $semuaSatuan = Laundry::where('kategori', 'Satuan')->get();

        return view('pengaturan_laundry', compact('semuaKiloan', 'semuaSatuan'));
    }

    public function create()
    {
        return view('tambah_laundry');
    }

    public function store(Request $request)
    {
        Laundry::create([
            'id_layanan'   => $request->input('id_layanan'),
            'kategori'     => $request->input('kategori'),
            'nama_layanan' => $request->input('nama'),
            'harga_reguler'=> $request->input('reguler'),
            'harga_express'=> $request->input('express'),
        ]);

        return redirect('/portal/pengaturan');
    }

    public function edit($id)
{
    $item = Laundry::where('id_layanan', $id)->firstOrFail();
    $kategori = $item->kategori;

    return view('edit_laundry', compact('item', 'kategori', 'id'));
}

public function update(Request $request, $id)
{
    $item = Laundry::where('id_layanan', $id)->firstOrFail();

    $item->update([
        'nama_layanan'  => $request->input('nama'),
        'harga_reguler' => $request->input('reguler'),
        'harga_express' => $request->input('express'),
    ]);

    return redirect('/portal/pengaturan');
}

    public function destroy($id)
    {
        $item = Laundry::findOrFail($id);
        $item->delete();

        return redirect('/portal/pengaturan');
    }
}
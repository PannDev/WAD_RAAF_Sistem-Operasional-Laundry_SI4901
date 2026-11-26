<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('index', compact('pelanggans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index'); # add
        //return redirect() pelanggan.index
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        //$pelanggan delete
        $request->validate

        return redirect()->route('pelanggan.index');
    }
}
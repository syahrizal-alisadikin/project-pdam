<?php

namespace App\Http\Controllers\Admin;

use App\Kota;
use App\Http\Controllers\Controller;
use App\Provinsi;
use Illuminate\Http\Request;

class kotaController extends Controller
{
    public function index()
    {
        $kota = Kota::with('provinsi')->get();
        return view('pages.admin.kota.index', compact('kota'));
    }

    public function create()
    {
        $provinsi = Provinsi::all();
        // dd($provinsi);
        return view('pages.admin.kota.create', compact('provinsi'));
    }

    public function edit($id)
    {
        $kota = Kota::with('provinsi')->findOrFail($id);
        $prov = Provinsi::all();
        return view('pages.admin.kota.update', compact('kota', 'prov'));
    }

    public function update(Request $request, $id)
    {
        $kota = Kota::findOrFail($id);
        $kota->update([
            'fk_provinsi_id' => $request->provinsi,
            'name' => $request->name
        ]);

        return redirect()->route('kota.index')->with('success', 'Kota Berhasil Diupdate!!');
    }

    public function store(Request $request)
    {
        Kota::create([
            'fk_provinsi_id' => $request->provinsi,
            'name' => $request->name
        ]);
        return redirect()->route('kota.index')->with('success', 'Kelurahan Berhasil ditambahkan !!');
    }

    public function destroy($id)
    {
        kota::where('kota_id', $id)->delete();
        return redirect()->route('kota.index')->with('success', 'Kelurahan Berhasil Dihapus!!');
    }
}

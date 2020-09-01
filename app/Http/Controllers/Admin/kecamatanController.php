<?php

namespace App\Http\Controllers\Admin;

use App\Kota;
use App\Kecamatan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class kecamatanController extends Controller
{
    public function index()
    {
        $kecamatan = Kecamatan::with('kota.provinsi')->get();
        // dd($kecamatan);
        return view('pages.admin.kecamatan.index', compact('kecamatan'));
    }

    public function create()
    {
        $kota = Kota::all();
        return view('pages.admin.kecamatan.create', compact('kota'));
    }

    public function store(Request $request)
    {
        Kecamatan::create([
            'fk_kota_id' => $request->kota,
            'name' => $request->name
        ]);
        return redirect()->route('kecamatan.index')->with('success', 'Kelurahan Berhasil ditambahkan !!');
    }

    public function destroy($id)
    {
        $data = Kecamatan::where('kecamatan_id', $id)->delete();
        return redirect()->route('kecamatan.index')->with('success', 'Kelurahan Berhasil Dihapus!!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Kelurahan;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    public function index()
    {
        $kelurahans = Kelurahan::with('kecamatan.kota')->get();
        return view('pages.admin.kelurahan.index', compact('kelurahans'));
    }

    public function create()
    {
        $kecamatan = Kecamatan::all();
        return view('pages.admin.kelurahan.create', compact('kecamatan'));
    }

    public function store(Request $request)
    {
        Kelurahan::create([
            'fk_kecamatan_id' => $request->kecamatan,
            'name' => $request->name
        ]);
        return redirect()->route('kelurahan.index')->with('success', 'Kelurahan Berhasil ditambahkan !!');
    }

    public function destroy($id)
    {
        $data = Kelurahan::where('kelurahan_id', $id)->delete();
        return redirect()->route('kelurahan.index')->with('success', 'Kelurahan Berhasil Dihapus!!');
    }
}

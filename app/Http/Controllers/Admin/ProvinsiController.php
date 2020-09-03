<?php

namespace App\Http\Controllers\Admin;

use App\Provinsi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function index()
    {
        $provinsi = Provinsi::all();
        return view('pages.admin.provinsi.index', compact('provinsi'));
    }

    public function create()
    {
        return view('pages.admin.provinsi.create');
    }

    public function edit($id)
    {
        $prov = Provinsi::findOrFail($id);
        return view('pages.admin.provinsi.update', compact('prov'));
    }

    public function update(Request $request, $id)
    {
        $prov = Provinsi::findOrfail($id);
        $prov->update([
            'name' => $request->name
        ]);
        return redirect()->route('provinsi.index')->with('success', 'Provinsi Berhasil Diupdate!!');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Provinsi::create($data);
        return redirect()->route('provinsi.index')->with('success', 'Kelurahan Berhasil ditambahkan !!');
    }

    public function destroy($id)
    {
        Provinsi::where('provinsi_id', $id)->delete();
        return redirect()->route('provinsi.index')->with('success', 'Kelurahan Berhasil Dihapus!!');
    }
}

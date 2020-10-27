<?php

namespace App\Http\Controllers\Rw;

use App\Http\Controllers\Controller;
use App\PetugasRw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function index()
    {
        $data = PetugasRw::where('fk_rw_id', Auth::guard('rw')->user()->rw_id)->get();
        return view('pages.rw.petugas.v_index', compact('data'));
    }

    public function store(Request $request)
    {
        $data = new PetugasRw;
        $data->fk_rw_id = Auth::guard('rw')->user()->rw_id;
        $data->nama = $request->name;
        $data->phone = $request->phone;
        $data->level = $request->level;
        $data->save();
        return redirect()->route('petugas-rw.index')->with('sukses', 'data berhasil ditambahkan !!');
    }

    public function edit($id)
    {
        $data = PetugasRw::findOrFail($id);
        return view('pages.rw.petugas.v_update', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = PetugasRw::findOrFail($id);
        $data->fk_rw_id = Auth::guard('rw')->user()->rw_id;
        $data->nama = $request->name;
        $data->phone = $request->phone;
        $data->level = $request->level;
        $data->update();
        return redirect()->route('petugas-rw.index')->with('sukses', 'data berhasil Diupdate !!');
    }

    public function destroy($id)
    {
        $data = PetugasRw::findOrFail($id);
        $data->delete();
        return redirect()->route('petugas-rw.index')->with('sukses', 'data berhasil Dihapus!!');
    }
}

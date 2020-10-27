<?php

namespace App\Http\Controllers\Rw;

use App\Http\Controllers\Controller;
use App\JalanRw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JalanController extends Controller
{
    public function index()
    {
        $data = JalanRw::where('fk_rw_id', Auth::guard('rw')->user()->rw_id)->get();
        return view('pages.rw.jalan.v_index', compact('data'));
    }

    public function store(Request $request)
    {
        $data = new JalanRw;
        $data->fk_rw_id = Auth::guard('rw')->user()->rw_id;
        $data->nama_jalan = $request->name;
        $data->save();
        return redirect()->route('jalan-rw.index')->with('sukses', 'data berhasil ditambahkan !!');
    }

    public function edit($id)
    {
        $data = JalanRw::findOrFail($id);
        return view('pages.rw.jalan.v_update', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = JalanRw::findOrFail($id);
        $data->fk_rw_id = Auth::guard('rw')->user()->rw_id;
        $data->nama_jalan = $request->name;
        $data->update();
        return redirect()->route('jalan-rw.index')->with('sukses', 'data berhasil Diupdate !!');
    }

    public function destroy($id)
    {
        $data = JalanRw::findOrFail($id);
        $data->delete();
        return redirect()->route('jalan-rw.index')->with('sukses', 'data berhasil Dihapus!!');
    }
}

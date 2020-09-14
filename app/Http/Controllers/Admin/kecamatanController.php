<?php

namespace App\Http\Controllers\Admin;

use App\Kota;
use App\Kecamatan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

class kecamatanController extends Controller
{
    public function index(Request $request)
    {
        // dd($kecamatan);
        if ($request->ajax()) {
            $kecamatan = Kecamatan::with('kota.provinsi')->get();

            return DataTables::of($kecamatan)
                ->addIndexColumn()
                ->addcolumn('action', function ($kecamatan) {
                    $btn = ' <a  href="kecamatan/' . $kecamatan->kecamatan_id . '/edit" data-id="" class="btn btn-success btn-sm editItem" ><i class="fas fa-pencil-alt"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onClick="Delete(this.id)" id="' . $kecamatan->kecamatan_id . '" data-original-title="Delete" class="btn btn-danger btn-sm"> <i class="fa  fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])->make(true);
        }
        return view('pages.admin.kecamatan.index');
    }

    public function create()
    {
        $kota = Kota::all();
        return view('pages.admin.kecamatan.create', compact('kota'));
    }

    public function edit($id)
    {
        $kec = Kecamatan::with('kota')->findOrFail($id);
        $kota = Kota::all();
        return view('pages.admin.kecamatan.update', compact('kec', 'kota'));
    }

    public function update(Request $request, $id)
    {
        $kec = Kecamatan::findOrFail($id);
        $kec->update([
            'fk_kota_id' => $request->kota,
            'name' => $request->name
        ]);
        return redirect()->route('kecamatan.index')->with('success', 'kecamatan Berhasil Diupdate !');
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

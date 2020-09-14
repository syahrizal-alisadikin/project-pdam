<?php

namespace App\Http\Controllers\Admin;

use App\Kelurahan;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use Illuminate\Http\Request;
use DataTables;

class KelurahanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kelurahans = Kelurahan::with('kecamatan.kota')->get();
            return DataTables::of($kelurahans)
                ->addIndexColumn()
                ->addcolumn('action', function ($kelurahan) {
                    $btn = ' <a  href="kelurahan/' . $kelurahan->kelurahan_id . '/edit" data-id="" class="btn btn-success btn-sm editItem" ><i class="fas fa-pencil-alt"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onClick="Delete(this.id)" id="' . $kelurahan->kelurahan_id . '" data-original-title="Delete" class="btn btn-danger btn-sm"> <i class="fa  fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])->make(true);
        }
        return view('pages.admin.kelurahan.index');
    }

    public function create()
    {
        $kecamatan = Kecamatan::all();
        return view('pages.admin.kelurahan.create', compact('kecamatan'));
    }

    public function edit($id)
    {
        $kel = Kelurahan::with('kecamatan')->findOrFail($id);
        // dd($kel);
        $kec = Kecamatan::all();
        return view('pages.admin.kelurahan.update', compact('kel', 'kec'));
    }

    public function update(Request $request, $id)
    {
        $kel =  Kelurahan::findOrFail($id);
        $kel->update([
            'fk_kecamatan_id' => $request->kecamatan,
            'name'            => $request->name
        ]);
        return redirect()->route('kelurahan.index')->with('success', 'Kelurahan Berhasil Diupdate!!');
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

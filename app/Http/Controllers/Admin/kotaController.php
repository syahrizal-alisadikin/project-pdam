<?php

namespace App\Http\Controllers\Admin;

use App\Kota;
use App\Http\Controllers\Controller;
use App\Provinsi;
use Illuminate\Http\Request;
use DataTables;

class kotaController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $kota = Kota::with('provinsi')->get();
            return DataTables::of($kota)
                ->addIndexColumn()
                ->addcolumn('action', function ($kota) {
                    $btn = ' <a  href="kota/' . $kota->kota_id . '/edit" data-id="" class="btn btn-success btn-sm editItem" ><i class="fas fa-pencil-alt"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onClick="Delete(this.id)" id="' . $kota->kota_id . '" data-original-title="Delete" class="btn btn-danger btn-sm"> <i class="fa  fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])->make(true);
        }
        return view('pages.admin.kota.index');
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

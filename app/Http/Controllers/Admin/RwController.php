<?php

namespace App\Http\Controllers\Admin;

use App\Kecamatan;
use App\Kelurahan;
use App\Kota;
use App\Provinsi;
use App\Rw;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RwController extends Controller
{
    public function index()
    {
        $rw = Rw::with('kelurahan', 'kecamatan', 'kota', 'provinsi')->get();

        // return $rw; die();
        return view('pages.admin.rw.index', compact('rw'));
    }

    public function create()
    {
        $kelurahan = Kelurahan::all();
        $kecamatan = Kecamatan::all();
        $kota = Kota::all();
        $provinsi = Provinsi::all();

        return view('pages.admin.rw.create', compact('kelurahan', 'kecamatan', 'kota', 'provinsi'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|min:6',
            'email'     => 'required|email|unique:tbl_rw,email',
            'password'  => 'required|min:6',
        ]);

        $rw_id = $this->rw_id();
        Rw::create([
            'rw_id' => $rw_id,
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'fk_kelurahan_id' => $request->kelurahan,
            'fk_kecamatan_id' => $request->kecamatan,
            'fk_kota_id' => $request->kota,
            'fk_provinsi_id' => $request->provinsi,
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('rw.index')->with('success', 'Data Berhasil Di Tambahkan!!');
    }

    public function rw_id()
    {
        $get_kode       = DB::table('tbl_rw')->limit(1)->orderBy('rw_id', 'desc')->get();
        $q              = 0;

        if (count($get_kode) > 0) {
            $kode      =  $get_kode[0]->rw_id;
            $r          = substr($kode, 1);
            $q          = (int) $r + 1;
        } else {
            $q          = 1;
        }

        return str_pad($q, 3, "0", STR_PAD_LEFT);
    }
}

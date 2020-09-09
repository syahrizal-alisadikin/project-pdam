<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rw;
use App\Pembayaran;
use App\Tagihan;
use Illuminate\Support\Facades\Auth;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = Pembayaran::all();
        dd($tagihan);
        return view('pages.admin.tagihan.index');
    }

    public function create()
    {
        $rw = Rw::all();

        return view('pages.admin.tagihan.create', compact('rw'));
    }

    public function store(Request $request)
    {
        $id = Auth::guard('admin')->user()->admin_id;
        $tagihan =  Tagihan::create([
            'tagihan_id' => mt_rand(0, 999),
            'fk_rw_id' => $request->rw,
            'nama'     => $request->name,
            'tanggal_tagihan' => $request->tanggal,
            'jumlah_tagihan' => $request->jumlah,
            'create_post' => $id
        ]);
        // dd($tagihan->tagihan_id);
        Pembayaran::create([
            'fk_tagihan_id' => $tagihan->tagihan_id,
            'status'        => "Pending",
            'create_post'   => $id
        ]);
        return redirect()->route('tagihan.index')->with('success', 'Tagihan Berhasil ditambahkan');
    }
}

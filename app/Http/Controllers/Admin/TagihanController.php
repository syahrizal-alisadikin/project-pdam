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
        $tagihan = Tagihan::with('rw')->get();
        // dd($tagihan);
        return view('pages.admin.tagihan.index', compact('tagihan'));
    }

    public function create()
    {
        $rw = Rw::all();

        return view('pages.admin.tagihan.create', compact('rw'));
    }

    public function store(Request $request)
    {
        $rw = Rw::all();
        // dd($rw);
        $id = Auth::guard('admin')->user()->admin_id;

        foreach ($rw as $tag) {
            $tagihan = Tagihan::create([
                'fk_rw_id'          => $tag->rw_id,
                'nama'              => $request->name,
                'tanggal_tagihan'   => $request->tanggal,
                'jumlah_tagihan'    => $request->jumlah,
                'tarif'             => $request->tarif,
                'create_post'       => $id


            ]);
            // dd($bayar);

            Pembayaran::create([
                'fk_tagihan_id' => $tagihan->tagihan_id,
                'status' => "Pending",
                'create_post' => $id
            ]);
        }


        return redirect()->route('tagihan.index')->with('success', 'Tagihan Berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tagihan = Tagihan::with('rw')->findOrFail($id);
        // dd($tagihan);
        return view('pages.admin.tagihan.edit', compact('tagihan'));
    }

    public function update(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->nama = $request->name;
        $tagihan->tanggal_tagihan = $request->tanggal;
        $tagihan->jumlah_tagihan = $request->jumlah;
        $tagihan->save();
        return redirect()->route('tagihan.index')->with('success', 'Tagihan Berhasil di Update');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rw;
use App\Pembayaran;
use App\Tagihan;
use App\Tarif;
use Illuminate\Support\Facades\Auth;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::with('tarif', 'rw')->get();
        // dd($tagihan);
        return view('pages.admin.tagihan.index', compact('tagihan'));
    }

    public function create()
    {
        $rw = Rw::all();
        $tarif = Tarif::all();
        return view('pages.admin.tagihan.create', compact('rw', 'tarif'));
    }

    public function store(Request $request)
    {
        $rw = Rw::all();
        $id = Auth::guard('admin')->user()->admin_id;
        // dd($request->all());
        foreach ($rw as $tag) {
            // dd($tarif);
            $tagihan = Tagihan::create([
                'fk_rw_id'          => $tag->rw_id,
                'fk_tarif_id'       => $request->tarif,
                'tanggal_tagihan'   => $request->tanggal,
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
        $tagihan = Tagihan::with('rw', 'tarif')->findOrFail($id);
        $tarif = Tarif::all();
        return view('pages.admin.tagihan.edit', compact('tagihan', 'tarif'));
    }

    public function update(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->fk_tarif_id = $request->name;
        $tagihan->tanggal_tagihan = $request->tanggal;
        $tagihan->save();
        return redirect()->route('tagihan.index')->with('success', 'Tagihan Berhasil di Update');
    }
}

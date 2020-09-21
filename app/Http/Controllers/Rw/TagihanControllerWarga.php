<?php

namespace App\Http\Controllers\Rw;

use App\Http\Controllers\Controller;
use App\Pembayaran;
use App\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagihanControllerWarga extends Controller
{
    public function index()
    {
        $id = Auth::guard('rw')->user()->rw_id;
        $tagihan = Tagihan::with('tarif')->where('fk_rw_id', Auth::guard('rw')->user()->rw_id)->get();
        $pem = Pembayaran::whereHas('tagihan', function ($query) {
            return $query->where('fk_rw_id', Auth::guard('rw')->user()->rw_id);
        })->with('tagihan.tarif')->get();
        // $products->whereHas('merchant', function ($query) use ($requestId) {
        //     return $query->whereIn('fk_city_id', $requestId);
        // });
        // dd($pem);
        return view('pages.rw.tagihan.v_index', compact('tagihan', 'pem'));
    }
}

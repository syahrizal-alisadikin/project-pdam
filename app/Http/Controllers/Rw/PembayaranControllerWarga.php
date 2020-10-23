<?php

namespace App\Http\Controllers\Rw;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\{Pembayaran, Tagihan, KonfirmasiPembayaran};
use Str;

class PembayaranControllerWarga extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran = Pembayaran::with('tagihan.tarif')->get();
        return view('pages.rw.pembayaran.v_index', compact('pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('image')) {
            $image = Str::random(9);
            $request->file('image')->move(storage_path('image/pembayaran'), $image);
            KonfirmasiPembayaran::create([
                'fk_pembayaran_id' => $request->pembayaran_id,
                'jumlah' => $request->jumlah,
                'fk_rw_id' => Auth::guard('rw')->user()->rw_id,
                'image' => $image
            ]);
            return redirect()->back()->with('sukses', 'Berhasil Kirim Bukti Pembayaran');
        } else {
            KonfirmasiPembayaran::create([
                'fk_pembayaran_id' => $request->pembayaran_id,
                'jumlah' => $request->jumlah,
                'fk_rw_id' => Auth::guard('rw')->user()->rw_id,
            ]);
            return redirect()->back()->with('sukses', 'Berhasil Kirim Bukti Pembayaran');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $details = KonfirmasiPembayaran::where('fk_pembayaran_id', $id)->first();
            return view('pages.rw.pembayaran.v_details', compact('details'));
        } catch (ModelNotFoundException $e) {
            print_r('Users Not Found !');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pembayaran::findOrFail($id);
        return view('pages.rw.pembayaran.v_update', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Kirim Bukti Pembayaran
            if ($request->file('image')) {
                $pembayaran = KonfirmasiPembayaran::where('fk_pembayaran_id', $id)->first();

                if (storage_path('image/pembayaran/' . $pembayaran->image)) {
                    unlink(storage_path('image/pembayaran/' . $pembayaran->image));
                }

                $image = Str::random(9);
                $request->file('image')->move(storage_path('image/pembayaran'), $image);
                $pembayaran->update([
                    'jumlah' => $request->jumlah,
                    'fk_rw_id' => Auth::guard('rw')->user()->rw_id,
                    'image' => $image
                ]);
                return redirect()->back()->with('sukses', 'Berhasil Update Data Pembayaran');
            } else {
                $pembayaran = KonfirmasiPembayaran::where('fk_pembayaran_id', $id)->first();
                $pembayaran->update([
                    'jumlah' => $request->jumlah,
                    'fk_rw_id' => Auth::guard('rw')->user()->rw_id,
                ]);
                return redirect()->back()->with('sukses', 'Berhasil Update Data Pembayaran');
            }
        } catch (Exception $e) {

            print_r('error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}

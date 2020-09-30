<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\LaporanKejadian;
use App\ParamKejadian;
use App\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanKejadianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kejadian = LaporanKejadian::with('warga', 'ParamKejadian')->get();
        // dd($kejadian);
        return view('pages.admin.laporkejadian.index', compact('kejadian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warga = Warga::all();
        $kejadian = ParamKejadian::all();
        return view('pages.admin.laporkejadian.create', compact('warga', 'kejadian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        LaporanKejadian::create([
            'fk_user_id'    => $request->warga,
            'fk_rw_id'      => $request->rw,
            'fk_param_id'   => $request->param,
            'tanggal_kejadian'   => $request->tanggal_kejadian,
            'keterangan'   => $request->keterangan,
            'status'   => "Pending",
        ]);

        return redirect()->route('laporankejadian.index')->with('success', 'Laporan Berhasil Dibuat!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $warga = Warga::with('rw')->findOrFail($id);
        return response()->json($warga);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lapor = LaporanKejadian::with('warga', 'ParamKejadian')->findOrFail($id);
        $warga = Warga::all();
        $kejadian = ParamKejadian::all();
        return view('pages.admin.laporkejadian.update', compact('lapor', 'warga', 'kejadian'));
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
        $admin = Auth::guard('admin')->user()->admin_id;
        // $data = $request->all();
        $lapor = LaporanKejadian::with('warga', 'ParamKejadian')->findOrFail($id);

        // dd($lapor);
        $lapor->update([
            'fk_user_id'    => $request->warga,
            'fk_rw_id'      => $request->fk_rw_id,
            'fk_param_id'   => $request->param,
            'tanggal_kejadian'   => $request->tanggal_kejadian,
            'keterangan'   => $request->keterangan,
            'status'   => $request->status,
            'edit_post' => $admin
        ]);

        return redirect()->route('laporankejadian.index')->with('success', 'Laporan Berhasil Di update!!');
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

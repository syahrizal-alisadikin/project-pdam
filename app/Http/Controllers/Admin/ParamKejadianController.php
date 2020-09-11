<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ParamKejadian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParamKejadianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kejadian = ParamKejadian::all();

        return view('pages.admin.paramkejadian.index', compact('kejadian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $id = Auth::guard('admin')->user()->admin_id;
        ParamKejadian::create([
            'nama'       => $request->nama,
            'created'    => $id
        ]);
        return redirect()->route('paramkejadian.index')->with('success', 'Data Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kejadian = ParamKejadian::findOrFail($id);
        return view('pages.admin.paramkejadian.edit', compact('kejadian'));
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
        $kejadian = ParamKejadian::findOrFail($id);
        $kejadian->nama = $request->name;
        $kejadian->save();
        return redirect()->route('paramkejadian.index')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ParamKejadian::findOrFail($id)->delete();
        return redirect()->route('paramkejadian.index')->with('success', 'Data Berhasil Diupdate');
    }
}

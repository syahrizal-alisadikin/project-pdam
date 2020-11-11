<?php

namespace App\Http\Controllers\Rw;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RwController extends Controller
{
    public function index()
    {
        return view('pages.rw.index');
    }

    public function aktif()
    {
        return redirect()->route('dashboard-rw')->with('info', 'Anda belum melakukan pembayaran, silahkan hubungin admin !');
    }
}

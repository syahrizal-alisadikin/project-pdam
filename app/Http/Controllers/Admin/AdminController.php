<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('pages.admin.index', compact('admins'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:admins,email',
            'password'  => 'required'
        ]);

        Admin::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->name),
        ]);
        return redirect()->route('dashboard-admin')->with('success', 'Admin Berhasil Ditambahkan');
    }
}

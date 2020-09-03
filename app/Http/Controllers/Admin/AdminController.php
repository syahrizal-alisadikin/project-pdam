<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $id = Auth::guard('admin')->user()->admin_id;
        $admins = Admin::all();
        return view('pages.admin.index', compact('admins', 'id'));
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('pages.admin.update', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $data = Admin::findOrFail($id);
        if ($request->password) {
            $this->validate(
                $request,
                [
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required'
                ],
                [
                    'password.confirmed' => 'Password Tidak sama!',
                ]
            );
            $data->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),

            ]);
            return redirect()->route('dashboard-admin')->with('success', 'Data Berhasil Diupdate');
        } else {

            $data->update([
                'name' => $request->name,
                'email' => $request->email,

            ]);
            return redirect()->route('dashboard-admin')->with('success', 'Data Berhasil Diupdate');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:admins,email',
            'password'  => 'required'
        ]);
        // dd($request->password);
        Admin::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);
        return redirect()->route('dashboard-admin')->with('success', 'Admin Berhasil Ditambahkan');
    }

    public function destroy($id)
    {
        Admin::where('admin_id', $id)->delete();
        return redirect()->route('dashboard-admin')->with('success', 'Data Berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.admin.login');
    }

    public function postlogin(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        //LAKUKAN PENGECEKAN, 
        $loginType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $login = [
            $loginType => $request->email,
            'password' => $request->password
        ];

        // Passwordnya pake bcrypt
        if (Auth::guard('admin')->attempt($login)) {
            return redirect()->route('dashboard-admin');

        } elseif(Auth::guard('rw')->attempt($login)) {
            return redirect('/rw');

        }else {

            return redirect()->route('login-admin')->with('gagal', 'Gagal Login !! Silahkan Periksa Email / Password');
        }
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            
        }elseif (Auth::guard('rw')->check()) {
            Auth::guard('rw')->logout();
        }

        return redirect('/login-admin');
    }
}

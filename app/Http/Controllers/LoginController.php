<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\{Rw, Provinsi, Kota, Kecamatan, Kelurahan};
use Exception;
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
        } elseif (Auth::guard('rw')->attempt($login)) {
            return redirect('/rw');
        } else {

            return redirect()->route('login-admin')->with('gagal', 'Gagal Login !! Silahkan Periksa Email / Password');
        }
    }

    /*
    * Register View
    */
    public function registerRW()
    {
        $provinsi = Provinsi::all();
        return view('pages.admin.register', compact('provinsi'));
    }

    /*
    * Register Process RW
    */
    public function registerRWProcess(Request $request)
    {
        $id= $request->fk_kota_id . $request->fk_kecamatan_id . $request->fk_kelurahan_id;

        try {
            
            $this->validate($request, [
                'name' => 'required|string',
                'email' => 'required|email|unique:tbl_rw',
                'password' => 'required|string',
                'alamat' => 'required|string',
                'fk_provinsi_id' => 'required|string',
                'fk_kota_id' => 'required|string',
                'fk_kecamatan_id' => 'required|string',
                'fk_kelurahan_id' => 'required|string',
            ]);

            RW::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'alamat' => Hash::make($request->alamat),
                'fk_provinsi_id' => $request->fk_provinsi_id,
                'fk_kota_id' => $request->fk_kota_id,
                'fk_kecamatan_id' => $request->fk_kecamatan_id,
                'fk_kelurahan_id' => $request->fk_kelurahan_id,
                'rw_id' => $id
            ]);

            return redirect('')->with('sukses', 'Registration Success ! Login Now');
        } catch (Exception $e) {
            // print_r($e->getMessage()); die();
            return redirect()->back()->with('gagal', 'Pastikan Semua Data Data Teriisi !');
        }
    }

    /*
    * Logout
    */
    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('rw')->check()) {
            Auth::guard('rw')->logout();
        }

        return redirect('/');
    }

    /*
    * Get Prov, Kota, Kec, Desa
    */
    public function getCities($province_id)
    {
        $kota = Kota::where('fk_provinsi_id', $province_id)->pluck('name', 'kota_id');
        return response()->json($kota);
    }

    public function getKecamatan($kota_id)
    {
        $kec = Kecamatan::where('fk_kota_id', $kota_id)->pluck('name', 'kecamatan_id');
        return response()->json($kec);
    }

    public function getKelurahan($kecamatan_id)
    {
        $kel = Kelurahan::where('fk_kecamatan_id', $kecamatan_id)->pluck('name', 'kelurahan_id');
        return response()->json($kel);
    }
}

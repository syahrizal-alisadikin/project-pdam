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

    public function pembayaran($id_rw)
    {
        $data = Rw::where(['rw_id' => $id_rw])->first();
        return view('pages.admin.pembayaran', compact('data'));
    }

    /*
    * Login Process
    */
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
        // dd($request->all());
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

        $random = mt_rand(0, 999);
        $id = $request->fk_kelurahan_id . $random;
        RW::create([
            'rw_id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->phone,
            'no_rw' => $request->no_rw,
            'password' => Hash::make($request->password),
            'fk_provinsi_id' => $request->fk_provinsi_id,
            'fk_kota_id' => $request->fk_kota_id,
            'fk_kecamatan_id' => $request->fk_kecamatan_id,
            'fk_kelurahan_id' => $request->fk_kelurahan_id,
            'flag_marketplace' => $request->market,
            'flag_bmt' => $request->baitul,
            'flag_surket' => $request->surat,

        ]);

        return redirect()->route('pembayaran', $id); // redirect ke pembayaran
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

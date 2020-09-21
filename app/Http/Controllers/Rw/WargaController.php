<?php

namespace App\Http\Controllers\Rw;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Warga;
use App\Rw;
use Str;
use Illuminate\Support\Facades\Auth;

class WargaController extends Controller
{
    private function rules()
    {
        return [
            'fk_rw_id' => 'required',
            'email' => 'required|email',
            'nama' => 'required',
            'phone' => 'required|string',
            'alamat' => 'required|string',
            'longtitude' => 'required|string',
            'latitude' => 'required|string',
            'status' => 'required|string',
            'jenis_kelamin' => 'required|string',
            // 'foto_ktp' => 'mimes:jpeg,jpg,png|required|max:10000',
            // 'foto_kk' => 'mimes:jpeg,jpg,png|required|max:10000',
            // 'foto_profile' => 'mimes:jpeg,jpg,png|required|max:10000',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warga = Warga::all();
        return view('pages.rw.warga.v_index', compact('warga'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rw = Rw::all();
        return view('pages.rw.warga.v_create', compact('rw'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            // $test_data = $request->file('foto_ktp')->getClientOriginalName();
            // $request->file('foto_ktp')->move(storage_path('image'), $test_data);

            $this->validate($request, $this->rules());

            $foto_ktp = Str::random(9);
            $request->file('foto_ktp')->move(storage_path('image/warga'), $foto_ktp);
            $foto_kk = Str::random(9);
            $request->file('foto_kk')->move(storage_path('image/warga'), $foto_kk);
            $foto_profile = Str::random(9);
            $request->file('foto_profile')->move(storage_path('image/warga'), $foto_profile);

            $data = Warga::create([
                'fk_rw_id' => $request->fk_rw_id,
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'edit_post' => 2,
                'status' => $request->status,
                'longtitude' => $request->longtitude,
                'latitude' => $request->latitude,
                'foto_ktp' => $foto_ktp,
                'foto_kk' => $foto_kk,
                'foto_profile' => $foto_profile,
            ]);

            return redirect('rw/warga')->with('success', 'Success');
        } catch (Exception $e) {

            return redirect('rw/warga')->with('gagal', 'Gagal');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $warga = Warga::where('fk_rw_id', Auth::guard('rw')->user()->rw_id)->get();
        // dd($warga);
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
        $warga_edit = Warga::findOrFail($id);
        $rw = Rw::all();
        return view('pages.rw.warga.v_edit', compact('warga_edit', 'rw'));
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

            $this->validate($request, $this->rules());

            $file = Warga::where('warga_id', $id)->first();

            // Unlink File Gambar
            if (storage_path('image/warga/' . $file->foto_ktp) && storage_path('image/warga/' . $file->foto_kk) && storage_path('image/warga/' . $file->foto_profile)) {

                unlink(storage_path('image/warga/' . $file->foto_ktp));
                unlink(storage_path('image/warga/' . $file->foto_kk));
                unlink(storage_path('image/warga/' . $file->foto_profile));
            }

            $foto_ktp = Str::random(9);
            $request->file('foto_ktp')->move(storage_path('image/warga'), $foto_ktp);
            $foto_kk = Str::random(9);
            $request->file('foto_kk')->move(storage_path('image/warga'), $foto_kk);
            $foto_profile = Str::random(9);
            $request->file('foto_profile')->move(storage_path('image/warga'), $foto_profile);

            if ($request->input('password')) {

                $update_warga = array(
                    'fk_rw_id' => $request->fk_rw_id,
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phone,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat' => $request->alamat,
                    'edit_post' => 2,
                    'status' => $request->status,
                    'longtitude' => $request->longtitude,
                    'latitude' => $request->latitude,
                    'foto_ktp' => $foto_ktp,
                    'foto_kk' => $foto_kk,
                    'foto_profile' => $foto_profile,
                );

                Warga::find($id)->update($update_warga);

                return redirect('rw/warga')->with('sukses', 'Success');
            } else {

                $update_warga = array(
                    'fk_rw_id' => $request->fk_rw_id,
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat' => $request->alamat,
                    'edit_post' => 2,
                    'status' => $request->status,
                    'longtitude' => $request->longtitude,
                    'latitude' => $request->latitude,
                    'foto_ktp' => $foto_ktp,
                    'foto_kk' => $foto_kk,
                    'foto_profile' => $foto_profile,
                );

                Warga::find($id)->update($update_warga);

                return redirect('rw/warga')->with('sukses', 'Success');
            }
        } catch (Exception $e) {

            return redirect('rw/warga')->with('gagal', 'Gagal');
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
        $delete_warga = Warga::findOrFail($id);

        if ($delete_warga != null) {
            // Delete File Foto
            if (storage_path('image/warga/' . $delete_warga->foto_ktp) && storage_path('image/warga/' . $delete_warga->foto_kk) && storage_path('image/warga/' . $delete_warga->foto_profile)) {

                unlink(storage_path('image/warga/' . $delete_warga->foto_ktp));
                unlink(storage_path('image/warga/' . $delete_warga->foto_kk));
                unlink(storage_path('image/warga/' . $delete_warga->foto_profile));
            }

            $delete_warga->delete();
            return redirect('rw/warga')->with('sukses', 'Success');
        }

        return redirect('rw/warga')->with('gagal', 'Gagal !');
    }

    // Get File Foto KTP / KK/ Profile
    public function fileWarga($file)
    {
        $avatar_path = storage_path('image/warga') . '/' . $file;

        if (file_exists($avatar_path)) {
            $file = file_get_contents($avatar_path);
            return response($file, 200)->header('Content-Type', 'image/jpeg');
        }

        return response()->json([
            'status' => 500,
            'msg' => 'File Not Found !'
        ], 500);
    }
}

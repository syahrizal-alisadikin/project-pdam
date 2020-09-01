<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Users;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          try {
        
            $warga = Users::all();

            return response()->json([
                'status' => 200,
                'data' => $warga
            ], 200);
            
        } catch (Exception $e) {
            
            return response()->json([
                'status' => 401,
                'msg' => 'Failed read data'
            ], 401);

        }
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
        try {
            
            $rules = [
                'fk_rw_id' => 'required',
                'email' => 'required|email|unique:users',
                'name' => 'required',
                'password' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $data = Users::create([
                'fk_rw_id' => $request->fk_rw_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'status' => 200,
                'data' => $data 
            ], 200);

        } catch (Exception $e) {
            
            return response()->json([
                "msg" => 'error'
            ], 401);
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
        try {
            
            $users_edit = Users::findOrFail($id);

            if ($users_edit) {

                return response()->json([
                    'status' => 200,
                    'data' => $users_edit
                ],200);
            }else {

               return response()->json([
                    "msg" => 'Data User Tidak Ada'
               ], 401);   
            }

        } catch (Exception $e) {
            
            return response()->json([
                "msg" => 'error'
            ], 500);   
        }
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
            
            $rules = [
                'fk_rw_id' => 'required',
                'email' => 'required|email',
                'name' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            if ($request->input('password')) {
                $update_user = array(
                   'fk_rw_id' => $request->fk_rw_id,
                   'name' => $request->name,
                   'email' => $request->email,
                   'password' => Hash::make($request->password), 
                );

                Users::find($id)->update($update_user);
                return response()->json([
                    'status' => 200,
                    'data' => $update_user 
                ], 200);

            }else {
                $update_user = array(
                   'fk_rw_id' => $request->fk_rw_id,
                   'name' => $request->name,
                   'email' => $request->email,
                );

                Users::find($id)->update($update_user);
                return response()->json([
                    'status' => 200,
                    'data' => $update_user 
                ], 200);
            }

        } catch (Exception $e) {
            
            return response()->json([
                "msg" => 'error'
            ], 401);
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
         try {

            $delete_data = Users::findOrFail($id);
            $delete_data->delete();


            if ($delete_data != null) {

                $delete_data->delete();
                return response()->json([
                    'status' => 200,
                    'msg' => 'Success Delete Data User' 
                ]);
            }

            return response()->json([
                'status' => 401,
                'msg' => 'Wrong ID User' 
            ], 401);

        } catch (Exception $e) {
            
            return response()->json([
                "msg" => 'error'
            ], 500);     
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;

class UserController extends ControllerLogin
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {        
        $params['data'] = \App\UserModel::orderBy('id', 'DESC')->get();

    	return view('admin.user.index')->with($params);
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * [profile description]
     * @return [type] [description]
     */
    public function profile()
    {
    	return view('/admin/profile');
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $data = \App\UserModel::where('id', $id)->first();

        return view('admin.user.edit', compact('data'));
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
        $data =  \App\UserModel::where('id', $id)->first();
        
        if(!empty($request->password))
        {
            $this->validate($request,[
                'confirmation'      => 'same:password',
            ]);

            $data->password             = bcrypt($request->password);
        }

        $data->no_anggota           = $request->no_anggota;
        $data->nik                  = $request->nik;
        $data->telepon              = $request->telepon;
        $data->name                 = $request->name;
        $data->email                = $request->email; 
        $data->jenis_kelamin        = $request->jenis_kelamin;
        $data->access_id            = $request->access_id;
        $data->save();

        return redirect()->route('admin.user.index')->with('message-success', 'Data berhasil disimpan'); 
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nik'               => 'required|unique:users',
            'telepon'           => 'required',
            'name'              => 'required',
            //'email'             => 'required|email|unique:users',
            'password'          => 'required',
            'confirmation'      => 'required|same:password',
        ]);

        $data = new \App\UserModel();
        $data->no_anggota           = $request->no_anggota;
        $data->nik                  = $request->nik;
        $data->telepon              = $request->telepon;
        $data->name                 = $request->name;
        $data->email                = $request->email;
        $data->jenis_kelamin        = $request->jenis_kelamin;
        $data->password             = bcrypt($request->password); 
        $data->access_id            = $request->access_id;
        $data->save();

        return redirect()->route('admin.user.index')->with('message-success', 'User berhasil di buat');
    }
}

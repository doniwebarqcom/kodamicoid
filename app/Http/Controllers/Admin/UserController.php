<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;
use App\ModelUser; 

class UserController extends ControllerLogin
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {        
        $data = ModelUser::all();

    	return view('admin.user.index', compact('data'));
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
        $data = ModelUser::where('id', $id)->first();

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
        $data =  ModelUser::where('id', $id)->first();
        
        if(!empty($request->password))
        {
            $this->validate($request,[
                'confirmation'      => 'same:password',
            ]);

            $data->password             = bcrypt($request->password);
        }

        $data->nik                  = $request->nik;
        $data->telepon              = $request->telepon;
        $data->name                 = $request->name;
        $data->email                = $request->email; 
        $data->jenis_kelamin        = $request->jenis_kelamin;
        $data->access_id            = $request->access_id;
        $data->save();

        return redirect()->route('user.index')->with('message-success', 'Data berhasil disimpan'); 
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
            'email'             => 'required|email|unique:users',
            'password'          => 'required',
            'confirmation'      => 'required|same:password',
        ]);

        $data = new ModelUser();
        $data->nik                  = $request->nik;
        $data->telepon              = $request->telepon;
        $data->name                 = $request->name;
        $data->email                = $request->email;
        $data->jenis_kelamin        = $request->jenis_kelamin;
        $data->password             = bcrypt($request->password); 
        $data->access_id            = $request->access_id;
        $data->save();

        return redirect()->route('user.index')->with('message-success', 'User berhasil di buat');
    }
}

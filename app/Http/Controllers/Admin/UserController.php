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
        $data->password             = bcrypt($request->password); 
        $data->access_id            = $request->access_id;
        $data->save();

        $data->password = $request->password;

        return redirect()->route('user.index')->with('message-success', 'User berhasil di buat');
    }
}

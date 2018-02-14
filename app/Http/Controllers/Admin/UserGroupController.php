<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kodami\Models\Mysql\UserGroup;

use Auth;

class UserGroupController extends Controller
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
        if (Auth::user() == NULL) {
            return redirect()->route('login');
        }
        
    	return view('admin.user-group.index');
    }

    /**
     * [profile description]
     * @return [type] [description]
     */
    public function profile()
    {
    	return view('admin.profile');
    }
    
    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        return view('admin.user-group.create');
    }


   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
        $data = new UserGroup();
        $data->name  = $request->name;
        $data->description  = $request->description;
        $data->save();

        return redirect()->route('user-group.index')->with('messages-success', 'Group berhasil disimpan');
   }
}

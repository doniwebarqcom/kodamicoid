<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModelUser; 

class UserController extends Controller
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
}

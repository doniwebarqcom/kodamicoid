<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller
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
        
    	return view('/admin/index');
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

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\Controller;
use Auth;

class IndexController extends ControllerLogin
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
}

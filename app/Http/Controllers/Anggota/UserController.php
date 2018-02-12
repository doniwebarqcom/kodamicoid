<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends ControllerLogin
{
	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		if (Auth::user() == NULL) {
	        return redirect()->route('login');
	    }
	}
	
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	return view('anggota.index');
    }

    /**
     * [konfirmasiAnggota description]
     * @return [type] [description]
     */
    public function konfirmasianggota()
    {
    	return view('anggota.user.konfirmasi-anggota');
    }
}

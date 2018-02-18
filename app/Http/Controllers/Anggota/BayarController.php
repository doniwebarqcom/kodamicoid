<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\Controller;
use Auth;

class BayarController extends ControllerLogin
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function step1()
    {
    	return view('anggota.bayar.bayar');
    }
}

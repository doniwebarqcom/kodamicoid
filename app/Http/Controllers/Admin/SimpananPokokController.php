<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;

class SimpananPokokController extends ControllerLogin
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	$params['data_sudah_bayar'] = \Kodami\Models\Mysql\Deposit::where('type', 3)->where('status', 3)->orderBy('id', 'DESC')->paginate(100);
    	$params['data_belum_bayar'] = \Kodami\Models\Mysql\Deposit::where('type', 3)->where(function($table){
    																						$table->where('status',1)->orWhere('status', 2);
    																					})->orderBy('id', 'DESC')->paginate(100);
    	return view('admin.simpanan-pokok.index')->with($params);
    }
}

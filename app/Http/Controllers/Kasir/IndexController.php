<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{	
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {	
    	$params['data'] = \App\UserModel::where('access_id', 2)->orderBy('id', 'DESC')->get();

    	return view('kasir.index')->with($params);
    }
}

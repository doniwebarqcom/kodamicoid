<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kodami\Models\Mysql\Users; 

class KemitraanController extends Controller
{	
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	$params['dropshiper'] = Users::where('access_id', 7)->orderBy('id', 'DESC')->paginate(50);

    	return view('admin.kemitraan.index')->with($params);
    }
}

<?php

namespace App\Http\Controllers\Dropshiper;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;

/**
 * Kodami Package
 */
use Kodami\Models\Mysql\RekeningBankUser;


class RekeningBankController extends ControllerLogin
{	
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
        $data = RekeningBankUser::where('user_id', Auth::user()->id)->all();

    	return view('dropshiper.rekening-bank.index', compact('data'));
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        return view('dropshiper.rekening-bank.create');
    }
}
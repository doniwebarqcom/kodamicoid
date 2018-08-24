<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;
use Kodami\Models\Mysql\RekeningBank; 
use Kodami\Models\Mysql\Bank;

class RekeningBankController extends ControllerLogin
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {        
        $data = RekeningBank::all();

    	return view('admin.rekening-bank.index', compact('data'));
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        $bank = Bank::all();

        return view('admin.rekening-bank.create', compact('bank'));
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function mutasi($id)
    {
        $params['data'] = \Kodami\Models\Mysql\Mutation::where('rekening_bank_id', $id)->get();

        return view('admin.rekening-bank.mutasi')->with($params);
    }
}
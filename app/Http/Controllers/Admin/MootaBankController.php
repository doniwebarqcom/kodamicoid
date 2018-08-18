<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;
use App\ModelUser; 

class MootaBankController extends ControllerLogin
{	
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
        $params['data'] = json_decode(moota_bank());

    	return view('admin.moota-bank.index')->with($params);
    }

    /**
     * [mutasi description]
     * @return [type] [description]
     */
    public function mutasi($bank_id, $bank_type)
    {
        $params['data']     = json_decode(moota_mutasi($bank_id));
        $params['bank']     = $bank_type;

        return view('admin.moota-bank.mutasi')->with($params);
    }
}

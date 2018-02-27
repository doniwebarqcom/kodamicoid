<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\Controller;
use App\ModelUser;
use Carbon\Carbon;

use Kodami\Models\Mysql\Deposit;
use Auth;

class IndexController extends ControllerLogin
{	
    
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
        $data = [];

        $data['tagihan'] = Deposit::where('user_id', Auth::user()->id)
                                    ->where('status',1)
                                    ->where('type', 1)
                                    ->first();
                                    
        $data['deposit'] = Deposit::where('user_id', Auth::user()->id)
                                    ->where('type', 1)
                                    ->first();

    	return view('anggota.index')->with($data);
    }

    /**
     * [profile description]
     * @return [type] [description]
     */
    public function profile()
    {
        return view('anggota.profile');
    }

    /**
     * [saveProfile description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function saveProfile(Request $request)
    {
        $data = ModelUser::where('id', Auth::user()->id)->first();
        
        if(!empty($request->agama)) $data->agama = $request->agama;
        if(!empty($request->tempat_lahir)) $data->tempat_lahir = $request->tempat_lahir;
        if(!empty($request->tanggal_lahir)) $data->tanggal_lahir = $request->tanggal_lahir;   


        if ($request->hasFile('file_ktp')) {
            
            $image = $request->file('file_ktp');
            
            $name = time().'.'.$image->getClientOriginalExtension();
            
            $destinationPath = public_path('/file_ktp/'. Auth::user()->id);
            
            $image->move($destinationPath, $name);

            $data->foto_ktp = $name;
        }

        if ($request->hasFile('file_photo')) {
            
            $image = $request->file('file_photo');
            
            $name = time().'.'.$image->getClientOriginalExtension();
            
            $destinationPath = public_path('/file_photo/'. Auth::user()->id);
            
            $image->move($destinationPath, $name);
            
            $data->foto = $name;
        }
        

        $data->save();
   
        return redirect()->route('anggota.dashboard')->with('message-success', 'Profil berhasil disimpan');
    }
}

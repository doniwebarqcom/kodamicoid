<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\Controller;
use App\ModelUser;
use Auth;
use Carbon\Carbon;

class IndexController extends ControllerLogin
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
    public function index()
    {
    	return view('anggota.index');
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
   
        return redirect()->route('anggota.index')->with('message-success', 'Profil berhasil disimpan');
    }
}

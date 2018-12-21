<?php

namespace App\Http\Controllers\Cs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kodami\Models\Mysql\Users;

class AnggotaController extends Controller
{	
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	$data = Users::where('access_id', 2)->orWhere('access_id', 7)->orderBy('id', 'DESC')->get();

    	return view('cs.anggota.index', compact('data'));
    }

    /**
     * Active Anggota
     */
    public function active($id)
    {
        $user =  Users::where('id', $id)->first();
        $user->status_login = 1;
        $user->save();

        return redirect()->route('cs.anggota.index')->with('message-success', 'Login Anggota berhasil di Aktifkan');
    }

    /**
     * Inactive Anggota
     */
    public function inactive($id)
    {
        Users::where('id', $id)->update(['status_login'=> '0']);

        return redirect()->route('cs.anggota.index')->with('message-success', 'Login Anggota berhasil di Non Aktifkan');
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        $params['no_anggota'] = date('y').date('m').date('d'). (\App\UserModel::all()->count() + 1);

        return view('cs.anggota.create')->with($params);
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $user = \App\UserModel::where('id', $id)->first();
        $data['data'] 	= $user;
        $data['id'] 	= $id;
        
        return view('cs.anggota.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data =  \App\UserModel::where('id', $id)->first();
        
        if($request->password != $data->password)
        {
            if(!empty($request->password))
            {
                $this->validate($request,[
                    'confirmation'      => 'same:password',
                ]);

                $data->password             = bcrypt($request->password);
            }
        }
        
        $data->nik          = $request->nik; 
        $data->name         = strtoupper($request->name); 
        $data->jenis_kelamin= $request->jenis_kelamin; 
        $data->email        = $request->email;
        $data->telepon      = $request->telepon;
        $data->agama        = $request->agama;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->tanggal_lahir= $request->tanggal_lahir;
        $data->passport_number          = $request->passport_number;
        $data->kk_number                = $request->kk_number;
        $data->npwp_number              = $request->npwp_number;
        $data->bpjs_number              = $request->bpjs_number; 
        $data->domisili_provinsi_id     = $request->domisili_provinsi_id;
        $data->domisili_kabupaten_id    = $request->domisili_kabupaten_id;
        $data->domisili_kecamatan_id    = $request->domisili_kecamatan_id;
        $data->domisili_kelurahan_id    = $request->domisili_kelurahan_id;
        $data->domisili_alamat          = $request->domisili_alamat;
        $data->ktp_provinsi_id      = $request->ktp_provinsi_id;
        $data->ktp_kabupaten_id     = $request->ktp_kabupaten_id;
        $data->ktp_kecamatan_id     = $request->ktp_kecamatan_id;
        $data->ktp_kelurahan_id     = $request->ktp_kelurahan_id;
        $data->ktp_alamat           = $request->ktp_alamat;

        if ($request->hasFile('file_ktp'))
        {    
            $image = $request->file('file_ktp');   
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/file_ktp/'. $data->id);
            $image->move($destinationPath, $name);
            $data->foto_ktp = $name;
        }

        if ($request->hasFile('file_photo')) 
        {    
            $image = $request->file('file_photo');   
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/file_photo/'. $data->id);
            $image->move($destinationPath, $name);
            $data->foto = $name;
        }

        if ($request->hasFile('file_npwp')) 
        {    
            $image = $request->file('file_npwp');   
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/file_npwp/'. $data->id);
            $image->move($destinationPath, $name);
            $data->file_npwp = $name;
        }

        $data->is_dropshiper    = $request->is_dropshiper;

        if($request->is_dropshiper == 1)
        {
            $data->access_id = 7; # set access login sebagai dropshiper
        }
        else
        {
            $data->access_id = 2; # set access login sebagai anggota
        }
        $data->durasi_pembayaran = $request->durasi_pembayaran;
        $data->save();

        return redirect()->route('cs.anggota.edit', $data->id)->with('message-success', 'Data Anggota berhasil disimpan'); 
    }


    /**
     * [desctroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        $data = \App\UserModel::where('id', $id)->first();
        $data->delete();

        return redirect()->route('cs.anggota.index')->with('message-sucess', 'Data berhasi di hapus');
    }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $data               =  new \App\UserModel();
        $data->no_anggota   = $request->no_anggota;
        $data->nik          = $request->nik; 
        $data->name         = strtoupper($request->name); 
        $data->jenis_kelamin= $request->jenis_kelamin; 
        $data->email        = $request->email;
        $data->telepon      = $request->telepon;
        $data->agama        = $request->agama;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->tanggal_lahir= $request->tanggal_lahir;
        $data->password             = bcrypt($request->password); 
        $data->passport_number          = $request->passport_number;
        $data->kk_number                = $request->kk_number;
        $data->npwp_number              = $request->npwp_number;
        $data->bpjs_number              = $request->bpjs_number;
        $data->domisili_provinsi_id     = $request->domisili_provinsi_id;
        $data->domisili_kabupaten_id    = $request->domisili_kabupaten_id;
        $data->domisili_kecamatan_id    = $request->domisili_kecamatan_id;
        $data->domisili_kelurahan_id    = $request->domisili_kelurahan_id;
        $data->domisili_alamat          = $request->domisili_alamat;
        $data->ktp_provinsi_id      = $request->ktp_provinsi_id;
        $data->ktp_kabupaten_id     = $request->ktp_kabupaten_id;
        $data->ktp_kecamatan_id     = $request->ktp_kecamatan_id;
        $data->ktp_kelurahan_id     = $request->ktp_kelurahan_id;
        $data->ktp_alamat           = $request->ktp_alamat;
        
        $data->save();

        if ($request->hasFile('file_ktp'))
        {    
            $image = $request->file('file_ktp');   
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/file_ktp/'. $data->id);
            $image->move($destinationPath, $name);
            $data->foto_ktp = $name;
        }

        if ($request->hasFile('file_photo')) 
        {    
            $image = $request->file('file_photo');   
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/file_photo/'. $data->id);
            $image->move($destinationPath, $name);
            $data->foto = $name;
        } 

        if ($request->hasFile('file_npwp')) 
        {    
            $image = $request->file('file_npwp');   
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/file_npwp/'. $data->id);
            $image->move($destinationPath, $name);
            $data->file_npwp = $name;
        }
        
        $data->is_dropshiper    = $request->is_dropshiper;

        if($data->is_dropshiper == 1)
        {
            $data->access_id = 7; # set access login sebagai dropshiper
        }
        else
        {
            $data->access_id = 2; # set access login sebagai anggota
        }
        $data->durasi_pembayaran = $request->durasi_pembayaran;
        $data->save();

        return redirect()->route('cs.anggota.edit', $data->id)->with('message-success', 'Data Anggota berhasil disimpan.'); 
   }

   /**
    * [cetakKwitansi description]
    * @param  [type] $id [description]
    * @return [type]     [description]
    */
   public function cetakKwitansi($id)
   {
        $params['data']     = \Kodami\Models\Mysql\Deposit::where('id', $id)->first();

        return view('cs.anggota.kwitansi')->with($params);
   }

   /**
    * [topupSimpananPokok description]
    * @param  Request $request [description]
    * @return [type]           [description]
    */
    public function topupSimpananPokok(Request $request)
    {
        $deposit                = new \Kodami\Models\Mysql\Deposit();
        $deposit->no_invoice    = no_invoice(); 
        $deposit->status        = 3;
        $deposit->type          = 3;
        $deposit->user_id       = $request->user_id;
        $deposit->nominal       = $request->nominal;
        $deposit->proses_user_id = \Auth::user()->id;
        $deposit->save();  

        return redirect()->route('cs.anggota.edit', $request->user_id)->with('message-success', 'Topup Simpanan Pokok berhasil !');
    }

    /**
     * [topupSimpananWajib description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function topupSimpananWajib(Request $request)
    {
        $user                       = \App\UserModel::where('id', $request->user_id)->first();
        $user->durasi_pembayaran    = $request->durasi_pembayaran;
        $user->first_durasi_pembayaran_date = date('Y-m-d');
        $user->save();

        $deposit                = new \Kodami\Models\Mysql\Deposit();
        $deposit->no_invoice    = no_invoice(); 
        $deposit->status        = 3; 
        $deposit->type          = 5; // Simpanan Wajib
        $deposit->user_id       = $request->user_id;
        $deposit->nominal       = $request->durasi_pembayaran * $request->nominal;
        $deposit->proses_user_id = \Auth::user()->id;
        $deposit->save();

        return redirect()->route('cs.anggota.edit', $request->user_id)->with('message-success', 'Topup Simpanan Wajib berhasil !');
    }
}

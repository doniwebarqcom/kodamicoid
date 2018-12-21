<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;
use App\ModelUser; 
use Kodami\Models\Mysql\Users;
use Kodami\Models\Mysql\Deposit;
use Kodami\Models\Mysql\UserAnggotaKonfirmasiTransaksi;
use Kodami\Models\Mysql\UserAnggota;

class AnggotaController extends ControllerLogin
{	
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	$data = ModelUser::where(function($table){
                                    $table->where('access_id', 2)->orWhere('access_id', 7);
                                })->orderBy('id', 'DESC');

        if(isset($_GET['name']) and !empty($_GET['name']))
        {
            $data = $data->where('name','LIKE','%'. $_GET['name'] .'%');
        }
        
        $data = $data->paginate(50);

    	return view('admin.anggota.index', compact('data'));
    }

    /**
     * Active Anggota
     */
    public function active($id)
    {
        $user =  Users::where('id', $id)->first();
        $user->status_login = 1;
        $user->save();

        return redirect()->route('admin.anggota.index')->with('message-success', 'Login Anggota berhasil di Aktifkan');
    }

    /**
     * Inactive Anggota
     */
    public function inactive($id)
    {
        Users::where('id', $id)->update(['status_login'=> '0']);

        return redirect()->route('admin.anggota.index')->with('message-success', 'Login Anggota berhasil di Non Aktifkan');
    }

    /**
     * [confirm description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function confirm($id)
    {
        $params['data']         = Modeluser::where('id', $id)->first();
        $params['deposit']      = \Kodami\Models\Mysql\Deposit::where('type', 1)->where('user_id', $id)->first();

        return view('admin.anggota.confirm')->with($params);
    }

    /**
     * [confirmSubmit description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function confirmSubmit(Request $request)
    {
        if($request->status == 1)
        {
            $status = Deposit::where('id', $request->deposit_id)->first();
            $status->status = 3;
            $status->proses_user_id = \Auth::user()->id;
            $status->save(); 

            $user = \App\UserModel::where('id', $status->user_id)->first();

            /** Rubah status angota jadi active */
            $user = ModelUser::where('id', $status->user_id)->first();
            $user->status_anggota = 1;
            $user->status_login = 1;
            $user->save();

            // Insert Simpanan Pokok
            $deposit                = new Deposit();
            $deposit->no_invoice    = $status->no_invoice; 
            $deposit->status        = 3;
            $deposit->type          = 3; // Simpanan Pokok
            $deposit->user_id       = $status->user_id;
            $deposit->nominal       = get_setting('simpanan_pokok');
            $deposit->proses_user_id = \Auth::user()->id;
            $deposit->save();  

            // Insert Simpanan Wajib
            $deposit                = new Deposit();
            $deposit->no_invoice    = $status->no_invoice; 
            $deposit->status        = 3; 
            $deposit->type          = 5; // Simpanan Wajib
            $deposit->user_id       = $status->user_id;
            $deposit->nominal       = $user->durasi_pembayaran * get_setting('simpanan_wajib');
            $deposit->proses_user_id = \Auth::user()->id;
            $deposit->save();

            // Insert Simpanan Sukarela
            $deposit                = new Deposit();
            $deposit->no_invoice    = $status->no_invoice; 
            $deposit->status        = 3; 
            $deposit->type          = 4; // Simpanan Sukarela
            $deposit->user_id       = $status->user_id;
            $deposit->nominal       = $user->first_simpanan_sukarela + $status->code;
            $deposit->proses_user_id = \Auth::user()->id;
            $deposit->save();

             # Generata No Anggota
            $no_anggota = generate_no_anggota($status->user_id);
            if($no_anggota['status'] == 'success')
            {
              $no_anggota = $no_anggota['data'];
            }
            else
            {
              $no_anggota = 0;
            }

            $params['text']         = '<p>Dear Ibu/Bapak '. $status->user->name .'<br /> Pembayaran Data Anggota Anda berhasil </p>'. $no_anggota;
            $params['data']         = $deposit;
            $params['no_anggota']   = delimiterNoAnggota($no_anggota);

            if(isset($user->telepon))
            {   
                $msg  = "*Hallo ". $user->name .",*\n\n";
                $msg .= "Terima kasih pembayaran simpanan anggota anda telah kami terima, bersama email ini kami informasikan status keanggotaan anda saat ini telah aktif, dengan detil informasi sebagai berikut :\n\n";
                $msg .= "1. Nama \n    *". $user->name ."*\n";
                $msg .= "2. Nomor Anggota \n    *". delimiterNoAnggota($no_anggota) ."*\n";
                $msg .= "3. Username \n    *". $user->telepon ." / ". delimiterNoAnggota($no_anggota) ."*\n";
                $msg .= "4. Password \n    *".  $user->aktivasi_code ."*\n";
                $msg .= "     _(Silahkan melakukan penggantian password pada saat pertama kali login, demi menjaga keamanan data anda)_\n\n";
                $msg .= "Anda dapat menggunakan username dan password untuk login keanggotaan melalui https://kodami.co.id dan transaksi jual beli melalui https://kodami.id.\n\n";
                $msg .= "*Ttd*\n *Pengurus*"; 
              
                ApiWhaCurl($user->telepon, $msg);
            }

            // Update status anggota aktif ketika bayar simpanan
            Users::where('id', $status->user_id)->update(['status_anggota'=>1, 'status_pembayaran' => 1, 'status_login'=>1, 'no_anggota'=> $no_anggota, 'active_simko'=>1]);
            
            // cek user konfirmasi
            UserAnggotaKonfirmasiTransaksi::where('user_id', $status->user_id)->where('transaksi_id', $status->id)->where('type', 2)->update(['status' => 1]);

            # update table user anggota
            $user_anggota = UserAnggota::where('user_id', $status->user_id)->first();
            if(!$user_anggota)
            {
                $user_anggota                   = new UserAnggota();
                $user_anggota->user_id          = $status->user_id;
                $user_anggota->simpanan_pokok   = get_setting('simpanan_pokok');
                $user_anggota->simpanan_wajib   = $status->user->durasi_pembayaran * get_setting('simpanan_wajib');
                $user_anggota->simpanan_sukarela=$status->user->first_simpanan_sukarela + $status->code;
                $user_anggota->kuota            = get_setting('simpanan_pokok');
                $user_anggota->save();
            }

            # send email
            \Mail::send('email.register.lunas', $params,
              function($message) use($status) {
                  $message->from('services@kodami.co.id', 'Kodami Pocket System');
                  $message->to($status->user->email);
                  $message->subject('Koperasi Produsen Daya  Masyarakat Indonesia - Pembayaran Anggota Berhasil');
              }
            );

            // send email notifikasi
            $params['text'] = '<p>Dear Ibu/Bapak '. $status->user->name .'<br />Sudah melakuan Pembayaran Data Anggota dan berhasil</p>';
            \Mail::send('email.default', $params,
              function($message){
                  $message->from('services@kodami.co.id', 'Kodami Pocket System');
                  $message->to('noreply.kodami@gmail.com');
                  $message->subject('Koperasi Produsen Daya  Masyarakat Indonesia - Pembayaran Anggota Berhasil');
              }
            );
        }
        else
        {
            $deposit = \Kodami\Models\Mysql\Deposit::where('id', $id)->first();
            $deposit->status = 4;
            $status->proses_user_id = \Auth::user()->id;
            $deposit->save();

             /** Rubah status angota jadi reject */
            $user                   = ModelUser::where('id', $deposit->user_id)->first();
            $user->status           = 3;
            $user->status_anggota   = 3;
            $user->save();
        }

        return redirect()->route('admin.anggota.index')->with('message-success', 'Data berhasil di konfirmasi');
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        $params['no_anggota'] = date('y').date('m').date('d'). (ModelUser::all()->count() + 1);

        return view('admin.anggota.create')->with($params);
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
        
        return view('admin.anggota.edit')->with($data);
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
        $data =  ModelUser::where('id', $id)->first();
        
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
        $data->name         = $request->name; 
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

        #$data->status       = $request->status;
        #$data->status_login = $request->status_login;
        if($request->is_dropshiper == 1)
        {
            $data->access_id = 7; # set access login sebagai dropshiper
        }
        else
        {
            $data->access_id = 2; # set access login sebagai anggota
        }
        $data->is_dropshiper        = $request->is_dropshiper;
        $data->durasi_pembayaran    = $request->durasi_pembayaran;
        $data->save();

        return redirect()->route('admin.anggota.edit', $data->id)->with('message-success', 'Data berhasil disimpan'); 
    }

    /**
     * Delete Item
     * @return redirect
     */
    public function destroy($id)
    {
        $data = ModelUser::where('id', $id)->first();
        $data->delete();

        return redirect()->route('admin.anggota.index')->with('message-success', 'Data berhasi di hapus');
    }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $data               =  new ModelUser();
        $data->no_anggota   = $request->no_anggota;
        $data->nik          = $request->nik; 
        $data->name         = $request->name; 
        $data->jenis_kelamin= $request->jenis_kelamin; 
        $data->email        = $request->email;
        $data->telepon      = $request->telepon;
        $data->agama        = $request->agama;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->tanggal_lahir= $request->tanggal_lahir;
        $data->password             = bcrypt($request->password); 
        $data->status       = 1; // menunggu pembayaran 
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
        #$data->status = $request->status;
        $data->is_dropshiper = $request->is_dropshiper;
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

        return redirect()->route('admin.anggota.edit', $data->id)->with('message-success', 'Data berhasil disimpan'); 
   }

   /**
    * [cetakKwitansi description]
    * @param  [type] $id [description]
    * @return [type]     [description]
    */
   public function cetakKwitansi($id)
   {
        $params['data']     = \Kodami\Models\Mysql\Deposit::where('id', $id)->first();

        return view('admin.anggota.kwitansi')->with($params);
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

        return redirect()->route('admin.anggota.edit', $request->user_id)->with('message-success', 'Topup Simpanan Pokok berhasil !');
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

        return redirect()->route('admin.anggota.edit', $request->user_id)->with('message-success', 'Topup Simpanan Wajib berhasil !');
    }

    /**
     * [autologin description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function autologin($id)
    {
        \Auth::loginUsingId($id);
        \Session::put('is_login_admin', true);
        
        return redirect()->route('anggota.dashboard');
    }
    /*
     * [deteleBank description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteBank($id, $user_id)
    {
        $bank = \Kodami\Models\Mysql\RekeningBankUser::where('id', $id)->first();
        $bank->delete();

        return redirect()->route('admin.anggota.edit', $user_id)->with('message-success', 'Data Bank berhasil dihapus !');
    }

    /**
     * [addRekeningBank description]
     * @param Request $request [description]
     */
    public function addRekeningBank(Request $request)
    {
        $data                   = new \Kodami\Models\Mysql\RekeningBankUser();
        $data->nama_akun        = $request->nama_akun;
        $data->no_rekening      = $request->no_rekening;
        $data->bank_id          = $request->bank_id;
        $data->cabang           = $request->cabang;
        $data->user_id          = $request->user_id;
        $data->save();

        return redirect()->route('admin.anggota.edit', $request->user_id)->with('message-success', 'Data Rekening Bank berhasil disimpan !');
    }
}

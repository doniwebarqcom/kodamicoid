<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\ContactUs;
use Kodami\Models\Mysql\Users;
use Kodami\Models\Mysql\Deposit;
use Kodami\Models\Mysql\UserAnggotaKonfirmasiTransaksi;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * [postContactUs description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postContactUs(Request $request)
    {
        $data           = new ContactUs();
        $data->nama     = $request->nama;
        $data->email    = $request->email;
        $data->telepon  = $request->telepon;
        $data->message  = $request->message;
        $data->save();

        return redirect('/')->with('messages', 'Pertanyaan dan Kritik anda akan kami proses dengan segera.');
    }

    /**
     * Daftar Anggota Baru
     */
    public function daftar()
    { 
        return view('auth.daftar');
    }

    /**
     * Request Store
     */
    public function daftarStore(Request $request)
    {
        $this->validate($request,[
            'name'              => 'required',
            'telepon'           => 'required|unique:users',
            'email'             => 'required|email|unique:users',
            'jenis_kelamin'     => 'required',
            'setuju'              => 'required'
        ]);

        $password               = generateRandomString(6);

        $no_anggota             = date('y').date('m').date('d'). (Users::all()->count() + 1);
	if($request->simpanan_sukarela != "")
	{
        	$simpanan_sukarela      = str_replace('Rp. ', '', $request->simpanan_sukarela);
        	$simpanan_sukarela      = str_replace('.', '', $simpanan_sukarela);
       		$simpanan_sukarela      = str_replace(',', '', $simpanan_sukarela);
	}
	else
	{
		$simpanan_sukarela = 0;
	}

        $data                   =  new Users();
        $data->name             = $request->name; 
        $data->jenis_kelamin    = $request->jenis_kelamin; 
        $data->email            = $request->email;
        $data->telepon          = $request->telepon;
        $data->agama            = $request->agama;
        $data->tempat_lahir     = $request->tempat_lahir;
        $data->tanggal_lahir    = $request->tanggal_lahir;
        $data->nik              = $request->nik; 
        $data->no_anggota       = $no_anggota;
        $data->password         = bcrypt($password);
        $data->aktivasi_code    = $password;
        $data->domisili_provinsi_id     = $request->domisili_provinsi_id;
        $data->domisili_kabupaten_id    = $request->domisili_kabupaten_id;
        $data->domisili_kecamatan_id    = $request->domisili_kecamatan_id;
        $data->domisili_kelurahan_id    = $request->domisili_kelurahan_id;
        $data->domisili_alamat          = $request->domisili_alamat;
        $data->durasi_pembayaran        = $request->durasi_pembayaran;
        $data->register_source          = 1; // pendaftaran online
        $data->first_simpanan_sukarela  = $simpanan_sukarela;
        $data->durasi_pembayaran        = $request->durasi_pembayaran;
        $data->access_id                = 2;

        if ($request->hasFile('file_ktp'))
        {    
            $image = $request->file('file_ktp');   
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/file_ktp/'. $data->id);
            $image->move($destinationPath, $name);
            $data->foto_ktp = $name;
        }

        $data->save();

        $code = rand(100, 999);
        $deposit = new Deposit;
        $deposit->no_invoice   = (\Kodami\Models\Mysql\PInvoice::count()+1).$data->id.'/KDM/'. date('d').date('m').date('y');;
        $deposit->user_id      = $data->id;
        $deposit->status       = 1; // menunggu konfirmasi pembayaran
        $deposit->type         = 1; // pembayaran awal sebagai anggota
        $deposit->nominal      = $request->total_pembayaran + $code;
        $deposit->due_date     = date('Y-m-d', strtotime("+3 days"));
        $deposit->code         = $code;
        $deposit->save();

        $params['user']         = $data;
        $params['deposit']      = $deposit;
        
        \Mail::send('email.register.success', $params,
            function($message) use($data) {
                $message->from('noreply.kodami@gmail.com', 'Kodami Pocket System');
                $message->to($data->email);
                $message->subject('Registrasi - Kodami Pocket System');
            }
        );

        // send notifikasi ke admin ketika ada registrasi baru
        \Mail::send('email.register.success', $params,
            function($message) use($data) {
                $message->from('noreply.kodami@gmail.com', 'Kodami Pocket System');
                $message->to('noreply.kodami@gmail.com');
                $message->subject('Pendaftaran Baru Anggota #'. $data->name .' - Kodami Pocket System');
            }
        );

        return redirect('register/success')->with('success-register', 'Berhasil melakukan registrasi');
    }

    /**
     * Aktivasi Link
     * @return redirect
     */
    public function konfirmasi($aktivasi_code)
    {
        $params['data'] = Users::where('aktivasi_code', $aktivasi_code)->first();
        
        if(!$params['data'])
        {
            return redirect('/login')->with('message-success', 'Maaf link konfirmasi tidak berlaku lagi.');
        }
        
        if($params['data'])
        {
            if($params['data']->aktivasi_link == 1)
            {
                return redirect('/login')->with('message-success', 'Anda sudah melakukan konfirmasi pembayaran, Status anggota anda akan kami aktifkan maksimal 1x24 jam. ');
            }
        }
        return view('auth.konfirmasi')->with($params);
    }

    /**
     * Konfirmasi Pembayaran
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function konfirmasiStore(Request $request, $id)
    {
        $this->validate($request,[
            'nominal'                       => 'required',
            'rekening_bank_id'              => 'required',
            'file_confirmation'             => 'required',
            'tanggal_transfer'              => 'required'
        ]);

        $data               = Deposit::where('user_id', $id)->where('status','1')->where('type',1)->first(); 
        $data->status       = 2;
        $data->due_date     = $request->tanggal_transfer;
        $data->rekening_bank_id= $request->rekening_bank_id;
        
        if ($request->hasFile('file_confirmation'))
        {    
            $image = $request->file('file_confirmation');   
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/file_confirmation/'. $data->id);
            $image->move($destinationPath, $name);
            $data->file_confirmation = $name;
        }
        $data->save();

        $nominal = remove_number_format($request->nominal) - $data->nominal;

        // record transaksi
        $konfirmasi                  = new UserAnggotaKonfirmasiTransaksi();
        $konfirmasi->transaksi_id    = $data->id;
        $konfirmasi->user_id         = $data->user_id;
        $konfirmasi->nominal         = remove_number_format($request->nominal);
        $konfirmasi->nominal_kurang  = ($nominal < 0 ? $nominal : 0);
        $konfirmasi->nominal_lebih   = ($nominal > 0 ? abs($nominal) : 0 );
        $konfirmasi->file            = $name;
        $konfirmasi->type            = 2; // source dari register simpanan
        $konfirmasi->bank_id         = $request->rekening_bank_id;
        $konfirmasi->save();

        $user = Users::where('id', $data->user_id)->first();
        $user->aktivasi_link = 1;
        $user->save();

        $params['data']         = $data;
        $params['konfirmasi']   = $konfirmasi;

        \Mail::send('email.register.konfirmasi', $params,
            function($message) use($data) {
                $message->from('noreply.kodami@gmail.com', 'Kodami Pocket System');
                $message->to($data->user->email);
                $message->subject('Konfirmasi Pembayaran - Kodami Pocket System');
            }
        );

        // send notifikasi ke admin ketika ada registrasi baru
        \Mail::send('email.register.konfirmasi', $params,
            function($message) use($data) {
                $message->from('noreply.kodami@gmail.com', 'Kodami Pocket System');
                $message->to('noreply.kodami@gmail.com');
                $message->subject('Konfirmasi Pembayaran Anggota #'. $data->user->name .' - Kodami Pocket System');
            }
        );

        return redirect('login')->with('message-success', 'Terima kasih telah melaukan konfirmasi pembayaran pendaftaran anggota Koperasi Produsen Daya Masyarakat Indonesia. Status anggota anda akan kami aktifkan maksimal 1x24 jam.');
    }
}

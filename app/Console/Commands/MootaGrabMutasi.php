<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kodami\Models\Mysql\UserAnggotaKonfirmasiTransaksi;

class MootaGrabMutasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Moota:grab';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      echo "\n\n";
      echo " ================================================== \n";
      echo " MOOTA GRAB MUTASI \n";
      echo " ================================================== \n \n";

      $banks = \Kodami\Models\Mysql\RekeningBank::whereNotNull('moota_bank_id')->get();

      foreach($banks as $bank)
      {
        echo " BANK : ". strtoupper(@$bank->bank->nama) ." \n";
        echo " NO REKENING : ". strtoupper(@$bank->no_rekening) ." \n";
        echo " ATAS NAMA : ". strtoupper(@$bank->owner) ." \n\n";
 
        // GRAB MUTASI
        $allmutasi = moota_mutasi($bank->moota_bank_id);
        
        foreach($allmutasi as $mutasi)
        {
          $temp = \Kodami\Models\Mysql\Mutation::where('mutation_id', $mutasi->mutation_id)->first();

          if(!$temp)
          {
            echo " DATE TRANSFER : ". strtoupper($bank->atas_nama) ." \n";
            echo " DESCRIPTION : ". strtoupper($mutasi->description) ." \n";
            echo " AMOUNT : ". strtoupper($mutasi->amount) ." \n";
            echo " TYPE : ". strtoupper($mutasi->type) ." \n\n";

            /**
             * CEK TRANSAKSI YANG ADA DI-DEPOSIT
             */
            # CEK PEMBAYARAN DEPOSIT AWAL
            # VALIDASI PEMBAYARAN ANGGOTA
            echo " CEK MUTASI PEMBAYARAN ANGGOTA \n";
            $deposit_awal = \Kodami\Models\Mysql\Deposit::where('type', 1)->where(function($table){
              $table->where('status', 1)->orWhere('status', 2);
            })->where('nominal', $mutasi->amount)->first();

            if($deposit_awal)
            {
              $temp                   = new \Kodami\Models\Mysql\Mutation();
              $temp->rekening_bank_id = $bank->id;
              $temp->date_transfer    = $mutasi->date;
              $temp->description      = $mutasi->description;
              $temp->amount           = $mutasi->amount;
              $temp->type             = $mutasi->type == 'DB' ? 2 : 1;
              $temp->note             = $mutasi->note;
              $temp->account_number   = $mutasi->account_number;
              $temp->mutation_id      = $mutasi->mutation_id;
              $temp->created_at_mutation=$mutasi->created_at;
              $temp->save();

              $data_deposit                  = \Kodami\Models\Mysql\Deposit::where('id', $deposit_awal->id)->first();
              $data_deposit->mutation_id     = $temp->id;
              $data_deposit->mutation_datesyn= date('Y-m-d H:i:s');
              $data_deposit->status          = 3; // Rubah status menjadi lunas
              $data_deposit->save();

              if(isset($data_deposit->user->name))
              {
                // Insert Simpanan Pokok
                $deposit                = new \Kodami\Models\Mysql\Deposit();
                $deposit->no_invoice    = $data_deposit->no_invoice; 
                $deposit->status        = 3;
                $deposit->type          = 3; // Simpanan Pokok
                $deposit->user_id       = $data_deposit->user_id;
                $deposit->nominal       = get_setting('simpanan_pokok');
                $deposit->save();  

                // Insert Simpanan Wajib
                $deposit                = new \Kodami\Models\Mysql\Deposit();
                $deposit->no_invoice    = $data_deposit->no_invoice; 
                $deposit->status        = 3; 
                $deposit->type          = 5; // Simpanan Wajib
                $deposit->user_id       = $data_deposit->user_id;
                $deposit->nominal       = $data_deposit->user->durasi_pembayaran * get_setting('simpanan_wajib');
                $deposit->save();

                // Insert Simpanan Sukarela
                $deposit                = new \Kodami\Models\Mysql\Deposit();
                $deposit->no_invoice    = $data_deposit->no_invoice; 
                $deposit->status        = 3; 
                $deposit->type          = 4; // Simpanan Sukarela
                $deposit->user_id       = $data_deposit->user_id;
                $deposit->nominal       = $data_deposit->user->first_simpanan_sukarela + $data_deposit->code;
                $deposit->save();

                echo " =================================================\n";
                echo " NOMINAL : ". @$mutasi->amount ."\n";
                echo " NAME : ". @$data_deposit->user->name ."\n";
                echo " NIK : ". @$data_deposit->user->nik ."\n";
                echo " SEND EMAIL KE ANGGOTA ...  \n";

                # Generata No Anggota
                $no_anggota = generate_no_anggota($data_deposit->user_id);
                if($no_anggota['status'] == 'success')
                {
                  $no_anggota = $no_anggota['data'];
                }
                else
                {
                  $no_anggota = 0;
                }

                $params['text']         = '<p>Dear Ibu/Bapak '. $data_deposit->user->name .'<br /> Pembayaran Data Anggota Anda berhasil </p>'. $no_anggota;
                $params['data']         = $deposit;
                $params['no_anggota']   = delimiterNoAnggota($no_anggota);

                // Update status anggota aktif ketika bayar simpanan
                \Kodami\Models\Mysql\Users::where('id', $data_deposit->user_id)->update(['status_anggota'=>1, 'status_pembayaran' => 1, 'status_login'=>1, 'no_anggota'=> $no_anggota]);
                
                // cek user konfirmasi
                UserAnggotaKonfirmasiTransaksi::where('user_id', $data_deposit->user_id)->where('transaksi_id', $deposit_awal->id)->where('type', 2)->update(['status' => 1]);

                # send email
                \Mail::send('email.register.lunas', $params,
                  function($message) use($data_deposit) {
                      $message->from('services@kodami.co.id', 'Kodami Pocket System');
                      $message->to($data_deposit->user->email);
                      $message->subject('Koperasi Produsen Daya  Masyarakat Indonesia - Pembayaran Anggota Berhasil');
                  }
                );

                // send email notifikasi
                $params['text'] = '<p>Dear Ibu/Bapak '. $data_deposit->user->name .'<br />Sudah melakuan Pembayaran Data Anggota dan berhasil</p>';
                \Mail::send('email.default', $params,
                  function($message){
                      $message->from('services@kodami.co.id', 'Kodami Pocket System');
                      $message->to('noreply.kodami@gmail.com');
                      $message->subject('Koperasi Produsen Daya  Masyarakat Indonesia - Pembayaran Anggota Berhasil');
                  }
                );
                
                echo " SUCCESS EMAIL : ". $data_deposit->user->email ."\n";
                echo " =================================================\n\n";
              }
            }

            /**
             * Konfirmasi via transafer / Web
             */
            $konfirmasi = UserAnggotaKonfirmasiTransaksi::where('nominal', $mutasi->amount)->where('type',2)->whereNull('status')->first();
            if($konfirmasi)
            {
              $temp                   = new \Kodami\Models\Mysql\Mutation();
              $temp->rekening_bank_id = $bank->id;
              $temp->date_transfer    = $mutasi->date;
              $temp->description      = $mutasi->description;
              $temp->amount           = $mutasi->amount;
              $temp->type             = $mutasi->type == 'DB' ? 2 : 1;
              $temp->note             = $mutasi->note;
              $temp->account_number   = $mutasi->account_number;
              $temp->mutation_id      = $mutasi->mutation_id;
              $temp->created_at_mutation=$mutasi->created_at;
              $temp->save();
              
              if($konfirmasi->nominal_lebih > 0)
              {
                $data_deposit                  = \Kodami\Models\Mysql\Deposit::where('id', $konfirmasi->transaksi_id)->first();
                $data_deposit->mutation_datesyn= date('Y-m-d H:i:s');
                $data_deposit->status          = 3; // Rubah status menjadi lunas
                $data_deposit->save();

                // Insert Simpanan Pokok
                $deposit                = new \Kodami\Models\Mysql\Deposit();
                $deposit->no_invoice    = $data_deposit->no_invoice; 
                $deposit->status        = 3;
                $deposit->type          = 3; // Simpanan Pokok
                $deposit->user_id       = $data_deposit->user_id;
                $deposit->nominal       = get_setting('simpanan_pokok');
                $deposit->save();  

                // Insert Simpanan Wajib
                $deposit                = new \Kodami\Models\Mysql\Deposit();
                $deposit->no_invoice    = $data_deposit->no_invoice; 
                $deposit->status        = 3; 
                $deposit->type          = 5; // Simpanan Wajib
                $deposit->user_id       = $data_deposit->user_id;
                $deposit->nominal       = $data_deposit->user->durasi_pembayaran * get_setting('simpanan_wajib');
                $deposit->save();

                // Insert Simpanan Sukarela
                $deposit                = new \Kodami\Models\Mysql\Deposit();
                $deposit->no_invoice    = $data_deposit->no_invoice; 
                $deposit->status        = 3; 
                $deposit->type          = 4; // Simpanan Sukarela
                $deposit->user_id       = $data_deposit->user_id;
                $deposit->nominal       = $konfirmasi->nominal_lebih;
                $deposit->save();

                # Generata No Anggota
                $no_anggota = generate_no_anggota($data_deposit->user_id);
                if($no_anggota['status'] == 'success')
                {
                  $no_anggota = $no_anggota['data'];
                }
                else
                {
                  $no_anggota = 0;
                }

                $params['text']         = '<p>Dear Ibu/Bapak '. $data_deposit->user->name .'<br /> Pembayaran Data Anggota Anda berhasil </p>'. $no_anggota;
                $params['data']         = $deposit;
                $params['no_anggota']   = delimiterNoAnggota($no_anggota);
                $params['kelebihan_bayar']=$konfirmasi->nominal_lebih;

                // Update status anggota aktif ketika bayar simpanan
                \Kodami\Models\Mysql\Users::where('id', $data_deposit->user_id)->update(['status_anggota'=>1, 'status_pembayaran' => 1, 'status_login'=>1, 'no_anggota'=> $no_anggota]);
                
                # send email
                \Mail::send('email.register.lunas', $params,
                  function($message) use($data_deposit) {
                      $message->from('services@kodami.co.id', 'Kodami Pocket System');
                      $message->to($data_deposit->user->email);
                      $message->subject('Koperasi Produsen Daya  Masyarakat Indonesia - Pembayaran Anggota Berhasil');
                  }
                );

                
                // send email notifikasi
                $params['text'] = '<p>Dear Ibu/Bapak '. $data_deposit->user->name .'<br />Sudah melakuan Pembayaran Data Anggota dan berhasil</p>';
                \Mail::send('email.default', $params,
                  function($message){
                      $message->from('services@kodami.co.id', 'Kodami Pocket System');
                      $message->to('noreply.kodami@gmail.com');
                      $message->subject('Koperasi Produsen Daya  Masyarakat Indonesia - Pembayaran Anggota Berhasil');
                  }
                );
              }
              
            }
          }
        }
      }
    }
}

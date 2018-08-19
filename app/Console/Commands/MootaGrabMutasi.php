<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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

      $banks = \Kodami\Models\Mysql\Bank::whereNotNull('moota_bank_id')->get();

      foreach($banks as $bank)
      {
        echo " BANK : ". strtoupper($bank->nama) ." \n";
        echo " NO REKENING : ". strtoupper($bank->no_rekening) ." \n";
        echo " ATAS NAMA : ". strtoupper($bank->owner) ." \n\n";

        // GRAB MUTASI
        $allmutasi = moota_mutasi($bank->moota_bank_id);
        if(isset($allmutasi->data))
        {
          foreach($allmutasi->data as $mutasi)
          {
            $temp = \Kodami\Models\Mysql\MutasiMoota::where('mutation_id', $mutasi->mutation_id)->first();

            if(!$temp)
            {
              $temp                   = new \Kodami\Models\Mysql\MutasiMoota();
              $temp->bank_id          = $bank->id;
              $temp->date_transfer    = $mutasi->date;
              $temp->description      = $mutasi->description;
              $temp->amount           = $mutasi->amount;
              $temp->type             = $mutasi->type == 'DB' ? 2 : 1;
              $temp->note             = $mutasi->note;
              $temp->account_number   = $mutasi->account_number;
              $temp->mutation_id      = $mutasi->mutation_id;

              echo " DATE TRANSFER : ". strtoupper($bank->atas_nama) ." \n";
              echo " DESCRIPTION : ". strtoupper($mutasi->description) ." \n";
              echo " AMOUNT : ". strtoupper($mutasi->amount) ." \n";
              echo " TYPE : ". strtoupper($mutasi->type) ." \n\n";
            }
            $temp->save();
          }
        }
      }
    }
}

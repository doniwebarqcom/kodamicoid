<?php

/**
 * Get Kabupaten
 */
function getKabupatenById($id)
{
  return \Kodami\Models\Mysql\Kabupaten::where('id_kab', $id)->first();
}

/**
 * Generate Password
 */
function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

/**
 * Parsing Yearmonth
 * @return string
 */
function parsing_pln_periode($periode)
{
  $str = substr($periode, 4);

  return date('M', mktime(0, 0, 0, $str, 10)) .' - '.substr($periode, 0,4);
} 

/**
 * Remove Number Format
 * @return number
 */
function remove_number_format($number)
{
  return str_replace(',', '',$number);
}

/**
 * 
 * @return [type] [description]
 */
function generate_no_anggota($user_id)
{
  $user = \Kodami\Models\Mysql\Users::where('id', $user_id)->first();

  if($user)
  { 
    $no_anggota = '';

    # Register Source
    if($user->register_source == 1)
    {
      $no_anggota = 12;
    }
    else
    {
      $no_anggota = 11;      
    }

    if(!empty($user->domisili_kelurahan_id))
    {
      $no_anggota .= floor($user->domisili_kelurahan_id / 123456);
    }
    else
    {
      return ['status'=>'error','message'=>'Data Kecamatan Domisili belum lengkap.'];
    }

    # Get Tanggal Lahir
    if(!empty($user->tanggal_lahir))
    {
      $no_anggota .= date('d', strtotime($user->tanggal_lahir));
      $no_anggota .= date('m', strtotime($user->tanggal_lahir));
      $no_anggota .= date('y', strtotime($user->tanggal_lahir));
    }
    else
    {
      return ['status'=>'error','message'=>'Data Tanggal lahir belum lengkap.'];
    }

    $no_anggota .= rand(100, 999);

    return ['status'=>'success', 'data'=> $no_anggota];
  }
}

/**
 * Parsing No Telpon
 * @return string
 */
function explode_telepon($no_telpon)
{
  $str = explode('/', $no_telpon);

  if(count($str) == 1)
  {
    return $no_telpon;
  }
  else
  {
    return @$str[0];
  }
}

/**
 * [total_transaksi_sukses_dropshiper description]
 * @param  [type] $user_id [description]
 * @return [type]          [description]
 */
function total_transaksi_gagal_dropshiper($user_id)
{
  return \Kodami\Models\Mysql\PPulsaTransaksi::whereNotNull('simko_reff_id')->where('user_id', $user_id)->where('status', 3)->count();
}

/**
 * [total_transaksi_sukses_dropshiper description]
 * @param  [type] $user_id [description]
 * @return [type]          [description]
 */
function total_transaksi_sukses_dropshiper($user_id)
{
  return \Kodami\Models\Mysql\PPulsaTransaksi::whereNotNull('simko_reff_id')->where('user_id', $user_id)->where('status', 2)->count();
}

/**
 * [total_transaksi description]
 * @return [type] [description]
 */
function total_transaksi_dropshiper($user_id)
{
  return \Kodami\Models\Mysql\PPulsaTransaksi::whereNotNull('simko_reff_id')->where('user_id', $user_id)->count();
}

/**
 * [saldo_dropshiper description]
 * @param  [type] $user_id [description]
 * @return [type]          [description]
 */
function saldo_dropshiper($user_id)
{
  $saldo = \Kodami\Models\Mysql\UserDropshiper::where('user_id', $user_id)->first();
  
  if($saldo)
  {
    return $saldo->saldo;
  }

  return "0";
} 

/**
 * [saldo_terpakai_dropshiper description]
 * @param  [type] $user_id [description]
 * @return [type]          [description]
 */
function saldo_terpakai_dropshiper($user_id)
{
  $saldo = \Kodami\Models\Mysql\UserDropshiper::where('user_id', $user_id)->first();
  
  if($saldo)
  {
    return $saldo->saldo_terpakai;
  }

  return "0";
} 

/**
 * [total_saldo_terpakai_dropshiper description]
 * @param  [type] $user_id [description]
 * @return [type]          [description]
 */
function total_saldo_terpakai_dropshiper($user_id)
{
  $saldo = \Kodami\Models\Mysql\UserDropshiper::where('user_id', $user_id)->first();
  
  if($saldo)
  {
    return $saldo->total_saldo_terpakai;
  }

  return "0";
} 

/**
 * [getInvoicePulsa description]
 * @param  [type] $no_invoice [description]
 * @return [type]             [description]
 */
function getInvoicePulsa($no_invoice)
{
  return \Kodami\Models\Mysql\PPulsaTransaksi::where('no_invoice', $no_invoice)->first();
}

/**
 * Status Login
 * @return String
 */
function status_login_anggota($status)
{
  switch ($status) {
    case 1:
       return "<a class=\"btn btn-success btn-xs\" title='Aktif'><i class=\"fa fa-check\"></i></a>";
       break;
    default:
       return "<a class=\"btn btn-danger btn-xs\" title='Tidak Aktif'><i class=\"fa fa-close\"></i></a>";
      break;
 }
} 

/**
 * [status_anggota description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function status_anggota($id)
{
   $user = App\ModelUser::where('id', $id)->first();

   switch ($user->status_anggota) {
      case 0:
         return "<a class=\"btn btn-danger btn-xs\" style=\"font-size:11px\"><i class=\"fa fa-ban\"></i> Tidak Aktif</a>";
         break;
      case 1:
            return "<a class=\"btn btn-success btn-xs\" style=\"font-size:11px\"><i class=\"fa fa-check\"></i> Aktif</a>";
         break;
      case 2:
         return "<a class=\"btn btn-danger btn-xs\" style=\"font-size:11px\"><i class=\"fa fa-ban\"></i> Ditolak</a>";
         break;
      case 3:
         return "<a class=\"btn btn-danger btn-xs\" style=\"font-size:11px\"><i class=\"fa fa-ban\"></i> Non Aktif</a>";
         break;
      default:
         return "<a class=\"btn btn-danger btn-xs\" style=\"font-size:11px\"><i class=\"fa fa-ban\"></i> Tidak Aktif</a>";
         break;
   }
}

/**
 * [all_simpanan_wajib description]
 * @return [type] [description]
 */
function all_simpanan_wajib()
{
  return \Kodami\Models\Mysql\Deposit::where('type', 5);
}

/**
 * [simpanan_pokok description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function all_simpanan_sukarela()
{
  return \Kodami\Models\Mysql\Deposit::where('type', 4);
}

/**
 * [simpanan_pokok description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function all_simpanan_pokok()
{
  return \Kodami\Models\Mysql\Deposit::where('type', 3);
}

/**
 * [total_anggota description]
 * @param  string $status [description]
 * @return [type]         [description]
 */
function total_anggota($status = 'all')
{
  if($status == 'all')
  {
    $count = \Kodami\Models\Mysql\Users::where('access_id', 2)->count();
  }
  if($status == 'active')
  {
    $count = \Kodami\Models\Mysql\Users::where('access_id', 2)->where('status', 1)->count();
  }

  return $count;
}

/**
 * [access_rules description]
 * @param  [type] $selected [description]
 * @return [type]           [description]
 */
function access_rules($selected = 0)
{

   $array_map = [
                  1 => 'Administrator',
                  2 => 'Anggota',
                  3 => 'Teller / Kasir',
                  4 => 'Customer Service',
                  5 => 'Operator',
                  6 => 'Admin Operator',
                  7 => 'Dropshiper',
                  8 => 'Admin Produk'
               ];
               
  $array_map = \Kodami\Models\Mysql\Users::access();

   if($selected != null || $selected != "" || $selected != 0)
   {
      return '<span class="label label-info"><i class="fa fa-key"></i> '. @$array_map[$selected] .'</span>';
   }

   return $array_map;
}

/**
 * [type_deposit description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function type_deposit($key)
{
  $array_map = [
                  3 => 'Simpanan Pokok',
                  4 => 'Simpanan Sukarela',
                  5 => 'Simpanan Wajib'
               ];

    if(array_key_exists($key, $array_map))
    {
      return $array_map[$key];
    }
}

/**
 * [list_bank description]
 * @return [type] [description]
 */
function list_bank()
{
  return \Kodami\Models\Mysql\Bank::all();
}

/**
 * [get_jabatan description]
 * @return [type] [description]
 */
function get_jabatan($key)
{
  $array_map = [
                  1 => 'Administrator',
                  2 => 'Anggota',
                  3 => 'Teller',
                  4 => 'Customer Service',
                  5 => 'Operator',
                  6 => 'Admin Operator',
                  7 => 'Dropshiper'
               ];

    if(array_key_exists($key, $array_map))
    {
      return $array_map[$key];
    }
}

/**
 * [status_deposit_awal description]
 * @return [type] [description]
 */
function status_deposit_awal($user_id)
{
  $status = \Kodami\Models\Mysql\Deposit::where('type', 1)->where('user_id', $user_id)->first();

  if($status)
  {
    return $status->status;
  }
  else
  {
    return 0;
  }
}

/**
 * [no_invoice description]
 * @return [type] [description]
 */
function no_invoice()
{
  $no = (\Kodami\Models\Mysql\Deposit::count()+1);

  return  $no . \Auth::user()->id.'/INV/KDM/'. date('d').date('m').date('y');
}

/**
 * [status_deposit description]
 * @param  [type] $status [description]
 * @return [type]         [description]
 */
function status_deposit($status)
{
  switch ($status) {
      case 1:
         return "<a class=\"btn btn-warning btn-xs\"><i class=\"fa fa-ban\"></i> Menunggu Konfirmasi Pembayaran</a>";
         break;
      case 2:
            return "<a class=\"btn btn-warning btn-xs\"><i class=\"fa fa-info\"></i> Menunggu Persetujuan Admin</a>";
         break;
      case 3:
         return "<a class=\"btn btn-success btn-xs\"><i class=\"fa fa-check\"></i> Berhasil</a>";
         break;
       case 4:
         return "<a class=\"btn btn-danger btn-xs\"><i class=\"fa fa-ban\"></i> Ditolak</a>";
         break;
      default:
         return "<a class=\"btn btn-warning btn-xs\"><i class=\"fa fa-ban\"></i> Inactive</a>";
         break;
   }
}

/**
 * [simpanan_wajib description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function simpanan_wajib($id)
{
  return \Kodami\Models\Mysql\Deposit::where('user_id', $id)->where('type', 5);
}

/**
 * [sum_simpanan_wajib description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function sum_simpanan_wajib($id, $status=3)
{
  if($status == 'all')
  {
    $simpanan_wajib = \Kodami\Models\Mysql\Deposit::where('user_id', $id)->sum('nominal');
  }
  else
  {
    $simpanan_wajib = \Kodami\Models\Mysql\Deposit::where('user_id', $id)->where('status', $status)->where('type', 5)->sum('nominal');

  }

  return $simpanan_wajib;
}

/**
 * [simpanan_pokok description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function simpanan_pokok($id)
{
  return \Kodami\Models\Mysql\Deposit::where('user_id', $id)->where('type', 3);
}

/**
 * [cek_tagihan description]
 * @return [type] [description]
 */
function simpanan_sukarela($id)
{
  return \Kodami\Models\Mysql\Deposit::where('user_id', $id)->where('type', 4);
}

/**
 * [get_setting description]
 * @param  [type] $field [description]
 * @return [type]        [description]
 */
function get_setting($field)
{
  $item = \App\Setting::where('field', $field)->first();

  if($item)
  {
    return $item->value;
  }

  return;
}

/**
 * [get_provinsi description]
 * @return [type] [description]
 */
function get_provinsi()
{
   return \App\Provinsi::orderBy('nama', 'ASC')->get();
}

/**
 * [get_kabupaten_by_provinsi description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function get_kabupaten_by_provinsi($id)
{
  return \App\Kabupaten::where('id_prov', $id)->get();
}

/**
 * [get_kecamatan_by_kabupaten description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function get_kecamatan_by_kabupaten($id)
{
  return \App\Kecamatan::where('id_kab', $id)->get();
}

/**
 * [get_kelurahan_by_kecamatan description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function get_kelurahan_by_kecamatan($id)
{
  return \App\Kelurahan::where('id_kec', $id)->get();
}

?>

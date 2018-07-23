<?php 


if (!function_exists('get_api_response')) {
   function get_api_response($url = "", $method = "GET", $header = [], $body = [], $body_type = null)
   {
      $session = Session::all();
      if(isset($session['token']))
         $header['authorization'] = 'Bearer '.$session['token'];

      if($method == "GET")
         $body_type = "query";
      elseif ($body_type == null) 
         $body_type = "form_params";

      $data_send = [
         'headers'   => $header,
         $body_type  => $body
      ];

      $client = new \GuzzleHttp\Client();
      $url = env('URL_API').$url;        

      try {
         try {
            $res = json_decode($client->request($method, $url, $data_send)->getBody()->getContents());
         } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $res = json_decode($exception->getResponse()->getBody()->getContents());
         }  
      } catch (Exception $e) {

      }

      $result_respon  = [
         'code'    => isset($res->status->code) ? $res->status->code : 200,
         'error'   => isset($res->status->error) ? $res->status->error : false,
         'message' => isset($res->status->message) ? $res->status->message : null,
         'data'    => isset($res->data) ? $res->data : null,
         'meta'    => isset($res->meta) ? $res->meta : null,
      ];

      if(isset($result_respon['meta']->token))
         Session::put('token', $result_respon['meta']->token);

      return (object) $result_respon;
   }
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
                  3 => 'Teller', 
                  4 => 'Customer Service',
                  5 => 'Operator',
                  6 => 'Admin Operator'
               ];

   if(!empty($selected)) return '<span class="label label-info"><i class="fa fa-key"></i> '. $array_map[$selected] .'</span>';

   return $array_map;
}

if (!function_exists('status_pembayaran_anggota'))
{
   /**
    * [status_anggota description]
    * @param  [type] $user_id [description]
    * @return [type]          [description]
    */
   function status_pembayaran_anggota($user_id)
   {
      $deposit = Kodami\Models\Mysql\Deposit::where('user_id', $user_id)->first();  

      if($deposit)
      {
         switch ($deposit->status) {
            case 1:
               $status = 'Menunggu Pembayaran dari Anggota';
               
               return "<a class=\"label label-danger\">". $status ."</a>";
               break;
            case 2:

               $img = asset('file_confirmation/'. $user_id. '/'. $deposit->file_confirmation);
               $url_approve = route('admin.bayar.approve', ['id' => $deposit->id]);
               $url_denied = route('admin.bayar.denied', ['id' => $deposit->id]);
               
               return '
               <p>
                  Bukti Pembayaran <br />
                  <a href="'. $img .'" target="_blank"><img src="'. $img .'" style="width: 200px;" /></a><br />
                  <a href="'. $url_approve .'"  onclick="return confirm(\'Approve data ini?\')"  class="btn btn-success btn-rounded waves-effect waves-light m-t-20"><i class="fa fa-check"></i> Approve</a>
                     <a href="'. $url_denied .'" onclick="return confirm(\'Reject data ini?\')" class="btn btn-danger btn-rounded waves-effect waves-light m-t-20"><i class="fa fa-close"></i> Reject</a>
               </p>';
               break;
         }

      }else{
         return;
      }
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

   switch ($user->status) {

      case 1:
         return "<a class=\"btn btn-danger btn-xs\"><i class=\"fa fa-ban\"></i> Inactive</a>";
         break;
      case 2:
            return "<a class=\"btn btn-success btn-xs\"><i class=\"fa fa-check\"></i> Active</a>";
         break;
      case 3:
         return "<a class=\"btn btn-danger btn-xs\"><i class=\"fa fa-ban\"></i> Reject</a>";
         break;
      default:
         return "<a class=\"btn btn-warning btn-xs\"><i class=\"fa fa-ban\"></i> Inactive</a>";
         break;
   }
}


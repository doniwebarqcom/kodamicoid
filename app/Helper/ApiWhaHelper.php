<?php 

/**
 * API WHA CURL
 */
function ApiWhaCurl($number, $message)
{
  $message = $message ."\n\n _Kami melindungi penggunaan data dan infomasi penting para pengguna aplikasi Kodami. Harap tidak membalas pesan ini, karena pesan ini dikirimkan secara otomatis oleh sistem.Jika ada pertanyaan lebih lanjut, silahkan menghubungi Customer Service kami._";

  $message = 'text='. urlencode($message);

  $number = str_replace_first('0','62', $number);
  $number = str_replace('-', '', $number);
  
  $url = "https://panel.apiwha.com/send_message.php?apikey=". env('APIWHA_TOKEN') ."&number=". $number ."&".$message;
  
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
  }
}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Pembayaran Berhasil  - Kodami Pocket System</title>
</head>
<body style="margin:0px; background: #f8f8f8; ">
<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
  <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
      <tbody>
        <tr>
          <td style="vertical-align: top; padding-bottom:30px;">
            <a href="http://www.kodami.co.id" target="_blank" style="text-decoration: none;color: #484848;"><img src="{{ asset('kodami-co-id.png') }}" alt="Koperasi Produsen Daya Masyarakat Indonesia" style="border:none; width: 100px; "><br/>
            <h2 style="margin-top: 5px; padding-top: 5px;">Koperasi Daya Masyarakat</h2>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
    <div style="padding: 40px; background: #fff;">
      <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
        <tbody>
          <tr> 
            <td><b>Dear, {{ $data->user->name }}</b>
              <p>Terima kasih pembayaran simpanan anggota anda telah kami terima, bersama email ini kami informasikan status keanggotaan anda saat ini telah aktif, dengan detil informasi sebagai berikut :  </p>
              <table style="width: 100%;max-width: 100%;margin-bottom: 20px;">
                <tr>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">1. Nama</td>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">{{ $data->user->name }}</td>
                </tr>
                <tr>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">2. Nomor Anggota</td>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">{{ $no_anggota }}</td>
                </tr>
                <tr>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">3. Username</td>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">{{ $data->user->telepon }} / {{ $no_anggota }}</td>
                </tr>
                <tr>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">4. Password</td>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">{{ $data->user->aktivasi_code }} <small>(Silahkan melakukan penggantian password pada saat pertama kali login, demi menjaga keamanan data anda)</small></td>
                </tr>
              </table>
              @if(isset($kelebihan_bayar))
              <p>Anda memiliki kelebihan bayar sebesar <strong>Rp. {{ number_format($kelebihan_bayar) }}</strong> dan otomatis masuk ke Simpanan Sukarela anda.</p>
              @endif
              @if(isset($kekurang_bayar))
              <p>Anda memiliki kekurangan bayar sebesar <strong>Rp. {{ number_format($kekurang_bayar) }}</strong>.</p>
              @endif
              <p>Anda dapat menggunakan username dan password untuk login keanggotaan melalui https://kodami.co.id dan transaksi jual beli melalui https://kodami.id. </p>
              <b>Ttd,<br /> Pengurus</b> 
              @include('email.footer')
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
      <p> Powered by Kodami Pocket System</p>
    </div>
  </div>
</div>
</body>
</html>

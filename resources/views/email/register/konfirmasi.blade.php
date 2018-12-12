<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Konfirmasi Pembayaran  - Kodami Pocket System</title>
</head>
<body style="margin:0px; background: #f8f8f8; ">
<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
  <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
      <tbody>
        <tr>
          <td style="vertical-align: top; padding-bottom:30px;">
            <a href="http://www.kodami.co.id" target="_blank" style="text-decoration: none;color: #484848;"><img src="{{ asset('kodami-co-id.png') }}" alt="Admin Responsive web app kit" style="border:none; width: 270px; "><br/>
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
              <p>Terima kasih telah melaukan konfirmasi pembayaran pendaftaran anggota Koperasi Produsen Daya Masyarakat Indonesia. Status anggota anda akan kami aktifkan maksimal 1x24 jam. </p>
              <p>Detil Pembayaran</p>
              <table style="width: 100%;max-width: 100%;margin-bottom: 20px;">
                <tr>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">1. Nominal Pembayaran</td>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">{{ number_format($konfirmasi->nominal) }}</td>
                </tr>
                <tr>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">2. Rekening Tujuan</td>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">{{ $konfirmasi->rekening_bank->bank->nama }} - {{ $konfirmasi->rekening_bank->no_rekening }}</td>
                </tr>
                <tr>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">3. Tanggal Bayar</td>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">{{ date('d F Y', strtotime($data->due_date)) }}</td>
                </tr>
              </table>
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

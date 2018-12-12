<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Registrasi  - Kodami Pocket System</title>
</head>
<body style="margin:0px; background: #f8f8f8; ">
<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
  <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
      <tbody>
        <tr>
          <td style="vertical-align: top; padding-bottom:30px;">
            <a href="http://www.kodami.co.id" target="_blank" style="text-decoration: none;color: #484848;"><img src="{{ asset('kodami-co-id.png') }}" alt="Kodami Pocket System" style="border:none; width: 270px; "><br/>
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
            <td><b>Dear, {{ $user->name }}</b>
              <p>Terima kasih telah melaukan pendaftaran anggota Koperasi Produsen Daya Masyarakat Indonesia. Status anggota anda akan kami aktifkan setelah melakukan pembayaran : </p>
              <table style="width: 100%;max-width: 100%;margin-bottom: 20px;">
                <tr>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">1. Simpanan Pokok</td>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">Rp. {{ number_format(get_setting('simpanan_pokok')) }}</td>
                </tr>
                <tr>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">2. Simpanan Wajib</td>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">Rp. {{ number_format($user->durasi_pembayaran * get_setting('simpanan_wajib')) }}</td>
                </tr>
                <tr>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">&nbsp;&nbsp;&nbsp;&nbsp;Durasi Pembayaran</td>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">{{ $user->durasi_pembayaran }} Bulan</td>
                </tr>
                <tr>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">3. Simpanan Sukarela</td>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">Rp. {{ number_format($user->first_simpanan_sukarela) }}</td>
                </tr>
                <tr>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">4. Kartu Anggota</td>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">Rp. {{ number_format(get_setting('kartu_anggota')) }}</td>
                </tr>
                <tr>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">5. Kode Unik</td>
                  <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">{{ $deposit->code }}</td>
                </tr>
                <tr>
                  <th style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;text-align: left;">Total Pembayaran</th>
                  <th style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;text-align: left;">Rp. {{ number_format($deposit->nominal) }}</th>
                </tr>
              </table>
              <p>Pembayaran dapat dilakukan melalui transfer ke Rekening Kami di bawah ini : </p>
              <ol>
                @foreach(rekening_bank() as $item)
                <li>{{ $item->bank->nama }} {{ $item->no_rekening }} a/n {{ $item->owner }}</li>
                @endforeach
              </ol>
              <p>Silahkan melakukan konfirmasi pembayaran apabila telah melakukan transfer melalui link berikut.</p>
              <a href="{{ route('konfirmasi', $user->aktivasi_code) }}" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #1e88e5; border-radius: 60px; text-decoration:none;"> Konfirmasi Pembayaran</a><br />              
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

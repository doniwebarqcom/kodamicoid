<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/normalize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paper.css') }}?v={{ date('YmdHis') }}">
    <style>@page { size: A7 }</style>
</head>
<body class="A7">
    <section class="sheet padding-5mm">
        <article>
            <p class="img"><img src="{{ asset('logo-biru.png')}}" /></p>
            <hr />
            @if($jenis_transaksi == 0)
            <p class="text-center">KWITANSI PEMBAYARAN {{ strtoupper(type_deposit($data->type)) }}</p>
            <table class="table">
                <thead>
                    <tr>
                        <td>NO ANGGOTA</td>
                        <td> : {{ $data->no_anggota }}</td>
                    </tr>
                    <tr>
                        <td>NAMA</td>
                        <td> : {{ $data->name }}</td>
                    </tr>
                    <tr>
                        <td>NO KWITANSI</td>
                        <td> : {{ $data->no_invoice }}</td>
                    </tr>
                    <tr>
                        <td>TANGGAL</td>
                        <td> : {{ date('d F Y H:i:s') }}</td>
                    </tr>
                        <td>NOMINAL</td>
                        <td> : {{ number_format($data->nominal) }}</td>
                    </tr>
                    <tr>
                        <td>STATUS</td>
                        <td> : BERHASIL</td>
                    </tr>
                </thead>
            </table>
            @endif

            @if($jenis_transaksi == 1)
            <p class="text-center">
                KWITANSI PEMBAYARAN 
                @if(isset($data->pulsa->jenis_paket))
                    {{ $data->pulsa->jenis_paket }}
                @elseif($data->pulsa->jenis_product)
                    {{ $data->pulsa->jenis_product }}
                @endif
            </p>
            <table class="table">
                <thead>
                    @if($data->pulsa->simko_provider_id==6 || $data->pulsa->jenis_product == "PLN PASCABAYAR")
                      <td width="100px"><span class="gray-muted">No Meter/ID Pel</span></td>
                      @else 
                      <td width="100px"><span class="gray-muted">Phone</span></td>
                      @endif
                       <td>
                         <span class="" >{{ $data->no_telepon }}</span>
                       </td>
                   </tr>
                  @if($data->pulsa->jenis_product != "PLN PASCABAYAR")
                   <tr> 
                       <td width="100px"><span class="gray-muted">Harga</span></td>
                       <td>
                         <span class="" >Rp. {{ number_format($data->harga_beli) }}</span>
                       </td>
                   </tr>
                   @endif

                  @if($data->pulsa->jenis_product == "PLN PASCABAYAR")
                    <tr>
                      <td><span class="gray-muted">Nama</span> </td>
                      <td>{{ isset($data->plnPascabayar->nama) ? $data->plnPascabayar->nama : '' }}</td>
                    </tr>
                    <tr>
                      <td><span class="gray-muted">Tarif / Daya</span></td>
                      <td>{{ isset($data->plnPascabayar->tarif_daya) ? $data->plnPascabayar->tarif_daya : '' }}</td>
                    </tr>
                    <tr>
                      <td><span class="gray-muted">Periode</span></td>
                      <td>{{ isset($data->plnPascabayar->periode) ? parsing_pln_periode($data->plnPascabayar->periode) : '' }}</td>
                    </tr>
                    <tr>
                      <td><span class="gray-muted">Denda</span></td>
                      <td>{{ isset($data->plnPascabayar->denda) ? $data->plnPascabayar->denda : '' }}</td>
                    </tr>
                    <tr>
                      <td><span class="gray-muted">Tagihan PLN</span></td>
                      <td>{{ isset($data->plnPascabayar->tagihan) ? number_format($data->plnPascabayar->tagihan) : '' }}</td>
                    </tr>
                    <tr>
                      <td><span class="gray-muted">Biaya Admin</span></td>
                      <td>{{ isset($data->plnPascabayar->biaya_admin) ? number_format($data->plnPascabayar->biaya_admin) : '' }}</td>
                    </tr>
                    <tr>
                      <td><span class="gray-muted">Cashback</span></td>
                      <td>{{ isset($data->plnPascabayar->cashback) ? number_format($data->plnPascabayar->cashback) : '' }}</td>
                    </tr>
                    <tr>
                      <td><span class="gray-muted">Total Dibayarkan</span></td>
                      <td>{{ number_format($data->harga_beli) }}</td>
                    </tr>
                  @endif

                  @if($data->status == 2 and $data->pulsa->simko_provider_id==6 and $data->pulsa->jenis_product != "PLN PASCABAYAR")
                    <tr>
                      <td><span class="gray-muted">Nama</span> </td>
                      <td>{{ isset($data->plnToken->nama) ? $data->plnToken->nama : '' }}</td>
                    </tr>
                    <tr>
                      <td><span class="gray-muted">Tarif / Daya</span></td>
                      <td>{{ isset($data->plnToken->volt) ? $data->plnToken->volt : '' }}</td>
                    </tr>
                    <tr>
                      <td><span class="gray-muted">Jumlah KWH</span></td>
                      <td>{{ isset($data->plnToken->jumlah_kwh) ? $data->plnToken->jumlah_kwh : '' }}</td>
                    </tr>
                    <tr>
                      <td colspan="2" style="text-align: center;">
                        <span class="gray-muted">Stroom / Token</span>
                        <p id="copy_teks{{$data->id}}" style="float: left; border: 1px solid; padding: 5px;width: 100%;font-weight: bold;">{{ isset($data->plnToken->token) ? $data->plnToken->token : '' }}</p>
                      </td>
                    </tr>
                  @endif
                    <tr>
                       <td><span class="gray-muted">Tanggal Transaksi</span></td>
                       <td>
                          {{ date('d/m/Y H:i:s', strtotime($data->created_at)) }}
                       </td>
                    </tr>
                </thead>
            </table>
            @endif
            <p class="text-center" style="padding:0;margin:0">SIMPAN KWITANSI INI SEBAGAI BUKTI TRANSAKSI TERIMAKASIH</p>
            <hr />
            <p class="text-center" style="padding:0;margin:0">Koperasi Daya Masyarakat Indonesia</p>
            <p class="text-center" style="padding:0;margin:0">
               Jl Raya Maospati - Gorang Gareng Ds Belotan<br /> RT 34 / 12 - Kabupaten Magetan 63384 <br />
               Telpon : (0351) 4360 167 / 4360 661<br />
               Email : services@kodami.co.id<br />
               http://kodami.co.id
            </p>
        </article>
    </section>
</body>
</html> 
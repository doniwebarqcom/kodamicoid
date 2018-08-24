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
            <p class="text-center">KWITANSI PEMBAYARAN {{ strtoupper(type_deposit($data->type)) }}</p>
            <table class="table">
                <thead>
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
            <p class="text-center">
                SIMPAN KWITANSI INI SEBAGAI BUKTI TRANSAKSI TERIMAKASIH
            </p>
            <hr />
            <p>Koperasi Produsen Daya Masyarakat Indonesia</p>
        </article>
    </section>
</body>
</html> 
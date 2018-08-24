<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/kwitansi.css') }}">
</head>
<body>
    <div class="face face-front">
        <img src="{{ asset('logo-biru.png')}}" style="height: 50px;" />
        <p>{!! get_setting('alamat') !!}</p>
        <h3>KWITANSI PEMBAYARAN</h3>
        <hr />
        <h5>NO KWITANSI : {{ $data->no_invoice }}</h5>
        <h5>Tanggal : {{ date('d F Y') }}</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>KETERANGAN</th>
                    <th>NOMINAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{ type_deposit($data->type) }}</td>
                    <td>{{ number_format($data->nominal) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
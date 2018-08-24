<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
</head>
<body>
    <img src="{{ asset('logo-biru.png')}}" style="height: 50px;" />
    <p>{!! get_setting('alamat') !!}</p>
    <h3>KWITANSI</h3>
    <h5>{{ $data->no_invoice }}</h5>
    <p>{{ date('d F Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>KETERANGAN</th>
                <th>NOMINAL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $no+1 }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>


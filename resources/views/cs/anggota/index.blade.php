@extends('layout.cs')

@section('title', 'Admin - Koperasi Daya Masyarakat Indonesia')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Manage Anggota</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a href="{{ route('cs.anggota.create') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"> <i class="fa fa-plus"></i> TAMBAH ANGGOTA</a>
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="active">Anggota</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- .row --> 
        <div class="row">
            <div class="col-md-12">
               <div class="white-box">
                    <div class="table-responsive">
                        <table class="display nowrap" id="data_table_no_button" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="70" class="text-center">#</th>
                                    <th>NAME</th>
                                    <th>DOMISILI</th>
                                    <th>NO ANGGOTA</th>
                                    <th>JENIS KELAMIN</th>
                                    <th>TELEPON</th>
                                    <th>EMAIL</th>
                                    <th>TERDAFTAR</th>
                                    <th>LOGIN</th>
                                    <th>STATUS ANGGOTA</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $no => $item)
                                <tr>
                                    <td class="text-center">{{ $no+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ isset(getKabupatenById($item->domisili_kabupaten_id)->nama) ? getKabupatenById($item->domisili_kabupaten_id)->nama : '' }}</td>
                                    <td>{{ $item->no_anggota }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->telepon }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        @switch ($item->status_login)
                                            @case(0)
                                                <a href="{{ route('cs.anggota.active', $item->id) }}" onclick="return confirm('Aktifkan Login Anggota ini ?')" class="btn btn-danger btn-xs" style="font-size:11px"><i class="fa fa-ban"></i> Tidak Aktif</a>
                                            @break
                                            @case(1)
                                                <a href="{{ route('cs.anggota.inactive', $item->id) }}" onclick="return confirm('Non Aktifkan Login Anggota ini ?')" class="btn btn-success btn-xs" style="font-size:11px"><i class="fa fa-check"></i> Aktif</a>
                                            @break
                                            @case(2)
                                                <a class="btn btn-danger btn-xs" style="font-size:11px"><i class="fa fa-ban"></i> Ditolak</a>
                                            @break;
                                            @case(3)
                                                <a class="btn btn-danger btn-xs" style="font-size:11px"><i class="fa fa-ban"></i> Non Aktif</a>
                                            @break
                                            @default
                                                <a href="{{ route('cs.anggota.inactive', $item->id) }}" onclick="return confirm('Aktifkan Anggota ini ?')" class="btn btn-danger btn-xs" style="font-size:11px"><i class="fa fa-ban"></i> Tidak Aktif</a>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>{!! status_anggota($item->id) !!}</td>
                                    <td>
                                        <a href="{{ route('cs.anggota.edit', ['id' => $item->id]) }}"> <button class="btn btn-info btn-xs"><i class="ti-pencil-alt"></i> detail</button></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>                        
        </div>
    </div>
   @include('layout.footer-admin')
</div>
@endsection

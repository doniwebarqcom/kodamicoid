@extends('layout.admin')

@section('title', 'Admin - Koperasi Daya Masyarakat Indonesia')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Manage Anggota</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a href="{{ route('admin.anggota.create') }}" class="btn btn-info btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"> <i class="fa fa-plus"></i> TAMBAH</a>
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="active">Anggota</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
               <div class="white-box">
                    <div class="table-responsive">
                        <table id="data_table" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="25" class="text-center">#</th>
                                    <th>NAME</th>
                                    <th>NO ANGGOTA</th>
                                    <th>TELEPON</th>
                                    <th>EMAIL</th>
                                    <th>ADDED</th>
                                    <th>STATUS LOGIN</th>
                                    <th>STATUS ANGGOTA</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $no => $item)
                                    <tr>
                                        <td class="text-center">{{ $no+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->no_anggota }}</td>
                                        <td>{{ $item->telepon }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{!! status_login_anggota($item->status_login) !!}</td>
                                        <td>{!! status_anggota($item->id) !!}</td>
                                        <td>
                                            <div class="btn-group m-r-10">
                                                <button aria-expanded="false" data-toggle="dropdown" class="btn btn-xs btn-default dropdown-toggle waves-effect waves-light" type="button">Action 
                                                    <span class="caret"></span>
                                                </button>
                                                <ul role="menu" class="dropdown-menu">
                                                @php ($status_deposit_awal = status_deposit_awal($item->id))
                                                @if($status_deposit_awal == 2)
                                                    <li><a href="{{ route('admin.anggota.confirm', $item->id) }}">Konfirmasi</a></li>
                                                @endif
                                                    <li><a href="{{ route('admin.anggota.edit', ['id' => $item->id]) }}"> <i class="ti-pencil-alt"></i> detail</a></li>
                                                    <li><a href="{{ route('admin.anggota.destroy', ['id' => $item->id]) }}" onclick="return confirm('Hapus data anggota ?')"> <i class="fa fa-trash"></i> delete</a></li>
                                                    <li><a onclick="confirm_autologin('{{ route('admin.autologin', $item->id) }}', '{{ $item->name }}')"><i class="fa fa-key"></i> Autologin</a></li>
                                                </ul>
                                            </div>
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
@section('footer-script')
<script type="text/javascript">
    var confirm_autologin = function(url, name){
        bootbox.confirm("Login sebagai "+ name +" ?", function(res){
            if(res)
            {
                window.location = url;
            }
        })
    }
</script>
@endsection
@endsection

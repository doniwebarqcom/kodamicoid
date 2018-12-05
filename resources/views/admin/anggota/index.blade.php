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
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active" role="presentation" class=""><a href="#anggota" aria-controls="anggota" role="tab" data-toggle="tab" aria-expanded="false"><i class="ti-user"></i>&nbsp;&nbsp; Anggota</a></li>
                        <li role="presentation"><a href="#pendiri" aria-controls="pendiri" role="tab" data-toggle="tab" aria-expanded="false"><i class="ti-user"></i>&nbsp;&nbsp; Pendiri dan Pengurus</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content mt-1">
                        <div role="tabpanel" class="tab-pane in active" id="anggota">
                            <form method="GET" action="">
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="name" value="{{ (isset($_GET['name']) and !empty($_GET['name'])) ? $_GET['name'] : '' }}" placeholder="Nama" />
                                    </div>
                                    <div class="col-md-1 pl-0">
                                        <button type="submit" class="btn btn-info"><i class="fa fa-search-plus"></i></button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                            <div class="table-responsive mt-0">
                                <table class="display nowrap data_table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="25" class="text-center">#</th>
                                            <th>NAME</th>
                                            <th>NO REG</th>
                                            <th>NO ANGGOTA</th>
                                            <th>TELEPON</th>
                                            <th>EMAIL</th>
                                            <th>TERDAFTAR</th>
                                            <th>LOGIN</th>
                                            <th title="Status Anggota">STATUS</th>
                                            <th title="Kuota Anggota">KUOTA</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $no => $item)
                                            <tr>
                                                <td class="text-center">{{ $no+1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ empty($item->no_pendaftaran) ? $item->no_anggota : $item->no_pendaftaran }}</td>
                                                <td>{{ $item->no_anggota }}</td>
                                                <td>{{ explode_telepon($item->telepon) }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                                <td>
                                                    @switch ($item->status_login)
                                                        @case(0)
                                                            <a href="{{ route('admin.anggota.active', $item->id) }}" onclick="return confirm('Aktifkan Login Anggota ini ?')" class="btn btn-danger btn-xs" style="font-size:11px"><i class="fa fa-ban"></i> Tidak Aktif</a>
                                                        @break
                                                        @case(1)
                                                            <a href="{{ route('admin.anggota.inactive', $item->id) }}" onclick="return confirm('Non Aktifkan Login Anggota ini ?')" class="btn btn-success btn-xs" style="font-size:11px"><i class="fa fa-check"></i> Aktif</a>
                                                        @break
                                                        @case(2)
                                                            <a class="btn btn-danger btn-xs" style="font-size:11px"><i class="fa fa-ban"></i> Ditolak</a>
                                                        @break;
                                                        @case(3)
                                                            <a class="btn btn-danger btn-xs" style="font-size:11px"><i class="fa fa-ban"></i> Non Aktif</a>
                                                        @break
                                                        @default
                                                            <a href="{{ route('admin.anggota.inactive', $item->id) }}" onclick="return confirm('Aktifkan Anggota ini ?')" class="btn btn-danger btn-xs" style="font-size:11px"><i class="fa fa-ban"></i> Tidak Aktif</a>
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>{!! status_anggota($item->id) !!}</td>
                                                <td>
                                                    @if($item->access_id==2)
                                                        @php($simpanan_pokok = simpanan_pokok($item->id)->where('status', 3)->sum('nominal'))
                                                        @if($simpanan_pokok)
                                                            <label>Rp. {{ number_format($simpanan_pokok) }}</label><!--set sisa kuota dikurangi dengan jumlah transaksi -->
                                                        @endif
                                                    @endif
                                                    @if($item->access_id == 7)
                                                        <label class="btn btn-info btn-xs btn-circle" title="Aktif Dropshiper" style="width: 23px;height: 23px;padding: 4px 0;font-size:10px;">DS</label>
                                                    @endif
                                                </td>
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
                                <div class="col-m-6 pull-left text-left">Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries</div>
                                <div class="col-md-6 pull-right text-right">{{ $data->appends($_GET)->render() }}</div><div class="clearfix"></div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane in" id="pendiri">
                            <div class="table-responsive mt-5">
                                <table id="data_table" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="25" class="text-center">#</th>
                                            <th>NAME</th>
                                            <th>NO REG</th>
                                            <th>NO ANGGOTA</th>
                                            <th>TELEPON</th>
                                            <th>EMAIL</th>
                                            <th>TERDAFTAR</th>
                                            <th>LOGIN</th>
                                            <th title="Status Anggota">STATUS</th>
                                            <th title="Kuota Anggota">KUOTA</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>                  
        </div>
    </div>
   @include('layout.footer-admin')
</div>
<style type="text/css">
    tr th {
        font-weight: normal !important;
    }
</style>
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

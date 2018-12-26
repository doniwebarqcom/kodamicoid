@extends('layout.admin')

@section('title', 'Admin - Koperasi Daya Masyarakat Indonesia')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Manage Kemitraan</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="active">Kemitraan</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
               <div class="white-box">
                     <ul class="nav nav-tabs" role="tablist">
                        <li class="active" role="presentation" class=""><a href="#dropshiper" aria-controls="dropshiper" role="tab" data-toggle="tab" aria-expanded="false"><i class="ti-user"></i>&nbsp;&nbsp; Dropshiper</a></li>
                        <li role="presentation" class=""><a href="#fasilitator" onclick="alert('Segera hadir.');" aria-controls="fasilitator" role="tab" data-toggle="tab" aria-expanded="false"><i class="ti-user"></i>&nbsp;&nbsp; Fasilitator</a></li>
                        <li role="presentation" class=""><a href="#kuper" onclick="alert('Segera hadir.');" aria-controls="kuper" role="tab" data-toggle="tab" aria-expanded="false"><i class="ti-user"></i>&nbsp;&nbsp; Kurir Koperasi (Kuper)</a></li>
                        <li role="presentation" class=""><a href="#pusar" onclick="alert('Segera hadir.');" aria-controls="pusar" role="tab" data-toggle="tab" aria-expanded="false"><i class="ti-user"></i>&nbsp;&nbsp; Petugas Pasar (Pusar)</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content mt-1">
                        <div role="tabpanel" class="tab-pane in active" id="dropshiper">
                            <div class="col-md-12 ml-0 pl-0 pull-left">
                                <form>
                                    <div class="form-group">
                                        <div class="col-md-2 pl-0">
                                            <input type="text" class="form-control" placeholder="Search...">
                                        </div>
                                        <div class="col-md-1">
                                            <select class="form-control">
                                                <option value="">STATUS</option>
                                                <option value="1">AKTIF</option>
                                                <option value="0">TIDAK AKTIF</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-info"><i class="fa fa-search"></i></button>
                                            <button class="btn btn-default"><i class="fa fa-download"></i></button>
                                            <a href="{{ route('admin.kemitraan.create') }}" class="btn btn-success m-l-20 hidden-xs hidden-sm waves-effect waves-light mx-0"> <i class="fa fa-check"></i> AKTIVASI DS</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                            <div class="mt-4">
                                <table class="">
                                    <tr>
                                        <td style="width: 123px;">TOTAL DS</td>
                                        <td> : </td>
                                    </tr>
                                    <tr>
                                        <td>KUOTA TERPAKAI </td>
                                        <td> : </td>
                                    </tr>
                                    <tr>
                                        <td>KUOTA</td>
                                        <td> : </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="clearfix"></div>
                            <div class="table-responsive">
                                <table class="display nowrap data_table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="25" class="text-center">#</th>
                                            <th>NAMA</th>
                                            <th>NO ANGGOTA</th>
                                            <th>TELEPON</th>
                                            <th>EMAIL</th>
                                            <th>AKTIF</th>
                                            <th>KUOTA</th>
                                            <th>KUOTA TERPAKAI</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dropshiper as $no => $item)
                                            <tr>
                                                <td class="text-center">{{ $no+1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->no_anggota }}</td>
                                                <td>{{ explode_telepon($item->telepon) }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                                                <td>
                                                    Rp. {{ number_format(saldo_dropshiper($item->id)) }}
                                                    @if(saldo_terpakai_dropshiper($item->id) == 0)
                                                    <label class="btn btn-info btn-xs pull-right" onclick="add_kuota('{{ route('admin.kemitraan.add-kuota', $item->id) }}')"><i class="fa fa-plus"></i></label>
                                                    @endif
                                                </td>
                                                <td class="text-right">{{ number_format(saldo_terpakai_dropshiper($item->id)) }}</td>
                                                <td>
                                                    @if($item->status == 0 || $item->status === NULL)
                                                        <a href="{{ route('admin.kemitraan.dropshiper-active', $item->id) }}" onclick="return confirm('Aktifkan Dropshiper ?')">
                                                            <label class="btn btn-danger btn-xs" style="font-size: 10px;height: 17px;">Tidak Aktif</label>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('admin.kemitraan.dropshiper-inactive', $item->id) }}" onclick="return confirm('Non Aktifkan Dropshiper ?')">
                                                            <label class="btn btn-success btn-xs" style="font-size: 10px;height: 17px;">Aktif</label>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="col-m-6 pull-left text-left">Showing {{ $dropshiper->firstItem() }} to {{ $dropshiper->lastItem() }} of {{ $dropshiper->total() }} entries</div>
                                <div class="col-md-6 pull-right text-right">{{ $dropshiper->appends($_GET)->render() }}</div><div class="clearfix"></div>
                            </div>
                        </div>
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

    function add_kuota(url)
    {
        bootbox.prompt({
                title: "Set Kuota",
                inputType: 'number',
                callback: function (result) {
                    if(result !== null)
                    {
                        window.location = url +"?kuota="+ result;
                    }
                }
            });
    }
</script>
@endsection
@endsection

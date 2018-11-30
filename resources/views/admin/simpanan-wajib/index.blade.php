@extends('layout.admin')

@section('title', 'Simpanan Wajib - Koperasi Daya Masyarakat Indonesia')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">SIMPANAN WAJIB</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="active">Simpanan Wajib</li>
                </ol>
            </div>
        </div>
        <!-- .row -->
        <div class="row">
           <div class="white-box">
                <div class="table-responsive">
                    <table id="data_table_no_attribute" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="70" class="text-center">#</th>
                                <th>NAMA</th>
                                <th>NO ANGGOTA</th>
                                <th>NO TELEPON</th>
                                <th>NOMINAL</th>
                                <th>TANGGAL JATUH TEMPO</th>
                                <th>ADDED</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $no => $item)
                              @if(isset($item->user->name))
                                <tr>
                                    <td class="text-center">{{ $no+1 }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->user->no_anggota }}</td>
                                    <td>{{ $item->user->telepon }}</td>
                                    <td>{{ number_format($item->nominal) }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                              @endif
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-m-6 pull-left text-left">Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries</div>
                    <div class="col-md-6 pull-right text-right">{{ $data->appends($_GET)->render() }}</div><div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
   @include('layout.footer-admin')
</div>
@endsection

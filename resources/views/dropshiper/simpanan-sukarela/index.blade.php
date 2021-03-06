@extends('layout.dropshiper')

@section('title', 'Anggota Simpanan Sukarela - Koperasi Daya Masyarakat Indonesia')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Dashboard</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a href="{{ route('dropshiper.simpanan-sukarela.create') }}" class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"> <i class="fa fa-plus"></i> TAMBAH SIMPANAN SUKARELA</a>
                <ol class="breadcrumb">
                    <li><a href="{{ route('dropshiper.dashboard') }}">Dashboard</a></li>
                    <li class="active">Simpanan Sukarela</li>
                </ol>
            </div>
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading"> SIMPANAN SUKARELA</div>
                    <div class="table-responsive">
                        <div class="col-md-12">
                            <table id="data_table" class="table table-hover manage-u-table">
                                <thead>
                                    <tr>
                                        <th width="70" class="text-center">#</th>
                                        <th>NOMINAL</th>
                                        <th>STATUS</th>
                                        <th>ADDED</th>
                                        <th width="300">MANAGE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $no => $item)
                                    <tr>
                                        <td>{{ $no+1 }}</td>
                                        <td>{{ number_format($item->nominal) }}</td>
                                        <td>{!! status_deposit($item->status) !!}</td>
                                        <td>{{ date("d F Y H:i:s", strtotime($item->created_at)) }}</td>
                                         <td>
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
    </div>
    <!-- /.container-fluid -->
   @include('layout.footer-admin')
</div>
@endsection
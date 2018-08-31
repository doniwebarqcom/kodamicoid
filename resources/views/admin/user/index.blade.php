@extends('layout.admin')

@section('title', 'Admin - Koperasi Daya Masyarakat Indonesia')

@section('sidebar')

@endsection

@section('content')
<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper"> 
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Dashboard</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a href="{{ route('admin.user.create') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"> <i class="fa fa-plus"></i> TAMBAH USER</a>
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="active">Users</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Manage USERS</h3>
                    <hr />
                    <div class="table-responsive">
                        <table id="data_table" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="70" class="text-center">#</th>
                                    <th>NIK</th>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>JENIS KELAMIN</th>
                                    <th>TELEPON</th>
                                    <th>LAST LOGIN</th>
                                    <th>LAST LOGOUT</th>
                                    <th>STATUS</th>
                                    <th>AKSES LOGIN</th>
                                    <th width="300">MANAGE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $no => $item)
                                    <tr>
                                        <td class="text-center">{{ $no+1 }}</td>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->telepon }}</td>
                                        <td>{{ date('d F Y', strtotime($item->last_logged_in_at)) }}</td>
                                        <td>{{ date('d F Y', strtotime($item->last_logged_out_at)) }}</td>
                                        <td>
                                            @if($item->status == 1)
                                                <label class="btn btn-success btn-xs"><i class="fa fa-check"></i> Active</label>
                                            @else
                                                <label class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Inactive</label>
                                            @endif
                                        </td>
                                        <td>{!! access_rules($item->access_id) !!}</td>
                                        <td>
                                            <a href="{{ route('admin.user.edit', ['id' => $item->id]) }}"> <button class="btn btn-default btn-xs"><i class="ti-pencil-alt"></i> edit</button></a>

                                            <form action="{{ route('admin.user.destroy', $item->id) }}" style="float: left; margin-right: 5px;" onsubmit="return confirm('Hapus data ini ?')" method="post" style="float: left;">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}                                               
                                                <button type="button" class="btn btn-danger btn-xs"><i class="ti-trash"></i> delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>                        
        </div>
        <!-- /.row -->
        <!-- ============================================================== -->
    </div>
    <!-- /.container-fluid -->
   @include('layout.footer-admin')
</div>
<!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->

@endsection

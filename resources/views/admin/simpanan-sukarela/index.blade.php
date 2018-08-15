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
                <a href="{{ route('admin.anggota.create') }}" class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"> <i class="fa fa-plus"></i> TAMBAH</a>
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
                    <h3 class="box-title m-b-0">Manage Anggota</h3>
                    <br />
                    <div class="table-responsive">
                        <table id="data_table" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="70" class="text-center">#</th>
                                    <th>NAME</th>
                                    <th>NO ANGGOTA</th>
                                    <th>NOMINAL</th>
                                    <th>STATUS</th>
                                    <th>ADDED</th>
                                    <th width="300">MANAGE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $no => $item)
                                  @if(isset($item->user->name))
                                    <tr>
                                        <td class="text-center">{{ $no+1 }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.anggota.edit', ['id' => $item->id]) }}"> <button class="btn btn-info btn-xs"><i class="ti-pencil-alt"></i> detail</button></a>
                                            <form action="{{ route('admin.anggota.destroy', $item->id) }}" style="float: left; margin-right: 5px;" onsubmit="return confirm('Hapus data ini?')" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}                                               
                                                <button type="submit" class="btn btn-danger btn-xs"><i class="ti-trash"></i> delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                  @endif
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

@extends('layout.admin')

@section('title', 'Admin - Koperasi Daya Masyarakat Indonesia')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Dashboard</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="active">Home</li>
                </ol>
            </div>
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">FORM USER</h3>
                <hr />
                <form class="form-horizontal" action="{{ route('admin.user.update', $data->id) }}" method="POST">
                    <div class="col-md-6">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="form-group">
                            <label class="col-md-6">No Anggota</label>
                            <label class="col-md-6">NIK</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="no_anggota" value="{{ $data->no_anggota }}"> </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nik" value="{{ $data->nik }}"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6">Nama</label>
                            <label class="col-md-6">Jenis Kelamin</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name"  value="{{ $data->name }}"> </div>
                            <div class="col-md-6">
                                <select class="form-control" name="jenis_kelamin" required>
                                    <option value=""> - Jenis Kelamin - </option>
                                    @foreach(['Laki-laki', 'Perempuan'] as $item)
                                        <option {{ $item == $data->jenis_kelamin ? ' selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6">Email</label>
                            <label class="col-md-6">Phone</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ $data->email }}"> </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="telepon" value="{{ $data->telepon }}"> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Confirm Password</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="confirmation"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6">Akses Login</label>
                            <label class="col-md-6">Status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="access_id">
                                    @foreach(access_rules() as $key => $item)
                                        
                                        @if($key == 2) 
                                            @continue
                                        @endif

                                        <option value="{{ $key }}" {{ $key == $data->access_id ? "selected" : "" }}> {{ $item }} </option>
                                    @endforeach 
                                </select>    
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" name="status">
                                    <option value=""> - Status - </option>
                                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr />
                    <a href="{{ route('admin.user.index') }}" class="btn btn-default btn-sm waves-effect waves-light m-r-10"><i class="fa fa-arrow-left"></i> Back</a>
                    <button type="submit" class="btn btn-success btn-sm waves-effect waves-light m-r-10"><i class="fa fa-save"></i> Save User</button>
                    <br style="clear: both;" />
                </form>
              </div>
            </div>                        
        </div>
    </div>
    @include('layout.footer-admin')
</div>
@endsection

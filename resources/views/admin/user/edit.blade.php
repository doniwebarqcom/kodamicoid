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

                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="active">Home</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- .row -->
        <div class="row">
            
            <div class="col-md-12">
            <div class="white-box">
                
                <h3 class="box-title m-b-0">USER</h3>
                <br />
                <form class="form-horizontal" action="{{ route('user.update', $data->id) }}" method="POST">
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
                            <label class="col-md-12">NIK</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="nik" value="{{ $data->nik }}"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Nama</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="name"  value="{{ $data->name }}"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Jenis Kelamin</label>
                            <div class="col-md-12">
                                <select class="form-control" name="jenis_kelamin" required>
                                    <option value=""> - Jenis Kelamin - </option>
                                    @foreach(['Laki-laki', 'Perempuan'] as $item)
                                        <option {{ $item == $data->jenis_kelamin ? ' selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" class="form-control" name="email" value="{{ $data->email }}"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Phone</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="telepon" value="{{ $data->telepon }}"> </div>
                        </div>
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
                            <label class="col-md-12">Akses</label>
                            <div class="col-md-12">
                                <select class="form-control" name="access_id">
                                    @foreach(access_rules() as $key => $item)
                                        
                                        @if($key == 2) 
                                            @continue
                                        @endif

                                        <option value="{{ $key }}" {{ $key == $data->access_id ? "selected" : "" }}> {{ $item }} </option>
                                    @endforeach 
                                </select>    
                            </div>
                        </div>
                        <a href="{{ url('angggota.iindex') }}" class="btn btn-inverse waves-effect waves-light m-r-10">Cancel</a>
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    </div>
                    <br style="clear: both;" />
                </form>
              </div>
            </div>                        
        </div>
        <!-- /.row -->
        <!-- ============================================================== -->
    </div>
    <!-- /.container-fluid -->
    @extends('layout.footer-admin')
</div>
<!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->
@endsection

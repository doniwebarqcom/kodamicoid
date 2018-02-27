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
                    <li class="active">Anggota</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Anggota</h3>
                <br />
                <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('anggota.update', $data->id) }}" method="POST">
                    <div class="col-md-6">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label class="col-md-12">NIK</label>
                            <div class="col-md-12">
                                <input type="text" name="nik" value="{{ $data->nik }}" class="form-control form-control-line"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Nama</label>
                            <div class="col-md-12">
                                <input type="text" name="nama" value="{{ $data->name }}" class="form-control form-control-line"> </div>
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
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email"  class="form-control form-control-line" value="{{ $data->email }}" name="email" id="example-email"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Telepon</label>
                            <div class="col-md-12">
                                <input type="text" name="telepon" value="{{ $data->telepon }}" class="form-control form-control-line"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Agama</label>
                            <div class="col-md-12">
                                <?php $agama = ['Islam', 'Kristen', 'Budha', 'Hindu']; ?>
                                <select class="form-control" name="agama">
                                    <option value=""> - Agama - </option>
                                    @foreach($agama as $item)
                                        <option value="{{ $item }}" {{ $item == $data->agama ? 'selected' : '' }}> {{ $item }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tempat Lahir</label>
                            <div class="col-md-12">
                                <input type="text" name="tempat_lahir" value="{{ $data->tempat_lahir }}" class="form-control form-control-line"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tanggal Lahir</label>
                            <div class="col-md-12">
                                <input type="text" name="tanggal_lahir" value="{{ $data->tanggal_lahir }}" class="form-control form-control-line"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">KTP</label>
                            <div class="col-md-6">
                                <input type="file" name="file_ktp" class="form-control">
                            </div>
                            @if(!empty($data->foto_ktp))
                                <div class="col-md-6">
                                    <img src="{{ asset('file_ktp/'. $data->id .'/'.  $data->foto_ktp)}}" style="width: 200px;">
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Foto</label>
                            <div class="col-md-6">
                                <input type="file" name="file_photo" class="form-control">
                            </div>
                            @if(!empty($data->foto))
                                <div class="col-md-6">
                                    <img src="{{ asset('file_photo/'. $data->id .'/'.  $data->foto)}}" style="width: 200px;">
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('anggota.index') }}" class="btn btn-inverse waves-effect waves-light m-r-10">Cancel</a>
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

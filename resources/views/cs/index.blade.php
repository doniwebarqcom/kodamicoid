@extends('layout.cs')

@section('title', 'Customer Service - Koperasi Daya Masyarakat Indonesia')

@section('sidebar')

@endsection

@section('content')
<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper">
    <div class="container-fluid">
        <br />
        <div class="clearfix"></div>
        <!-- .row --> 
        <div class="row">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box">
                        <h3 class="box-title">DATA ANGGOTA</h3>
                        <ul class="list-inline two-part">
                            <li><i class="icon-people text-info"></i></li>
                            <li class="text-right"><span class="counter">23</span></li>
                        </ul>
                        <a href="{{ route('cs.anggota.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Anggota</a>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box">
                        <h3 class="box-title">SIMPANAN POKOK</h3>
                        <ul class="list-inline two-part">
                            <li><i class="icon-folder text-purple"></i></li>
                            <li class="text-right"><span class="counter">169</span></li>
                        </ul>
                        <button class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Simpanan Pokok</button>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box">
                        <h3 class="box-title">SIMPANAN SUKARELA</h3>
                        <ul class="list-inline two-part">
                            <li><i class="icon-folder-alt text-danger"></i></li>
                            <li class="text-right"><span class="">311</span></li>
                        </ul>
                        <button class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Simpanan Sukarela</button>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box">
                        <h3 class="box-title">SIMPANAN WAJIB</h3>
                        <ul class="list-inline two-part">
                            <li><i class="ti-wallet text-success"></i></li>
                            <li class="text-right"><span class="">117</span></li>
                        </ul>
                        <button class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Simpanan Wajib</button>
                        <div class="clearfix"></div>
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

@extends('layout.admin')

@section('title', 'Anggota - Koperasi Daya Masyarakat Indonesia')

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
                    <button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
                    <a href="{{ url('profile')}}" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Profile</a>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- .row -->
            <div class="row">
                <div class="col-md-6 col-sm-12 col-lg-4">
                    <div class="panel">
                        <div class="p-30">
                            <div class="row">
                                <div class="col-xs-4 col-sm-4">

                                    @if(Auth::user()->foto != "")
                                        <img src="{{ Auth::user()->foto }}" alt="{{ Auth::user()->name }}" class="img-circle img-responsive">
                                    @else 
                                        <img src="{{ asset('images/user.png') }}" alt="{{ Auth::user()->name }}" class="img-circle img-responsive">
                                    @endif

                                </div>
                                <div class="col-xs-12 col-sm-8">
                                    <h2 class="m-b-0">{{ Auth::user()->name }}</h2>
                                    <h4>Anggota</h4><a href="{{ url('anggota/user/konfirmasi-pembayaran-anggota') }}" class="btn btn-rounded btn-success"><i class="fa fa-check"></i> Konfirmasi Pembayaran Keanggotaan</a></div>
                            </div>
                            <div class="row text-center m-t-30">
                                <div class="col-xs-4 b-r">
                                    <h2>SHU</h2>
                                    <h4>Rp. 0</h4>
                                </div>
                                <div class="col-xs-4 b-r">
                                    <h2>Deposit</h2>
                                    <h4>Rp. 0</h4>
                                </div>
                            </div>
                        </div>
                        <hr class="m-t-10" />
                        
                        <ul class="dp-table profile-social-icons">
                            <li><a href="javascript:void(0)"><i class="fa fa-globe"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-8 col-sm-12">
                    <div class="panel">
                        <div class="panel-heading">IURAN BULANAN</div>
                        <div class="table-responsive">
                            <table class="table table-hover manage-u-table">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;" class="text-center">#</th>
                                        <th>NOMINAL</th>
                                        <th>TANGGAL</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td><span class="font-medium">Rp. 10.000</span></td>
                                        <td>1 Januari 2018</td>
                                        <td>
                                            <span class="btn btn-rounded btn-success"><i class="fa fa-check"></i> Lunas</span>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td><span class="font-medium">Rp. 10.000</span></td>
                                        <td>1 Januari 2018</td>
                                        <td>
                                            <span class="btn btn-rounded btn-danger">Belum Lunas</span>
                                        </td>
                                        <td>
                                            <a class="btn btn-rounded btn-success"><i class="fa fa-check"></i> Konfirmasi Pembayaran</a>
                                        </td>
                                    </tr>
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
        <footer class="footer text-center"> &copy; Kodami Pocket System </footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
</div>

@endsection

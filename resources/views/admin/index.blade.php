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
                                        <h4>Administrator</h4></div>
                                </div>
                                <div class="row text-center m-t-30">
                                    <div class="col-xs-4 b-r">
                                        <h2>Anggota</h2>
                                        <h4>0</h4>
                                    </div>
                                    <div class="col-xs-4 b-r">
                                        <h2>Konfirmasi</h2>
                                        <h4>0</h4>
                                    </div>
                                    <div class="col-xs-4">
                                        <h2>Belum Lunas</h2>
                                        <h4>0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-8 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading">Anggota</div>
                            <div class="table-responsive">
                                <table class="table table-hover manage-u-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;" class="text-center">#</th>
                                            <th>NAMA</th>
                                            <th>NIK</th>
                                            <th>EMAIL</th>
                                            <th>TELEPON</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td colspan="4"><i>Empty</i></td>
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
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>


@endsection

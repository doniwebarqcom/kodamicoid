@extends('layout.anggota')

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
                @include('layout.alert');
                <div class="col-md-6 col-sm-12 col-lg-4">
                    <div class="panel">
                        <div class="p-30">
                            <div class="row">
                                <div class="col-xs-4 col-sm-4">
                                    @if(Auth::user()->foto != "")
                                        <img src="{{ asset('file_photo/'.  Auth::user()->id .'/'. Auth::user()->foto) }}" alt="{{ Auth::user()->name }}" class="img-circle img-responsive">
                                    @else 
                                        <img src="{{ asset('images/user.png') }}" alt="{{ Auth::user()->name }}" class="img-circle img-responsive">
                                    @endif
                                </div>
                                <div class="col-xs-12 col-sm-8">
                                    <h2 class="m-b-0">{{ Auth::user()->name }}</h2>
                                    <h4>SHU</h4><a href="{{ url('anggota/user/detail') }}" class="btn btn-rounded btn-success">Rp. 0</a></div>
                            </div>
                            <div class="row text-center m-t-30">
                                <div class="col-xs-4 b-r">
                                    <h3>Simpanan Pokok</h3>
                                    <a href="{{ url('anggota/user/iuran') }}" class="btn btn-rounded btn-warning">Belum Lunas</a>
                                </div>
                                <div class="col-xs-4 b-r">
                                    <h3>Simpanan Sukarela</h3>
                                    <h4>Rp. 0</h4>
                                    <a href="{{ route('anggota.index.save.profile') }}" title="Tambah Simpanan Sukarela"><i class="fa fa-plus"></i> </a>
                                </div>
                                <div class="col-xs-4 b-r">
                                    <h3>Simpanan Wajib</h3>
                                    <a href="{{ url('anggota/user/iuran') }}" class="btn btn-rounded btn-warning">Belum Lunas</a>
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

                    <div class="panel panel-themecolor">
                        <div class="panel-heading">AKTIVASI KEANGGOTAAN</div>
                        <div class="panel-body">                            
                            <div class="steamline">
                                <div class="sl-item">
                                    <div class="sl-left bg-success"> <i class="fa fa-check"></i></div>
                                    <div class="sl-right">
                                        <div><h2>Pendaftaran</h2> <span class="sl-date">&nbsp;</span></div>
                                        <div class="desc">
                                            <form method="POST" action="{{ route('anggota.index.save.profile') }}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="col-md-6">
                                                <div>
                                                    <h5> <span class="btn btn-xs btn-rounded btn-success"><i class="fa fa-check"></i></span> NIK : {{ Auth::user()->name }}</h5>
                                                </div>
                                                <div>
                                                    <h5> <span class="btn btn-xs btn-rounded btn-success"><i class="fa fa-check"></i></span> Nama : {{ Auth::user()->nik }}</h5>
                                                </div>
                                                <div>
                                                    <h5> <span class="btn btn-xs btn-rounded btn-success"><i class="fa fa-check"></i></span> Email : {{ Auth::user()->email }}</h5>
                                                </div>
                                                <div>
                                                    <h5> <span class="btn btn-xs btn-rounded btn-success"><i class="fa fa-check"></i></span> Telepon : {{ Auth::user()->telepon }}</h5>
                                                </div>
                                               <div>
                                                    @if(!empty(Auth::user()->agama))
                                                        <h5><span class="btn btn-xs btn-rounded btn-success"><i class="fa fa-check"></i></span> Agama : </h5>
                                                    @else
                                                        <h5><span class="btn btn-xs btn-rounded btn-danger"><i class="fa fa-close"></i></span> Agama : </h5>
                                                    @endif

                                                    <?php $agama = ['Islam', 'Kristen', 'Budha', 'Hindu']; ?>
                                                    <select class="form-control" name="agama">
                                                        <option value=""> - Agama - </option>
                                                        @foreach($agama as $item)
                                                            <option value="{{ $item }}" {{ $item == Auth::user()->agama ? 'selected' : '' }}> {{ $item }} </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <hr />
                                                <div>
                                                    @if(!empty(Auth::user()->tempat_lahir))
                                                        <h5> <span class="btn btn-xs btn-rounded btn-success"><i class="fa fa-check"></i></span> Tempat Lahir : </h5>
                                                    @else 
                                                        <h5> <span class="btn btn-xs btn-rounded btn-danger"><i class="fa fa-close"></i></span> Tempat Lahir : </h5>
                                                    @endif

                                                    <input type="text" name="tempat_lahir" class="form-control" value="{{ Auth::user()->tempat_lahir }}" />
                                                </div>
                                                <hr />
                                                <div>
                                                    @if(!empty(Auth::user()->tanggal_lahir))
                                                        <h5> <span class="btn btn-xs btn-rounded btn-success"><i class="fa fa-check"></i></span> Tanggal Lahir : </h5>
                                                    @else 
                                                         <h5> <span class="btn btn-xs btn-rounded btn-danger"><i class="fa fa-close"></i></span> Tanggal Lahir : </h5>
                                                    @endif

                                                    <input type="text" name="tanggal_lahir" class="form-control" value="{{ Auth::user()->tanggal_lahir }}" />
                                                </div>
                                                <hr />
                                                @if(!empty(Auth::user()->foto_ktp))
                                                    <div>
                                                        <h5><span class="btn btn-xs btn-rounded btn-success"><i class="fa fa-check"></i></span> Upload KTP <input type="file" name="file_ktp" class="form-control"></h5>
                                                        <img src="{{ asset('file_ktp/'. Auth::user()->id .'/'.  Auth::user()->foto_ktp)}}" style="width: 200px;">
                                                    </div>
                                                @else 
                                                    <div>
                                                        <h5><span class="btn btn-xs btn-rounded btn-danger"><i class="fa fa-close"></i></span> Upload KTP <input type="file" name="file_ktp" class="form-control"></h5>
                                                    </div>
                                                @endif
                                                <hr />

                                                @if(!empty(Auth::user()->foto))
                                                    <div>
                                                        <h5><span class="btn btn-xs btn-rounded btn-success"><i class="fa fa-check"></i></span> Upload Foto <input type="file" name="file_photo" class="form-control"></h5>
                                                        <img src="{{ asset('file_photo/'. Auth::user()->id .'/'. Auth::user()->foto)}}" style="width: 200px;">
                                                    </div>
                                                @else 
                                                    <div>
                                                        <h5><span class="btn btn-xs btn-rounded btn-danger"><i class="fa fa-close"></i></span> Upload Foto <input type="file" name="file_photo" class="form-control"></h5>
                                                    </div>
                                                @endif
                                                <hr />
                                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan Perubahan</button>
                                              </div>
                                              <br style="clear:both;" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-left bg-warning"> <i class="fa fa-money"></i></div>
                                    <div class="sl-right">
                                        <div><h2>Pembayaran</h2> <span class="sl-date">&nbsp;</span></div>
                                        <div class="desc">
                                            <div>
                                                <h4> <span class="btn btn-xs btn-rounded btn-danger"><i class="fa fa-close"></i></span> Simpanan Pokok</h4>
                                                <p>Simpanan pokok manjadi anggota KODAMI Rp. 100.000 
                                                </p>
                                            </div>
                                            <hr />
                                            <div>
                                                <h4> <span class="btn btn-xs btn-rounded btn-danger"><i class="fa fa-close"></i></span> Simpanan Wajib</h4>
                                                <p>Simpanan Wajib anggota KODAMI sebesar Rp. 10.000 perbulan ( Rp. 120.000 pertahun )</p>
                                            </div>
                                            <hr />
                                            <div>
                                                <h4> <span class="btn btn-xs btn-rounded btn-success"><i class="fa fa-check"></i></span> Simpanan Sukarela</h4>
                                                <p>Simpanan sukarela adalah tabungan anggota yang besarnya tergantung kemampuan anggota </p>
                                            </div>
                                            <hr />
                                             <div>
                                                <h4> <span class="btn btn-xs btn-rounded btn-danger"><i class="fa fa-close"></i></span> Kartu Anggota</h4>
                                                <p>Kartu anggota KODAMI sebesar Rp. 10.000 </p>
                                            </div>
                                            <hr />
                                            <div>
                                                <h4>Total : Rp. 120.000</h4>
                                                <a href="{{ url('anggota/bayar') }}" style="color: white;" class="btn btn-success"><i class="fa fa-money"></i> Bayar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-left bg-warning"> <i class="fa fa-money"></i></div>
                                    <div class="sl-right">
                                        <div><h2>Konfirmasi Pembayaran</h2> <span class="sl-date">&nbsp;</span></div>
                                        <div class="desc">Setelah anda melakukan pembayaran anda di haruskan melakukan konfirmasi pembayaran dengan meng-unggah bukti pembayaran</div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-left bg-warning"> <i class="fa fa-ban"></i></div>
                                    <div class="sl-right">
                                        <div>
                                            <h2 class="btn btn-rounded btn-warning">Anggota Belum Aktif</h2>
                                        </div>
                                        <br />
                                        <div class="desc">Data anggota akan otomatis aktif ketika anda sudah melakukan semua proses ini</div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                <!--<div class="panel">
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
                    </div>-->

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
</div>

@endsection

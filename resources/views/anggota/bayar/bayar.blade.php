@extends('layout.anggota')

@section('title', 'Pembayaran Anggota - Koperasi Daya Masyarakat Indonesia')

@section('sidebar')

@endsection

@section('content')

<div id="page-wrapper" style="min-height: 439px;">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Pembayaran</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                
                <a href="{{ route('anggota.profile') }}"class="btn-info btn-circle pull-right m-l-20"><i class="ti-user text-white"></i></a>
                
                <ol class="breadcrumb">
                    <li><a href="{{ route('anggota.index') }}">Home</a></li>
                    <li class="active">Pembayaran</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="vtabs">
                        <ul class="nav tabs-vertical">
                            <li class="tab active">
                                <a data-toggle="tab" href="#vihome3" aria-expanded="false"> <span><i class="fa fa-money"></i> Bank Transfer</span></a>

                            </li>
                            <li class="tab">
                                <a data-toggle="tab" href="#viprofile3" aria-expanded="false"> <span><i class="fa fa-bank"></i> Rekening Bank</span></a>
                            </li>
                            <li class="tab">
                                <a aria-expanded="true" data-toggle="tab" href="#vimessages3"> <span><i class="ti-email"></i> Pembayaran</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="vihome3" class="tab-pane active">
                                <div class="col-md-12">
                                    <h3>Bank Transfer</h3>    
                                    <div class="col-md-4">
                                        <img src="{{ asset('images/bank/bca.png') }}">
                                        <p>
                                            No Rekening : 0984746582<br />
                                            Atas Nama : KODAMI
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{ asset('images/bank/bni.png') }}">
                                        <p>
                                            No Rekening : 0984746582<br />
                                            Atas Nama : KODAMI
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{ asset('images/bank/bri.png') }}">
                                        <p>
                                            No Rekening : 0984746582<br />
                                            Atas Nama : KODAMI
                                        </p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="viprofile3" class="tab-pane">
                                <h3>Rekening Bank Anda</h3>
                                <a href="" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Rekening Bank</a>
                                <br style="clear:both;" />
                                <br style="clear:both;" />
                                <table class="table table-bordered" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bank</th>
                                            <th>Atas Nama</th>
                                            <th>Cabang</th>
                                            <th>No Rekening</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div id="vimessages3" class="tab-pane">
                                <div class="white-box printableArea">
                                  <form method="post" action="">
                                    <h3><b>INVOICE</b> <span class="pull-right">#5669626</span></h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pull-left">
                                                <h3>Transfer Ke,</h3>

                                                <!-- <address>
                                                    <h3> &nbsp;<b class="text-danger">Elite Admin</b></h3>
                                                    <p class="text-muted m-l-5">E 104, Dharti-2,
                                                        <br> Nr' Viswakarma Temple,
                                                        <br> Talaja Road,
                                                        <br> Bhavnagar - 364002</p>
                                                </address> -->
                                            </div>
                                            <div class="pull-right text-right">
                                                <address>
                                                    <h3>To,</h3>
                                                    <h4 class="font-bold">{{ Auth::user()->name }},</h4>
                                                    <p class="text-muted m-l-30">E 104, Dharti-2,
                                                        <br> Nr' Viswakarma Temple,
                                                        <br> Talaja Road,
                                                        <br> Bhavnagar - 364002</p>
                                                    <p class="m-t-30"><b>Invoice Date :</b> <i class="fa fa-calendar"></i> {{ date('d F Y') }}</p>
                                                    <p><b>Due Date :</b> <i class="fa fa-calendar"></i> {{ date('d F Y', strtotime("+3 dasys")) }}</p>
                                                </address>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="table-responsive m-t-40" style="clear: both;">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th>Pembayaran</th>
                                                            <th class="text-right">Nominal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">1</td>
                                                            <td>Simpanan Pokok</td>
                                                            <td class="text-right">Rp. 100.000 </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">2</td>
                                                            <td>Simpanan Wajib</td>
                                                            <td class="text-right">Rp. 10.000 perbulan </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">3</td>
                                                            <td>Kartu Anggota</td>
                                                            <td class="text-right">Rp. 10.000 </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="pull-right m-t-30 text-right">
                                                <h3><b>Total :</b> Rp. 120.000</h3> </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                            <div class="text-right">
                                                <button class="btn btn-danger" type="submit"> Proceed to payment </button>
                                                <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                                            </div>
                                        </div>
                                    </div>
                                  </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    @include('layout.footer-admin')
</div>

<link href="{{ asset('admin/plugins/bower_components/horizontal-timeline/css/horizontal-timeline.css') }}" rel="stylesheet">
@section('footer-script')
    <!-- Horizontal-timeline JavaScript -->
    <script src="{{ asset('admin/plugins/bower_components/horizontal-timeline/js/horizontal-timeline.js') }}"></script>
    <!--Style Switcher -->
    <script src="{{ asset('admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
@endsection

@endsection
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
                                <a data-toggle="tab" href="#viprofile3" aria-expanded="false"> <span><i class="fa fa-bank"></i></span></a>
                            </li>
                            <li class="tab">
                                <a aria-expanded="true" data-toggle="tab" href="#vimessages3"> <span><i class="ti-email"></i></span></a>
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
                                <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                            </div>
                            <div id="vimessages3" class="tab-pane">
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
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
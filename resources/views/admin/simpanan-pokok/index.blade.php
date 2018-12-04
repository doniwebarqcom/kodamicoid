@extends('layout.admin')

@section('title', 'Simpanan Pokok - Koperasi Daya Masyarakat Indonesia')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Simpanan Pokok</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="active">Simpanan Pokok</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- .row --> 
        <div class="row">
            <div class="col-md-6 px-0">
                <div class="white-box" style="padding-top:3px;">
                    <h3>Sudah Bayar</h3>
                    <form method="GET" class="filter-div" autocomplete="off">
                        <div class="col-md-5" style="margin-left:0;padding-left: 0;">
                            <div class="input-daterange input-group" id="date-range">
                                <input type="text" placeholder="Start Date" class="form-control" name="start" value="{{ isset($_GET['start']) ? $_GET['start'] : '' }}" /> <span class="input-group-addon bg-info b-0 text-white">to</span>
                                <input type="text" placeholder="End Date" class="form-control" name="end" value="{{ isset($_GET['end']) ? $_GET['end'] : '' }}" />
                            </div>
                        </div>
                        <div class="col-md-3" style="padding-left:0;">
                            <input type="text" class="form-control" placeholder="Search..">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search-plus"></i></button>
                            <a type="submit" class="btn btn-default"><i class="fa fa-download"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                    <div class="table-responsive">
                        <table  class="display nowrap data_table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="70" class="text-center">#</th>
                                    <th>NAME</th>
                                    <th>NO ANGGOTA</th>
                                    <th>NOMINAL</th>
                                    <th>TANGGAL BAYAR</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_sudah_bayar as $no => $item)
                                  @if(isset($item->user->name))
                                    <tr>
                                        <td class="text-center">{{ $no+1 }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->no_anggota }}</td>
                                        <td>{{ number_format($item->nominal) }}</td>
                                        <td>{{ date('d F Y H:i', strtotime($item->updated_at))  }}</td>
                                        <td></td>
                                    </tr>
                                  @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-m-6 pull-left text-left">Showing {{ $data_sudah_bayar->firstItem() }} to {{ $data_sudah_bayar->lastItem() }} of {{ $data_sudah_bayar->total() }} entries</div>
                        <div class="col-md-6 pull-right text-right">{{ $data_sudah_bayar->appends($_GET)->render() }}</div><div class="clearfix"></div>
                    </div>
                </div>
            </div> 

            <div class="col-md-6 pr-0">
               <div class="white-box" style="padding-top:3px;">
                    <h3>Belum Bayar</h3>
                    <form method="GET" class="filter-div" autocomplete="off">
                        <div class="col-md-5" style="margin-left:0;padding-left: 0;">
                            <div class="input-daterange input-group" id="date-range">
                                <input type="text" placeholder="Start Date" class="form-control" name="start" value="{{ isset($_GET['start']) ? $_GET['start'] : '' }}" /> <span class="input-group-addon bg-info b-0 text-white">to</span>
                                <input type="text" placeholder="End Date" class="form-control" name="end" value="{{ isset($_GET['end']) ? $_GET['end'] : '' }}" />
                            </div>
                        </div>
                        <div class="col-md-3" style="padding-left:0;">
                            <input type="text" class="form-control" placeholder="Search..">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search-plus"></i></button>
                            <a type="submit" class="btn btn-default"><i class="fa fa-download"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                    <div class="table-responsive">
                        <table class="display nowrap data_table1" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="70" class="text-center">#</th>
                                    <th>NAME</th>
                                    <th>NO PENDAFTARAN</th>
                                    <th>NOMINAL</th>
                                    <th>TANGGAL DAFTAR</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_belum_bayar as $no => $item)
                                  @if(isset($item->user->name))
                                    <tr>
                                        <td class="text-center">{{ $no+1 }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->no_anggota }}</td>
                                        <td>{{ number_format($item->nominal) }}</td>
                                        <td>{{ date('d F Y H:i', strtotime($item->created_at))  }}</td>
                                        <td></td>
                                    </tr>
                                  @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-m-6 pull-left text-left">Showing {{ $data_belum_bayar->firstItem() }} to {{ $data_belum_bayar->lastItem() }} of {{ $data_belum_bayar->total() }} entries</div>
                        <div class="col-md-6 pull-right text-right">{{ $data_belum_bayar->appends($_GET)->render() }}</div><div class="clearfix"></div>
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
@section('footer-script')
<!-- Date picker plugins css -->
<link href="{{ asset('admin-css/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Daterange picker plugins css -->
<link href="{{ asset('admin-css/plugins/bower_components/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin-css/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<!-- Date Picker Plugin JavaScript -->
<script src="{{ asset('admin-css/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<!-- Date range Plugin JavaScript -->
<script src="{{ asset('admin-css/plugins/bower_components/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('admin-css/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript">
    $('#date-range').datepicker({
        toggleActive: true,
        format: 'yyyy-mm-dd'
    });
    $('#date-range2').datepicker({
        toggleActive: true,
        format: 'yyyy-mm-dd'
    });
</script>
@endsection

@endsection

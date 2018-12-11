@extends('layout.kasir')

@section('title', 'Kasir')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-md-1">
                <h4 class="page-title">PENCARIAN</h4> 
            </div>
            <div class="col-md-6">
                <form method="POST">
                    <input type="text" class="form-control autocomplete-anggota" placeholder="Nama Anggota / No Anggota">
                </form>
            </div>
        </div>
        <!-- .row --> 
        <div class="row">
            <div class="col-md-12 mx-0 px-0">
                <!-- .tmp-search -->
                <div class="white-box" style="position:relative;">
                    <h2># {{ $data->name }} {{ !empty($data->no_anggota) ? ' / '. $data->no_anggota : '' }}</h2>
                    <hr style="margin-top:0;" >
                    <h3 class="pull-right" style="position: absolute;top:0;right:30px;cursor:pointer;" onclick="delete_el(this)"><i class="fa fa-close"></i></h3>
                    <div class="col-md-4">
                        <div class="col-md-3">
                            @if(!empty($data->foto))
                                <img src="{{ asset('file_photo/'. $data->id .'/'. $data->foto) }}" style="width: 100%;" />
                            @else
                                <img src="{{ asset('images/default-user.png') }}" style="width: 100%;">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <table class="table" style="margin-top:-26px">
                                <tr>
                                    <th style="padding-bottom: 2px;border:0;">Status</th>
                                    <th style="padding-bottom: 2px;border:0">
                                        @if($data->status_anggota == 1)
                                            <label class="btn btn-success btn-xs"><i class="fa fa-check"></i> Aktif</label>
                                        @else
                                            <label class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Tidak Aktif</label>
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th style="padding-bottom: 2px;padding-top:7px;">No Anggota</th>
                                    <th style="padding-bottom: 2px;padding-top:7px;">{{ $data->no_anggota }}</th>
                                </tr>
                                <tr>
                                    <th style="padding-bottom: 2px;padding-top:7px;">Name</th>
                                    <th style="padding-bottom: 2px;padding-top:7px;">{{ $data->name }}</th>
                                </tr>
                                <tr>
                                    <th style="padding-bottom: 2px;padding-top:7px;">Email</th>
                                    <th style="padding-bottom: 2px;padding-top:7px;">{{ $data->email }}</th>
                                </tr>
                                <tr>
                                    <th style="padding-bottom: 2px;padding-top:7px;">Jenis Kelamin</th>
                                    <th style="padding-bottom: 2px;padding-top:7px;">{{ $data->jenis_kelamin }}</th>
                                </tr>
                                <tr>
                                    <th style="padding-bottom: 2px;padding-top:7px;">Tanggal Lahir</th>
                                    <th style="padding-bottom: 2px;padding-top:7px;">{{ $data->tanggal_lahir }}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <h3 style="margin-top: 0;"><small>Simpanan Wajib</small>
                            <br /> Rp. {{ number_format(simpanan_wajib($data->id)->where('status', 3)->sum('nominal')) }}
                        </h3>
                        <label class="btn btn-info btn-xs" onclick="topup_simpanan_wajib()"><i class="fa fa-plus"></i> Topup</label>
                        <!-- <label class="btn btn-danger btn-xs"  onclick="alert('Maaf Fitur masih dalam pengembangan.')"><i class="fa fa-minus"></i> Withdraw</label> -->
                        <!-- <p>Jatuh tempo pembayaran selanjutnya<br /> <label class="text-danger">{{ date('d F Y', strtotime($data->first_durasi_pembayaran_date ." + ". $data->durasi_pembayaran ." month") ) }}</label></p> -->
                    </div>
                    <div class="col-md-2">
                        <h3><small>Simpanan Pokok</small><br /> Rp. {{ number_format(simpanan_pokok($data->id)->where('status', 3)->sum('nominal')) }}</h3>
                        @if(simpanan_pokok($data->id)->where('status', 3)->sum('nominal') == 0)
                            <label class="btn btn-info btn-xs" onclick="topup_simpanan_pokok()"><i class="fa fa-plus"></i> Topup</label>
                            <!-- <label class="btn btn-danger btn-xs" onclick="alert('Maaf Fitur masih dalam pengembangan.')"><i class="fa fa-minus"></i> Withdraw</label> -->
                        @endif
                    </div>
                    <div class="col-md-2">
                        <h3><small>Simpanan Sukarela</small><br /> Rp. {{ number_format(simpanan_sukarela($data->id)->where('status', 3)->sum('nominal')) }}</h3>
                        <label class="btn btn-info btn-xs" onclick="topup()"><i class="fa fa-plus"></i> Topup</label>
                        <label class="btn btn-danger btn-xs"  onclick="alert('Maaf Fitur masih dalam pengembangan.')"><i class="fa fa-minus"></i> Withdraw</label>
                    </div>
                    <div class="clearfix"></div>
                    <hr />
                     <div>
                        <div class="col-md-2">
                            <ul class="nav tabs-vertical">
                                <li class="tab active">
                                    <a data-toggle="tab" href="#transaksi" aria-expanded="true"> <span class="visible-xs"><i class="ti-home"></i></span> <span class="hidden-xs">Transaksi</span> </a>
                                </li>
                                <li class="tab">
                                    <a data-toggle="tab" href="#simpanan_pokok" aria-expanded="true"> <span class="visible-xs"><i class="ti-home"></i></span> <span class="hidden-xs">Simpanan Pokok</span> </a>
                                </li>
                                <li class="tab">
                                    <a data-toggle="tab" href="#simpanan_sukarela" aria-expanded="false"> <span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Simpanan Sukarela</span> </a>
                                </li>
                                <li class="tab">
                                    <a aria-expanded="false" data-toggle="tab" href="#simpanan_wajib"> <span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Simpanan Wajib</span> </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-10 mt-0 pt-0">
                            <div class="tab-content" style="margin-top:0;">
                                <div id="transaksi" class="tab-pane active">
                                    <table class="display nowrap data_table mt-0" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Transaksi</th>
                                                <th>Nominal</th>
                                                <th>Tanggal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transaksi as $no => $item)
                                            <tr>
                                                <td>{{ $no+1 }}</td>
                                                <td>
                                                    @if($item->jenis_transaksi == 0)
                                                        {{ @type_deposit($item->type) }}
                                                    @endif

                                                    @if($item->jenis_transaksi == 1)
                                                        @php($pulsa = getInvoicePulsa($item->no_invoice))
                                                        {{ isset($pulsa->pulsa->provider->keterangan) ? $pulsa->pulsa->provider->keterangan .' - ' : '' }} {{ isset($pulsa->pulsa->kode_produk) ? $pulsa->pulsa->kode_produk : '' }}  
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($no==0)
                                                        <!-- <label class="text-danger"><i class="fa fa-minus"></i> </label>  -->
                                                    @else
                                                        <!-- <label class="text-info"><i class="fa fa-plus"></i> </label>  -->
                                                    @endif
                                                    {{ number_format($item->nominal) }}
                                                </td>
                                                <td>{{ date('d F Y H:i:s', strtotime($item->created_at)) }}</td>    
                                                <td>
                                                    <a href="{{ route('kasir.anggota.cetak-kwitansi', ['id'=> $item->id, 'jenis_transaksi'=> $item->jenis_transaksi]) }}" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-print"></i> cetak</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="simpanan_pokok" class="tab-pane">
                                    <table class="display nowrap data_table1 mt-0" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nominal</th>
                                                <th>Tanggal</th>
                                                <th>User Proses</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(simpanan_pokok($data->id)->orderBy('id', 'DESC')->get() as $no => $item)
                                            <tr>
                                                <td>{{ $no+1 }}</td>
                                                <td>{{ number_format($item->nominal) }}</td>    
                                                <td>{{ date('d F Y H:i:s', strtotime($item->created_at)) }}</td>    
                                                <td>{{ isset($item->user_proses->name) ? $item->user_proses->name : '' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.anggota.cetak-kwitansi', $item->id) }}" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-print"></i> cetak kwitansi</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="simpanan_sukarela" class="tab-pane">
                                    <table class="display nowrap data_table2 mt-0" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nominal</th>
                                                <th>Tanggal</th>
                                                <th>User Proses</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                        @foreach(simpanan_sukarela($data->id)->orderBy('id', 'DESC')->get() as $no => $item)
                                            <tr>
                                                <td>{{ $no+1 }}</td>
                                                <td>{{ number_format($item->nominal) }}</td>    
                                                <td>{{ date('d F Y H:i:s', strtotime($item->created_at)) }}</td>    
                                                <td>{{ isset($item->user_proses->name) ? $item->user_proses->name : '' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.anggota.cetak-kwitansi', $item->id) }}" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-print"></i> cetak kwitansi</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="simpanan_wajib" class="tab-pane">
                                    <table class="display nowrap data_table3  mt-0" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nominal</th>
                                                <th>Tanggal</th>
                                                <th>Jatuh Tempo Pembayaran</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                        @foreach(simpanan_wajib($data->id)->orderBy('id', 'DESC')->get() as $no => $item)
                                            <tr>
                                                <td>{{ $no+1 }}</td>
                                                <td>{{ number_format($item->nominal) }}</td>    
                                                <td>{{ date('d F Y H:i:s', strtotime($item->created_at)) }}</td>  
                                                <td>
                                                    {{ date('d F Y', strtotime($data->first_durasi_pembayaran_date ." + ". $data->durasi_pembayaran ." month") ) }}
                                                </td>  
                                                <td>
                                                    <a href="{{ route('admin.anggota.cetak-kwitansi', $item->id) }}" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-print"></i> cetak kwitansi</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Topup</h4> </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="number" name="nominal" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Submit Topup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal simpanan pokok-->
<div id="modal_simpanan_pokok" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('kasir.anggota.topup-simpanan-pokok') }}" onsubmit="return confirm('Topup Simpanan Pokok ?')">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Topup Simpanan Pokok</h4> 
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nominal (Rp. )</label>
                        <input type="number" name="nominal" class="form-control" value="{{ get_setting('simpanan_pokok') }}">
                    </div>
                    <p>Catatan: Saldo Simpanan Pokok Minimal Rp. 100.000</p>
                    <input type="hidden" name="user_id" value="{{ $data->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                    <button type="submit" class="btn btn-success waves-effect btn-sm"><i class="fa fa-check"></i> Topup Simpanan Pokok</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal --> 
<!-- modal simpanan wajib-->
<div id="modal_simpanan_wajib" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('kasir.anggota.topup-simpanan-wajib') }}" onsubmit="return confirm('Topup Simpanan Wajib ?')">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Topup Simpanan Wajib</h4> 
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="text" readonly="true" name="nominal" class="form-control modal_nominal_simpanan_wajib" value="{{ number_format(get_setting('simpanan_wajib')) }}">
                    </div>
                    Durasi Pembayaran : 
                    <select class="form-control" name="durasi_pembayaran" {{ $data->durasi_pembayaran !== NULL ? 'readonly="true"' : '' }}>
                        <option value="1" {{ $data->durasi_pembayaran == 1 ? 'selected' : '' }}>1 Bulan</option>                        
                        <option value="3" {{ $data->durasi_pembayaran == 3 ? 'selected' : '' }}>3 Bulan</option>                        
                        <option value="6" {{ $data->durasi_pembayaran == 6 ? 'selected' : '' }}>6 Bulan</option>                        
                        <option value="12" {{ $data->durasi_pembayaran == 12 ? 'selected' : '' }}>12 Bulan</option>                        
                    </select>
                    <br />
                    <label>Total : </label>
                    <input type="input" name="total" class="form-control total_simpanan_wajib" readonly="true" value="{{ number_format(get_setting('simpanan_wajib')) }}" />
                    <input type="hidden" name="user_id" value="{{ $data->id }}" >
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                    <button type="submit" class="btn btn-success waves-effect btn-sm"><i class="fa fa-print"></i> Topup Simpanan Wajib</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@include('layout.footer-admin')
</div>
@section('footer-script')
<script type="text/javascript">
    function delete_el(el)
    {
        $(el).parent().remove();
    }
    $(".autocomplete-anggota" ).autocomplete({
        minLength:0,
        limit: 25,
        source: function( request, response ) {
            $.ajax({
              url: "{{ route('ajax.get-anggota') }}",
              method : 'POST',
              data: {
                'name': request.term,'_token' : $("meta[name='csrf-token']").attr('content')
              },
              success: function( data ) {
                response( data.data );
              }
            });
        },
        select: function( event, ui ) {

            window.location = '{{ url('kasir/anggota/detail') }}/'+ ui.item.id; return false;

            $.ajax({
                type: 'POST',
                url: '{{ route('ajax.get-anggota-by-id-html') }}',
                data: {'id' : ui.item.id, '_token' : $("meta[name='csrf-token']").attr('content')},
                dataType: 'json',
                success: function (data) {

                    $("#content-search-anggota").prepend(data.data);

                    setTimeout(function(){
                        $(".autocomplete-anggota").val(" ");
                        init_datatable();
                    }, 500);
                }
            });
            $(".autocomplete-anggota" ).val("");
        }
    }).on('focus', function () {
            $(this).autocomplete("search", "");
    });

    $("select[name='durasi_pembayaran']").on('change', function(){

            var total = parseInt($(this).val()) * parseInt($('.modal_nominal_simpanan_wajib').val());

            $(".total_simpanan_wajib").val( total );
        });

        var topup_simpanan_wajib = function(user_id){
            $("#modal_simpanan_wajib").modal("show");
        }

        var topup_simpanan_pokok = function(){
            $("#modal_simpanan_pokok").modal("show");
        }

        function topup()
        {
            var pr = bootbox.prompt({
                title: "Topup Simpanan Sukarela ",
                inputType: 'number',
                buttons: {
                        confirm: {
                            label: '<i class="fa fa-check"></i> TOPUP',
                            className: 'btn-success btn-sm'
                        },
                        cancel: {
                            label: '<i class="fa fa-close"></i> BATAL',
                            className: 'btn-danger btn-sm'
                        }
                    },
                callback: function (nominal) 
                {
                    if(nominal != null)
                    {
                        var confirm = bootbox.confirm({
                            message: "Apakah anda ingin Topup Simpanan Sukarela ?",
                            buttons: {
                                confirm: {
                                    label: '<i class="fa fa-check"></i> Ya',
                                    className: 'btn-success btn-sm'
                                },
                                cancel: {
                                    label: '<i class="fa fa-close"></i> Tidak',
                                    className: 'btn-danger btn-sm'
                                }
                            },
                            callback: function (result) {
                                
                                if(result)
                                {   
                                    $(".modal-footer").hide();
                                    confirm.find('.bootbox-body').html('<p><i class="fa fa-spin fa-spinner"></i> Silahkan tunggu beberapa saat ...</p>');

                                    setTimeout(function(){
                                         $.ajax({
                                            url: "{{ route('ajax.kasir.submit-simpanan-sukarela') }}", 
                                            data: {'_token' : '{{csrf_token()}}','nominal' : nominal, 'user_id' : {{ $data->id }} },
                                            type: 'POST',
                                            success: function(res)
                                            {
                                                if(res.message == 'success')
                                                {
                                                    confirm.modal('hide');
                                                    
                                                       bootbox.alert("Anda Berhasil Topup Simpanan Sukarela sebesar <strong>Rp. "+ numberWithComma(nominal) +"</strong> <br /><a href=\""+ res.link_cetak +"\" class=\"btn btn-default btn-sm\" target=\"_blank\"><i class=\"fa fa-print\"></i> Cetak Kwitansi</a>", function() {
                                                        location.reload();
                                                    });

                                                }else{
                                                    confirm.find('.bootbox-body').html('<p><i class="fa fa-times-octagon"></i> '+ res.data +'</p>');
                                                }
                                            }
                                        })
                                    }, 1000);

                                    return false;
                                }
                            }
                        });
                    }
                }
            });
        }
</script>
@endsection
@endsection

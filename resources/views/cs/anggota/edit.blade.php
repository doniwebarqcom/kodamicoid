@extends('layout.cs')

@section('title', 'Customer Service')

@section('content')
<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Anggota <label class="text-danger">#{{ $data->no_anggota }}</label></h4> </div>
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
                <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('cs.anggota.update', $data->id) }}" method="POST">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active" role="presentation" class=""><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Profile</span></a></li>
                        <li role="presentation" class=""><a href="#upload_file" aria-controls="upload_file" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Upload File</span></a></li>
                        <li role="presentation" class=""><a href="#rekening_bank" aria-controls="upload_file" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Rekening Bank</span></a></li>
                        <li role="presentation" class=""><a href="#kartu_anggota" aria-controls="upload_file" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Kartu Anggota</span></a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane" id="kartu_anggota">
                            <div class="col-md-4">
                                <div>
                                    <h2>KARTU ANGGOTA</h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <table id="data_table2" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane active" id="profile">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-6">No Anggota</label>
                                    <label class="col-md-6">KTP Number</label>
                                    <div class="col-md-6">
                                        <input type="text" name="no_anggota" readonly="true" value="{{ $data->no_anggota }}" class="form-control"> 
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="nik" class="form-control" value="{{ $data->nik }}"> 
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6">Nama</label>
                                    <label class="col-md-6">Jenis Kelamin</label>
                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control" value="{{ $data->name }}"> 
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control" name="jenis_kelamin" required>
                                            <option value=""> - Jenis Kelamin - </option>
                                            @foreach(['Laki-laki', 'Perempuan'] as $item)
                                                <option {{ $data->jenis_kelamin == $item ? 'selected' : '' }}>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6">Email</label>
                                    <label class="col-md-6">Telepon</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" value="{{ $data->email }}"> 
                                    </div>
                                     <div class="col-md-6">
                                        <input type="text" name="telepon" class="form-control" value="{{ $data->telepon }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4">Agama</label>
                                    <label class="col-md-4">Tempat Lahir</label>
                                    <label class="col-md-4">Tanggal Lahir</label>
                                    <div class="col-md-4"s>
                                        <?php $agama = ['Islam', 'Kristen', 'Budha', 'Hindu']; ?>
                                        <select class="form-control" name="agama">
                                            <option value=""> - Agama - </option>
                                            @foreach($agama as $item)
                                                <option value="{{ $item }}" {{ $data->agama == $item ? 'selected' : '' }}> {{ $item }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="tempat_lahir" class="form-control" value="{{ $data->tempat_lahir }}"> 
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="tanggal_lahir" class="form-control datepicker" value="{{ $data->tanggal_lahir }}"> 
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4">Password</label>
                                    <label class="col-md-4">Ketik Ulang Password</label>
                                    <label class="col-md-4">Status Login</label>
                                    <div class="col-md-4">
                                        <input type="password" name="password" class="form-control" value="{{ $data->password }}">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="password" name="confirmation" class="form-control" value="{{ $data->password }}"> 
                                    </div>
                                    <div class="col-md-4">
                                        <label><input type="radio" name="status_login" value="1" {{ $data->status_login == 1 ? 'checked="true"' : '' }} /> Active </label> &nbsp;
                                        <label><input type="radio" name="status_login" value="0" {{ $data->status_login == 0 ? 'checked="true"' : '' }} /> Inactive </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6"><input type="checkbox" name="is_dropshiper" value="1" {{ $data->access_id == 7 ? 'checked="true"' : '' }}> Aktifkan Sebagai Dropshiper</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12">Domisili Alamat</label>
                                        <div  class="col-md-12">
                                            <select name="domisili_provinsi_id" class="form-control">
                                                <option value=""> - Provinsi - </option>
                                                @foreach(get_provinsi() as $item)
                                                <option value="{{ $item->id_prov }}" {{ $item->id_prov == $data->domisili_provinsi_id ? 'selected' : '' }} >{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"> 
                                        <div class="col-md-12">
                                            <select name="domisili_kabupaten_id" class="form-control">
                                                <option value=""> - Kota / Kabupaten - </option>
                                                @if($data->domisiliKabupatenByProvinsi)
                                                    @foreach($data->domisiliKabupatenByProvinsi as $item)
                                                        <option value="{{ $item->id_kab }}" {{ $item->id_kab == $data->domisili_kabupaten_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select name="domisili_kecamatan_id" class="form-control">
                                                <option value=""> - Kecamatan - </option>
                                                @if($data->domisiliKecamatanByKabupaten)
                                                    @foreach($data->domisiliKecamatanByKabupaten as $item)
                                                        <option value="{{ $item->id_kec }}" {{ $item->id_kec == $data->domisili_kecamatan_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select name="domisili_kelurahan_id" class="form-control">
                                                <option value=""> - Kelurahan - </option>
                                                @if($data->domisiliKelurahanByKecamatan)
                                                    @foreach($data->domisiliKelurahanByKecamatan as $item)
                                                        <option value="{{ $item->id_kel }}" {{ $item->id_kel == $data->domisili_kelurahan_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="domisili_alamat" placeholder="Alamat RT / RW">{{ $data->domisili_alamat }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat KTP</label>
                                        <select name="ktp_provinsi_id" class="form-control">
                                            <option value=""> - Provinsi - </option>
                                            @foreach(get_provinsi() as $item)
                                            <option value="{{ $item->id_prov }}" {{ $item->id_prov == $data->ktp_provinsi_id ? 'selected' : '' }} >{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="ktp_kabupaten_id" class="form-control">
                                            <option value=""> - Kota / Kabupaten - </option>
                                            @if($data->ktpKabupatenByProvinsi)
                                                @foreach($data->ktpKabupatenByProvinsi as $item)
                                                    <option value="{{ $item->id_kab }}" {{ $item->id_kab == $data->ktp_kabupaten_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="ktp_kecamatan_id" class="form-control">
                                            <option value=""> - Kecamatan - </option>
                                            @if($data->ktpKecamatanByKabupaten)
                                                @foreach($data->ktpKecamatanByKabupaten as $item)
                                                    <option value="{{ $item->id_kec }}" {{ $item->id_kec == $data->ktp_kecamatan_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="ktp_kelurahan_id" class="form-control">
                                            <option value=""> - Kelurahan - </option>
                                            @if($data->ktpKelurahanByKecamatan)
                                                @foreach($data->ktpKelurahanByKecamatan as $item)
                                                    <option value="{{ $item->id_kel }}" {{ $item->id_kel == $data->ktp_kelurahan_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="ktp_alamat" placeholder="Alamat RT / RW">{{ $data->ktp_alamat }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-6">Passport Number</label>
                                        <label class="col-md-6">KK Number</label>
                                        <div class="col-md-6">
                                            <input type="text" name="passport_number" class="form-control" value="{{ $data->passport_number }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="kk_number" class="form-control" value="{{ $data->kk_number }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-6">NPWP Number</label>
                                        <label class="col-md-6">BPJS Number</label>
                                        <div class="col-md-6">
                                            <input type="text" name="npwp_number" class="form-control" value="{{ $data->npwp_number }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="bpjs_number" class="form-control" value="{{ $data->bpjs_number }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="rekening_bank">
                            <label class="btn btn-info btn-xs" onclick="add_bank()"><i class="fa fa-plus"></i> Tambah Data Rekening </label>
                            <br />
                            <style type="text/css">
                                .dt-buttons, .dataTables_filter {
                                    display: none;
                                }
                            </style>
                            <table id="data_table" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bank</th>
                                        <th>Nama Pemilik Rekening</th>
                                        <th>No Rekening</th>
                                        <th>Cabang</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->RekeningBankUser as $no => $item)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $item->bank->nama }}</td>
                                            <td>{{ $item->nama_akun }}</td>
                                            <td>{{ $item->no_rekening }}</td>
                                            <td>{{ $item->cabang }}</td>
                                            <td><a href="{{ route('admin.user.delete-bank', [$item->id, $data->id]) }}" onclick="return confirm('Delete data ini ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="upload_file">
                            <div class="form-group">
                                <label class="col-md-4">KTP</label>
                                <label class="col-md-4">Foto</label>
                                <label class="col-md-4">NPWP</label>
                                <div class="col-md-4">
                                    <input type="file" name="file_ktp" class="form-control">
                                    @if(!empty($data->foto_ktp))
                                        <div class="col-md-4">
                                            <img src="{{ asset('file_ktp/'. $data->id .'/'.  $data->foto_ktp)}}" style="width: 200px;">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="file_photo" class="form-control">
                                    @if(!empty($data->foto))
                                        <div class="col-md-4">
                                            <img src="{{ asset('file_photo/'. $data->id .'/'.  $data->foto)}}" style="width: 200px;">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="file_npwp" class="form-control">
                                    @if(!empty($data->file_npwp))
                                        <div class="col-md-4">
                                            <img src="{{ asset('file_npwp/'. $data->id .'/'.  $data->file_npwp)}}" style="width: 200px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{ route('admin.anggota.index') }}" class="btn btn-default btn-sm waves-effect waves-light m-r-10"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success waves-effect btn-sm waves-light m-r-10"><i class="fa fa-save"></i> Simpan Perubahan </button>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </form>
              </div>
            </div>                        
        </div>
    </div>
    @include('layout.footer-admin')
</div>

<!-- modal simpanan wajib-->
<div id="modal_add_bank" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.anggota.add-rekening-bank') }}">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ $data->id }}" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Rekening Bank</h4> 
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Bank</label>
                        <select class="form-control" name="bank_id">
                            <option value="">- Select - </option>
                            @foreach(list_bank() as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Pemilik Rekening</label>
                        <input type="text" class="form-control" name="nama_akun" />
                    </div>
                    <div class="form-group">
                        <label>No Rekening</label>
                        <input type="text" class="form-control" name="no_rekening">
                    </div>
                    <div class="form-group">
                        <label>Cabang</label>
                        <input type="text" class="form-control" name="cabang">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                    <button type="submit" class="btn btn-success waves-effect btn-sm"><i class="fa fa-print"></i> Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->
@section('footer-script')
<style type="text/css">
    table#data_table, table#data_table2,table#data_table3 {
        font-size: 13px;
    }
</style>
<script src="{{ asset('admin-css/plugins/bower_components/blockUI/jquery.blockUI.js') }}"></script>
<script type="text/javascript">
    function add_bank()
    {
        $("#modal_add_bank").modal("show");
    }
</script>
<script type="text/javascript">
    
    function reload_page()
    {
        location.reload();
    }
        jQuery('.datepicker').datepicker({  
            format: 'yyyy-mm-dd',
        });

        /**
         * DOMISILI LOKASI
         */
        $("select[name='domisili_provinsi_id']").on('change', function(){

            var id = $(this).val();
            
            // get kabupaten
            $.ajax({
                url: "{{ route('ajax.get-kabupaten-by-provinsi-id') }}",
                method:"POST",
                data: {'id' : id, '_token' : $("meta[name='csrf-token']").attr('content')},
                dataType:"json",
                success:function(data)
                {
                    var el = '<option value="">- Kota / Kabupaten -</option>';

                    $(data.data).each(function(k,v){
                        el += '<option value="'+ v.id_kab +'">'+ v.nama +'</option>';
                    });

                    $("select[name='domisili_kabupaten_id']").html(el);
                }
            });
        });

        $("select[name='domisili_kabupaten_id']").on('change', function(){

            var id = $(this).val();
            
            // get kecamatan
            $.ajax({
                url: "{{ route('ajax.get-kecamatan-by-kabupaten-id') }}",
                method:"POST",
                data: {'id' : id, '_token' : $("meta[name='csrf-token']").attr('content')},
                dataType:"json",
                success:function(data)
                {
                    var el = '<option value="">- Kecamatan -</option>';

                    $(data.data).each(function(k,v){
                        el += '<option value="'+ v.id_kec +'">'+ v.nama +'</option>';
                    });

                    $("select[name='domisili_kecamatan_id']").html(el);
                }
            });
        });

        $("select[name='domisili_kecamatan_id']").on('change', function(){

            var id = $(this).val();
            
            // get kelurahan
            $.ajax({
                url: "{{ route('ajax.get-kelurahan-by-kecamatan-id') }}",
                method:"POST",
                data: {'id' : id, '_token' : $("meta[name='csrf-token']").attr('content')},
                dataType:"json",
                success:function(data)
                {
                    var el = '<option value="">- Kelurahan -</option>';

                    $(data.data).each(function(k,v){
                        el += '<option value="'+ v.id_kel +'">'+ v.nama +'</option>';
                    });

                    $("select[name='domisili_kelurahan_id']").html(el);
                }
            });
        });
        /**
         * END LOKASI
         */


        /**
         * KTP LOKASI
         */
        $("select[name='ktp_provinsi_id']").on('change', function(){

            var id = $(this).val();
            
            // get kabupaten
            $.ajax({
                url: "{{ route('ajax.get-kabupaten-by-provinsi-id') }}",
                method:"POST",
                data: {'id' : id, '_token' : $("meta[name='csrf-token']").attr('content')},
                dataType:"json",
                success:function(data)
                {
                    var el = '<option value="">- Kota / Kabupaten -</option>';

                    $(data.data).each(function(k,v){
                        el += '<option value="'+ v.id_kab +'">'+ v.nama +'</option>';
                    });

                    $("select[name='ktp_kabupaten_id']").html(el);
                }
            });
        });

        $("select[name='ktp_kabupaten_id']").on('change', function(){

            var id = $(this).val();
            
            // get kecamatan
            $.ajax({
                url: "{{ route('ajax.get-kecamatan-by-kabupaten-id') }}",
                method:"POST",
                data: {'id' : id, '_token' : $("meta[name='csrf-token']").attr('content')},
                dataType:"json",
                success:function(data)
                {
                    var el = '<option value="">- Kecamatan -</option>';

                    $(data.data).each(function(k,v){
                        el += '<option value="'+ v.id_kec +'">'+ v.nama +'</option>';
                    });

                    $("select[name='ktp_kecamatan_id']").html(el);
                }
            });
        });

        $("select[name='ktp_kecamatan_id']").on('change', function(){

            var id = $(this).val();
            
            // get kelurahan
            $.ajax({
                url: "{{ route('ajax.get-kelurahan-by-kecamatan-id') }}",
                method:"POST",
                data: {'id' : id, '_token' : $("meta[name='csrf-token']").attr('content')},
                dataType:"json",
                success:function(data)
                {
                    var el = '<option value="">- Kelurahan -</option>';

                    $(data.data).each(function(k,v){
                        el += '<option value="'+ v.id_kel +'">'+ v.nama +'</option>';
                    });

                    $("select[name='ktp_kelurahan_id']").html(el);
                }
            });
        });
        /**
         * END KTP LOKASI
         */
    </script>
@endsection

@endsection

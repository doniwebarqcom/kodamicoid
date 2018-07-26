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
                <h3 class="box-title m-b-0">Data Anggota</h3>
                <hr />
                <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.anggota.update', $data->id) }}" method="POST">
                    
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class=""><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Profile</span></a></li>
                        <li role="presentation" class=""><a href="#simpanan" aria-controls="simpanan" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Simpanan</span></a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="profile">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-6">No Anggota</label>
                                    <label class="col-md-6">NIK</label>
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
                                        <input type="text" name="nama" class="form-control" value="{{ $data->nama }}"> 
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
                                        <input type="text" name="tanggal_lahir" class="form-control datepicker" value="{{ $tanggal_lahir }}"> 
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-6">KTP</label>
                                    <label class="col-md-6">Foto</label>
                                    <div class="col-md-6">
                                        <input type="file" name="file_ktp" class="form-control">
                                        @if(!empty($data->foto_ktp))
                                            <div class="col-md-6">
                                                <img src="{{ asset('file_ktp/'. $data->id .'/'.  $data->foto_ktp)}}" style="width: 200px;">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" name="file_photo" class="form-control">
                                        @if(!empty($data->foto))
                                            <div class="col-md-6">
                                                <img src="{{ asset('file_photo/'. $data->id .'/'.  $data->foto)}}" style="width: 200px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="col-md-6">Password</label>
                                    <label class="col-md-6">Ketik Ulang Password</label>
                                    <div class="col-md-6">
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" name="confirmation" class="form-control"> 
                                    </div>
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
                                                <option value="{{ $item->id_prov }}" >{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select name="domisili_kabupaten_id" class="form-control">
                                                <option value=""> - Kota / Kabupaten - </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select name="domisili_kecamatan_id" class="form-control">
                                                <option value=""> - Kecamatan - </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select name="domisili_kelurahan_id" class="form-control">
                                                <option value=""> - Kelurahan - </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="domisili_alamat" placeholder="Alamat RT / RW"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat KTP</label>
                                        <select name="ktp_provinsi_id" class="form-control">
                                            <option value=""> - Provinsi - </option>
                                            @foreach(get_provinsi() as $item)
                                            <option value="{{ $item->id_prov }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="ktp_kabupaten_id" class="form-control">
                                            <option value=""> - Kota / Kabupaten - </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="ktp_kecamatan_id" class="form-control">
                                            <option value=""> - Kecamatan - </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="ktp_kelurahan_id" class="form-control">
                                            <option value=""> - Kelurahan - </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="ktp_alamat" placeholder="Alamat RT / RW"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="simpanan">
                             <div class="vtabs">
                                <ul class="nav tabs-vertical">
                                    <li class="tab active">
                                        <a data-toggle="tab" href="#home3" aria-expanded="true"> <span class="visible-xs"><i class="ti-home"></i></span> <span class="hidden-xs">Simpanan </span> </a>
                                    </li>
                                    <li class="tab">
                                        <a data-toggle="tab" href="#profile3" aria-expanded="false"> <span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Profile</span> </a>
                                    </li>
                                    <li class="tab">
                                        <a aria-expanded="false" data-toggle="tab" href="#messages3"> <span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Messages</span> </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="home3" class="tab-pane active">
                                        
                                    </div>
                                    <div id="profile3" class="tab-pane">
                                        <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                    </div>
                                    <div id="messages3" class="tab-pane">
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr />
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{ route('admin.anggota.index') }}" class="btn btn-default btn-sm waves-effect waves-light m-r-10"><i class="fa fa-arrow-left"></i> Back</a>
                            <button type="submit" class="btn btn-success waves-effect btn-sm waves-light m-r-10"><i class="fa fa-save"></i> Save </button>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
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

@section('footer-script')
    <script src="{{ asset('admin-css/plugins/bower_components/blockUI/jquery.blockUI.js') }}"></script>
    <script type="text/javascript">
        
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

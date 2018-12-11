@extends('layout.login')

@section('title', 'Pendaftaran Anggota')

@section('content')
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<header class="navbar">
 <a href="{{ url('/') }}">
  <img src="{{ asset('logo.png')}}" style="width: 152px;margin-left: 112px;margin-top: 0px;" />
  </a> 
</header>
<section id="wrapper" class="new-login-register" style="background: url('{{ asset('images/bg-1.png?v=1') }}') !important; background-size:auto 100% !important;background-position:left bottom !important;background-repeat: no-repeat !important; ">
      <a href="{{ url('/') }}" class="back_index"><i class="fa fa-arrow-left"></i></a>
      <div class="new-login-box">
          <div class="white-box">
            <h3 class="box-title m-b-0">Pendaftaran Kodami</h3>
            <form class="form-horizontal new-lg-form" method="POST" id="form-daftar" action="{{ route('daftar-store') }}" autocomplete="off">
              {{ csrf_field() }}
              <div class="box">
                <h3 class="box-title-toggle">Biodata</h3>
                <div class="form-group">
                  <div class="col-xs-6">
                    <label>Nama</label>
                    <input class="form-control" name="name" type="text" required="" placeholder="Nama" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="col-xs-6">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin">
                      <option value="">Pilih</option>
                      <option>Laki-laki</option>
                      <option>Perempuan</option>
                    </select>
                    @if ($errors->has('jenis_kelamin'))
                        <span class="help-block">
                            <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-6">
                    <label>Email</label>
                    <input class="form-control" name="email" type="email" required="" placeholder="Email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="col-xs-6">
                    <label>Telepon</label>
                    <input class="form-control" name="telepon" type="text" required="" placeholder="Telepon" value="{{ old('telepon') }}">
                    @if ($errors->has('telepon'))
                        <span class="help-block">
                            <strong>{{ $errors->first('telepon') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-6">
                    <label>Agama</label>
                    <?php $agama = ['Islam', 'Kristen', 'Budha', 'Hindu']; ?>
                    <select class="form-control" name="agama">
                        <option value=""> - Agama - </option>
                        @foreach($agama as $item)
                            <option value="{{ $item }}"> {{ $item }} </option>
                        @endforeach
                    </select>
                    @if ($errors->has('agama'))
                        <span class="help-block">
                            <strong>{{ $errors->first('agama') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="col-xs-6">
                    <label>Tempat Lahir</label>
                    <input class="form-control" name="tempat_lahir" type="text" required="" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}">
                    @if ($errors->has('tempat_lahir'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tempat_lahir') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-6">
                    <label>Tanggal Lahir</label>
                    <input class="form-control datepicker" name="tanggal_lahir" type="text" required="" placeholder="Tanggal Lahir" value="{{ old('tanggal_lahir') }}">
                    @if ($errors->has('tanggal_lahir'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="col-xs-6">
                  </div>
                  <div class="col-xs-6">
                    <label>Nomor KTP</label>
                    <input class="form-control" name="nik" type="text" required="" placeholder="Nomor KTP" value="{{ old('nik') }}">
                    @if ($errors->has('nik'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nik') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-6">
                    <label>Alamat</label>
                    <select name="domisili_provinsi_id" class="form-control" required>
                        <option value=""> - Provinsi - </option>
                        @foreach(get_provinsi() as $item)
                        <option value="{{ $item->id_prov }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col-xs-6">
                    <label></label>
                    <select name="domisili_kabupaten_id" class="form-control" required>
                        <option value=""> - Kota / Kabupaten - </option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-6">
                    <select name="domisili_kecamatan_id" class="form-control" required>
                        <option value=""> - Kecamatan - </option>
                    </select>
                  </div>
                  <div class="col-xs-6">
                    <select name="domisili_kelurahan_id" class="form-control" required>
                        <option value=""> - Kelurahan - </option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                      <textarea class="form-control" name="domisili_alamat" placeholder="Alamat RT / RW" required></textarea>
                  </div>
                </div>
              </div><br />
              <div class="box">
                <h3>Simpanan</h3>
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Durasi Pembayaran Simpanan Wajib</label>
                        <select class="form-control" name="durasi_pembayaran">
                            <option value="1">1 Bulan</option>                        
                            <option value="3">3 Bulan</option>                        
                            <option value="6">6 Bulan</option>                        
                            <option value="12">12 Bulan</option> 
                        </select>
                    </div>
                </div>
              </div>
              <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                  <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Daftar</button>
                </div>
              </div>
            </form>
            <form class="form-horizontal" id="recoverform" action="index.html">
              <div class="form-group ">
                <div class="col-xs-12">
                  <h3>Recover Password</h3>
                  <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                </div>
              </div>
              <div class="form-group ">
                <div class="col-xs-12">
                  <input class="form-control" type="text" required="" placeholder="Email">
                </div>
              </div>
              <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                  <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                </div>
              </div>
            </form>
          </div>
      </div>              
</section>
<style type="text/css">
  .white-box{
    padding-top:0 !important;
  }
  .box-title-toggle{
    margin-bottom:10px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 2px;
    moz-box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
    -ms-box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
    -webkit-box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
    box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
  }
  .box {
    padding: 0 15px 15px 15px;
    border: 1px solid #ddd;
    border-radius: 2px;
    moz-box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
    -ms-box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
    -webkit-box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
    box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
  }
  .new-login-box
  {
    width: 600px !important;
  }
  .new-login-register .new-login-box
  {
    margin-top: 0 !important;
  }
  .navbar {
    padding:5px 0;
    -webkit-box-shadow: 0px 0px 5px 2px rgba(197, 197, 197, 0.5);
    -moz-box-shadow: 0px 0px 5px 2px rgba(197, 197, 197, 0.5);
    box-shadow: 0px 0px 5px 2px rgba(197, 197, 197, 0.5);
    
    background-color: white;
  }
  .new-login-register .new-login-box {
    margin-top: 10%;
    width: 400px;
    float: right;
    margin-right: 10%;
  }
</style>
@section('footer-script')
<script type="text/javascript">
    
    jQuery('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear : true,
        changeMonth : true
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
                    if(v.id_jenis == 1)
                        var pref = 'KABUPATEN ';
                    else
                        var pref = 'KOTA ';
                      
                    el += "<option value=\""+ v.id_kab +"\">"+ pref + v.nama +"</option>";

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

</script>
@endsection
@endsection



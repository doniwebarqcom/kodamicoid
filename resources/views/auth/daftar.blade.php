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
<section id="wrapper" class="new-login-register">
      <a href="{{ url('/') }}" class="back_index"><i class="fa fa-arrow-left"></i></a>
      <div class="col-md-6 box_left hidden-xs">&nbsp;</div>
      <div class="new-login-box">
          <div class="white-box">
            <h3 class="box-title m-b-0">Pendaftaran Kodami</h3>
            <form class="form-horizontal new-lg-form" enctype="multipart/form-data" method="POST" id="form-daftar" action="{{ route('daftar-store') }}" autocomplete="off">
              {{ csrf_field() }}
              @if ($errors->has('setuju'))
                  <div class="help-block">
                      <strong>Anda harus menyetujui ketentuan keanggotaan.</strong>
                  </div>
              @endif
              <h3 class="box-title-toggle" onclick="toggle_box('box_biodata')">1. Biodata</h3>
              <div class="box box_biodata">
                <div class="form-group">
                  <div class="col-xs-6">
                    <label>Nama</label>
                    <input class="form-control" name="name" type="text" required placeholder="Nama" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                      <span class="text-danger">Nama harus diisi.</span>
                    @endif
                  </div>
                  <div class="col-xs-6">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin" required>
                      <option value="">Pilih</option>
                      <option {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                      <option {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @if ($errors->has('jenis_kelamin'))
                        <span class="text-danger">Jenis Kelamin harus dipilih.</span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-6">
                    <label>Email</label>
                    <input class="form-control" name="email" type="email" required="" placeholder="Email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                      <span class="text-danger">Email anda sudah terdaftar.</span>
                    @endif
                  </div>
                  <div class="col-xs-6">
                    <label>Telepon</label>
                    <input class="form-control" name="telepon" type="text" required="" placeholder="Telepon" value="{{ old('telepon') }}">
                    @if ($errors->has('telepon'))
                        <span class="text-danger">No Telepon anda sudah terdaftar.</span>
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
                            <option value="{{ $item }}" {{ old('agama') == $item ? 'selected' : '' }}> {{ $item }} </option>
                        @endforeach
                    </select>
                    @if ($errors->has('agama'))
                        <span class="text-danger">Agama harus anda pilih.</span>
                    @endif
                  </div>
                  <div class="col-xs-6">
                    <label>Tempat Lahir</label>
                    <input class="form-control" name="tempat_lahir" type="text" required="" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}">
                    @if ($errors->has('tempat_lahir'))
                        <span class="text-danger">Tempat lahir harus diisi.</span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-6">
                    <label>Tanggal Lahir</label>
                    <input class="form-control datepicker2" name="tanggal_lahir" type="text" required="" placeholder="Tanggal Lahir" value="{{ old('tanggal_lahir') }}">
                    @if ($errors->has('tanggal_lahir'))
                        <span class="text-danger">Tanggal lahir harus diisi.</span>
                    @endif
                  </div>
                  <div class="col-xs-6">
                    <label>Nomor KTP</label>
                    <input class="form-control" name="nik" type="text" required="" placeholder="Nomor KTP" value="{{ old('nik') }}">
                    @if ($errors->has('nik'))
                        <span class="text-danger">Nomor KTP harus diisi.</span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
                    <label>Upload KTP</label>
                    <input type="file" class="form-control" name="file_ktp">
                    @if ($errors->has('file_ktp'))
                        <span class="text-danger">File KTP harus diisi.</span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-6">
                    <label>Alamat Domisili</label>
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
              </div>
              <h4 class="box-title-toggle" onclick="toggle_box('box_simpanan')" title="Klik disini untuk melihat detail simpanan.">2. Simpanan</h4>
              <div class="box box_simpanan" style="display: none;">
                <div class="form-group">
                    <div class="col-md-8">
                      Simpanan Pokok
                      <p style="font-size: 11px;">Simpanan pokok manjadi anggota KODAMI sebesar Rp. {{ number_format(get_setting('simpanan_pokok')) }}</p>
                    </div>
                    <div class="col-md-4">
                      Rp. {{ number_format(get_setting('simpanan_pokok')) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                      Simpanan Wajib  
                      <p style="font-size: 11px;">Simpanan Wajib anggota KODAMI sebesar Rp. {{ number_format(get_setting('simpanan_wajib')) }} perbulan ( Rp. {{ number_format(get_setting('simpanan_wajib') * 12) }} pertahun )</p>
                    </div>
                    <div class="col-md-4">
                      Rp. {{ number_format(get_setting('simpanan_wajib')) }}
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-md-8">Durasi Pembayaran Simpanan Wajib</div>
                  <div class="col-md-4">
                    <select class="form-control" name="durasi_pembayaran" required>
                      <option value="1">1 Bulan</option>                        
                      <option value="3">3 Bulan</option>                        
                      <option value="6">6 Bulan</option>                        
                      <option value="12">12 Bulan</option> 
                    </select>
                  </div>
                </div>
                 <div class="form-group">
                    <div class="col-md-8">
                      Simpanan Sukarela
                      <p style="font-size: 11px;">Simpanan Sukarela adalah simpanan Anggota yang besarnya tergantung kemampuan anggota</p>
                    </div>
                    <div class="col-md-4">
                      <input type="text" name="simpanan_sukarela" class="form-control price_format">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                      Kartu Anggota
                      <p style="font-size: 11px;">Biaya kartu anggota KODAMI sebesar Rp. {{ number_format(get_setting('kartu_anggota')) }} (1 Kali Bayar)</p>
                    </div>
                    <div class="col-md-4">Rp. {{ number_format(get_setting('kartu_anggota')) }}</div>
                </div>
                <hr />
                <div class="form-group">
                  <div class="col-md-12 text-right">
                    <h4 class="total_pembayaran">Total Pembayaran : {{ number_format(get_setting('simpanan_pokok') + get_setting('simpanan_wajib') + get_setting('kartu_anggota')) }}</h4>
                  </div>
                </div>
              </div>
              <br />
              <div class="form-group">
                <div class="col-md-12">
                  <p style="float: left; margin-right: 10px;"><input type="checkbox" name="setuju" value="1" required></p>
                  <p>Saya telah membaca dan menyetujui <a onclick="ketentuan()" style="cursor:pointer;">ketentuan keanggotaan</a> Koperasi Produsen Daya Masyarakat Indonesia.</p>
                </div>
              </div>
              <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                  <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Daftar</button>
                </div>
              </div>
              <input type="hidden" name="total_pembayaran" value="{{ get_setting('simpanan_pokok') + get_setting('simpanan_wajib') + get_setting('kartu_anggota') }}" />
            </form>
          </div>
      </div>              
</section>
<style type="text/css">

@media all and (min-width: 320px) and (max-width: 780px) {
  .new-login-register .new-login-box {
    margin-top: 10%;
    width: 100%;
    float: right;
    margin-right: 0%;
  }
}
/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
  .new-login-register .new-login-box {
    margin-top: 10%;
    width: 600px;
    float: right;
    margin-right: 6%;
  }
}

  .text-danger {
    font-size: 12px;
  }
  .new-login-register{
    position: unset !important;
    height: auto  !important;
  }
  .box_left {
    background: url('{{ asset('images/bg-1.png?v=1') }}') !important; 
    background-size:auto 100% !important;
    background-position:left bottom !important;
    background-repeat: no-repeat !important; 
    position: fixed;
    height: 100%;
  }
  .form-group, .form-horizontal .form-group {
    margin-bottom: 15px;
  }
  .new-login-register .new-login-box .new-lg-form {
    padding-top:5px !important;
  }
  .white-box{
    padding-top:0 !important;
  }
  .box-title-toggle{
    font-size: 17px;
    margin-bottom:0px;
    padding: 5px 0 5px 15px;
    border: 1px solid #ddd;
    border-radius: 2px;
    moz-box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
    -ms-box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
    -webkit-box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
    box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
    background: #eee;
    cursor: pointer;
  }
  .box {
    padding: 15px 15px 15px 15px;
    border: 1px solid #ddd;
    border-radius: 2px;
    moz-box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
    -ms-box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
    -webkit-box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
    box-shadow: 0 2px 1px rgba(0, 0, 0, .1);
  }
  
  .new-login-register .new-login-box{
    margin-top: 0 !important;
  }
  .navbar {
    padding:5px 0;
    -webkit-box-shadow: 0px 0px 5px 2px rgba(197, 197, 197, 0.5);
    -moz-box-shadow: 0px 0px 5px 2px rgba(197, 197, 197, 0.5);
    box-shadow: 0px 0px 5px 2px rgba(197, 197, 197, 0.5);
    background-color: white;
  }
 
</style>

<!-- sample modal content -->
<div id="modal_ketentuan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Ketentuan Keanggotaan</h4> </div>
            <div class="modal-body">
              <p>Dengan ini saya menyatakan setuju untuk mendaftar sebagai anggota Koperasi Produsen Daya Masyarakat Indonesia, tanpa adanya unsur paksaan dan bersedia melakukan pembayaran Simpanan Anggota sebagaimana yang telah ditetapkan sebagai berikut : 
                <ol>
                  <li>Simpanan Pokok, sebesar Rp. 100,000,- ( dibayar satu kali )</li> 
                  <li>Simpanan Wajib, sebesar Rp. 10,000,- ( dibayar setiap bulan)</li>
                  <li>Biaya Cetak Kartu Anggota Rp. 10,000,- ( dibayar satu kali)</li>
                </ol>
              </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
@section('footer-script')
<link href="{{ asset('admin-css/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('admin-css/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/jquery.priceformat.min.js') }}"></script>
<script type="text/javascript">
  $( function() {
      $( document ).tooltip();
  } );
 jQuery('.datepicker2').datepicker({
      format: 'yy-mm-dd'
  });

  function ketentuan()
  {
    $('#modal_ketentuan').modal("show");
  }

  $('.price_format').priceFormat({
      prefix: 'Rp. ',
      centsSeparator: '.',
      thousandsSeparator: ',',
      clearOnEmpty: true,
      centsLimit : 0
  });

  function numberWithComma(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  function calculate_simpanan()
  {
    var simpanan_sukarela = $("input[name='simpanan_sukarela']").val() == "" ? 0 : parseInt($("input[name='simpanan_sukarela']").val().replace('Rp. ','').replace(',','').replace(',','').replace(',',''));

    var total = (parseInt($("select[name='durasi_pembayaran'] option:selected").val()) * {{ get_setting('simpanan_wajib') }}) + {{ get_setting('simpanan_pokok') }} + {{ get_setting('kartu_anggota') }} + simpanan_sukarela;

    $("input[name='total_pembayaran']").val(total);

    return total;
  }

  $("input[name='simpanan_sukarela']").on('input', function(){
    $('.total_pembayaran').html('Total Pembayaran Rp. '+numberWithComma(calculate_simpanan()));
  });

  $("select[name='durasi_pembayaran']").on('change', function(){

    $('.total_pembayaran').html('Total Pembayaran Rp. '+numberWithComma(calculate_simpanan()));
  });

    jQuery('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear : true,
        changeMonth : true
    });

    var current_cls = "box_biodata";
    
    function toggle_box(cls)
    {
      if(current_cls != cls)
      {
        $('.box').each(function(){
          $(this).slideUp();
        })

        $('.'+ cls).slideDown("slow");
      }
      current_cls = cls;
    }

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



@extends('layout.login')

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
            <h3 class="box-title m-b-0">Konfirmasi Pendaftaran</h3>
            <p>Terima kasih sudah melakukan konfirmasi pendaftaran, berikut detail pembayaran simpanan yang harus Anda Bayarkan.</p>
            <table class="table">
                <tr>
                  <th>Simpanan Pokok</th>
                  <th>Rp. {{ get_setting('simpanan_wajib') }}</th>
                </tr>
                <tr>
                  <th>Simpanan Wajib</th>
                  <th>
                      Durasi Pembayaran : 
                    <select class="form-control" name="durasi_pembayaran">
                        <option value="1">1 Bulan</option>                        
                        <option value="3">3 Bulan</option>                        
                        <option value="6">6 Bulan</option>                        
                        <option value="12">12 Bulan</option>                        
                    </select>
                    Rp. <label class="text-simpanan-wajib"></label></th>
                </tr>
                <tr>
                  <th>Simpanan Pokok</th>
                  <th>Rp. </th>
                </tr>
            </table>
          </div>
      </div>              
</section>
<style type="text/css">
  .new-login-box{ width: 600px !important;}
  .new-login-register .new-login-box{ margin-top: 0 !important;}
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
<script type="text/javascript">
  $("select[name='text-simpanan-wajib']").on('change', function(){

    var nominal = {{  get_setting('simpanan_wajib') }};

    $('.text-simpanan-wajib').html(   );
  });
</script>
@endsection



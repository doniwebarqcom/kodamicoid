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
            <h3 class="box-title m-b-0">Konfirmasi Pembayaran</h3>
            <form class="form-horizontal new-lg-form" enctype="multipart/form-data" method="POST" id="form-daftar" action="{{ route('konfirmasi-store', $data->id) }}" autocomplete="off">
              {{ csrf_field() }}
              
              <div class="box box_biodata">
                <div class="form-group">
                  <div class="col-md-12">
                    <label>Bank Tujuan</label>
                    <select class="form-control" name="rekening_bank_id" required>
                      <option value="">Pilih</option>
                      @foreach(rekening_bank() as $item)
                        <option value="{{ $item->id }}">{{ $item->bank_->nama }} - {{ $item->no_rekening }} - {{ $item->owner }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
                    <label>Nominal Pembayaran</label>
                    <input class="form-control price_format" name="nominal" type="text" placeholder="Rp. " required value="{{ old('name') }}">
                    @if ($errors->has('nominal'))
                        <span class="text-error">Nominal harus diisi.</span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
                    <label>File Bukti Pembayaran</label>
                    <input class="form-control" name="file_confirmation" type="file" required>
                    @if ($errors->has('file_confirmation'))
                        <span class="help-block">File harus diisi.</span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
                    <label>Tanggal Transfer</label>
                    <input class="form-control datepicker" name="tanggal_transfer" type="text" required placeholder="Piih Tanggal">
                    @if ($errors->has('tanggal_transfer'))
                        <span class="text-error">Tanggal transfer harus diisi.</span>
                    @endif
                  </div>
                </div>
               
              </div>
              <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                  <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Konfirmasi</button>
                </div>
              </div>
            </form>
          </div>
      </div>              
</section>
@section('footer-script')
<script src="{{ asset('js/jquery.priceformat.min.js') }}"></script>
<script type="text/javascript">
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
  jQuery('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear : true,
        changeMonth : true,
        setDate: new Date()
    });
</script>
@endsection

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
@endsection



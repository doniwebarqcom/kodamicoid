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
              <h3 class="box-title m-b-0">Kodami Pocket System</h3>
              <small>Sign In to and Enter your details below</small>
            <form class="form-horizontal new-lg-form" method="POST" id="loginform" action="{{ route('login') }}">
              
              {{ csrf_field() }}
              
              <div class="form-group  m-t-20">
                <div class="col-xs-12">
                  <label>No Anggota</label>
                  <input class="form-control" type="text" required="" name="email" placeholder="No Anggota" value="{{ old('email') }}">
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <label>Password</label>
                  <input class="form-control" name="password" type="password" required="" placeholder="Password">
                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <div class="checkbox checkbox-info pull-left p-t-0">
                    <input id="checkbox-signup" type="checkbox"  name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="checkbox-signup"> Remember me </label>
                  </div>
                <!--   <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> --> 
                </div>
              </div>
              <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                  <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Log In</button>
                </div>
              </div>
              <!--
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                  <div class="social"><a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip"  title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a> <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip"  title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a> </div>
                </div>
              </div>
              -->
              <div class="form-group m-b-0">
                <div class="col-sm-12 text-center">
                  <p>Belum menjadi anggota? <a href="{{ route('daftar') }}" class="text-primary m-l-5"><b>Daftar</b></a></p>
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
@endsection



<!DOCTYPE html>
<!--[if IE 7 ]><body class="ie ie7"><![endif]-->
<!--[if IE 8 ]><body class="ie ie8"><![endif]-->
<!--[if IE 9 ]><body class="ie ie9"><![endif]-->
<html class='no-js' lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, maximum-scale=1.0">
	<title>@yield('title')</title>
	<meta content="" name="keywords">
	<meta content="" name="description">

	<link type="image/x-icon" href="img/favicon.ico" rel="shortcut icon">
	<link rel="stylesheet" href="{{ asset('advisa/css/bootstrap.css') }}">
	<!--<link rel="stylesheet" href="{{ asset('advisa/css/font-awesome.css') }}"> -->
	<link rel="stylesheet" href="{{ asset('advisa/fontawesome/css/fontawesome-all.css') }}">

	
	<link rel="stylesheet" href="{{ asset('advisa/css/main.css') }}">
	<link rel="stylesheet" href="{{ asset('advisa/css/responsive.css') }}">
</head>
<body>
<!--===========================-->
<!--==========Header===========-->
<div id="preloader">
	<div id="status">
		<div class="spinner">
			<div class="bounce1"></div>
			<div class="bounce2"></div>
			<div class="bounce3"></div>
		</div>
	</div>
</div>

<div class="main-holder">
<header class='main-wrapper header'>
	<div class="container apex">
		<div class="row">

			<nav class="navbar header-navbar" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<div class="logo navbar-brand">
						<img src="{{ asset('kodami-co-id.png') }}" style="width: 200px;" />
					</div>
		      <button class='toggle-slide-left visible-xs collapsed navbar-toggle' type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"><i class="fa fa-bars"></i></button>
				</div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<div class="navbar-right">
						<nav class='nav-menu navbar-left main-nav trig-mob slide-menu-left'>
							<ul class='list-unstyled'>
								<li>
									<a href="#" data-scroll="about_kodami">
										<div class="inside">
											<div class="backside"> About Kodami </div>
											<div class="frontside"> About Kodami </div>
										</div>
									</a>
								</li>
								<li>
									<a data-toggle="modal" role="button" href="#myModal">
										<div class="inside">
											<div class="backside"> Hubungi Kami </div>
											<div class="frontside"> Hubungi Kami </div>
										</div>
									</a>
								</li>
								@guest
								<li>
									<a data-toggle="modal" role="button" href="{{ route('login') }}">
										<div class="inside">
											<div class="backside"> Login </div>
											<div class="frontside"> Login </div>
										</div>
									</a>
								</li>
								@endguest
							</ul>
						</nav>
						<div class="wr-soc">
							<div class="header-social">
								<ul class='social-transform unstyled'>
								<li>
									<a href='#' target='blank' class='front'><div class="fab fa-facebook-f"></div></a>
								</li>
								<li>
									<a href='#' target='blank' class='front'><i class="fab fa-twitter"></i></a>
								</li>
								<li>
									<a href='#' target='blank' class='front'><i class="fab fa-google-plus"></i></a>
								</li>
								</ul>
							</div>
						</div>
					</div>
		    </div><!-- /.navbar-collapse -->
			</nav>

		</div>
	</div>
</header>
<!--===========================-->
<!--==========Content==========-->
<div class='main-wrapper content'>
	<section class="relative software_slider">
		<div class="forma-slider">
			<div class="container">
				<div class="row">
					<div id="form_slider" data-anchor="form_slider">

						<ul class="form-bxslider list-unstyled">
							<li>
								<div class="list-forstart fin_1">
									<h2 class="h-Bold" style="font-size: 29px;">Kodami Pocket System</h2>
									<p class='desc' style="font-size: 16px;">Adalah layanan digital Kodami yang memungkinkan seluruh anggota maupun calon anggota untuk dapat mengetahui lebih jauh tentang Kodami. Layanan ini memberikan informasi cukup rinci mengenai profil Kodami, pengurus, badan pengawas, tatacara keanggotaan, manfaat, jenis layanan Kodami, armada, proteksi, bagi hasil usaha dan kegiatan yang telah dan sedang dilakukan oleh Kodami.</p>
								</div>
								<div class="img-slider hidden-xs fin_2"></div>
							</li>
						</ul>
					</div>

					<div class="clearfix visible-xs visible-md"></div>

					<div class="container relative fin_3" id='elem-portable'>
						<div class="reg-now" style="top: 100px;">
						@guest
							<h2 class='medium-h text-center'>Registrasi Form</h2>
							<h3 class='xsmall-h text-center'>Daftar disini untuk menjadi anggota Kodami. </h3>

							<form class='reg-now-visible' action="{{ url('registerPost') }}" method="POST">

		  						<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" />

								<div class='control-group'>
									<span class="error"><?php echo $errors->first('nik') ?></span>
									<input type="text" name="nik" placeholder="NIK" required class="insert-attr"  value="<?=Form::old('nik')?>" />
								</div>
								<div class="control-group">
									<span class="error"><?php echo $errors->first('nama') ?></span>
		    						<input type="text" name="name" placeholder="Nama" required class="insert-attr" value="<?=Form::old('name')?>" />
								</div>
								<div class='control-group'>
									<span class="error"><?php echo $errors->first('email') ?></span>
		    						<input type="text" name="email" placeholder="Email" value="<?=Form::old('email')?>" />
								</div>
								<div class='control-group'>
									<span class="error"><?php echo $errors->first('telepon') ?></span>
		    						<input type="text" name="telepon" placeholder="Telepon" value="<?=Form::old('telepon')?>" />
								</div>
								<div class="control-group">
									<span class="error"><?php echo $errors->first('password') ?></span>
								    <input type="password" name="password" placeholder="Password" />
								</div>
								<div class="control-group">
								    <span class="error"><?php echo $errors->first('confirmation') ?></span>
								    <input type="password" name="confirmation" placeholder="Confirmation Password" />
								</div>
								<button type="submit" value="Register Now" class='btn submit sub-form' name="submit">DAFTAR</button>
							</form>
                        @endguest
						</div>
					</div>
				</div>
			</div><!-- end container -->
		</div>
	</section>
	<section class="container" data-anchor="about_kodami">
		<div class="spacer6"></div>
			<h2 class='text-center xxh-Bold'>kodami</h2>
			<h3 class='text-center xmedium-h'>Adalah Koperasi Daya Masyarakat Indonesia, merupakan salah satu koperasi produsen yang modern, bekerja dengan memberdayakan masyarakat Indonesia dalam rangka menjadi pelaku ekonomi yang tangguh dan profesional, dengan mengembangkan sistem ekonomi kerakyatan yang bertumpu pada mekanisme pasar yang berkeadilan, dengan suatu tujuan untuk Indonesia yang lebih baik. Layanan Kodami berupa penjualan offline dan online didukung armada kuper (kurir koperasi) dan eskop (ekspedisi koperasi) yang akan membantu masyarakat untuk kemudahan bertransaksi dengan harga yang lebih kompetitif.</h3>
			<div class="row trainings" id='trainings'>
				
				<div class="col-md-2 col-xs-6 hov1">
					<figure class='thumbnails'>
						<i class='fa fa-users'></i>
					</figure>
					<h4 class='xxsmall-h text-center transition-h'>Keanggotaan</h4>
					<div class="full-text"></div>
				</div>

				<div class="col-md-2 col-xs-6 hov2">
					<figure class='thumbnails'>
						<i class='fa fa-sync'></i>
					</figure>
					<h4 class='xxsmall-h text-center transition-h'>Modern</h4>
					<div class="full-text"> </div>
				</div>

				<div class="col-md-2 col-xs-6 hov3">
					<figure class='thumbnails'>
						<i class='fa fa-star'></i>
					</figure>
					<h4 class='xxsmall-h text-center transition-h'>Profesional</h4>
					<div class="full-text"></div>
				</div>

				<div class="col-md-2 col-xs-6 hov4">
					<figure class='thumbnails'>
						<i class='fa fa-share-alt'></i>
					</figure>
					<h4 class='xxsmall-h text-center transition-h'>Berbagi</h4>
					<div class="full-text"></div>
				</div>
				<div class="col-md-2 col-xs-6 hov4">
					<figure class='thumbnails'>
						<i class='fa fa-umbrella'></i>
					</figure>
					<h4 class='xxsmall-h text-center transition-h'>Proteksi</h4>
					<div class="full-text"></div>
				</div>
				<div class="col-md-2 col-xs-6 hov4">
					<figure class='thumbnails'>
						<i class='fa fa-book'></i>
					</figure>
					<h4 class='xxsmall-h text-center transition-h'>Edukasi</h4>
					<div class="full-text"></div>
				</div>
			</div>
		<div class="offsetY-4"></div>
	</section>
</div>
<!--===========================-->
<!--=========Footer============-->
<footer class='main-wrapper footer'>
	<div class="container">
		<a href="#" data-scroll="form_slider" class='btn submit a-trig reg-footer'>Daftar sekarang</a>
	</div>
	<div class="container bottom">

		<ul class='social-transform footer-soc list-unstyled'>
			<li>
				<a href='#' target='blank' class='front'><div class="fab fa-facebook-f"></div></a>
			</li>
			<li>
				<a href='#' target='blank' class='front'><i class="fab fa-twitter"></i></a>
			</li>
			<li>
				<a href='#' target='blank' class='front'><i class="fab fa-google-plus"></i></a>
			</li>
			<li>
				<a href='#' target='blank' class='front'><i class='fab fa-youtube'></i></a>
			</li>
		</ul>
		<div class="clearifx"></div>
		<span class="copyright">
			&#169; <?=date('Y')?> Koperasi Daya Masyarakat
		</span>
		<div class="container-fluid responsive-switcher hidden-md hidden-lg">
			<i class="fa fa-mobile"></i>
			Mobile version: Enabled
		</div>
	</div>
</footer>
<!-- Top -->
<div id="back-top-wrapper" class="visible-lg">
	<p id="back-top" class='bounceOut'>
		<a href="#top">
			<span></span>
		</a>
	</p>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-wr" style="width: 525px; left: 40%;">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h2 style="font-size: 20px;">Silakan hubungi kami untuk memberikan saran, kritik, keluhan, menanyakan keanggotaan, mekanisme kerja sama dan sebagainya. Kami selalu siap membantu anda.</h2>
		<br />
		<form id='contact' action="{{ route('contact-us') }}" method="post" accept-charset="utf-8" role="form">
			{{ csrf_field() }}
			<div class='control-group'>
				<input type="text" required name="nama" placeholder='Nama' data-required>
			</div>
			<div class='control-group'>
				<input type="email" required placeholder='Email' name="email" class='insert-attr' data-required>
			</div>
			<div class='control-group'>
				<input type="text" required placeholder='No Telepon' name="telepon" class='insert-attr' data-required>
			</div>
			<div class='control-group'>
				<textarea name='message' cols="30" required rows="10" maxlength="300" placeholder='Ketik pertanyaan anda disini.' data-required></textarea>
			</div>
			<button type="submit" value="Submit" class='btn submit' name="submit">Submit</button>
		</form>
	</div>
</div>

<div id="modal_success" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-wr">
		<h2>Terima kasih</h2> 
		<p>{{ Session::get('messages') }}</p>
	</div>
</div>

</div>
	<div class="mask"></div>
	<script src="{{ asset('advisa/js/libs/jquery-1.10.1.min.js') }}"></script>
	<script src="{{ asset('advisa/js/libs/bootstrap.min.js') }}"></script>
	<script src="{{ asset('advisa/js/cross/modernizr.js') }}"></script>
	<script src="{{ asset('advisa/js/jquery.bxslider.min.js') }}"></script>
	<script src="{{ asset('advisa/js/jquery.customSelect.js') }}"></script>
	<script src="{{ asset('advisa/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('advisa/js/jquery.colorbox-min.js') }}"></script>
	<script src="{{ asset('advisa/js/jquery.waypoints.min.js') }}"></script>
	<script src="{{ asset('advisa/js/jquery.parallax-1.1.3.js') }}"></script>
	<script src="{{ asset('advisa/js/custom.js?v=2') }}"></script>
	<!-- file loader -->
	<script src="{{ asset('advisa/js/loader.js?v=2') }}"></script>
	
	<script type="text/javascript">
		
		@if(Session::has('messages'))
		$("#modal_success").modal('show');
		@endif;

	</script>
	<style type="text/css">
		/*.list-forstart {
			width: 55%;
		}*/

		.fa-share-alt:before {
		    content: "\f1e0";
		}
	</style>
</body>
</html>
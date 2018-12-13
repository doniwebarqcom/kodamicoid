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
	<link rel="stylesheet" href="{{ asset('advisa/css/main.css') }}?rand={{ rand(1,10000) }}">
	<link rel="stylesheet" href="{{ asset('advisa/css/responsive.css') }}">
	<?php 
         $chek_url = @$_SERVER['HTTP_HOST'];
         if (strpos($chek_url, '.local') == false) {
      ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-126553963-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-126553963-1');
        </script>

    <?php } ?>
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
<header class='main-wrapper header' style="background: url('{{ asset('18.png')  }}') !important; ">
	<div class="container apex">
		<div class="row">
			<nav class="navbar header-navbar" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<div class="logo navbar-brand">
						<img src="{{ asset('images/logo.png') }}" style="width: 153px;margin-top: 7px;" />
					</div>
		      		<button class='toggle-slide-left visible-xs collapsed navbar-toggle' type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"><i class="fa fa-bars"></i></button>
				</div>

		    	<!-- Collect the nav links, forms, and other content for toggling -->
		    	<div class="collapse navbar-collapse hidden-xs" id="bs-example-navbar-collapse-1">
					<div class="navbar-right">
						<nav class='nav-menu navbar-left main-nav trig-mob slide-menu-left'>
							<ul class='list-unstyled nav_atas'>
								<li>
									<a href="#" data-scroll="about_kodami">
										<div class="inside">
											<div class="backside"> Tentang Kodami </div>
											<div class="frontside"> Tentang Kodami </div>
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
								@if(Auth::check())
								  @if(Auth::user()->access_id == 1)
									<li>
										<a data-toggle="modal" role="button" href="{{ route('admin.dashboard') }}">
											<div class="inside">
												<div class="backside"> Admin </div>
												<div class="frontside"> Admin </div>
											</div>
										</a>
									</li>
								  @endif
								  @if(Auth::user()->access_id == 3)
									<li>
										<a data-toggle="modal" role="button" href="{{ route('kasir.index') }}">
											<div class="inside">
												<div class="backside"> Kasir </div>
												<div class="frontside"> Kasir </div>
											</div>
										</a>
									</li>
								  @endif
								  @if(Auth::user()->access_id == 4)
									<li>
										<a data-toggle="modal" role="button" href="{{ route('cs.index') }}">
											<div class="inside">
												<div class="backside"> Customer Service </div>
												<div class="frontside"> Customer Service </div>
											</div>
										</a>
									</li>
								  @endif
								@endif
							</ul>
						</nav>
					</div>
		    	</div><!-- /.navbar-collapse -->
				
				<div class="visible-xs">
		    	<!-- Collect the nav links, forms, and other content for toggling -->
			    	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<div class="navbar-right">
							<nav class='nav-menu navbar-left main-nav trig-mob slide-menu-left'>
								<ul class='list-unstyled nav_atas'>
									<li>
										<a href="#" data-scroll="about_kodami">
											<div class="inside">
												<div class="backside"> Tentang Kodami </div>
												<div class="frontside"> Tentang Kodami </div>
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
									<li>
										<a href="{{ route('daftar') }}" data-toggle="modal" role="button" href="#myModal">
											<div class="inside">
												<div class="backside"> Pendaftaran Anggota </div>
												<div class="frontside"> Pendaftaran Anggota </div>
											</div>
										</a>
									</li>
									<li>
										<a href="{{ route('daftar') }}" data-toggle="modal" role="button" href="#myModal">
											<div class="inside">
												<div class="backside"> Login Kodami ID </div>
												<div class="frontside"> Login Kodami ID </div>
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
									@if(Auth::check())
									  @if(Auth::user()->access_id == 1)
										<li>
											<a data-toggle="modal" role="button" href="{{ route('admin.dashboard') }}">
												<div class="inside">
													<div class="backside"> Admin </div>
													<div class="frontside"> Admin </div>
												</div>
											</a>
										</li>
									  @endif
									  @if(Auth::user()->access_id == 3)
										<li>
											<a data-toggle="modal" role="button" href="{{ route('kasir.index') }}">
												<div class="inside">
													<div class="backside"> Kasir </div>
													<div class="frontside"> Kasir </div>
												</div>
											</a>
										</li>
									  @endif
									  @if(Auth::user()->access_id == 4)
										<li>
											<a data-toggle="modal" role="button" href="{{ route('cs.index') }}">
												<div class="inside">
													<div class="backside"> Customer Service </div>
													<div class="frontside"> Customer Service </div>
												</div>
											</a>
										</li>
									  @endif
									@endif
								</ul>
							</nav>
						</div>
			    	</div><!-- /.navbar-collapse -->
			    </div>
			</nav>
		</div>
	</div>
</header>
<!--===========================-->
<!--==========Content==========-->
<div class='main-wrapper content'>
	<section class="relative software_slider">
		<div class="forma-slider">
			<div id="form_slider" data-anchor="form_slider">
				<ul class="form-bxslider list-unstyled">
					<li><div class="img-slider fin_2"><img src="{{ asset('images/banner/1.jpg') }}?v=1"></div></li>
					<li><div class="img-slider fin_3"><img src="{{ asset('images/banner/2.jpg') }}?v=1"></div></li>
				</ul>
			</div>
			<div class="container">
				<div class="row">
					<div class="relative fin_3" id='elem-portable'>
						<div class="reg-now menu-right hidden-xs" style="background: url('{{ asset('background-transparent.png?v=1') }}')">
							<ul class="menu-right">
								<li class="item">
									<a onclick="form_pendaftaran()">
										<img src="{{ asset('images/icon/1.png') }}" style="height: 32px" class="icon" />
									</a>
									<span class="sub-title sub-title-1">Pendaftaran</span>	
								</li>
								<li class="item">
									<a href="https://kodami.id">
										<img src="{{ asset('images/icon/2.png') }}" style="height: 32px" class="icon" />
									</a>
									<span class="sub-title sub-title-1">Belanja</span>	
								</li>
								<li class="item">
									<a href="">
										<img src="{{ asset('images/icon/3.png') }}" style="height: 32px" class="icon" />
									</a>
									<span class="sub-title sub-title-1">Modal Penyertaan</span>	
								</li>
								<li class="item">
									<a href="">
										<img src="{{ asset('images/icon/4.png') }}" style="height: 32px" class="icon" />
									</a>
									<span class="sub-title sub-title-1">Daftar Kemitraan</span>	
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div><!-- end container -->
		</div>
	</section>
</div>
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
<iframe src="http://kodami.co.id.local/daftar" width="100%" id="iframe_pendaftaran"></iframe>
<!-- Animasi -->
<style type="text/css">
/*body {
	overflow: hidden !important
}*/
.menu-right{
	height: 264px;
	margin-bottom:0;
	padding-left:0;
	margin-left:0;
}
.menu-right .item {
	position: relative;
	cursor: pointer;
	text-align: center;
}
.menu-right .item h1,.menu-right .item h1 a  {color: white;}
.menu-right .item a img {
	max-width: none;
}
.menu-right li.item {
	list-style: none;
	text-align: center;	
	height: 66px;
	position: relative;
	border-bottom: 1px solid #8c8c8c;
}
.menu-right .item .icon {
	position: absolute;
    top: 0;
    left: 0;
    right: 0;
    margin: auto;
    bottom: 0;
    z-index: 999
}
.menu-right .item .sub-title {
	display: block;
	position: absolute;
    top: 0px;
    right: 50px;
	background: #346fcd;
	color: white;
	min-height: 66px;
	max-height: 66px;
	transition: 0.5s;
	z-index: 0;
	padding-top: 23px;
	width: 0;
	text-align: left;
}
.menu-right .item h1:hover, .menu-right .item h1 a:hover {
	color: #ccc;
	background: #346fcd;

}
.sub-title-1 {
	position: absolute !important;
    right: 0px !important;
    top: 0px !important;
}
.sub-title-1 img{
	max-width: none;
	-webkit-box-shadow: 0px 0px 5px 2px rgba(128, 128, 128, 0.5);
    -moz-box-shadow: 0px 0px 5px 2px rgba(128, 128, 128, 0.5);
    box-shadow: 0px 0px 5px 2px rgba(128, 128, 128, 0.5);
}
.sub-title-2 {width: 145px;}
.sub-title-3 {width: 145px;}
.sub-title-4 {width: 145px;}
.sub-title-5 {width: 145px;}
.sub-title-6 {width: 145px;}
.reg-now {
	/*height: -webkit-fill-available;*/
	/*top: 71px;*/
	width: 60px;
	position: absolute;
	margin: auto;
	/*min-height:100vh;*/
	padding:0;
}

#iframe_pendaftaran {
	position: absolute;
    top: 0px;
    -width: 0;
    -right: 0;
    -right: -1904px;
	transition: 2s;
}
.main-holder {
	transition: 2s;
	width: 100%;
	position:relative;
}

.forma-slider {
	-min-height: 100vh;
	background: url('{{ asset('images/banner/pattern.jpg') }}')
}
.footer-banner {
	position: absolute;
	bottom:0;
	z-index: 9999;
}
.footer-banner img {
	width: 352px;
}
header {
	-webkit-box-shadow: 0px 0px 5px 2px rgba(197, 197, 197, 0.5);
    -moz-box-shadow: 0px 0px 5px 2px rgba(197, 197, 197, 0.5);
    box-shadow: 0px 0px 5px 2px rgba(107, 104, 104, 0.5);
    z-index: 999999
    padding:0 !important;
}
.bx-controls {
	display: none;
}
.item-error {
    color: #c54242;
    background: white;
    padding: 10px 20px;
}

.xmedium-h {
	margin-bottom: 30px;
}
.trainings > div {
	min-height: 270px;
}
.view {
   /*float: left;*/
   overflow: hidden;
   position: relative;
   text-align: center;
   cursor: default;

    width: 200px;
    margin: auto;
}
.view .mask,.view .content {
   position: absolute;
   overflow: hidden;
   top: 0;
   left: 0;
}
.view img {
   /*display: block;*/
   /*position: relative;*/
}
.view h2 {
   text-transform: uppercase;
   color: #fff;
   text-align: center;
   position: relative;
   font-size: 17px;
   padding: 10px;
   margin: 20px 0 0 0;
}
.view p {
   font-family: Georgia, serif;
   font-style: italic;
   font-size: 12px;
   position: relative;
   color: #fff;
   padding: 10px 20px 20px;
   text-align: center;
}
.view a.info {
   display: inline-block;
   text-decoration: none;
   padding: 7px 14px;
   background: #000;
   color: #fff;
   text-transform: uppercase;
   -webkit-box-shadow: 0 0 1px #000;
   -moz-box-shadow: 0 0 1px #000;
   box-shadow: 0 0 1px #000;
}
.view a.info: hover {
   -webkit-box-shadow: 0 0 5px #000;
   -moz-box-shadow: 0 0 5px #000;
   box-shadow: 0 0 5px #000;
}
.view-fifth {
	padding:0;
	border: 0;
	background: white;
}
.view-fifth h4 {
	color: black;
	position: absolute;
    bottom: 20px;
    left: 0;
    margin: auto;
    right: 0;
}
.view-fifth h4:hover {
	color: black;
}
.view-fifth:last-child{

}

.view-fifth img {
   -webkit-transition: all 0.3s ease-in-out;
   -moz-transition: all 0.3s ease-in-out;
   -o-transition: all 0.3s ease-in-out;
   -ms-transition: all 0.3s ease-in-out;
   transition: all 0.3s ease-in-out;
}
.view-fifth .mask {
   -webkit-transform: translateX(-300px);
   -moz-transform: translateX(-300px);
   -o-transform: translateX(-300px);
   -ms-transform: translateX(-300px);
   transform: translateX(-300px);
   -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=100)";
   filter: alpha(opacity=100);
   opacity: 1;
   -webkit-transition: all 0.3s ease-in-out;
   -moz-transition: all 0.3s ease-in-out;
   -o-transition: all 0.3s ease-in-out;
   -ms-transition: all 0.3s ease-in-out;
   transition: all 0.3s ease-in-out;
}
.view-fifth h2 {
   color: #000;
}
.view-fifth p {
   -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=0)";
   filter: alpha(opacity=0);
   opacity: 0;
   color: #333;
   -webkit-transition: all 0.2s linear;
   -moz-transition: all 0.2s linear;
   -o-transition: all 0.2s linear;
   -ms-transition: all 0.2s linear;
   transition: all 0.2s linear;
}
.view-fifth:hover .mask {
   -webkit-transform: translateX(0px);
   -moz-transform: translateX(0px);
   -o-transform: translateX(0px);
   -ms-transform: translateX(0px);
   transform: translateX(0px);
}
.view-fifth:hover img {
   -webkit-transform: translateX(300px);
   -moz-transform: translateX(300px);
   -o-transform: translateX(300px);
   -ms-transform: translateX(300px);
   transform: translateX(300px);
}
.view-fifth:hover p {
   -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=100)";
   filter: alpha(opacity=100);
   opacity: 1;
}
</style>
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
	
	var documentHeight = $(window).height();
	var documentWidth = $(window).width();
	var header = $('header').height();

	function form_pendaftaran()
	{
		$('.main-holder').animate({left:'-'+documentWidth+'px'})
		//$('.main-holder').css({width:0})
		$("#iframe_pendaftaran").animate( { right: 0 });
	}
	
	$('.menu-right .item').each(function(){
		$(this).on('mouseenter', function(){
			$(this).find('.sub-title').show().css({width: '200px',paddingLeft: '20px' });
		})
		.on('mouseleave', function(){
			$(this).find('.sub-title').css({width: 0,paddingLeft: 0 });
		});
	});
	
	setTimeout(function(){
		$("#iframe_pendaftaran").height(documentHeight);
		$("#iframe_pendaftaran").css({ right : '-'+documentWidth+'px'});
		$('.forma-slider').height((documentHeight - header - 14));
		console.log(documentHeight);
	});

	function slidetoogle_section_keanggotaan()
	{
		// $('.content_keanggotaan').slideToggle();
	}

	$( ".hover_btn" ).hover(
	  function() {
	    $( this ).find('img').src('{{ asset('background/middle/btn.png') }}');
	  }, function() {
	    $( this ).find('img').src('{{ asset('background/middle/btn_hover.png') }}');
	  }
	);

	@if(Session::has('messages'))
	$("#modal_success").modal('show');
	@endif;

</script>
<style type="text/css">
	@media (min-width: 1281px) {  }
	@media (min-width: 1025px) and (max-width: 1280px) {}
	@media (min-width: 768px) and (max-width: 1024px) {}
	@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {}
	@media (min-width: 481px) and (max-width: 767px) {
	  
	}

	@media (min-width: 320px) and (max-width: 480px) 
	{
	  .content-middle .text-middle {
	  	width: 179px;
	  	top: 2% !important;
	  }
	  .info_kodami_btn {
	  	width: 85px !important;
	  	left: 35% !important;
	  	color: white !important;
	  	bottom: 5% !important;
	  	height: 26px !important;
	  	padding-top: 2px !important;
	  	font-size: 10px !important;
	  }

	  	.trainings .col-md-4 .view-fifth
		{
			background: transparent;
		}
		.trainings .col-md-4 .view {
			margin-bottom: 15px;
			float: none;
		}
		.trainings .col-md-4 .view img {
			display: inline;
		}

		.trainings div.clearfix {
			min-height: 0;
		}
	}

	#slider_bottom .bx-wrapper .bx-controls-direction a {
       margin-top: -9%;
    }
	.info_kodami_btn:hover
	{
		background: transparent;
	}
	.trainings > div
	{
		margin-bottom: 0;
	}
	.thumbnails {
	    background: #f7efef;
	    border: 1px solid #ffffff;
	}
	.trainings i {
		color: #de2c23;
	}

	.xxsmall-h {
		color: white;
	}
	.list-forstart .desc  {
		font: 20px/28px 'OpenSans_Regular',Arial
	}
	 .xmedium-h {
	 	font: 14px/19px 'OpenSans_Regular',Arial	
	 }
	
	/*.list-forstart {
		width: 55%;
	}*/

	.fa-share-alt:before {
	    content: "\f1e0";
	}
</style>
</body>
</html>
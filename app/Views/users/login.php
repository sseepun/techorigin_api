<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<base href="">
		<meta charset="utf-8" />
		<title>ระบบการจัดการเอกสารอัจฉริยะ (IEAT SMART)</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<!--begin::Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;300;400;500&display=swap" rel="stylesheet">

		<!--end::Fonts -->

		<!--begin::Page Vendors Styles(used by this page) -->
		<link href="assets/css/pages/login/login-v1.css" rel="stylesheet" type="text/css" />

		<!--end::Page Vendors Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="assets/media/logos/favicon.png" />
	</head>
	<style>
		.kt-header__brand-logo-default {
			max-height: 70px;
			max-width: 350px;
		}
		.kt-login-v1__section{
			height: 100%;
			width: 50%;
			text-align: center;
			padding: 40px;
			position: fixed;
			left: 0;
			top: 0;
		}
		.kt-login-v1__info{
			font-size:1.5rem;
			margin-bottom: 5px;
			position: absolute;
			left: 0;
			width: 100%;
			top: 30vh;
			transform: translateY(-50%);
			color:#fff!important;
			
			-webkit-transition: all 1.5s cubic-bezier(0.7, 0, 0.3, 1);
			-moz-transition: all 1.5s cubic-bezier(0.7, 0, 0.3, 1);
			-ms-transition: all 1.5s cubic-bezier(0.7, 0, 0.3, 1);
			-o-transition: all 1.5s cubic-bezier(0.7, 0, 0.3, 1);
			transition: all 1.5s cubic-bezier(0.7, 0, 0.3, 1);
		}
		.kt-login-v1__info > p {
			color: rgba(255, 255, 255, 0.6);
			font-weight: 500;
			font-size: 1.2rem;
		}
		.display-block{
			transform: translateY(400%);
			-webkit-transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
			-moz-transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
			-ms-transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
			-o-transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
			transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
		}
		.display-block2{
			transform: translateY(200%);
			-webkit-transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
			-moz-transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
			-ms-transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
			-o-transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
			transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
		}
		.kt-login-v1 .kt-login-v1__body .kt-login-v1__wrapper .kt-login-v1__container .kt-login-v1__actions .btn{
			background-color: #C42B52;
		}
		.kt-login-v1 .kt-login-v1__body{
			padding:0rem 3rem;
		}
		.kt-login-v1 .kt-login-v1__body .kt-login-v1__wrapper .kt-login-v1__container .kt-login-v1__form .form-control{
			background-color: rgba(255,255,255,0.1);
			border: 1px solid rgba(255,255,255,0.5);
		}
		.invalid-feedback{
			color: #C42B52;
		}
		.lockbox{
		background: url('assets/css_lock/lock_bg1.png') center center no-repeat;
      width: 116px;
      height: 128px;
      position: relative;
      margin: 0 auto;
      overflow: hidden;
      background-size: contain;
      margin-top: 15px;
    }
    .lockbox > img{
      position: absolute;
      left: 0;
      right: 0;
      top: -7px;
      bottom: 0;
      margin: auto;
      width: 95px;
	 }
	 .kt-login-v1 .kt-login-v1__body .kt-login-v1__section .kt-login-v1__info{
		margin-right: 5rem;
	 }
	 h1{
		 margin-top: 50px;
	 }
	 .global-overlay{
		position: fixed;
		top: 0;
		left: -250vw;
		height: 100%;
		width: 100%;
		-webkit-transition: all 0.75s cubic-bezier(0.7, 0, 0.3, 1);
		-moz-transition: all 0.75s cubic-bezier(0.7, 0, 0.3, 1);
		-ms-transition: all 0.75s cubic-bezier(0.7, 0, 0.3, 1);
		-o-transition: all 0.75s cubic-bezier(0.7, 0, 0.3, 1);
		transition: all 0.75s cubic-bezier(0.7, 0, 0.3, 1);
	 }
	 .overlay{
		osition: fixed;
		top: 0;
		left: -50%;
		background: rgba(50,58,69,0.9);
		width: 100%;
		height: 100%;
		-webkit-transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
		-moz-transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
		-ms-transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
		-o-transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
		transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
		border-right: 1px solid #15171e;
	 }
	 .overlay.skew-part {
		-webkit-transform: skew(-25deg, 0deg);
		-moz-transform: skew(-25deg, 0deg);
		-ms-transform: skew(-25deg, 0deg);
		-o-transform: skew(-25deg, 0deg);
		transform: skew(-25deg, 0deg);
	}
	</style>
	<!-- end::Head -->

	<!-- begin::Body -->
	<body style="background-image: url(assets/media/misc/bg_1.jpg)" class="kt-login-v1--enabled kt-login-v1--enabled kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">

		<!-- begin::Page loader -->

		<!-- end::Page Loader -->

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid__item  kt-grid__item--fluid kt-grid kt-grid--hor kt-login-v1" id="kt_login_v1">
	 			<div class="global-overlay" style="opacity: 1; transform: translateX(100%);">
	 				<div class="overlay skew-part"></div>
				 </div>

			<!--begin::Item-->
				<div class="kt-login-v1__section">
					<div class="kt-login-v1__info display-block">
						<img alt="Logo" src="assets/media/logos/logo.png" class="kt-header__brand-logo-default">
						<h1 class="">Digital Transformation</h1>
						<h4 >ระบบการจัดการเอกสารอัจฉริยะ (IEAT SMART)</h4>
						<p>การนิคมอุตสาหกรรมแห่งประเทศไทย</p>
					</div>
				</div>

				<!--end::Item-->

				<!--begin::Item-->
				<div class="kt-grid__item  kt-grid kt-grid--ver  kt-grid__item--fluid">

					<!--begin::Body-->
					<div class="kt-login-v1__body">

					

						<!--begin::Separator-->
						<div class="kt-login-v1__seaprator"></div>

						<!--end::Separator-->

						<!--begin::Wrapper-->
						<div class="kt-login-v1__wrapper display-block2">
							<div class="kt-login-v1__container">
								<h3 class="kt-login-v1__title">
									เข้าสู่ระบบ
								</h3>

								<!--begin::Form-->
								<form class="kt-login-v1__form kt-form" action="/" method="post" autocomplete="off">
									<div class="form-group">
										<input class="form-control" type="text" placeholder="อีเมล์" value="smart-office@moe.go.th" name="email" autocomplete="off">
									</div>
									<div class="form-group">
										<input class="form-control KeyAutoLock" type="password" placeholder="รหัสผ่าน" name="password" autocomplete="off">
									</div>
									<div class="kt-login-v1__actions">
										<a href="/register" class="kt-login-v1__forgot">
											ยังไม่มีบัญชีผู้ใช้ ?
										</a>
										<button type="submit" class="btn btn-pill btn-elevate">เข้าสู่ระบบ</button>
									</div>
									<div class="lockbox">
										<img id="imgRotate" src="assets/css_lock/strongbox.png" alt="strongbox">
									</div>
								</form>

								<!--end::Form-->

							</div>
						</div>

						<!--end::Wrapper-->
					</div>

					<!--begin::Body-->
				</div>

				<!--end::Item-->

				
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#4d5cf2",
						"metal": "#c4c5d6",
						"light": "#ffffff",
						"accent": "#00c5dc",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995",
						"focus": "#9816f4"
					},
					"base": {
						"label": [
							"#c5cbe3",
							"#a1a8c3",
							"#3d4465",
							"#3e4466"
						],
						"shape": [
							"#f0f3ff",
							"#d9dffa",
							"#afb4d4",
							"#646c9a"
						]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
		<!-- <script src="assets/js/scripts.bundle.js" type="text/javascript"></script> -->

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts(used by this page) -->
		<!-- <script src="assets/js/pages/custom/user/login.js" type="text/javascript"></script> -->
		<!-- <script src="assets/css_lock/jQueryRotate.js"></script> -->
        <script>
			  	function showpanel(){
					$('.global-overlay').css("left","-150vw");
				}
				function rotate(){
					$('.overlay').css({
						'-moz-transform':'rotate(0deg)',
						'-webkit-transform':'rotate(0deg)',
						'-o-transform':'rotate(0deg)',
						'-ms-transform':'rotate(0deg)',
						'transform': 'rotate(0deg)'
					});  
					setTimeout(showtext, 500);
				}
				function showtext(){
					$('.display-block').css({
						transform: 'translateY(0%)'
					});
					setTimeout(showtext2, 250);
				}
				function showtext2(){
					$('.display-block2').css({
						transform: 'translateY(0%)'
					});
				}
            jQuery(document).ready(function($) {
					var lastKey = 0;
					$(".KeyAutoLock").keypress(function(event) {
						var nRand = Math.floor((Math.random() * 360) + 1);
						$('#imgRotate').rotate({
							angle: lastKey,
							animateTo:nRand,
							easing: $.easing.easeInOutBack
							});
						lastKey = nRand;
					});

					setTimeout(showpanel, 750);
					setTimeout(rotate, 1500);
            });
        </script>
		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>
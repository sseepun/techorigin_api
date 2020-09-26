<!DOCTYPE html>
<html lang="en">
<head>
	<base href="">
	<meta charset="utf-8" />
	<title>ระบบการจัดการเอกสารอัจฉริยะ (IEAT SMART)</title>
	<meta name="description" content="Latest updates and statistic charts">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="shortcut icon" href="/assets/media/logos/favicon.png" />

	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;300;400;500&display=swap" />

	<link rel="stylesheet" type="text/css" href="/assets/css/pages/login/login-v1.css" />
	<link rel="stylesheet" type="text/css" href="/assets/plugins/global/plugins.bundle.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/style.bundle.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/auth-page.css" />
</head>
<body class="kt-login-v1--enabled kt-login-v1--enabled kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading" style="background-image:url('/assets/media/misc/bg_1.jpg')">

	<div class="kt-grid kt-grid--ver kt-grid--root">
		<div class="kt-grid__item  kt-grid__item--fluid kt-grid kt-grid--hor kt-login-v1" id="kt_login_v1">
			
			<div class="global-overlay" style="opacity:1; transform:translateX(100%);">
				<div class="overlay skew-part"></div>
			</div>

			<div class="kt-login-v1__section">
				<div class="kt-login-v1__info display-block">
					<img alt="Logo" src="/assets/media/logos/logo.png" class="kt-header__brand-logo-default">
					<h1 class="">Digital Transformation</h1>
					<h4 >ระบบการจัดการเอกสารอัจฉริยะ (IEAT SMART)</h4>
					<p>การนิคมอุตสาหกรรมแห่งประเทศไทย</p>
				</div>
			</div>

			<div class="kt-grid__item  kt-grid kt-grid--ver  kt-grid__item--fluid">
				<div class="kt-login-v1__body">
					<div class="kt-login-v1__seaprator"></div>
					<div class="kt-login-v1__wrapper display-block2">
						<div class="kt-login-v1__container">
							<h3 class="kt-login-v1__title">
								เข้าสู่ระบบ
							</h3>
							<form class="kt-login-v1__form kt-form" action="/" method="post" autocomplete="off">
								<div class="form-group">
									<input class="form-control" type="text" placeholder="ชื่อผู้ใช้ / อีเมล์" value="SuperAdmin" 
									name="username" autocomplete="off" required />
								</div>
								<div class="form-group">
									<input class="form-control KeyAutoLock" type="password" placeholder="รหัสผ่าน" 
									name="password" autocomplete="off" required />
								</div>
								<div class="kt-login-v1__actions">
									<a href="/register" class="kt-login-v1__forgot">
										ยังไม่มีบัญชีผู้ใช้ ?
									</a>
									<button type="submit" class="btn btn-pill btn-elevate">เข้าสู่ระบบ</button>
								</div>
								<div class="lockbox">
									<img id="imgRotate" src="/assets/css_lock/strongbox.png" alt="strongbox">
								</div>
							</form>
							<?php if(isset($validation)){?>
								<div class="col-12">
									<div class="alert alert-danger" role="alert">
										<?= $validation->listErrors(); ?>
									</div>
								</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>

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

	<script type="text/javascript" src="/assets/plugins/global/plugins.bundle.js"></script>
	<script type="text/javascript" src="/assets/js/scripts.bundle.js"></script>
	<script type="text/javascript" src="/assets/js/pages/custom/user/login.js"></script>
	<script src="/assets/css_lock/jQueryRotate.js"></script>
	<script>
		function showpanel(){
			$('.global-overlay').css('left', '-100vw');
		}
		function rotate(){
			$('.overlay').css({
				'-moz-transform': 'rotate(0deg)',
				'-webkit-transform': 'rotate(0deg)',
				'-o-transform': 'rotate(0deg)',
				'-ms-transform': 'rotate(0deg)',
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
		$(document).ready(function($) {
			var lastKey = 0;
			$('.KeyAutoLock').keypress(function(event) {
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
</body>
</html>

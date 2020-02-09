<!DOCTYPE html>

<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>تسجيل الدخول</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
				google: {
					"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
				},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>

		<!--end::Web font -->

		<!--begin::Base Styles -->
		<link href="/admin/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="/admin/assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
		<link href="/admin/assets/demo/demo6/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="/admin/assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Base Styles -->
		<link rel="shortcut icon" href="/admin/assets/demo/demo6/media/img/logo/favicon.ico" />

	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1" id="m_login" style="background-image: url(/admin/assets/app/media/img//bg/bg-1.jpg);">
				<div class="m-grid__item m-grid__item--fluid m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img alt="" src="/admin/assets/demo/demo1/media/img/logo/logo.png" />
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">تسجيل الدخول</h3>
							</div>
			        	<form class="m-login__form m-form" action="/admin/adminlogin" method="post">
                                {{ csrf_field() }}
                                @if(\Illuminate\Support\Facades\Session::has('danger'))
                                <div class="alert alert-danger">
                                    <button class="close pt-1" data-close="alert"></button>
                                    <span>  {{ \Illuminate\Support\Facades\Session::get('danger') }} </span>
                                    </div>
                                @endif
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text"  autocomplete="off" placeholder="اسم المستخدم" name="username" required>
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" type="password" autocomplete="off" placeholder="كلمة المرور" name="password" required>
								</div>
								<div class="row m-login__form-sub">
									
									
								</div>
								<div class="m-login__form-action">
									<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary">تسجيل الدخول</button>
								</div>
							</form>
						</div>
				
					
						
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!--begin::Base Scripts -->
		<script src="/admin/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="/admin/assets/demo/demo6/base/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Base Scripts -->

		<!--begin::Page Snippets -->

		<!--end::Page Snippets -->
	</body>

	<!-- end::Body -->
</html>

<!DOCTYPE html>
<html lang="en" dir="rtl">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="dashboard, admin, bootstrap admin template, codeigniter, php, php framework, codeigniter 4, php mvc, php codeigniter, best php framework, codeigniter admin, codeigniter dashboard, admin panel template, bootstrap 4 admin template, bootstrap dashboard template"/>

		<!-- Title -->
		<title> Valex -  Premium dashboard ui bootstrap rwd admin html5 template </title>

		<!-- Favicon -->
		<link rel="icon" href="{{ asset('back') }}/assets/img/brand/favicon.png" type="image/x-icon"/>

		<!-- Bootstrap css-->
		<link href="{{ asset('back') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

		<!-- Icons css -->
		<link href="{{ asset('back') }}/assets/css-rtl/icons.css" rel="stylesheet">

        <!-- P-scroll bar css remove in final -->
		<link href="{{ asset('back') }}/assets/plugins/perfect-scrollbar/p-scrollbar.css" rel="stylesheet" />

		<!-- Style css -->
		<link href="{{ asset('back') }}/assets/css-rtl/style.css" rel="stylesheet">

		<!-- Dark-mode css -->
		<link href="{{ asset('back') }}/assets/css-rtl/style-dark.css" rel="stylesheet">

        
		<!---Skinmodes css-->
		<link href="{{ asset('back') }}/assets/css-rtl/skin-modes.css" rel="stylesheet" />

		<!---Switcher css-->
		<link href="{{ asset('back') }}/assets/switcher/css/switcher-rtl.css" rel="stylesheet">
		<link href="{{ asset('back') }}/assets/switcher/demo.css" rel="stylesheet">

		<link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Cairo:slnt,wght@11,200..1000&family=Changa:wght@200..800&display=swap" rel="stylesheet">

		<style>
			@font-face {
				font-family: "4_F4";
				src: url("{{ asset('back/fonts/4_F4.ttf') }}");
			}
			body{
				/* font-family: Arial, Helvetica, sans-serif, serif; */
				/* font-family: "4_F4", serif; */
				font-family: Almarai;
				
			}

		</style>
    </head>
	<body class="main-body">
			
                <!-- Start Switcher -->
        <div class="switcher-wrapper ">
			<div class="demo_changer">
				<div class="demo-icon bg_dark"><i class="fa fa-cog fa-spin  text_primary"></i></div>
				<div class="form_holder sidebar-right1">
					<div class="row">
						<div class="swichermainleft border-bottom  text-center">
							<div class="p-3">
								<a href="https://www.spruko.com/demo/valex/" class="btn btn-primary btn-block mt-0">View Demo</a>
								<a href="https://themeforest.net/item/valex-bootstrap-admin-dashboard-html-template/26645744" class="btn btn-secondary btn-block">Buy Now</a>
								<a href="https://themeforest.net/user/sprukosoft/portfolio" class="btn btn-success btn-block">Our Portfolio</a>
							</div>
						</div>
						<div class="predefined_styles">
							<div class="swichermainleft">
								<h4>Navigation Style</h4>
								<div class="pl-3 pr-3">
									<a href="{{ asset('back') }}/../pages/horizontal-light.html" class="btn btn-danger btn-block mt-0">Horizontal</a>
									<a href="{{ asset('back') }}/../pages/icon-light.html" class="btn btn-info btn-block">Left-menu</a>
								</div>
							</div>
							<div class="swichermainleft">
								<h4>Skin Modes</h4>
								<div class="pl-0 pr-0">
									<a class="wscolorcode blackborder nav-hor navstyle1" href="{{ asset('back') }}/../pages/icon-light.html">
										Light-theme
									</a>
									<a class="wscolorcode blackborder nav-hor navstyle1" href="{{ asset('back') }}/../pages/icon-dark.html">
										Dark-theme
									</a>
								</div>
							</div>
							<div class="swichermainleft">
								<h4>Skin Modes</h4>
								<div class="switch_section">
									<div class="switch-toggle d-flex">
										<span class="ml-auto">Default Body</span>
										<div class="onoffswitch2"><input type="radio" name="onoffswitch" id="myonoffswitch7" class="onoffswitch2-checkbox" checked>
											<label for="myonoffswitch7" class="onoffswitch2-label"></label>
										</div>
									</div>
									<div class="switch-toggle d-flex">
										<span class="ml-auto">Body Style1</span>
										<div class="onoffswitch2"><input type="radio" name="onoffswitch" id="myonoffswitch6" class="onoffswitch2-checkbox">
											<label for="myonoffswitch6" class="onoffswitch2-label"></label>
										</div>
									</div>
								</div>
							</div>
							<div class="swichermainleft">
								<h4>Leftmenu Bg-Image</h4>
								<div class="skin-body light-pattern">
									<button type="button" id="leftmenuimage1" class="bg1 wscolorcode1 blackborder"></button>
									<button type="button" id="leftmenuimage2" class="bg2 wscolorcode1 blackborder"></button>
									<button type="button" id="leftmenuimage3" class="bg3 wscolorcode1 blackborder"></button>
									<button type="button" id="leftmenuimage4" class="bg4 wscolorcode1 blackborder"></button>
									<button type="button" id="leftmenuimage5" class="bg5 wscolorcode1 blackborder"></button>
								</div>
							</div>
							<div class="swichermainleft">
								<h4>Leftmenu Styles</h4>
								<div class="switch_section">
									<div class="switch-toggle horizontal-light-switcher d-flex">
										<span class="ml-auto">Leftmenu Light</span>
										<div class="onoffswitch2"><input type="radio" name="onoffswitch3" id="myonoffswitch9" class="onoffswitch2-checkbox">
											<label for="myonoffswitch9" class="onoffswitch2-label"></label>
										</div>
									</div>
									<div class="switch-toggle d-flex">
										<span class="ml-auto">Leftmenu Color</span>
										<div class="onoffswitch2"><input type="radio" name="onoffswitch3" id="myonoffswitch10" class="onoffswitch2-checkbox">
											<label for="myonoffswitch10" class="onoffswitch2-label"></label>
										</div>
									</div>
									<div class="switch-toggle horizontal-Dark-switcher d-flex">
										<span class="ml-auto">Leftmenu Dark</span>
										<div class="onoffswitch2"><input type="radio" name="onoffswitch3" id="myonoffswitch11" class="onoffswitch2-checkbox">
											<label for="myonoffswitch11" class="onoffswitch2-label"></label>
										</div>
									</div>
									<div class="switch-toggle d-flex">
										<span class="ml-auto">Leftmenu Gradient Color</span>
										<div class="onoffswitch2"><input type="radio" name="onoffswitch3" id="myonoffswitch12" class="onoffswitch2-checkbox">
											<label for="myonoffswitch12" class="onoffswitch2-label"></label>
										</div>
									</div>
									<div class="switch-toggle d-flex">
										<span class="ml-auto">Reset Leftmenu Styles</span>
										<div class="onoffswitch2"><input type="radio" name="onoffswitch3" id="myonoffswitch13" class="onoffswitch2-checkbox">
											<label for="myonoffswitch13" class="onoffswitch2-label"></label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Switcher -->
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{ asset('back') }}/assets/img/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->

        
		<!-- Page -->
		<div class="error-page1 bg-light">
			<div class="page">

				<div class="container-fluid">
					<div class="row no-gutter">						
						
						<div class="col-md-6 col-lg-6 col-xl-5 bg-gray">
							<div class="login d-flex align-items-center py-2">
								<!-- Demo content-->
								<div class="container p-0">
									<div class="row">
										<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
											<div class="card-sigin">
												<div class="mb-5 d-flex">
													<a href="index.html"><img src="{{ asset('back/images/settings/logo.png') }}" class="sign-favicon ht-60" alt="logo"></a>
													<h1 class="main-logo1 mr-1 mr-0 my-auto tx-22" style="padding-top: 14px;">أكاديمية اديوستديج</h1>
												</div>

												<div class="card-sigin">
													<div class="main-signup-header">
														<h2 style="font-size: 23px;">مرحباً بك مرة أخرى!</h2>
														<h5 class="font-weight-semibold mb-4" style="font-size: 17px;">يرجى تسجيل الدخول للمتابعة.</h5>
														<form action="#">
															<div class="form-group">
																<label>البريد الإلكتروني</label> <input class="form-control" placeholder="البريد الإلكتروني" type="text">
															</div>
															<div class="form-group">
																<label>الرقم السري</label> <input class="form-control" placeholder="الرقم السري" type="password">
															</div><button class="btn btn-main-primary btn-block">تسجيل الدخول</button>

														</form>
														<div class="main-signin-footer mt-5">
															<p><a href="#">نسيت كلمة المرور ؟</a></p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div><!-- End -->
							</div>
						</div>
						
						<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent" style="background: #fff !important;">
							<div class="row wd-100p mx-auto text-center">
								<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
									<img src="{{ asset('back/images/settings/login6.jpg') }}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
								</div>
							</div>
						</div>
						
					</div>
				</div>

			</div>
		</div>
		<!-- End Page -->

	
        		<!-- JQuery min js -->
		<script src="{{ asset('back') }}/assets/plugins/jquery/jquery.min.js"></script>

		<!-- Bootstrap js -->
        <script src="{{ asset('back') }}/assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="{{ asset('back') }}/assets/plugins/bootstrap/js/bootstrap-rtl.js"></script>

		<!-- Ionicons js -->
		<script src="{{ asset('back') }}/assets/plugins/ionicons/ionicons.js"></script>

		<!-- P-scroll js Remove in final -->
		<script src="{{ asset('back') }}/assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js"></script>
		<script src="{{ asset('back') }}/assets/plugins/perfect-scrollbar/p-scroll-rtl.js"></script>

		<!-- eva-icons js -->
		<script src="{{ asset('back') }}/assets/js/eva-icons.min.js"></script>

		<!-- Rating js-->
		<script src="{{ asset('back') }}/assets/plugins/rating/jquery.rating-stars.js"></script>
		<script src="{{ asset('back') }}/assets/plugins/rating/jquery.barrating.js"></script>

        
		<!-- custom js -->
		<script src="{{ asset('back') }}/assets/js/custom.js"></script>

		<!-- Switcher js -->
		<script src="{{ asset('back') }}/assets/switcher/js/switcher-rtl.js"></script>

    </body>

<!-- Mirrored from codeigniter.spruko.com/valex/rtl/public/pages/signin by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jan 2022 09:50:18 GMT -->
</html>
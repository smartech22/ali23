
<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<title>car come</title>
		<link rel="shortcut icon" href="front_end/assets/images/logo/favourite_icon.png">

		<!-- fraimwork - css include -->
		<link rel="stylesheet" type="text/css" href="front_end/assets/css/bootstrap.min.css">

		<!-- icon - css include -->
		<link rel="stylesheet" type="text/css" href="front_end/assets/css/fontawesome.css">

		<!-- animation - css include -->
		<link rel="stylesheet" type="text/css" href="front_end/assets/css/aos.css">
		<link rel="stylesheet" type="text/css" href="front_end/assets/css/animate.css">

		<!-- carousel - css include -->
		<link rel="stylesheet" type="text/css" href="front_end/assets/css/slick.css">
		<link rel="stylesheet" type="text/css" href="front_end/assets/css/slick-theme.css">

		<!-- popup - css include -->
		<link rel="stylesheet" type="text/css" href="front_end/assets/css/magnific-popup.css">

		<!-- select options - css include -->
		<link rel="stylesheet" type="text/css" href="front_end/assets/css/nice-select.css">

		<!-- pricing range - css include -->
		<link rel="stylesheet" type="text/css" href="front_end/assets/css/jquery-ui.css">

		<!-- custom - css include -->
		<link rel="stylesheet" type="text/css" href="front_end/assets/css/style.css">

	</head>


	<body>


		<!-- backtotop - start -->
		<div id="thetop"></div>
		<div class="backtotop">
			<a href="#" class="scroll">
				<i class="far fa-arrow-up"></i>
			</a>
		</div>
		<!-- backtotop - end -->

		<!-- preloader - start -->
		<div class="preloader">
			<div class="animation_preloader">
				<div class="spinner"></div>
				<p class="text-center">Loading</p>
			</div>
			<div class="loader">
				<div class="row vh-100">
					<div class="col-3 loader_section section-left">
						<div class="bg"></div>
					</div>
					<div class="col-3 loader_section section-left">
						<div class="bg"></div>
					</div>
					<div class="col-3 loader_section section-right">
						<div class="bg"></div>
					</div>
					<div class="col-3 loader_section section-right">
						<div class="bg"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- preloader - end -->


		<!-- header_section - start
		================================================== -->
		<header class="header_section sticky text-white clearfix">
			<div class="header_top clearfix">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-7">
							<ul class="header_contact_info ul_li clearfix">
								<li><i class="fal fa-envelope"></i> carcomemail@email.com</li>
								<li><i class="fal fa-phone"></i> +1-202-555-0156</li>
							</ul>
						</div>

						<div class="col-lg-5">
							<ul class="primary_social_links ul_li_right clearfix">
								<li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#!"><i class="fab fa-instagram"></i></a></li>
								<li><a href="#!"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#!"><i class="fab fa-youtube"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="header_bottom clearfix">
				<div class="container">
					<div class="row align-items-center">

						<div class="col-lg-3 col-md-6 col-sm-6 col-6">
							<div class="brand_logo">
								<a href="index.html">
									<img src="front_end/assets/images/logo/logo_01_1x.png" srcset="front_end/assets/images/logo/logo_01_2x.png 2x" alt="logo_not_found">
									<img src="front_end/assets/images/logo/logo_02_1x.png" srcset="front_end/assets/images/logo/logo_02_2x.png 2x" alt="logo_not_found">
								</a>
							</div>
						</div>

						<div class="col-lg-3 col-md-6 col-sm-6 col-6 order-last">
							<ul class="header_action_btns ul_li_right clearfix">
								<li>
									<button type="button" class="search_btn" data-toggle="collapse" data-target="#collapse_search_body" aria-expanded="false" aria-controls="collapse_search_body">
										<i class="fal fa-search"></i>
									</button>
								</li>

								<li class="dropdown">
									<button type="button" class="user_btn" id="user_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fal fa-user"></i>
									</button>
									<div class="user_dropdown rotors_dropdown dropdown-menu clearfix" aria-labelledby="user_dropdown">
										<div class="profile_info clearfix">
											<a href="#!" class="user_thumbnail">
												<img src="front_end/assets/images/meta/img_01.png" alt="thumbnail_not_found">
											</a>
											<div class="user_content">
											@guest
												@if (Route::has('login'))
												<h4 class="user_name"><a href="#!">wellcome</a></h4>
												@endif
												@else
												<h4 class="user_name"><a href="#!">{{$user->name}}</a></h4>
											@endguest
												<span class="user_title">Seller</span>
											</div>
										</div>
										<ul class="ul_li_block clearfix">
											<li><a href="#!"><i class="fal fa-user-circle"></i> Profile</a></li>
											<li><a href="#!"><i class="fal fa-user-cog"></i> Settings</a></li>
											<li><a href="/login"><i class="fal fa-sign-out"></i> login</a></li>
										</ul>
									</div>
								</li>
								<li>
									<button type="button" class="mobile_sidebar_btn"><i class="fal fa-align-right"></i></button>
								</li>
							</ul>
						</div>

						<div class="col-lg-6 col-md-12">
							<nav class="main_menu clearfix">
								<ul class="ul_li_center clearfix">
									<li class="active has_child">
										<a href="#!">Home</a>
										<ul class="submenu">
											<li><a href="/">Home Page V.1</a></li>
											<li><a href="/index2">Home Page V.2</a></li>
										</ul>
									</li>
									<li><a href="/gallery">Our Cars</a></li>
									<li><a href="/allReview">Reviews</a></li>
									<li><a href="/about">About</a></li>
									<li class="has_child">
										<a href="#!">Pages</a>
										<ul class="submenu">
											<li><a href="service.html">Our Service</a></li>
											<li><a href="gallery.html">Car Gallery</a></li>
											<li><a href="account.html">My Account</a></li>
											<li><a href="reservation.html">Reservation</a></li>
											<li class="has_child">
												<a href="#!">Blogs</a>
												<ul class="submenu">
													<li><a href="blog.html">Blog</a></li>
													<li><a href="blog_details.html">Blog Details</a></li>
												</ul>
											</li>
											<li class="has_child">
												<a href="#!">Our Cars</a>
												<ul class="submenu">
													<li><a href="car.html">Cars</a></li>
													<li><a href="car_details.html">Car Details</a></li>
												</ul>
											</li>
											<li><a href="faq.html">F.A.Q.</a></li>
											@guest
                                                   @if (Route::has('login'))
												   <li><a href="/showAddLogin"><i class="fal fa-sign-out"></i> login</a></li>
                                                    @endif
                                                    @else
													<li><a href="/logout"><i class="fal fa-sign-out"></i> logout</a></li>
											@endguest
										</ul>
									</li>
									<li class="has_child">
										<a href="#!">Contact Us</a>
										<ul class="submenu">
											<li><a href="contact.html">Contact Default</a></li>
											<li><a href="contact_wordwide.html">Contact Wordwide</a></li>
										</ul>
									</li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>

			<div id="collapse_search_body" class="collapse_search_body collapse">
				<div class="search_body">
					<div class="container">
					<form method="POST" enctype="multipart/form-data" action="/search">
							@csrf
							<div class="form_item">
								<input type="search" name="name" placeholder="Type here...">
								<button type="submit"><i class="fal fa-search"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</header>
		<!-- header_section - end
		================================================== -->


		<!-- main body - start
		================================================== -->
		<main>


			<!-- mobile menu - start
			================================================== -->
			<div class="sidebar-menu-wrapper">
				<div class="mobile_sidebar_menu">
					<button type="button" class="close_btn"><i class="fal fa-times"></i></button>

					<div class="about_content mb_60">
						<div class="brand_logo mb_15">
							<a href="index.html">
								<img src="front_end/assets/images/logo/logo_01_1x.png" srcset="front_end/assets/images/logo/logo_01_2x.png 2x" alt="logo_not_found">
							</a>
						</div>
						<p class="mb-0">
							Nullam id dolor auctor, dignissim magna eu, mattis ante. Pellentesque tincidunt, elit a facilisis efficitur, nunc nisi scelerisque enim, rhoncus malesuada est velit a nulla. Cras porta mi vitae dolor tristique euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit
						</p>
					</div>

					<div class="menu_list mb_60 clearfix">
						<h3 class="title_text text-white">Menu List</h3>
						<ul class="ul_li_block clearfix">
							<li class="active dropdown">
								<a href="#!" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home</a>
								<ul class="dropdown-menu">
									<li><a href="/">Home Page V.1</a></li>
									<li><a href="/index2">Home Page V.2</a></li>
								</ul>
							</li>
							<li><a href="/gallery">Our Cars</a></li>
							<li><a href="/allReview">Reviews</a></li>
							<li><a href="/about">About</a></li>
							<li class="dropdown">
								<a href="#!" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
								<ul class="dropdown-menu">
									<li><a href="service.html">Our Service</a></li>
									<li><a href="gallery.html">Car Gallery</a></li>
									<li><a href="account.html">My Account</a></li>
									<li><a href="reservation.html">Reservation</a></li>
									<li class="dropdown">
										<a href="#!" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blogs</a>
										<ul class="dropdown-menu">
											<li><a href="blog.html">Blog</a></li>
											<li><a href="blog_details.html">Blog Details</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#!" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Our Cars</a>
										<ul class="dropdown-menu">
											<li><a href="car.html">Cars</a></li>
											<li><a href="car_details.html">Car Details</a></li>
										</ul>
									</li>
									<li><a href="faq.html">F.A.Q.</a></li>
									<li><a href="login.html">Login</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#!" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Contact Us</a>
								<ul class="dropdown-menu">
									<li><a href="contact.html">Contact Default</a></li>
									<li><a href="contact_wordwide.html">Contact Wordwide</a></li>
								</ul>
							</li>
						</ul>
					</div>

					<div class="booking_car_form">
						<h3 class="title_text text-white mb-2">Book A Car</h3>
						<p class="mb_15">
							Nullam id dolor auctor, dignissim magna eu, mattis ante. Pellentesque tincidunt, elit a facilisis efficitur.
						</p>
						<form action="#">
							<div class="form_item">
								<h4 class="input_title text-white">Pick Up Location</h4>
								<div class="position-relative">
									<input id="location_one" type="text" name="location" placeholder="City, State or Airport Code">
									<label for="location_one" class="input_icon"><i class="fas fa-map-marker-alt"></i></label>
								</div>
							</div>
							<div class="form_item">
								<h4 class="input_title text-white">Pick A Date</h4>
								<input type="date" name="date">
							</div>
							<button type="submit" class="custom_btn bg_default_red btn_width text-uppercase">Book A Car <img src="front_end/assets/images/icons/icon_01.png" alt="icon_not_found"></button>
						</form>
					</div>

				</div>
				<div class="overlay"></div>
			</div>
			<!-- mobile menu - end
			================================================== -->

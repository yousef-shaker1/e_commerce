<div class="logo-carousel-section">
	<div class="container">
			<div class="row">
					<div class="col-lg-12">
							<div class="logo-carousel-inner">
									<div class="single-logo-item">
											<img src="{{ URL::asset('assets/img/company-logos/1.png') }}" alt="">
									</div>
									<div class="single-logo-item">
											<img src="{{ URL::asset('assets/img/company-logos/2.png') }}" alt="">
									</div>
									<div class="single-logo-item">
											<img src="{{ URL::asset('assets/img/company-logos/3.png') }}" alt="">
									</div>
									<div class="single-logo-item">
											<img src="{{ URL::asset('assets/img/company-logos/4.png') }}" alt="">
									</div>
									<div class="single-logo-item">
											<img src="{{ URL::asset('assets/img/company-logos/5.png') }}" alt="">
									</div>
							</div>
					</div>
			</div>
	</div>
</div>
<!-- footer -->
<div class="footer-area">
	<div class="container">
			<div class="row">
					<div class="col-lg-3 col-md-6">
							<div class="footer-box about-widget">
									<h2 class="widget-title">{{ __('page.About') }}</h2>
									<p>{{ __('page.About_Store_Description') }}</p>
							</div>
					</div>
					<div class="col-lg-3 col-md-6">
							<div class="footer-box get-in-touch">
									<h2 class="widget-title">{{ __('page.Contact_Us') }}</h2>
									<ul>
											<li>{{ __('page.Store_Address') }}</li>
											<li>youssefshaker2cool@gmail.com</li>
											<li>+20 01101336383</li>
									</ul>
							</div>
					</div>
					<div class="col-lg-3 col-md-6">
							<div class="footer-box pages">
									<h2 class="widget-title">{{ __('page.Pages') }}</h2>
									<ul>
											<li><a href="{{ route('home') }}">{{ __('page.Home') }}</a></li>
											<li><a href="{{ route('about') }}">{{ __('page.About') }}</a></li>
											<li><a href="{{ route('shop') }}">{{ __('page.Shop') }}</a></li>
											<li><a href="{{ route('contact') }}">{{ __('page.Contact') }}</a></li>
									</ul>
							</div>
					</div>
					<div class="col-lg-3 col-md-6">
							<div class="footer-box subscribe">
									<h2 class="widget-title">{{ __('page.Subscribe') }}</h2>
									<p>{{ __('page.Subscribe_Message') }}</p>
									<form action="" method="POST">
											@csrf
											<input type="email" name="email" placeholder="{{ __('page.Enter_Email') }}">
											<button type="submit"><i class="fas fa-paper-plane"></i></button>
									</form>
							</div>
					</div>
			</div>
	</div>
</div>
<!-- end footer -->

<!-- copyright -->
<div class="copyright">
	<div class="container">
			<div class="row">
					<div class="col-lg-6 col-md-12">
							<p>Copyrights &copy; {{ date('Y') }} - <a href="{{ route('home') }}">{{ __('page.Store_Name') }}</a>, {{ __('page.All_Rights_Reserved') }}</p>
					</div>
					<div class="col-lg-6 text-right col-md-12">
							<div class="social-icons">
									<ul>
											<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
											<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
											<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
											<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
									</ul>
							</div>
					</div>
			</div>
	</div>
</div>

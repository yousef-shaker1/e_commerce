@extends('layouts.empty')

@section('title')
about
@endsection

@section('css')
<style>
  .breadcrumb-section:after {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  content: "";
  background-image: url("/assets/img/about3.png"); /* تأكد من أن المسار صحيح */
  background-size: cover; /* تجعل الصورة تغطي العنصر بالكامل */
  background-position: center; /* تضبط الصورة في المركز */
  z-index: -1;
  opacity: 0.8;
}
</style>
@endsection


@section('content')
<div class="loader">
	<div class="loader-inner">
			<div class="circle"></div>
	</div>
</div>
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>We sale fresh fruits</p>
						<h1>About Us</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- featured section -->
	<div class="feature-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-7">
					<div class="featured-text">
						<h2 class="pb-3">Why <span class="orange-text">Fruitkha</span></h2>
						<div class="row">
							<div class="col-lg-6 col-md-6 mb-4 mb-md-5">
								<div class="list-box d-flex">
									<div class="list-icon">
										<i class="fas fa-shipping-fast"></i>
									</div>
									<div class="content">
										<h3>Home Delivery</h3>
										<p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 mb-5 mb-md-5">
								<div class="list-box d-flex">
									<div class="list-icon">
										<i class="fas fa-money-bill-alt"></i>
									</div>
									<div class="content">
										<h3>Best Price</h3>
										<p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 mb-5 mb-md-5">
								<div class="list-box d-flex">
									<div class="list-icon">
										<i class="fas fa-briefcase"></i>
									</div>
									<div class="content">
										<h3>Custom Box</h3>
										<p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="list-box d-flex">
									<div class="list-icon">
										<i class="fas fa-sync-alt"></i>
									</div>
									<div class="content">
										<h3>Quick Refund</h3>
										<p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end featured section -->

	<!-- shop banner -->
	<section class="shop-banner">
    	<div class="container">
        	<h3>December sale is on! <br> with big <span class="orange-text">Discount...</span></h3>
            <div class="sale-percent"><span>Sale! <br> Upto</span>50% <span>off</span></div>
            <a href="shop.html" class="cart-btn btn-lg">Shop Now</a>
        </div>
    </section>
	<!-- end shop banner -->

	<!-- testimonail-section -->

	<div class="testimonail-section mt-80 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="testimonial-sliders">
						@foreach ($messages as $message)
						<div class="single-testimonial-slider">
							<div class="client-avater">
							</div>
							<div class="client-meta">
								<h3>{{ $message->customer->name }}<h4></h4></h3>
								<p class="testimonial-body">
									{{ $message->message }}
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
						@endforeach
						

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end testimonail-section -->

	<!-- logo carousel -->
	<div class="logo-carousel-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="logo-carousel-inner">
						<div class="single-logo-item">
							<img src="assets/img/company-logos/1.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/2.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/3.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/4.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/5.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('js')

@endsection
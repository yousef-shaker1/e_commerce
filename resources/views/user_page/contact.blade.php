@extends('layouts.empty')

@section('title')
contact
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
  background-image: url("/assets/img/shop3.png"); /* تأكد من أن المسار صحيح */
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
						<p>Get 24/7 Support</p>
						<h1>Contact us</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- contact form -->
	<div class="contact-from-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mb-5 mb-lg-0">
					<div class="form-title">
						@if (session()->has('Add'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>{{ session()->get('Add') }}</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
								</button>
						</div>
						@endif
						<h2>Please write your opinion about using the site: </h2>
						
					</div>
				 	<div id="form_status"></div>
					<div class="contact-form">
						<form method="POST" action="{{ route('mesage_customer') }}" id="fruitkha-contact" onSubmit="return valid_datas( this );">
							@csrf
							<p><textarea name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea></p>
							<input type="hidden" name="token" value="FsWga4&@f6aw" />
							<p><input type="submit" value="Submit"></p>
						</form>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="contact-form-wrap">
						<div class="contact-form-box">
							<h4><i class="fas fa-map"></i> Shop Address</h4>
							<p>34/8, East Hukupara <br> Gifirtok, Sadan. <br> Country Name</p>
						</div>
						<div class="contact-form-box">
							<h4><i class="far fa-clock"></i> Shop Hours</h4>
							<p>MON - FRIDAY: 8 to 9 PM <br> SAT - SUN: 10 to 8 PM </p>
						</div>
						<div class="contact-form-box">
							<h4><i class="fas fa-address-book"></i> Contact</h4>
							<p>Phone: +20 01101336383 <br> Email: youssefshaker2cool@gmail.com</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end contact form -->

	<!-- find our location -->
	<div class="find-location blue-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<p> <i class="fas fa-map-marker-alt"></i> Find Our Location</p>
				</div>
			</div>
		</div>
	</div>
	<!-- end find our location -->

@endsection

@section('js')

@endsection
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
  background-image: url("/assets/img/shop3.png"); 
  background-size: cover; 
  background-position: center;
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
						<h1>{{ __('page.Contact') }}</h1>
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
						<h2>{{ __('page.Opinion_Request') }}</h2>
						
					</div>
				 	<div id="form_status"></div>
					<div class="contact-form">
						<form method="POST" action="{{ route('mesage_customer') }}" id="fruitkha-contact" onSubmit="return valid_datas( this );">
							@csrf
							<p><textarea name="message" id="message" cols="30" rows="10" placeholder="{{ __('page.Message') }}" ></textarea></p>
							<input type="hidden" name="token" value="FsWga4&@f6aw" />
							<p><input type="submit" value="{{ __('page.Submit') }}"></p>
						</form>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="contact-form-wrap">
						<div class="contact-form-box">
							<h4><i class="fas fa-map"></i> {{ __('page.Shop_Address') }}</h4>
							<p>{{ __('page.Shop_Address_Details') }}</p>
						</div>
						<div class="contact-form-box">
							<h4><i class="far fa-clock"></i> {{ __('page.Shop_Hours') }}</h4>
							<p>{{ __('page.Shop_Hours_Details') }}</p>
						</div>
						<div class="contact-form-box">
							<h4><i class="fas fa-address-book"></i> {{ __('page.Contact') }}</h4>
							<p>{{ __('page.Contact_Details') }}</p>
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
                <p> <i class="fas fa-map-marker-alt"></i> {{ __('page.Find_Us') }}</p>
                <!-- Embed Google Map -->
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3459.482313127923!2d31.235413915202148!3d30.04442018183116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145847deea2b48b7%3A0x22cf7127cfab6a88!2sTahrir%20Square%2C%20Cairo%2C%20Egypt!5e0!3m2!1sen!2seg!4v1675334023103!5m2!1sen!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

	<!-- end find our location -->

@endsection

@section('js')

@endsection
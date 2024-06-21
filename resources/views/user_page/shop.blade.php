@extends('layouts.empty')

@section('title')
    shop
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
  background-image: url("/assets/img/shop11.png"); /* تأكد من أن المسار صحيح */
  background-size: cover; /* تجعل الصورة تغطي العنصر بالكامل */
  background-position: center; /* تضبط الصورة في المركز */
  z-index: -1;
  opacity: 0.8;
}

        .breadcrumb-text h1 {
            color: #51495e; /* اللون البنفسجي */
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
                        <p>Fresh and Organic</p>
                        <h1>Shop</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

  <!-- products -->
<div class="product-section mt-150 mb-150">
	<div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Our</span> sections</h3>

                </div>
            </div>
        </div>
			<div class="row product-lists">
					@foreach ($sections as $section)
							<div class="col-lg-4 col-md-6 text-center strawberry">
									<div class="single-product-item">
											<div class="product-image">
												<img src="{{ Storage::url($section->img) }}" style="width: 200px; height: 160px; object-fit: cover;">
											</div>
											<h3>{{ $section->name }}</h3>
											<a href="{{ route('section_product_view', $section->id) }}" class="cart-btn"><i ></i>View</a>		
									</div>
							</div>
					@endforeach
					@foreach ($clothing_sections as $clothing_section)
							<div class="col-lg-4 col-md-6 text-center strawberry">
									<div class="single-product-item">
											<div class="product-image">
												<img src="{{ Storage::url($clothing_section->img) }}" style="width: 200px; height: 160px; object-fit: cover;">
											</div>
											<h3>{{ $clothing_section->name }}</h3>
											<a href="{{ route('clothing_section_product_view', $clothing_section->id) }}" class="cart-btn"><i ></i>View</a>		
									</div>
							</div>
					@endforeach
			</div>
	</div>
</div>


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
    <!-- end logo carousel -->
@endsection

@section('js')
    <script src="{{ URL::asset('assets/js/sticker.js') }}"></script>
@endsection

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
                        <p>Fresh and Organic</p>
                        <h1>Shop</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <div class="product-section mt-150 mb-150">
      <div class="container">
          <div class="row">
              <div class="col-lg-8 offset-lg-2 text-center">
                  <div class="section-title">
                      <h3><span class="orange-text">Our </span>Best Sellers</h3>
                  </div>
              </div>
          </div>
          </div>
  <!-- products -->
  
<div class="product-section mt-120 mb-120">
	<div class="container">
			<div class="row product-lists">
					@foreach ($products as $product)
							<div class="col-lg-4 col-md-6 text-center strawberry">
									<div class="single-product-item">
											<div class="product-image">
													<img src="{{ Storage::url($product->product->img) }}" style="width: 200px; height: 160px; object-fit: cover;">
											</div>
											<h3>{{ $product->product->name }} </h3>
											<h3>{{ $product->product->description }}</h3>
											<h3>{{ $product->product->price }} $</h3>
											<a href="{{ route('product_view', $product->product->id) }}" class="cart-btn"><i class="fas fa-shopping-cart"></i>view</a>
									</div>
							</div>
					@endforeach
          @foreach ($clothing_products as $clothing_product)
          <div class="col-lg-4 col-md-6 text-center {{ $clothing_product->product->type }}">
              <div class="single-product-item">
                  <div class="product-image">
                      <img src="{{ Storage::url($clothing_product->product->img) }}" style="width: 200px; height: 200px; object-fit: cover;">
                  </div>
                  <h2>{{ $clothing_product->product->name }}</h2>
                  <h3>{{ $clothing_product->product->description }}</h3>
                  <h3>{{ $clothing_product->product->price }} $</h3>                                
                  <a href="{{ route('clothing_product_view', $clothing_product->product->id) }}" class="cart-btn">
                      <i class="fas fa-shopping-cart"></i>view
                  </a>
              </div>
          </div>
      @endforeach
			</div>
            <ul class="pagination justify-content-center">
                <!-- زر الصفحة السابقة -->
                @if ($products->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">السابق</span></li>
                @else
                    <li class="page-item"><a href="{{ $products->previousPageUrl() }}" class="page-link" rel="prev">السابق</a></li>
                @endif
        
                <!-- أرقام الصفحات -->
                @foreach(range(1, $products->lastPage()) as $page)
                    <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                        <a href="{{ $products->url($page) }}" class="page-link">{{ $page }}</a>
                    </li>
                @endforeach
        
                <!-- زر الصفحة التالية -->
                @if ($products->hasMorePages())
                    <li class="page-item"><a href="{{ $products->nextPageUrl() }}" class="page-link" rel="next">التالي</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link">التالي</span></li>
                @endif
            </ul>
	</div>
</div>


  
    <!-- end logo carousel -->
@endsection

@section('js')
    <script src="{{ URL::asset('assets/js/sticker.js') }}"></script>
@endsection

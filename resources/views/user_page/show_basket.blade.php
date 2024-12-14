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
  background-image: url("/assets/img/shop3.png"); 
  background-size: cover; 
  background-position: center; 
  z-index: -1;
  opacity: 0.8;
}

.buy-now-btn {
  background-color: #28a745;
  color: white;
  border-radius: 50px;
  padding: 10px 20px;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

.buy-now-btn:hover {
    background-color: #218838;
    color: white;
    text-decoration: none;
}
.custom-btn-width {
    margin-right: 8px; /* or a specific width like 200px */
}
.buy-now-btn i {
    margin-right: 8px;
}

.product-section {
margin-top: 50px; /* تعديل المسافة العلوية */
margin-bottom: 50px; /* تعديل المسافة السفلية */
    }

.delete-btn {
background-color: #dc3545; /* اللون الأساسي لزر الحذف */
border-color: #dc3545; /* لون الإطار */
color: #ffffff; /* لون النص */
transition: background-color 0.3s ease, border-color 0.3s ease;
}

.delete-btn:hover {
    background-color: #c82333; /* لون الخلفية عند التمرير */
    border-color: #bd2130; /* لون الإطار عند التمرير */
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

    <div class="product-section mt-5 mb-5">
      <div class="container">
          <div class="row">
              <div class="col-lg-8 offset-lg-2 text-center">
                  <div class="section-title">
                      <h3><span class="orange-text">basket</span></h3>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
  <!-- products -->
  <div class="product-section mt-5 mb-5">
      <div class="container">
          <div class="row product-lists">
              @foreach ($baskets as $basket)
                  <div class="col-lg-4 col-md-6 text-center strawberry">
                      <div class="single-product-item">
                          <div class="product-image">
                              <img src="{{ Storage::url($basket->product->img) }}" style="width: 200px; height: 160px; object-fit: cover;">
                          </div>
                          <h3>{{ $basket->product->name }} </h3>
                          <h3>{{ $basket->product->description }}</h3>
                          <h3>{{ $basket->product->price }} $</h3>
                          <div class="container mt-3 text-center">
                            <div class="container mt-3 text-center">
                                <div class="row">
                                    <div class="col-6">
                                        <form action="{{ route('del_product_basket', $basket->product->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger delete-btn">حذف من السلة</button>
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('show_single_basket', $basket->product->id) }}" class="btn buy-now-btn" style="width: 150px; display: block;">
                                            <i class="fas fa-shopping-cart"></i> شراء الآن
                                        </a>
                                    </div>
                                    
                                </div>
                            </div> 
                          </div>                                
                      </div>
                  </div>
              @endforeach
            @foreach ($clothesbaskets as $clothesbasket)
                <div class="col-lg-4 col-md-6 text-center strawberry">
                    <div class="single-product-item">
                        <div class="product-image">
                            <img src="{{ Storage::url($clothesbasket->product->img) }}" style="width: 200px; height: 200px; object-fit: cover;">
                        </div>
                        <h3>{{ $clothesbasket->product->name }} </h3>
                        <h3>{{ $clothesbasket->product->description }}</h3>
                        <h3>{{ $clothesbasket->product->price }} $</h3>
                        <div class="container mt-3 text-center">
                            <div class="row">
                                <div class="col-6">
                                    <form action="{{ route('del_clothing_basket', $clothesbasket->product->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger delete-btn">حذف من السلة</button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('show_single_clohing_basket', $clothesbasket->product->id) }}" class="btn buy-now-btn">
                                        <i class="fas fa-shopping-cart"></i> شراء الآن
                                    </a>
                                </div>
                            </div>
                        </div>                       
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

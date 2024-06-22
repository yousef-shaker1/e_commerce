@extends('layouts.empty')

@section('title')
    home
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

  .testimonail-section {
    background-color: #f9f9f9;
    padding: 60px 0;
    border-top: 1px solid #e5e5e5;
    border-bottom: 1px solid #e5e5e5;
}

.testimonail-section h3 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 40px;
    color: #333;
}

.testimonial-sliders {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.single-testimonial-slider {
    background-color: #fff;
    border: 1px solid #e5e5e5;
    padding: 30px;
    margin: 15px;
    width: calc(33.33% - 30px); /* Adjust width based on your grid */
    max-width: 350px;
    text-align: center;
    border-radius: 8px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
}

.client-meta {
    position: relative;
}

.client-avatar img {
    width: 80px; /* Adjust size based on your design */
    height: 80px; /* Adjust size based on your design */
    border-radius: 50%;
    margin: 0 auto 20px;
    display: block;
    object-fit: cover;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.client-details h3 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #333;
}

.testimonial-body {
    font-size: 16px;
    line-height: 1.6;
    color: #666;
    margin-bottom: 20px;
}

.last-icon {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    font-size: 24px;
    color: #999;
}

.last-icon i {
    margin-top: 10px;
}

  </style>
@endsection


@section('content')
<div class="loader">
    <div class="loader-inner">
        <div class="circle"></div>
    </div>
</div>
    <div class="hero-area hero-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-2 text-center">
                    <div class="hero-text">
                        <div class="hero-text-tablecell">
                            <p class="subtitle">Fresh & Organic</p>
                            <h1>Delicious Seasonal Fruits</h1>
                            <div class="hero-btns">
                                <a href="{{ route('shop') }}" class="boxed-btn">shop</a>
                                <a href="{{ route('contact') }}" class="bordered-btn">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- features list section -->
    <div class="list-section pt-80 pb-80">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="content">
                            <h3>Free Shipping</h3>
                            <p>When order over $75</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-phone-volume"></i>
                        </div>
                        <div class="content">
                            <h3>24/7 Support</h3>
                            <p>Get support all day</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="list-box d-flex justify-content-start align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-sync"></i>
                        </div>
                        <div class="content">
                            <h3>Refund</h3>
                            <p>Get refund within 3 days!</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end features list section -->

    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Our</span> Products</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
                    </div>
                </div>
            </div>

                        
            <div class="product-section mt-120 mb-120">
                <div class="container">
                    <div class="row product-lists">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 text-center strawberry">
                                <div class="single-product-item">
                                    <div class="product-image">
                                        <img src="{{ Storage::url($product->img) }}" style="width: 200px; height: 160px; object-fit: cover;">
                                    </div>
                                    <h3>{{ $product->name }} </h3>
                                    <h3>{{ $product->description }}</h3>
                                    <h3>{{ $product->price }} $</h3>
                                    <a href="{{ route('product_view', $product->id) }}" class="cart-btn"><i class="fas fa-shopping-cart"></i>اضف الي السلة</a>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-filters text-center">
                                <ul class="d-inline-flex">
                                    <li class="active" data-filter="" onclick="showSection('all')">All</li>
                                    <li data-filter="" onclick="showSection('رجالي')">رجالي</li>
                                    <li data-filter="" onclick="showSection('حريمي')">حريمي</li>
                                    <li data-filter="" onclick="showSection('اطفالي')">اطفالي</li>
                                </ul>
                            </div>
                        </div>
                    </div>
            
                    <!-- products -->
                    <div class="product-section">
                        <div class="container">
                            <div class="row clothing-product-lists">
                                @foreach ($clothing_products as $clothing_product)
                                    <div class="col-lg-4 col-md-6 text-center {{ $clothing_product->type }}">
                                        <div class="single-product-item">
                                            <div class="product-image">
                                                <img src="{{ Storage::url($clothing_product->img) }}" style="width: 200px; height: 200px; object-fit: cover;">
                                            </div>
                                            <h2>{{ $clothing_product->name }}</h2>
                                            <h3>{{ $clothing_product->description }}</h3>
                                            <h3>{{ $clothing_product->price }} $</h3>                                
                                            <a href="{{ route('clothing_product_view', $clothing_product->id) }}" class="cart-btn">
                                                <i class="fas fa-shopping-cart"></i>اضف الي السلة
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="pagination-wrapper mt-4">
                                <ul class="pagination justify-content-center">
                                    <!-- زر الصفحة السابقة -->
                                    @if ($clothing_products->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">السابق</span></li>
                                    @else
                                        <li class="page-item"><a href="{{ $clothing_products->previousPageUrl() }}" class="page-link" rel="prev">السابق</a></li>
                                    @endif
            
                                    <!-- أرقام الصفحات -->
                                    @foreach(range(1, $clothing_products->lastPage()) as $page)
                                        <li class="page-item {{ $page == $clothing_products->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $clothing_products->url($page) }}" class="page-link">{{ $page }}</a>
                                        </li>
                                    @endforeach
            
                                    <!-- زر الصفحة التالية -->
                                    @if ($clothing_products->hasMorePages())
                                        <li class="page-item"><a href="{{ $clothing_products->nextPageUrl() }}" class="page-link" rel="next">التالي</a></li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link">التالي</span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- end --}}
                </div>
            </div>
        </div>
    </div>
    <!-- end product section -->


    <div class="testimonail-section mt-80 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>آراء العملاء</h3>
                </div>
                <div class="col-lg-10 offset-lg-1">
                    <div class="testimonial-sliders">
                        @foreach ($messages as $message)
                        <div class="single-testimonial-slider">
                            <div class="client-meta">
                            
                                <div class="client-details">
                                    <h3>{{ $message->customer->name }}</h3>
                                    <p class="testimonial-body">
                                        {{ $message->message }}
                                    </p>
                                </div>
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
<script>
    function showSection(section) {
        const productList = document.querySelector('.clothing-product-lists');
        const products = Array.from(productList.querySelectorAll('.single-product-item'));

        // Clear current list
        productList.innerHTML = '';

        if (section === 'all') {
            products.forEach(product => product.style.display = 'block');
            products.forEach(product => productList.appendChild(product.closest('.col-lg-4')));
        } else {
            // Separate matching and non-matching products
            const matchingProducts = products.filter(product => product.closest('.col-lg-4').classList.contains(section));
            const nonMatchingProducts = products.filter(product => !product.closest('.col-lg-4').classList.contains(section));
            
            // Display matching products first
            matchingProducts.forEach(product => {
                product.style.display = 'block';
                productList.appendChild(product.closest('.col-lg-4'));
            });

            // Hide non-matching products
            nonMatchingProducts.forEach(product => {
                product.style.display = 'none';
                productList.appendChild(product.closest('.col-lg-4'));
            });
        }

        // Update active filter
        const filterItems = document.querySelectorAll('.product-filters ul li');
        filterItems.forEach(filter => filter.classList.remove('active'));
        const activeFilter = document.querySelector(`.product-filters ul li[onclick="showSection('${section}')"]`);
        activeFilter.classList.add('active');
    }
</script>
@endsection

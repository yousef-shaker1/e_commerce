@extends('layouts.empty')

@section('title')
    home
@endsection

@section('css')
<link rel="stylesheet" href="{{URL::asset('assets/css/home.css')}}">
@livewireStyles
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
                    @livewire('product_clothing')
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
    @livewireScripts
@endsection

@section('js')
<script src="{{ URL::asset('assets/js/sticker.js') }}"></script>

@endsection

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
        .product-filters {
            margin-bottom: 20px;
        }

        .product-filters ul {
            padding: 0;
            margin: 0;
            list-style: none;
            display: inline-flex;
            gap: 15px;
        }

        .product-filters ul li {
            padding: 10px 15px;
            margin: 0 5px;
            cursor: pointer;
        }

        .product-filters ul li.active {
            font-weight: bold;
            color: #000;
        }

        .product-section {
            padding-top: 50px;
        }

        .product-section .single-product-item {
            margin-bottom: 30px;
        }
    </style>
    @livewireStyles
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
                        <h3><span class="orange-text">Our</span> Products: {{ $clothing_section->name }}</h3>
                    </div>
                </div>
            </div>
            
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
            
            @livewire('search-clothing-product', ['sectionId' => $clothing_section->id])
            <!-- products -->
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
<script>
    function showSection(sectionName) {
        // إخفاء جميع المنتجات
        var allProducts = document.querySelectorAll('.product-lists .col-lg-4');
        allProducts.forEach(function(product) {
            product.style.display = 'none';
        });

        // إذا كان القسم المحدد هو "all"، اعرض جميع المنتجات
        if (sectionName === 'all') {
            allProducts.forEach(function(product) {
                product.style.display = 'block';
            });
        } else {
            // عرض المنتجات الخاصة بالقسم المحدد
            var selectedSectionProducts = document.querySelectorAll('.product-lists .' + sectionName);
            selectedSectionProducts.forEach(function(product) {
                product.style.display = 'block';
            });

        
        }

        // إظهار الـ footer
        var footer = document.querySelector('footer');
        if (footer) {
            footer.style.display = 'block';
        }
    }
</script>
@endsection
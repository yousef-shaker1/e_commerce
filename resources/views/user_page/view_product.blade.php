@extends('layouts.empty')

@section('title')
    Shop
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
    .reduce-margin-top {
        margin-top: 100px; /* Adjust value as needed */
        margin-bottom: -100px; /* Adjust value as needed */
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

<div class="product-section mt-150 mb-150"> <!-- Reduced top margin -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Our</span> Products : {{ $section->name }}</h3>
                </div>
            </div>
        </div>
    </div>
    @livewire('SearchProduct', ['sectionId' => $section->id])
</div>

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
@livewireScripts
@endsection

@section('js')
<script src="{{ URL::asset('assets/js/sticker.js') }}"></script>
@endsection
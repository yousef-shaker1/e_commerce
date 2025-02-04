@extends('layouts.empty')

@section('title')
    shop
@endsection

@section('css')
<link rel="stylesheet" href="{{URL::asset('assets/css/clothing_product.css')}}">
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

    <div class="product-section mt-5 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Our</span> Products: {{ $clothing_section->name }}</h3>
                    </div>
                </div>
            </div>
            
            
            
            @livewire('search-clothing-product', ['sectionId' => $clothing_section->id])
            <!-- products -->
        </div>
    </div>

    
    @livewireScripts
@endsection

@section('js')

@endsection
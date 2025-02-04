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
        margin-top: 100px; 
        margin-bottom: -100px;
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
                    <h3><span class="orange-text">{{ __('page.our') }}</span> {{ __('page.products') }} : {{ $section->name }}</h3>
                </div>
            </div>
        </div>
    </div>
    @livewire('search-product', ['sectionId' => $section->id])
</div>


@livewireScripts

@endsection

@section('js')

@endsection
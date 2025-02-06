@extends('layouts.empty')

@section('title')
عرض المنتج 
@endsection

@section('css')
<style>
/* Loader */
.loader {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.loader-inner .circle {
    width: 50px;
    height: 50px;
    border: 5px solid #3498db;
    border-top: 5px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

/* Breadcrumb */
.breadcrumb-section:after {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    content: "";
    background-image: url("/assets/img/img3.webp");
    background-size: cover;
    background-position: center;
    z-index: -1;
    opacity: 0.8;
}

.breadcrumb-section .breadcrumb-text p {
    font-size: 1.2rem;
    color: #fff;
    margin-bottom: 10px;
}

.breadcrumb-section .breadcrumb-text h1 {
    font-size: 2.5rem;
    font-weight: bold;
    color: #fff;
}

/* Buttons */
.btn-custom-primary {
    background-color: #3498db;
    border-color: #3498db;
    color: #fff;
}

.btn-custom-primary:hover {
    background-color: #2980b9;
    border-color: #2980b9;
}

.btn-custom-secondary {
    background-color: #95a5a6;
    border-color: #95a5a6;
    color: #fff;
}

.btn-custom-secondary:hover {
    background-color: #7f8c8d;
    border-color: #7f8c8d;
}

/* Product Gallery */
.product-gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.product-gallery img {
    width: 100px;
    height: auto;
    object-fit: cover;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease;
}

.product-gallery img:hover {
    transform: scale(1.1);
}

/* Product Image */
.product-image img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

/* Alerts */
.alert {
    animation: slide-down 0.5s ease-out;
}

@keyframes slide-down {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Disabled Button */
#add_to_basket.disabled {
    pointer-events: none;
    opacity: 0.5;
    cursor: not-allowed;
}
</style>
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
                    <p>{{ __('page.Premium_and_Organic') }}</p>
                    <h1>{{ __('page.About') }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session()->has('message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('message') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="container mt-5">
    <h2 class="mb-4 text-center">{{ __('page.show_product') }}</h2>

    <div class="row">
        <!-- عرض صور المنتج الإضافية -->
        <div class="col-md-3">
            <div class="product-gallery">
                @foreach($images as $img)
                    <a href="{{ Storage::url($img->image) }}">
                        <img src="{{ Storage::url($img->image) }}" alt="صورة المنتج" class="img-fluid rounded shadow-sm">
                    </a>
                @endforeach
            </div>
        </div>

        <!-- صورة المنتج الرئيسية -->
        <div class="col-md-6">
            <div class="product-image text-center mb-4">
                <a href="{{ Storage::url($product->img) }}">
                    <img src="{{ Storage::url($product->img) }}" alt="صورة المنتج" class="img-fluid">
                </a>
            </div>
        </div>

        <div class="col-md-3">
            @livewire('show-single-clothing-product', ['id' => $product->id])
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection

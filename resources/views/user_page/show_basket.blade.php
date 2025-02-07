@extends('layouts.empty')

@section('title')
    {{ __("page.basket") }}
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
            margin-right: 8px;
        }

        .buy-now-btn i {
            margin-right: 8px;
        }

        .product-section {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .delete-btn {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #ffffff;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .delete-btn:hover {
            background-color: #c82333;
            border-color: #bd2130;
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
                        <h1>{{ __('page.basket') }}</h1>
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
                        <h3><span class="orange-text">{{ __('page.basket') }}</span></h3>
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
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="single-product-item card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <!-- Product Image -->
                                <div class="product-image mb-3">
                                    <img src="{{ Storage::url($basket->product->img) }}" class="img-fluid rounded"
                                        style="max-width: 200px; height: auto; object-fit: cover;">
                                </div>

                                <!-- Product Details -->
                                <h5 class="card-title">{{ $basket->product->name }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($basket->product->description, 70) }}...</p>
                                <h6 class="card-subtitle mb-3 text-success">{{ $basket->product->price }} $</h6>

                                <!-- Actions -->
                                <div class="d-grid gap-2">
                                    <form action="{{ route('del_product_basket', $basket->product->id) }}" method="post"
                                        class="mb-2">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                            <i class="fas fa-trash"></i> {{ __('page.delete_basket') }}
                                        </button>
                                    </form>
                                    <a href="{{ route('show_single_basket', $basket->product->id) }}"
                                        class="btn btn-primary btn-sm buy-now-btn">
                                        <i class="fas fa-shopping-cart"></i> {{ __('page.order_now') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach ($clothesbaskets as $clothesbasket)
                    <div class="col-lg-4 col-md-6 text-center strawberry">
                        <div class="single-product-item card mb-4 shadow-sm">
                            <div class="card-body text-center">
                                <!-- Product Image -->
                                <div class="product-image mb-3">
                                    <img src="{{ Storage::url($clothesbasket->product->img) }}" class="img-fluid rounded"
                                        style="max-width: 200px; height: auto; object-fit: cover;">
                                </div>

                                <!-- Product Details -->
                                <h5 class="card-title">{{ $clothesbasket->product->name }}</h5>
                                <p class="card-text text-muted">
                                    {{ Str::limit($clothesbasket->product->description, 70) }}...</p>
                                <h6 class="card-subtitle mb-3 text-success">{{ $clothesbasket->product->price }} $</h6>

                                <!-- Actions -->
                                <div class="d-grid gap-2">
                                    <form action="{{ route('del_clothing_basket', $clothesbasket->product->id) }}"
                                        method="post" class="mb-2">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                            <i class="fas fa-trash"></i> {{ __('page.delete_basket') }}
                                        </button>
                                    </form>
                                    <a href="{{ route('show_single_clohing_basket', $clothesbasket->product->id) }}"
                                        class="btn btn-primary btn-sm buy-now-btn">
                                        <i class="fas fa-shopping-cart"></i> {{ __('page.order_now') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection

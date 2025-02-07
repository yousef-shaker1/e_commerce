@extends('layouts.empty')

@section('title')
    {{ __('page.Shop') }}
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
                    <h1>{{ __('page.Shop') }}</h1>
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

    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('section_product_view', $section->id) }}" method="GET">
                    <div class="input-group shadow-sm">
                        <input type="text" name="search" id="search-input" class="form-control" placeholder="{{ __('page.search_product') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> {{ __('page.search') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="product-section mt-5 mb-120">
            <div class="container">
                <div class="row product-lists">
                    @forelse ($products as $product)
                        <div class="col-lg-4 col-md-6 text-center strawberry">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <img src="{{ Storage::url($product->img) }}" style="width: 200px; height: 160px; object-fit: cover;" loading="lazy">
                                </div>
                                <h3>{{ $product->name }} </h3>
                                <h3>{{ $product->description }}</h3>
                                <h3>{{ $product->price }} $</h3>
                                <a href="{{ route('product_view', $product->id) }}" class="cart-btn"><i class="fas fa-shopping-cart"></i>اضف الي السلة</a>
                            </div>
                        </div>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center table-warning text-white fw-bold py-3 border">
                            <strong>{{ __('page.no_product') }}</strong>
                        </td>
                    </tr>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center my-4">
                    <ul class="pagination justify-content-center">
                        <!-- زر الصفحة السابقة -->
                        @if ($products->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">{{ __('pagination.previous') }}</span></li>
                        @else
                            <li class="page-item"><a href="{{ $products->previousPageUrl() }}" class="page-link" rel="prev">{{ __('pagination.previous') }}</a></li>
                        @endif
                
                        <!-- أرقام الصفحات -->
                        @foreach(range(1, $products->lastPage()) as $page)
                            <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                <a href="{{ $products->url($page) }}" class="page-link">{{ $page }}</a>
                            </li>
                        @endforeach
                
                        <!-- زر الصفحة التالية -->
                        @if ($products->hasMorePages())
                            <li class="page-item"><a href="{{ $products->nextPageUrl() }}" class="page-link" rel="next">{{ __('pagination.next') }}</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">{{ __('pagination.next') }}</span></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


@livewireScripts

@endsection

@section('js')

@endsection
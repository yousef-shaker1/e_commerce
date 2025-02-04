@extends('layouts.empty')

@section('title')
    {{ __('page.Important Products') }}
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
                        <p>{{ __('page.Premium_and_Organic') }}</p>
                    <h1>{{ __('page.Important Products') }}</h1>
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
                      <h3><span class="orange-text">{{ __('page.our') }} </span> {{ __('page.Important Products') }}</h3>
                  </div>
              </div>
          </div>
          </div>
  <!-- products -->
  
<div class="product-section mt-120 mb-120">
	<div class="container">
        <div class="row product-lists">
            <!-- عرض منتجات القسم العادي -->
            @foreach ($sections as $section)
                <div class="col-lg-4 col-md-6 text-center strawberry">
                    <div class="single-product-item">
                        <div class="product-image">
                            <img src="{{ Storage::url($section->img) }}" style="width: 200px; height: 160px; object-fit: cover;">
                        </div>
                        <h3>{{ $section->name }}</h3>
                        <h3>{{ $section->description }}</h3>
                        <h3>{{ $section->price }} $</h3>
                        <a href="{{ route('product_view', $section->id) }}" class="cart-btn"><i class="fas fa-shopping-cart"></i>view</a>
                    </div>
                </div>
            @endforeach
    
            <!-- عرض منتجات قسم الملابس -->
            @foreach ($clothingsections as $clothingsection)
                <div class="col-lg-4 col-md-6 text-center {{ $clothingsection->type }}">
                    <div class="single-product-item">
                        <div class="product-image">
                            <img src="{{ Storage::url($clothingsection->img) }}" style="width: 200px; height: 200px; object-fit: cover;">
                        </div>
                        <h2>{{ $clothingsection->name }}</h2>
                        <h3>{{ $clothingsection->description }}</h3>
                        <h3>{{ $clothingsection->price }} $</h3>
                        <a href="{{ route('clothing_product_view', $clothingsection->id) }}" class="cart-btn">
                            <i class="fas fa-shopping-cart"></i>view
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    
        <!-- Pagination للقسم العادي -->
        <div class="row">
            <div class="col-md-12 text-center">
                <h4 class="my-4">{{ __('page.Electronics') }}</h4>
            </div>
        </div>
        <ul class="pagination justify-content-center">
            @if ($sections->onFirstPage())
                <li class="page-item disabled"><span class="page-link">{{ __('pagination.previous') }}</span></li>
            @else
                <li class="page-item"><a href="{{ $sections->previousPageUrl() }}" class="page-link" rel="prev">{{ __('pagination.previous') }}</a></li>
            @endif
    
            @foreach(range(1, $sections->lastPage()) as $page)
                <li class="page-item {{ $page == $sections->currentPage() ? 'active' : '' }}">
                    <a href="{{ $sections->url($page) }}" class="page-link">{{ $page }}</a>
                </li>
            @endforeach
    
            @if ($sections->hasMorePages())
                <li class="page-item"><a href="{{ $sections->nextPageUrl() }}" class="page-link" rel="next">{{ __('pagination.next') }}</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">{{ __('pagination.next') }}</span></li>
            @endif
        </ul>
    
        <!-- Pagination لقسم منتجات الملابس -->
        <div class="row">
            <div class="col-md-12 text-center">
                <h4 class="my-4">{{ __('page.Clothing') }}</h4>
            </div>
        </div>
        <ul class="pagination justify-content-center">
            @if ($clothingsections->onFirstPage())
                <li class="page-item disabled"><span class="page-link">{{ __('pagination.previous') }}</span></li>
            @else
                <li class="page-item"><a href="{{ $clothingsections->previousPageUrl() }}" class="page-link" rel="prev">{{ __('pagination.previous') }}</a></li>
            @endif
    
            @foreach(range(1, $clothingsections->lastPage()) as $page)
                <li class="page-item {{ $page == $clothingsections->currentPage() ? 'active' : '' }}">
                    <a href="{{ $clothingsections->url($page) }}" class="page-link">{{ $page }}</a>
                </li>
            @endforeach
    
            @if ($clothingsections->hasMorePages())
                <li class="page-item"><a href="{{ $clothingsections->nextPageUrl() }}" class="page-link" rel="next">{{ __('pagination.next') }}</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">{{ __('pagination.next') }}</span></li>
            @endif
        </ul>
    </div>
</div>


  
    <!-- end logo carousel -->
@endsection

@section('js')
@endsection

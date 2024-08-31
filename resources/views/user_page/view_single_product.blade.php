@extends('layouts.empty')

@section('title')
عرض المنتج 
@endsection
@section('css')
<style>
.loader {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

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
                    <p>We sale fresh fruits</p>
                    <h1>About Us</h1>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session()->has('Add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('Add') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="container mt-5">
    <h2 class="mb-4 text-center">عرض المنتج</h2>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>اسم المنتج</th>
                        <th>الصورة</th>
                        <th>الوصف</th>
                        <th>السعر</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><h5>{{ $product->name }}</h5></td>
                        <td>
                            <a href="{{ Storage::url($product->img) }}">
                                <img src="{{ Storage::url($product->img) }}" alt="صورة المنتج" class="product-img img-fluid" style="width: 100px; height: auto;">
                            </a>
                        </td>
                        <td><h5>{{ $product->description }}</h5></td>
                        <td><h5>{{ $product->price }} $</h5></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div class="card mt-2">
                <div class="card-body text-center">
                    @if(!empty(Auth::user()->name))
                        <div class="mb-3">
                            <a class="btn btn-custom-primary btn-block" href="{{ route('add_basket', $product->id) }}">إضافة إلى السلة</a>
                        </div>
                    @else
                        <div class="mb-3">
                            <a class="btn btn-custom-primary btn-block" href="{{ route('login') }}">من فضلك سجل الدخول</a>
                        </div>
                    @endif
                    <div>
                        <a href="{{ route('section_product_view', $product->section->id) }}" class="btn btn-custom-secondary btn-block">عودة إلى الصفحة السابقة</a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection



@section('js')

@endsection
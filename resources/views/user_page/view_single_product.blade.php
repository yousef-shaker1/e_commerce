@extends('layouts.empty')

@section('title')
عرض المنتج 
@endsection
@section('css')
<style>
.breadcrumb-section {
    background: linear-gradient(90deg, rgba(255, 165, 0, 0.7), rgba(255, 99, 71, 0.7)), 
                url('/path-to-background.jpg') center/cover no-repeat;
    color: white;
    text-align: center;
    padding: 60px 0;
}

.product-img {
    border: 5px solid #eee;
    border-radius: 15px;
    transition: transform 0.5s ease, box-shadow 0.5s ease;
}

.product-img:hover {
    transform: scale(1.2);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.btn-custom-primary {
    background: linear-gradient(45deg, #ff7f50, #ff4500);
    border: none;
    color: white;
    padding: 10px 20px;
    font-size: 18px;
    border-radius: 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}

.btn-custom-primary:hover {
    background: linear-gradient(45deg, #ff6347, #ff0000);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.image-grid {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 30px;
}
.image-grid img {
    width: 120px;
    height: 120px;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.image-grid img:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
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
    <div class="breadcrumb-text">
        <p>منتجات طازجة وعالية الجودة</p>
        <h1>{{ $product->name }}</h1>
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
    <div class="row">
        <!-- صورة المنتج والمواصفات -->
        <div class="col-md-8 text-center">
            <a href="{{ Storage::url($product->img) }}">
                <img src="{{ Storage::url($product->img) }}" alt="صورة المنتج" class="product-img img-fluid mb-4" style="max-width: 300px;">
            </a>
            <h2>{{ $product->name }}</h2>
            <p class="text-muted">{{ $product->description }}</p>
            <h3 class="text-primary">{{ $product->price }} $</h3>
        </div>

        <!-- أزرار الإجراء -->
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-body text-center">
                    @if(App\Models\basket::where('customer_id', Auth::user()->id)->where('product_id', $product->id)->exists())
                    <a href="{{ route('show_single_basket', $product->id) }}" class="btn btn-custom-primary btn-block mb-3">اطلب الان</a>
                    @elseif(Auth::check())
                    <a href="{{ route('add_basket', $product->id) }}" class="btn btn-custom-primary btn-block mb-3">إضافة إلى السلة</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-custom-primary btn-block mb-3">سجل الدخول للشراء</a>
                    @endif
                    <a href="{{ route('section_product_view', $product->section->id) }}" class="btn btn-custom-secondary btn-block">عودة للصفحة السابقة</a>
                </div>
            </div>
        </div>
    </div>

    <!-- الصور الإضافية -->
    <div class="image-grid">
        @foreach($images as $img)
        <a href="{{ Storage::url($img->image) }}">
            <img src="{{ Storage::url($img->image) }}" alt="صورة إضافية">
        </a>
        @endforeach
    </div>
</div>
<br>
@endsection



@section('js')

@endsection
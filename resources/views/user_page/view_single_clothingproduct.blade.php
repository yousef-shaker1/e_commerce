{{-- <!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة عرض</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
       body {
            font-family: 'Arial', sans-serif;
            direction: rtl;
            text-align: right;
            background-color: #000000; /* اللون الأسود */
            color: #fff; /* النص الأبيض لتحسين القراءة على الخلفية السوداء */
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 50px;
        }
        .product-img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .product-details {
            background-color: #ff8c00; /* اللون البرتقالي */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        .product-details h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }
        .product-details p {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: #0056b3;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #004494;
        }

        .breadcrumb-section:after {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  content: "";
  background-image: url("/assets/img/shop3.png"); /* تأكد من أن المسار صحيح */
  background-size: cover; /* تجعل الصورة تغطي العنصر بالكامل */
  background-position: center; /* تضبط الصورة في المركز */
  z-index: -1;
  opacity: 0.8;
}
    </style>
</head>
<body>
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
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
  @if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
          @foreach ($errors->all() as $error)
              {{ $error }}
          @endforeach
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
@endif
 
    <div class="container">
        <div class="row">
            <div class="col-md-6">
              <img src="{{ Storage::url($product->img) }}" style="width: 400px; height: 400px; object-fit: cover;">
            </div>
            <div class="col-md-6">
                <div class="product-details">
                    <h2>اسم العرض: {{ $product->name }}</h2>
                    <p>تفاصيل المنتج: هذا المنتج هو عبارة عن {{ $product->description }}</p>
                    <p>السعر: ${{ $product->price }}</p>
                    <p>النوع: {{ $product->type }}</p>
                    <div class="form-group">
                        <label for="product_size">المقاس:</label>
                        <select class="form-control" id="product_size" name="product_size">
                            <option value="">من فضلك اختار مقاس</option>
                            @foreach ($sizes as $size)
                            <option value="{{ $size->size->id }}">{{ $size->size->size }}</option>
                        @endforeach                  
                          </select>
                        <input type="hidden" id="selected_id" name="selected_id" value="{{ $sizes->first()->size->id }}">
                  </div>
                  @if(!empty(Auth::user()->name))
                  <a class="btn btn-primary" href="{{ route('add_clohing_to_basket', ['id1' => $sizes->first()->size->id, 'id2' => $product->id]) }}" id="add_to_basket">إضافة إلى السلة</a>      
                    <a href="{{ route('clothing_section_product_view', $product->section->id)}}" class="btn btn-primary">عودة الي الصفحة السابقة</a>
                    @else
                    <a class="btn btn-primary" href="{{ route('login') }}">من فضلك سجل الدخول</a>
                    <a href="{{ route('clothing_section_product_view', $product->section->id) }}" class="btn btn-primary">عودة الي الصفحة السابقة</a>
                  @endif
                </div>
            </div>
          </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script>
 document.addEventListener("DOMContentLoaded", function() {
    var productSizeSelect = document.getElementById("product_size");
    var selectedIdInput = document.getElementById("selected_id");
    var addToBasketLink = document.getElementById("add_to_basket");

    // وظيفة لتحديث قيمة الـ input ورابط "إضافة إلى السلة"
    function updateSelectedSize() {
        var selectedSize = productSizeSelect.value;
        selectedIdInput.value = selectedSize;

        // استخدام route() بدلاً من replace() لتوليد الرابط بشكل ديناميكي
        var basketLink = "{{ route('add_clohing_to_basket', ['id1' => ':id1', 'id2' => ':id2']) }}";
        basketLink = basketLink.replace(':id1', selectedSize).replace(':id2', {{ $product->id }});
        addToBasketLink.href = basketLink;
    }

    // تحديث عند تحميل الصفحة لأول مرة
    updateSelectedSize();

    // تحديث عند تغيير الحجم المختار
    productSizeSelect.addEventListener("change", updateSelectedSize);
});
      </script>
  </body>
  </html>
   --}}

   
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
                        <th>اختار المقاس</th>
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
                        <td>
                            <select class="form-control" id="product_size" name="product_size">
                                <option value="">من فضلك اختار مقاس</option>
                                @foreach ($sizes as $size)
                                <option value="{{ $size->size->id }}">{{ $size->size->size }}</option>
                            @endforeach                  
                              </select>
                            <input type="hidden" id="selected_id" name="selected_id" value="{{ $sizes->first()->size->id }}">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div class="card mt-5">
                <div class="card-body text-center">
                    @if(!empty(Auth::user()->name))
                    <div class="mb-3">
                        <a class="btn btn-custom-primary btn-block" href="{{ route('add_clohing_to_basket', ['id1' => $sizes->first()->size->id, 'id2' => $product->id]) }}" id="add_to_basket">إضافة إلى السلة</a>
                    </div>
                    @else
                        <div class="mb-3">
                            <a class="btn btn-custom-primary btn-block" href="{{ route('login') }}">من فضلك سجل الدخول</a>
                        </div>
                    @endif
                    <div>
                        <a href="{{ route('clothing_section_product_view', $product->section->id)}}" class="btn btn-custom-secondary btn-block">عودة الي الصفحة السابقة</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
       var productSizeSelect = document.getElementById("product_size");
       var selectedIdInput = document.getElementById("selected_id");
       var addToBasketLink = document.getElementById("add_to_basket");
   
       // وظيفة لتحديث قيمة الـ input ورابط "إضافة إلى السلة"
       function updateSelectedSize() {
           var selectedSize = productSizeSelect.value;
           selectedIdInput.value = selectedSize;
   
           // استخدام route() بدلاً من replace() لتوليد الرابط بشكل ديناميكي
           var basketLink = "{{ route('add_clohing_to_basket', ['id1' => ':id1', 'id2' => ':id2']) }}";
           basketLink = basketLink.replace(':id1', selectedSize).replace(':id2', {{ $product->id }});
           addToBasketLink.href = basketLink;
       }
   
       // تحديث عند تحميل الصفحة لأول مرة
       updateSelectedSize();
   
       // تحديث عند تغيير الحجم المختار
       productSizeSelect.addEventListener("change", updateSelectedSize);
   });
         </script>
@endsection
{{-- <!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة عرض المنتج</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            direction: rtl;
            text-align: right;
            background-color: #000;
            /* اللون الأسود */
            color: #fff;
            /* النص الأبيض لتحسين القراءة على الخلفية السوداء */
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
        }

        .product-img {
            max-width: 100%;
            height: 450px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .product-form,
        .product-details {
            background-color: #ff8c00;
            /* اللون البرتقالي */
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }

        .product-form h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }
        .product-details h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .product-form .form-group,
        .product-details p {
            margin-bottom: 15px;
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

        #customButton {
        background-color: #6772e5;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }

        #customButton:hover {
            background-color: #5469d4;
        }
    </style>
</head>

<body>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('cancel'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('error') }}</strong>
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
                <img src="{{ Storage::url($basket->product->img) }}" alt="صورة المنتج" class="product-img">
                <div class="product-details mt-4">
                    <h2>اسم المنتج: {{ $basket->product->name }}</h2>
                    <p>تفاصيل المنتج: هذا المنتج هو عبارة عن {{ $basket->product->description }}</p>
                    <p>السعر: ${{ $basket->product->price }}</p>
                    <p>النوع: {{ $basket->product->type }}</p>
                    <p>المقاس : {{ $basket->size->size }}</p>
                    <a href="{{ route('show_basket') }}" class="btn btn-primary">عودة الي الصفحة السابقة</a>
                    <a href="{{ route('clothing_section_product_view' , $basket->product->section->id) }}" class="btn btn-primary">عودة الي صفحة جميع العروض</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-form">
                    <h2>طلب اوردر</h2>
                    <form action="{{ route('send_clothing_order', $basket->product->id) }}" method="POST" id="payment-form">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" id="id" name="id" value="{{ $basket->product->id }}">
                            <label for="date">تاريخ موصول المنتج</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ $basket->product->date }}">
                            <input type="hidden" class="form-control" id="size" name="size" value="{{ $basket->size->size }}">
                        </div>
                        <div class="form-group">
                            <label for="quantity">عدد المنتجات</label>
                            <button type="button" onclick="changeQuantity(-1)">-</button>
                            <span id="quantity" class="quantity-value">1</span>
                            <button type="button" onclick="changeQuantity(1)">+</button>
                            <input type="hidden" id="count" name="count" value="1">
                        </div>
                        <div class="form-group">
                            <div>الإجمالي المبلغ : $ <span id="total">{{ $basket->product->price }} </span></div>
                        </div>
                        <button type='submit' class="btn btn-primary">pay with stripe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function changeQuantity(amount) {
            const quantityElement = document.getElementById('quantity');
            let quantity = parseInt(quantityElement.textContent) + amount;
            if (quantity < 1) {
                quantity = 1;
            }
            quantityElement.textContent = quantity;
    
            const countInput = document.getElementById('count');
            countInput.value = quantity;
    
            updateTotal();
        }
    
        function updateTotal() {
            const quantity = parseInt(document.getElementById('quantity').textContent);
            const price = parseFloat("{{ $basket->product->price }}"); // تحويل السعر إلى رقم عائم
            const total = quantity * price;
            document.getElementById('total').textContent = total;
            // تحديث قيمة data-amount
            document.querySelector('.stripe-button').setAttribute('data-amount', total * 100);
        }


        
    </script>
</body>

</html>

 --}}


 @extends('layouts.empty')

@section('title')
شراء المنتج
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
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('success') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('error') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session()->has('cancel'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('error') }}</strong>
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
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h2>Shopping Cart</h2>
            <div class="card mb-3">
                <div class="card-body">
                    <table class="table table-hover">
          <thead>
            <tr>
                <th>Image</th>
              <th>Product name</th>
              <th>description</th>
              <th>المقاس</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td>
                  <a href='{{ Storage::url($clothingproduct->img) }}'>
                      <img src="{{ Storage::url($clothingproduct->img) }}" alt="صورة المنتج" class="product-img" style="width: 100px; height:100px auto;">
                  </a> 
               </td>
              <td>{{ $clothingproduct->name }}</td>
              <td>{{ $clothingproduct->description }}</td>
              <td>{{ $size->size }}</td>
              <td>{{ $clothingproduct->price }} $</td>
              
            </tr>
            <!-- End of product row -->
          </tbody>
        </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Cart Summary</h5>
                    <form action="{{ route('send_clothing_order', $clothingproduct->id) }}" method="POST" id="payment-form">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $clothingproduct->id }}">
                        <div class="form-group">
                            <label for="date">تاريخ وصول المنتج</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ $clothingproduct->date }}" >
                            <input type="hidden" class="form-control" id="size" name="size" value="{{ $size->size }}">
                        </div>
                        <div class="form-group">
                            <label for="quantity">عدد المنتجات</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(-1)">-</button>
                                    </div>
                                    <span id="quantity" class="form-control quantity-value d-inline-block py-1 px-2">1</span>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(1)">+</button>
                                    </div>
                                    <input type="hidden" id="count" name="count" value="1">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>اجمالي المبلغ : <span id="total">${{ $clothingproduct->price }} </span></div>
                        </div>
                        <button type='submit' class="btn btn-primary btn-block">الدفع باستخدام سترايب</button>
                        <a href="{{ route('show_basket') }}" class="btn btn-primary btn-block">عودة الي الصفحة السابقة</a>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://checkout.stripe.com/checkout.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function changeQuantity(amount) {
        const quantityElement = document.getElementById('quantity');
        let quantity = parseInt(quantityElement.textContent) + amount;
        if (quantity < 1) {
            quantity = 1;
        }
        quantityElement.textContent = quantity;

        const countInput = document.getElementById('count');
        countInput.value = quantity;

        updateTotal();
    }

    function updateTotal() {
        const quantity = parseInt(document.getElementById('quantity').textContent);
        const price = parseFloat("{{ $clothingproduct->price }}"); // تحويل السعر إلى رقم عائم
        const total = quantity * price;
        document.getElementById('total').textContent = total;
        // تحديث قيمة data-amount
        document.querySelector('.stripe-button').setAttribute('data-amount', total * 100);
    }


    
</script>
@endsection
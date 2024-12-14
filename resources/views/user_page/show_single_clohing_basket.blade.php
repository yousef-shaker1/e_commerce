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
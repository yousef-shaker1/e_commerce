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
        <!-- Cart Items -->
        <div class="col-lg-8">
            <h2 class="mb-4">Shopping Cart</h2>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a href="{{ Storage::url($clothingproduct->img) }}">
                                        <img src="{{ Storage::url($clothingproduct->img) }}" alt="Product Image"
                                            class="rounded" style="width: 100px; height: auto;">
                                    </a>
                                </td>
                                <td>{{ $clothingproduct->name }}</td>
                                <td>{{ $clothingproduct->description }}</td>
                                <td>{{ $size->size }}</td>
                                <td>
                                    @if($color_product)
                                        <a href="{{ Storage::url($color_product->image) }}">
                                            <img src="{{ Storage::url($color_product->image) }}" alt="Color Image"
                                                class="rounded-circle" style="width: 50px; height: 50px;">
                                        </a>
                                        <br>
                                        <span class="badge bg-secondary mt-2">{{ $color_product->color->name }}</span>
                                    @else
                                        <span class="text-muted">No color available</span>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($size_product))
                                        <span class="text-success fw-bold">${{ $size_product->price }}</span>
                                    @else
                                        <span class="text-success fw-bold">${{ $clothingproduct->price }}</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Cart Summary -->
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Cart Summary</h5>
                    <form action="{{ route('send_clothing_order', $clothingproduct->id) }}" method="POST" id="payment-form">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $clothingproduct->id }}">
                        <div class="form-group mb-3">
                            <label for="date" class="form-label">Delivery Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ $clothingproduct->date }}">
                            <input type="hidden" class="form-control" id="size" name="size" value="{{ $size->size }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <div class="input-group">
                                <button class="btn btn-outline-primary" type="button" onclick="changeQuantity(-1)">-</button>
                                <span id="quantity" class="form-control text-center quantity-value">1</span>
                                <button class="btn btn-outline-primary" type="button" onclick="changeQuantity(1)">+</button>
                                <input type="hidden" id="count" name="count" value="1">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Total:</span>
                                <span id="total" class="fw-bold text-success">${{ $clothingproduct->price }}</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mb-3">Pay with Stripe</button>
                        <a href="{{ route('show_basket') }}" class="btn btn-outline-secondary btn-block">Back to Previous Page</a>
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

<!DOCTYPE html>
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
            background-color: #000000;
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
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .product-details {
            background-color: #ff8c00;
            /* اللون البرتقالي */
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
            background-image: url("/assets/img/shop3.png");
            /* تأكد من أن المسار صحيح */
            background-size: cover;
            /* تجعل الصورة تغطي العنصر بالكامل */
            background-position: center;
            /* تضبط الصورة في المركز */
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
                    @if (!empty(Auth::user()->name))
                        <a class="btn btn-primary" href="{{ route('add_basket', $product->id) }}">إضافة إلى السلة</a>
                  <a href="{{ route('section_product_view', $product->section->id) }}" class="btn btn-primary">عودة الي الصفحة السابقة</a>
                    @else
                        <a class="btn btn-primary" href="{{ route('login') }}">من فضلك سجل الدخول</a>
                  <a href="{{ route('section_product_view', $product->section->id) }}" class="btn btn-primary">عودة الي الصفحة السابقة</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

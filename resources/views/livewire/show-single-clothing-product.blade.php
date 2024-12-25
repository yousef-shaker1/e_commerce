<div>

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
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
    <div class="product-details mt-5">
        <!-- عرض اسم المنتج -->
        <h3 class="text-primary mb-3">{{ $product->name }}</h3>

        <!-- عرض الوصف بشكل أنيق -->
        <div class="product-description mb-4">
            <p class="text-muted mb-3">{{ $product->description }}</p>
        </div>
    </div>

    @if ($price)
        <h4 class="text-success">Price: {{ $price }}$</h4>
    @else
        <h4 class="text-success">Price: {{ $product->price }}$</h4>
    @endif

    @if ($price)
        <div class="alert alert-info mt-3 d-flex align-items-center" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i>
            <span>السعر تم تغييره بناءً على المقاس الذي اخترته.</span>
        </div>
    @else
        <div class="alert alert-warning mt-3 d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            <span>يرجى اختيار مقاس لتحديد السعر المحدد.</span>
        </div>
        @endif

    @if ($amount == 0 && $selectedSize == true)
        <h4 class="text-danger">Out of stock</h4>
    @endif
    @if($check_color)

    <!-- الألوان -->
    <div class="colors-section mt-4">
        <h5 class="mb-3">الألوان المتاحة:</h5>
        <div class="d-flex flex-wrap justify-content-start">
            @foreach ($colors as $color)
                <div class="color-thumbnail text-center mx-2">
                    <input type="radio" name="selected_color" wire:model.live="selectedColor"
                        value="{{ $color->color_id }}" id="color_{{ $color->id }}">
                    <label for="color_{{ $color->id }}" class="color-option" style="cursor: pointer;">
                        <img src="{{ Storage::url($color->image) }}" alt="{{ $color->color->name }}"
                            class="img-fluid rounded-circle border"
                            style="width: 50px; height: 50px; object-fit: cover;">
                        <p class="small mt-2">{{ $color->color->name }}</p>
                    </label>
                </div>
            @endforeach
        </div>
    </div>
    <!-- المقاسات -->
    <div class="form-group mt-4">
        <h5 class="mb-3">اختيار المقاس:</h5>
        <select wire:model.live="selectedSize" class="form-control custom-select" id="product_size" name="product_size">
            <option value="">من فضلك اختار مقاس</option>
            @foreach ($sizes as $size)
                <option value="{{ $size->id }}">{{ $size->size }}</option>
            @endforeach
        </select>

    </div>

    @else
    <div class="form-group mt-4">
        <h5 class="mb-3">اختيار المقاس:</h5>
        <select wire:model.live="selectedSize" class="form-control custom-select" id="product_size" name="product_size">
            <option value="">من فضلك اختار مقاس</option>
            @foreach ($relationSizes as $size)
                <option value="{{ $size->size->id }}">{{ $size->size->size }}</option>
            @endforeach
        </select>

    </div>
    @endif
    <!-- الأزرار -->
    <div class="actions mt-4"> 
        @if (!empty(Auth::user()->name))

            @if($check_color)
                <a class="btn btn-primary btn-block" 
                wire:click="addToBasket" 
                id="add_to_basket"
                wire:disabled="!selectedColor || !selectedSize">
                    إضافة إلى السلة
                </a>
                <a class="btn btn-primary btn-block" 
                wire:click="OrderNow" 
                id="ordernow"
                wire:disabled="!selectedColor || !selectedSize">
                    اطلب الان
                </a>
            @else
            <a class="btn btn-primary btn-block" 
            wire:click="add_To_Basket" 
            id="add_to_basket">
                إضافة إلى السلة
            </a>
            <a class="btn btn-primary btn-block" 
            wire:click="Order_Now" 
            id="order_now">
                اطلب الان
            </a>
            @endif
        @else
            <a class="btn btn-primary btn-block" href="{{ route('login') }}">من فضلك سجل الدخول</a>
        @endif
        <a href="{{ route('clothing_section_product_view', $product->section->id) }}"
            class="btn btn-secondary btn-block mt-2">
            عودة إلى الصفحة السابقة
        </a>
    </div>
</br>

</div>

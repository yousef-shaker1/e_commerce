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
        <h4 class="text-success">{{ __('page.price') }}: {{ $price }}$</h4>
    @else
        <h4 class="text-success">{{ __('page.price') }}: {{ $product->price }}$</h4>
    @endif

    @if ($price)
        <div class="alert alert-info mt-3 d-flex align-items-center" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i>
            <span>{{ __('page.change_price') }}</span>
        </div>
    @else
        <div class="alert alert-warning mt-3 d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            <span>{{ __('page.select_size')  }}</span>
        </div>
        @endif

    @if ($amount == 0 && $selectedSize == true)
        <h4 class="text-danger">{{ __('page.stoke') }}</h4>
    @endif
    @if($check_color)

    <!-- الألوان -->
    <div class="colors-section mt-4">
        <h5 class="mb-3">{{ __('page.color_now') }}</h5>
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
        <h5 class="mb-3">{{ __('page.choose_size') }}:</h5>
        <select wire:model.live="selectedSize" class="form-control custom-select" id="product_size" name="product_size">
            <option value="">{{ __('page.plase_choose_size') }}</option>
            @foreach ($sizes as $size)
                <option value="{{ $size->id }}">{{ $size->size }}</option>
            @endforeach
        </select>

    </div>

    @else
    <div class="form-group mt-4">
        <h5 class="mb-3">{{ __('page.choose_size') }}:</h5>
        <select wire:model.live="selectedSize" class="form-control custom-select" id="product_size" name="product_size">
            <option value="">{{ __('page.plase_choose_size') }}</option>
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
                    {{ __('page.add_to_car') }}
                </a>
                <a class="btn btn-primary btn-block" 
                wire:click="OrderNow" 
                id="ordernow"
                wire:disabled="!selectedColor || !selectedSize">
                    {{ __("page.order_now") }}
                </a>
            @else
            <a class="btn btn-primary btn-block" 
            wire:click="add_To_Basket" 
            id="add_to_basket">
                {{ __('page.add_to_car') }}
            </a>
            <a class="btn btn-primary btn-block" 
            wire:click="Order_Now" 
            id="order_now">
                {{ __("page.order_now") }}
            </a>
            @endif
        @else
            <a class="btn btn-primary btn-block" href="{{ route('login') }}">{{ __('page.login_please') }}</a>
        @endif
        <a href="{{ route('clothing_section_product_view', $product->section->id) }}"
            class="btn btn-secondary btn-block mt-2">
            {{ __('page.back_to_page') }}
        </a>
    </div>
</br>

</div>

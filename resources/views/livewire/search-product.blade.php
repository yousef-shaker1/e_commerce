<div>
    {{-- <input wire:model.debounce.500ms='search' type='text' placeholder="Search products..."> --}}
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input wire:model.lazy='search' type='text' class="form-control" placeholder="Search products...">
                    <div class="input-group-append">
                        <button wire:click="searchProducts" class="btn btn-primary" type="button">Search</button>
                    </div>
                </div>
            </div>
        </div>
    <div class="product-section mt-120 mb-120">
        <div class="container">
            <div class="row product-lists">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 text-center strawberry">
                        <div class="single-product-item">
                            <div class="product-image">
                                <img src="{{ Storage::url($product->img) }}" style="width: 200px; height: 160px; object-fit: cover;">
                            </div>
                            <h3>{{ $product->name }} </h3>
                            <h3>{{ $product->description }}</h3>
                            <h3>{{ $product->price }} $</h3>
                            <a href="{{ route('product_view', $product->id) }}" class="cart-btn"><i class="fas fa-shopping-cart"></i>اضف الي السلة</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('input', function(event){
        if(event.target.matches('[wire\\:model]')){
            window.livewire.directive('refresh');
        }
   });
</script>
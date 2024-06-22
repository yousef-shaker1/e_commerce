<div>
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

        <div class="product-section">
            <div class="container">
                <div class="row product-lists">
                    @foreach ($clothing_products as $clothing_product)
                        <div class="col-lg-4 col-md-6 text-center {{ $clothing_product->type }}">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <img src="{{ Storage::url($clothing_product->img) }}" style="width: 200px; height: 200px; object-fit: cover;">
                                </div>
                                <h2>{{ $clothing_product->name }}</h2>
                                <h3>{{ $clothing_product->description }}</h3>
                                <h3>{{ $clothing_product->price }} $</h3>                                
                                <a href="{{ route('clothing_product_view', $clothing_product->id) }}" class="cart-btn">
                                    <i class="fas fa-shopping-cart"></i>اضف الي السلة
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination-wrapper mt-4">
                    <ul class="pagination justify-content-center">
                        <!-- زر الصفحة السابقة -->
                        @if ($clothing_products->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">السابق</span></li>
                        @else
                            <li class="page-item"><a href="{{ $clothing_products->previousPageUrl() }}" class="page-link" rel="prev">السابق</a></li>
                        @endif

                        <!-- أرقام الصفحات -->
                        @foreach(range(1, $clothing_products->lastPage()) as $page)
                            <li class="page-item {{ $page == $clothing_products->currentPage() ? 'active' : '' }}">
                                <a href="{{ $clothing_products->url($page) }}" class="page-link">{{ $page }}</a>
                            </li>
                        @endforeach

                        <!-- زر الصفحة التالية -->
                        @if ($clothing_products->hasMorePages())
                            <li class="page-item"><a href="{{ $clothing_products->nextPageUrl() }}" class="page-link" rel="next">التالي</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">التالي</span></li>
                        @endif
                    </ul>
                </div>
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

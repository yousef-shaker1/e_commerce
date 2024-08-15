<div>
    <div class="row">
        <div class="col-md-12">
            <div class="product-filters text-center">
                <ul class="d-inline-flex">
                    <li class="{{ $filter === 'all' ? 'active' : '' }}" wire:click="$set('filter', 'all')">All</li>
                    <li class="{{ $filter === 'رجالي' ? 'active' : '' }}" wire:click="$set('filter', 'رجالي')">رجالي</li>
                    <li class="{{ $filter === 'حريمي' ? 'active' : '' }}" wire:click="$set('filter', 'حريمي')">حريمي</li>
                    <li class="{{ $filter === 'اطفالي' ? 'active' : '' }}" wire:click="$set('filter', 'اطفالي')">اطفالي</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- products -->
    <div class="product-section">
        <div class="container">
            <div class="row clothing-product-lists">
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
            
            <!-- Pagination -->
            <div class="pagination-wrapper mt-4 text-center">
                {{ $clothing_products->links() }}
            </div>
        </div>
    </div>
</div>

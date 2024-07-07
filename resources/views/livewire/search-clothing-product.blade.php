<div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input wire:model.live='search' type='text' class="form-control" placeholder="Search products...">
                </div>
            </div>
        </div>

        <div class="product-section">
            <div class="container">
                <div class="row product-lists">
                    @forelse ($clothing_products as $clothing_product)
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
                    @empty
                        <tr>
                            <td colspan="10" class="text-center bg-warning text-white fw-bold">No product Found</td>
                        </tr>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center my-4">
                    {{ $clothing_products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


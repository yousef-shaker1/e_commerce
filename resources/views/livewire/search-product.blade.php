<div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input wire:model.live='search' type='text' class="form-control" placeholder="Search products...">
                </div>
            </div>
        </div>
        <div class="product-section mt-5 mb-120">
            <div class="container">
                <div class="row product-lists">
                    @forelse ($products as $product)
                        <div class="col-lg-4 col-md-6 text-center strawberry">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <img src="{{ Storage::url($product->img) }}" style="width: 200px; height: 160px; object-fit: cover;" loading="lazy">
                                </div>
                                <h3>{{ $product->name }} </h3>
                                <h3>{{ $product->description }}</h3>
                                <h3>{{ $product->price }} $</h3>
                                <a href="{{ route('product_view', $product->id) }}" class="cart-btn"><i class="fas fa-shopping-cart"></i>اضف الي السلة</a>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center bg-warning text-white fw-bold">No product Found</td>
                        </tr>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center my-4">
                    {{ $products->links('pagination::simple-bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
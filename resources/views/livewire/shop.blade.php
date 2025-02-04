<div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- <div class="input-group mb-3">
                <input wire:model='search' type='text' class="form-control" placeholder="Search products...">
            </div> --}}
        </div>
    </div>
    
    <div class="row product-lists">
        @forelse ($sections as $section)
            <div class="col-lg-4 col-md-6 text-center strawberry">
                    <div class="single-product-item">
                            <div class="product-image">
                                <img src="{{ Storage::url($section->img) }}" style="width: 200px; height: 160px; object-fit: cover;">
                            </div>
                            <h3>{{ $section->name }}</h3>
                            <a href="{{ route('section_product_view', $section->id) }}" class="cart-btn"><i ></i>View</a>		
                    </div>
            </div>
            @empty
            <tr>
                <td colspan="10" class="text-center bg-warning text-white fw-bold">No Record Found</td>
            </tr>
        @endforelse
        
        @foreach ($clothing_sections as $clothing_section)
                <div class="col-lg-4 col-md-6 text-center strawberry">
                        <div class="single-product-item">
                                <div class="product-image">
                                    <img src="{{ Storage::url($clothing_section->img) }}" style="width: 200px; height: 160px; object-fit: cover;">
                                </div>
                                <h3>{{ $clothing_section->name }}</h3>
                                <a href="{{ route('clothing_section_product_view', $clothing_section->id) }}" class="cart-btn"><i ></i>View</a>		
                        </div>
                </div>
        @endforeach
</div>
</div>

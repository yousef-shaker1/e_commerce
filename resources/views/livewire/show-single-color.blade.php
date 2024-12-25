<div>
    @include('livewire.model-show-single-color')

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <table class="table table-borderless table-hover" style="width: 1000px">
        <div class="input-group mb-3">
            <input wire:model.live="search" placeholder="Search" class="form-control form-control-lg" type="text">
        </div>
        <div class="d-flex justify-content-between">
            {{-- @can('اضافة منتج') --}}
            <button type="button" class="modal-effect btn btn-outline-primary btn-block" data-bs-toggle="modal"
                data-bs-target="#addColorModal">
                Add Color
            </button>
            {{-- @endcan --}}
        </div>
        <thead>
            <tr>
                <th>#</th>
                <th class="border-bottom-0">product_name</th>
                <th class="border-bottom-0">color</th>
                <th class="border-bottom-0">img</th>
                <th class="border-bottom-0">size&price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @forelse ($relationcolors as $color)
                <?php $i++; ?>
                <tr>
                    <td class="mb-0 text-muted">{{ $i }}</td>

                    <td class="mb-0 text-muted">{{ $color->product->name }}</td>
                    <td class="mb-0 text-muted">
                        <div style="display: inline-block;
                                    background-color: 
                                        @switch($color->color->name)
                                            @case('Red')
                                                red;
                                                @break
                                            @case('Blue')
                                                blue;
                                                @break
                                            @case('Green')
                                                green;
                                                @break
                                            @case('Yellow')
                                                yellow;
                                                @break
                                            @case('Black')
                                                black;
                                                @break
                                            @case('White')
                                                white;
                                                @break
                                            @case('Gray')
                                                gray;
                                                @break
                                            @case('Purple')
                                                purple;
                                                @break
                                            @case('Orange')
                                                orange;
                                                @break
                                            @case('Pink')
                                                pink;
                                                @break
                                            @case('Brown')
                                                brown;
                                                @break
                                            @case('Cyan')
                                                cyan;
                                                @break
                                            @case('Magenta')
                                                magenta;
                                                @break
                                            @case('Beige')
                                                beige;
                                                @break
                                            @case('Ivory')
                                                ivory;
                                                @break
                                            @case('Turquoise')
                                                turquoise;
                                                @break
                                            @case('Teal')
                                                teal;
                                                @break
                                            @case('Gold')
                                                gold;
                                                @break
                                            @case('Silver')
                                                silver;
                                                @break
                                            @case('Lavender')
                                                lavender;
                                                @break
                                            @case('Maroon')
                                                maroon;
                                                @break
                                            @case('Navy')
                                                navy;
                                                @break
                                            @case('Olive')
                                                olive;
                                                @break
                                            @case('Coral')
                                                coral;
                                                @break
                                            @case('Salmon')
                                                salmon;
                                                @break
                                            @case('Chocolate')
                                                chocolate;
                                                @break
                                            @case('Crimson')
                                                crimson;
                                                @break
                                            @case('Indigo')
                                                indigo;
                                                @break
                                            @case('Violet')
                                                violet;
                                                @break
                                            @case('Mint')
                                                mint;
                                                @break
                                            @case('Lime')
                                                lime;
                                                @break
                                            @case('Peach')
                                                peach;
                                                @break
                                            @default
                                                #f0f0f0; 
                                        @endswitch;
                                        width: 20px; height: 20px; border-radius: 50%; 
                                        margin-right: 10px; display: inline-block;">
                        </div>
                        {{ $color->color->name }}
                    </td>
                    <td class="mb-0 text-muted">
                        <div class="product-image">
                            <a href="{{ Storage::url($color->image) }}"><img src="{{ Storage::url($color->image) }}"
                                    style="width: 100px; height: 100px; object-fit: cover;"></a>
                        </div>
                    </td>
                    <td class="mb-0 text-muted">
                        <a href="{{ route('view_size_and_price', $color->id) }}" class="cart-btn">
                            <i class="fas fa-shopping-cart"></i>view
                        </a>
                    </td>
                    <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">

                            {{-- @can('حذف المنتج') --}}
                            <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                data-bs-target="#deleteColorModal" wire:click="delete_Color_Product({{ $color->id }})">
                                Remove
                            </button>
                            {{-- @endcan --}}
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No sizes found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

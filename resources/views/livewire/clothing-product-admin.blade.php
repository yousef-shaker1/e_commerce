<div>
    @include('livewire.model-clothing-product')

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
            <strong>{{ session()->get('success') }}</strong>
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
                @can('اضافة منتج الملابس')
                    <button type="button" class="modal-effect btn btn-outline-primary btn-block"
                        data-bs-toggle="modal" data-bs-target="#addProductModal">
                        Add Product
                    </button>
                @endcan
            </div>
        <thead>
            <tr>
                <th>#</th>
                <th class="border-bottom-0">image</th>
                <th class="border-bottom-0">name</th>
                <th class="border-bottom-0">description</th>
                <th class="border-bottom-0">price</th>
                <th class="border-bottom-0">type</th>
                @can('عرض حجم وسعر المنتج')
                <th class="border-bottom-0">amount&size</th>
                @endcan
                @can('عرض لون المنتج')
                <th class="border-bottom-0">colors</th>
                @endcan
                @can('عرض صور المنتج الملابس')
                <th class="border-bottom-0">images</th>
                @endcan
                <th class="border-bottom-0">section</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td class="mb-0 text-muted">{{ $products->firstItem() + $loop->index }}</td>
                    <td class="mb-0 text-muted"><a href="{{ Storage::url($product->img) }}"><img
                                src="{{ Storage::url($product->img) }}" style="width: 80px; height: 50px;"></a></td>
                    <td class="mb-0 text-muted">{{ $product->name }}</td>
                    <td class="mb-0 text-muted">{{ $product->description }}</td>
                    <td class="mb-0 text-muted">{{ $product->price }}</td>
                    <td class="mb-0 text-muted">{{ $product->type }}</td>
                    @can('عرض حجم وسعر المنتج')
                    <td> <a href='{{ route('show_size_product', $product->id) }}'>view size
                        </a></td>
                    @endcan
                    @can('عرض لون المنتج')
                    <td> <a href='{{ route('show_color_product', $product->id) }}'>view color
                        </a></td>
                    @endcan
                    @can('عرض صور المنتج الملابس')
                    <td> <a href='{{ route('show_images_product', $product->id) }}'>view images
                        </a></td>
                    @endcan
                    <td class="mb-0 text-muted">{{ $product->section->name }}</td>
                    <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            @can('تعديل منتج الملابس')
                                <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#updateProductModal" wire:click="editProduct({{ $product->id }})">
                                    Edit
                                </button>
                            @endcan

                            @can('حذف منتج الملابس')
                                <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#deleteProductModal"
                                    wire:click="deleteProduct({{ $product->id }})">
                                    Remove
                                </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">No products found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center my-4">
        {{ $products->links('pagination::simple-bootstrap-5') }}
    </div>
</div>

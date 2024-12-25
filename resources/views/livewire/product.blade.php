<div>
    @include('livewire.model-product')

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
                @can('اضافة منتج')
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
                <th class="border-bottom-0">amount</th>
                <th class="border-bottom-0">section</th>
                <th class="border-bottom-0">images</th>
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
                    <td class="mb-0 text-muted">{{ $product->amount }}</td>
                    <td class="mb-0 text-muted">{{ $product->section->name }}</td>
                    <td class="mb-0 text-muted"><a href="{{ route('view_images', $product->id) }}">view images</a></td>
                    <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            @can('تعديل المنتج')
                                <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#updateProductModal" wire:click="editProduct({{ $product->id }})">
                                    Edit
                                </button>
                            @endcan

                            @can('حذف المنتج')
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
                    <td colspan="10" class="text-center">No product found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center my-4">
        {{ $products->links() }}
    </div>
</div>

<div>
    @include('livewire.model-show-size-and-price')

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
        <div class="d-flex justify-content-between">
            {{-- @can('اضافة منتج') --}}
            <button type="button" class="modal-effect btn btn-outline-primary btn-block" data-bs-toggle="modal"
                data-bs-target="#addSizeModal">
                Add size
            </button>
            {{-- @endcan --}}
        </div>
        <thead>
            <tr> 
                <th>#</th>
                <th class="border-bottom-0">product_name</th>
                <th class="border-bottom-0">color</th>
                <th class="border-bottom-0">size</th>
                <th class="border-bottom-0">amount</th>
                <th class="border-bottom-0">price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @forelse ($sizes as $size)
            <?php $i++?>
                <tr>
                    <td class="mb-0 text-muted">{{ $i }}</td>

                    <td class="mb-0 text-muted">{{ $size?->color_product?->product?->name }}</td>
                    <td class="mb-0 text-muted">{{ $size?->color_product?->color?->name }}</td>
                    <td class="mb-0 text-muted">{{ $size?->size?->size }}</td>
                    <td class="mb-0 text-muted">{{ $size?->amount }}</td>
                    <td class="mb-0 text-muted">{{ $size?->price }}</td>
                    <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">

                            {{-- @can('حذف المنتج') --}}
                            <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                data-bs-target="#UpdateSizeModal" wire:click="EditSize({{ $size->id }})">
                                Edit
                            </button>
                            {{-- @endcan --}}

                            {{-- @can('حذف المنتج') --}}
                            <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                data-bs-target="#deleteSizeModal" wire:click="DeleteSize({{ $size->id }})">
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

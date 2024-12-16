<div>
    @include('livewire.model-size')

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
            @can('اضافة مقاس')
                <button type="button" class="modal-effect btn btn-outline-primary btn-block" data-bs-toggle="modal"
                    data-bs-target="#addSizeModal">
                    Add Size
                </button>
            @endcan
        </div>
        <thead>
            <tr>
                <th>#</th>
                <th class="border-bottom-0">size</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sizes as $size)
                <tr>
                    <td class="mb-0 text-muted">{{ $sizes->firstItem() + $loop->index }}</td>
                    <td class="mb-0 text-muted">{{ $size->size }}</td>
                    <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">

                            @can('حذف مقاس')
                                <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#deleteSizeModal" wire:click="deleteSize({{ $size->id }})">
                                    Remove
                                </button>
                            @endcan
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
    <div class="d-flex justify-content-center my-4">
        {{ $sizes->links() }}
    </div>
</div>

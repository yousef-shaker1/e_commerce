<div>
    @include('livewire.model-image-product')

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
            {{-- @can('اضافة لون') --}}
                <button type="button" class="modal-effect btn btn-outline-primary btn-block" data-bs-toggle="modal"
                    data-bs-target="#addImageModal">
                    Add image
                </button>
            {{-- @endcan --}}
        </div>
        <thead>
            <tr>
                <th>#</th>
                <th class="border-bottom-0">name product</th>
                <th class="border-bottom-0">images</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($imagess as $img)
                <tr>
                    <td class="mb-0 text-muted">{{ $img->id }}</td>
                    <td class="mb-0 text-muted">{{ $img->product->name }}</td>
                    <td class="mb-0 text-muted">
                        <a href="{{ Storage::url($img->image) }}"><img src="{{ Storage::url($img->image) }}" style="width: 100px; height: 100px; object-fit: cover;">
                    </a>    
                    </td>
                    <td>
                        <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#deleteImageModal" wire:click="deleteImage({{ $img->id }})">
                                Remove
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

</div>

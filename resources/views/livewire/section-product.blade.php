<div>
    @include('livewire.model-section')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <table class="table table-borderless table-hover" style="width: 1000px">
            <div class="d-flex justify-content-between">
                @can('اضافة قسم')
                    <button type="button" class="modal-effect btn btn-outline-primary btn-block"
                        data-bs-toggle="modal" data-bs-target="#addSectionModal">
                        Add Section
                    </button>
                @endcan
            </div>
        <thead>
            <tr>
                <th>#</th>
                <th class="border-bottom-0">image</th>
                <th class="border-bottom-0">name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sections as $section)
                <tr>
                    <td class="mb-0 text-muted">{{ $sections->firstItem() + $loop->index }}</td>
                    <td class="mb-0 text-muted"><a href="{{ Storage::url($section->img) }}"><img
                                src="{{ Storage::url($section->img) }}" style="width: 80px; height: 50px;"></a></td>
                    <td class="mb-0 text-muted">{{ $section->name }}</td>
                    <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            @can('تعديل القسم')
                                <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#updateSectionModal" wire:click="editSection({{ $section->id }})">
                                    Edit
                                </button>
                            @endcan
                            @can('حذف القسم')
                                <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#deleteSectionModal"
                                    wire:click="deleteSection({{ $section->id }})">
                                    Remove
                                </button>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center my-4">
        {{ $sections->links() }}
    </div>
</div>

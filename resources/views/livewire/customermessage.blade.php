<div>
    @include('livewire.model-massage')
    @if (session()->has('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <table class="table table-borderless table-hover" style="width: 1000px">
        <thead>
            <tr>
                <th>#</th>
                <th class="border-bottom-0">name</th>
                <th class="border-bottom-0">email</th>
                <th class="border-bottom-0">phone</th>
                <th class="border-bottom-0">message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td class="mb-0 text-muted">{{ $messages->firstItem() + $loop->index }}</td>
                    <td class="mb-0 text-muted">{{ $message->customer->name }}</td>
                    <td class="mb-0 text-muted">{{ $message->customer->email }}</td>
                    <td class="mb-0 text-muted">{{ $message->customer->phone }}</td>
                    <td class="mb-0 text-muted">{{ $message->message }}</td>

                    <td class="mb-0 text-muted"><button class="btn btn-sm dropdown-toggle more-horizontal"
                            type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            @can('حذف اراء العملاء')
                                <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#deleteMassageModal" wire:click="deleteStudent({{ $message->id }})">
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
        {{ $messages->links('pagination::simple-bootstrap-5') }}
    </div>
</div>

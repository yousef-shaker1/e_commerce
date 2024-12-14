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
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        @can('اضافة مقاس')
                        <button type="button" class="modal-effect btn btn-outline-primary btn-block" data-bs-toggle="modal" data-bs-target="#addSizeModal">
                            اضافة مقاس
                          </button>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">المقاس</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($sizes as $size)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $size->size }}</td>
                                        <td>
                                            @can('حذف مقاس')
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteSizeModal" wire:click="deleteSize({{$size->id}})" class="modal-effect btn btn-sm btn-danger">Delete</button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $sizes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- row closed -->
    </div>
    <!-- Container closed -->
</div>
</div>

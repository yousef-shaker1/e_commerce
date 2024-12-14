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
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم العميل</th>
                                    <th class="border-bottom-0">بريد العميل</th>
                                    <th class="border-bottom-0">هاتف العميل</th>
                                    <th class="border-bottom-0">الرسالة</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($messages as $message)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $message->customer->name }}</td>
                                        <td>{{ $message->customer->email }}</td>
                                        <td>{{ $message->customer->phone }}</td>
                                        <td>{{ $message->message }}</td>
                                        <td>
                                            @can('حذف اراء العملاء')
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#deleteMassageModal"
                                                    wire:click="deleteStudent({{ $message->id }})"
                                                    class="btn btn-danger">حذف</button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $messages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- End Basic modal -->
    </div>





    <!-- row closed -->
</div>
<!-- Container closed -->
</div>

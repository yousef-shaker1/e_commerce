<div>
    @include('livewire.model-order-admin')
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
        <thead>
            <tr>
                <th>#</th>
                <th class="border-bottom-0">name</th>
                <th class="border-bottom-0">email</th>
                <th class="border-bottom-0">phone</th>
                <th class="border-bottom-0">address</th>
                <th class="border-bottom-0">date</th>
                <th class="border-bottom-0">product_name</th>
                <th class="border-bottom-0">size</th>
                <th class="border-bottom-0">amount</th>
                <th class="border-bottom-0">price</th>
                <th class="border-bottom-0">total</th>
                <th class="border-bottom-0">section</th>
                <th class="border-bottom-0">status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($orders as $order)
                <tr>
                    <td>{{ $orders->firstItem() + $loop->index }}</td>

                    <td class="mb-0 text-muted">{{ $order->customer->name }}</td>
                    <td class="mb-0 text-muted">{{ $order->customer->email }}</td>
                    <td class="mb-0 text-muted">{{ $order->customer->phone }}</td>
                    <td class="mb-0 text-muted">{{ $order->customer->address }}</td>
                    <td class="mb-0 text-muted">{{ $order->day }}</td>
                    <td class="mb-0 text-muted">{{ $order->product->name }}</td>
                    <td class="mb-0 text-muted">{{ $order->size }}</td>
                    <td class="mb-0 text-muted">{{ $order->count }}</td>
                    <td class="mb-0 text-muted">{{ $order->product->price }}</td>
                    <td class="mb-0 text-muted">{{ $order->product->price * $order->count }}</td>
                    <td class="mb-0 text-muted">{{ $order->product->section->name }}</td>
                    <td style="width: 100px; padding: 17px; text-align: center; vertical-align: middle;"
                        class="text-white 
                            @if ($order->status == 'يتم مراجعة الطلب') bg-secondary 
                            @elseif($order->status == 'قبول') bg-primary 
                            @elseif($order->status == 'رفض') bg-danger 
                            @elseif($order->status == 'اتمام') bg-success @endif">
                        {{ $order->status }}
                    </td>

                    <td class="mb-0 text-muted">
                        <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">

                            @can('قبول الاوردر')
                                <a wire:click="status1({{ $order->id }})" class="btn btn-primary btn-sm mb-1">قبول</a>
                            @endcan

                            @can('رفض الاوردر')
                                <a wire:click="status2({{ $order->id }})" class="btn btn-danger btn-sm mb-1">رفض</a>
                            @endcan

                            @can('اتمام الاوردر')
                                <a wire:click="status3({{ $order->id }})" class="btn btn-success btn-sm mb-1">اتمام</a>
                            @endcan

                            @can('حذف الاوردر')
                                <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#destroyOrderModal" wire:click="deleteOrder({{ $order->id }})">
                                    Remove
                                </button>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No orders found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center my-4">
        {{ $orders->links() }}
    </div>
</div>

@extends('layouts.master_admin')
@section('css')
    <style>
        .navbar-custom {
            background-color: #343a40;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff;
        }

        .navbar-custom .nav-link:hover {
            color: #d4d4d4;
        }
    </style>
@endsection

@section('title')
    العملاء
@endsection

@section('content')

    <table class="table table-borderless table-hover" style="width: 1000px">
        <thead>
            <tr>
                <th>#</th>
                <th class="border-bottom-0">name</th>
                <th class="border-bottom-0">email</th>
                <th class="border-bottom-0">phone</th>
                <th class="border-bottom-0">basket</th>
                <th class="border-bottom-0">order</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @forelse ($customers as $customer)
            <?php $i++?>
                <tr>
                    <td class="mb-0 text-muted">{{ $customers->firstItem() + $loop->index }}</td>

                    <td class="mb-0 text-muted">{{ $customer->name }}</td>
                    <td class="mb-0 text-muted">{{ $customer->email }}</td>
                    <td class="mb-0 text-muted">{{ $customer->phone }}</td>
                    <td>{{ \App\Models\basket::where('customer_id', $customer->id)->count() + \App\Models\clothesbasket::where('customer_id', $customer->id)->count()}}</td>
                    <td>{{ \App\Models\order::where('customer_id', $customer->id)->count() + \App\Models\clothingorder::where('customer_id', $customer->id)->count() }}</td>
                </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No sizes found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <ul class="pagination justify-content-center">
            <!-- زر الصفحة السابقة -->
            @if ($customers->onFirstPage())
                <li class="page-item disabled"><span class="page-link">السابق</span></li>
            @else
                <li class="page-item"><a href="{{ $customers->previousPageUrl() }}" class="page-link" rel="prev">السابق</a></li>
            @endif
    
            <!-- أرقام الصفحات -->
            @foreach(range(1, $customers->lastPage()) as $page)
                <li class="page-item {{ $page == $customers->currentPage() ? 'active' : '' }}">
                    <a href="{{ $customers->url($page) }}" class="page-link">{{ $page }}</a>
                </li>
            @endforeach
    
            <!-- زر الصفحة التالية -->
            @if ($customers->hasMorePages())
                <li class="page-item"><a href="{{ $customers->nextPageUrl() }}" class="page-link" rel="next">التالي</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">التالي</span></li>
            @endif
        </ul>
@endsection
@section('js')

@endsection

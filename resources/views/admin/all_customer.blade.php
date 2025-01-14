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

<div class="container">
    <table class="table table-borderless table-hover" style="width: 100%;">
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
            @forelse ($customers as $customer)
                <tr>
                    <td class="mb-0 text-muted">{{ $customers->firstItem() + $loop->index }}</td>
                    <td class="mb-0 text-muted">{{ $customer->name }}</td>
                    <td class="mb-0 text-muted">{{ $customer->email }}</td>
                    <td class="mb-0 text-muted">{{ $customer->phone }}</td>
                    <td>{{ \App\Models\basket::where('customer_id', $customer->id)->count() + \App\Models\clothesbasket::where('customer_id', $customer->id)->count() }}</td>
                    <td>{{ \App\Models\order::where('customer_id', $customer->id)->count() + \App\Models\clothingorder::where('customer_id', $customer->id)->count() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No sizes found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center my-4">
        <ul class="pagination">
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
    </div>
</div>

@endsection
@section('js')

@endsection

@extends('layouts.master_admin')

@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    الاوردرات 
@endsection

@section('content')
    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
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

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class='alert alert-danger'>
            @foreach ($errors->all() as $error)
                {{ $error }}
                <br>
            @endforeach
        </div>
    @endif

    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم العميل</th>
                                    <th class="border-bottom-0">ايميل العميل</th>
                                    <th class="border-bottom-0">تليفون العميل</th>
                                    <th class="border-bottom-0">عنوان العميل</th>
                                    <th class="border-bottom-0">تاريخ وصول الاوردر</th>
                                    <th class="border-bottom-0">اسم المنتج</th>
                                    <th class="border-bottom-0">الكمية</th>
                                    <th class="border-bottom-0">سعر المنتج</th>
                                    <th class="border-bottom-0">المجموع</th>
                                    <th class="border-bottom-0">القسم التابع للمنتج</th>
                                    <th class="border-bottom-0">حالة الاوردر</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($orders as $order)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $order->customer->name }}</td>
                                        <td>{{ $order->customer->email }}</td>
                                        <td>{{ $order->customer->phone }}</td>
                                        <td>{{ $order->customer->address }}</td>
                                        <td>{{ $order->day }}</td>
                                        <td>{{ $order->product->name }}</td>
                                        <td>{{ $order->count }}</td>
                                        <td>{{ $order->product->price }}</td>
                                        <td>{{ $order->product->price * $order->count }}</td>
                                        <td>{{ $order->product->section->name }}</td>
                                        <td style="width: 100px; padding: 17px; text-align: center; vertical-align: middle;" class="text-white 
                                            @if ($order->status == 'يتم مراجعة الطلب') bg-secondary 
                                            @elseif($order->status == 'قبول') bg-primary 
                                            @elseif($order->status == 'رفض') bg-danger 
                                            @elseif($order->status == 'اتمام') bg-success 
                                            @endif">
                                            {{ $order->status }}
                                        </td>
                                        <td>
                                            @can('قبول الاوردر')
                                                <a href="{{ route('order.status1', $order->id) }}" class="btn btn-primary btn-sm mb-1">قبول</a>
                                            @endcan
                                            @can('رفض الاوردر')
                                                <a href="{{ route('order.status2', $order->id) }}" class="btn btn-danger btn-sm mb-1">رفض</a>
                                            @endcan
                                            @can('اتمام الاوردر')
                                            <a href="{{ route('order.status3', $order->id) }}" class="btn btn-success btn-sm mb-1">اتمام</a>
                                            @endcan
                                            @can('حذف الاوردر')
                                            <a class="btn btn-danger btn-sm" data-effect="effect-scale"
                                            data-id="{{ $order->id }}" data-name="{{ $order->customer->name }}"
                                            data-toggle="modal" href="#modaldemo9" title="حذف">حذف<i
                                            class="las la-trash"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- @if ($orders->hasPages()) --}}
                        <ul class="pagination justify-content-center">
                            <!-- زر الصفحة السابقة -->
                            @if ($orders->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">السابق</span></li>
                            @else
                                <li class="page-item"><a href="{{ $orders->previousPageUrl() }}" class="page-link" rel="prev">السابق</a></li>
                            @endif
                    
                            <!-- أرقام الصفحات -->
                            @foreach(range(1, $orders->lastPage()) as $page)
                                <li class="page-item {{ $page == $orders->currentPage() ? 'active' : '' }}">
                                    <a href="{{ $orders->url($page) }}" class="page-link">{{ $page }}</a>
                                </li>
                            @endforeach
                    
                            <!-- زر الصفحة التالية -->
                            @if ($orders->hasMorePages())
                                <li class="page-item"><a href="{{ $orders->nextPageUrl() }}" class="page-link" rel="next">التالي</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">التالي</span></li>
                            @endif
                        </ul>
                    {{-- @endif --}}
                    </div>
                </div>
            </div>
            <div class="modal" id="modaldemo9">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">حذف المنتج</h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('order.destroy', $i) }}" method="post">
                            @method('delete')
                            @csrf
                            <div class="modal-body">
                                <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                <input type="hidden" name="id" id="id" value="">
                                <input class="form-control" name="name" id="name" type="text" vlaue=""
                                    readonly>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                <button type="submit" class="btn btn-danger">تاكيد</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        
        </div>
    </div>
@endsection

@section('js')
    <script>
            $(document).ready(function() {
            $('#modaldemo9').on('show.bs.modal', function(event) {
                // الحصول على الزر الذي أطلق الحدث
                var button = $(event.relatedTarget);
                // استخراج المعلومات من سمات البيانات
                var id = button.data('id');
                var name = button.data('name');
                // تحديث محتوى الحقول في النموذج داخل الـ modal
                var modal = $(this);
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
            });
        });
    </script>
@endsection
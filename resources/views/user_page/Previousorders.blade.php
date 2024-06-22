@extends('layouts.empty')

@section('title')
Previousorders
@endsection

@section('css')
<style>
    .breadcrumb-section:after {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  content: "";
  background-image: url("/assets/img/Previousorders.jpg"); /* تأكد من أن المسار صحيح */
  background-size: cover; /* تجعل الصورة تغطي العنصر بالكامل */
  background-position: center; /* تضبط الصورة في المركز */
  z-index: -1;
  opacity: 0.8;
}
</style>
@endsection


@section('content')
<div class="loader">
    <div class="loader-inner">
        <div class="circle"></div>
    </div>
</div>
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Shop</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
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
                                  <th class="border-bottom-0">تليفون العميل</th>
                                  <th class="border-bottom-0">عنوان العميل</th>
                                  <th class="border-bottom-0">تاريخ وصول الاوردر</th>
                                  <th class="border-bottom-0">اسم المنتج</th>
                                  <th class="border-bottom-0">مقاس المنتج</th>
                                  <th class="border-bottom-0">الكمية</th>
                                  <th class="border-bottom-0">سعر المنتج</th>
                                  <th class="border-bottom-0">المجموع</th>
                                  <th class="border-bottom-0">حالة الاوردر</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php $i = 0; ?>
                              @foreach ($orders as $order)
                                  <?php $i++; ?>
                                  <tr>
                                      <td>{{ $i }}</td>
                                      <td>{{ $order->customer->name }}</td>
                                      <td>{{ $order->customer->phone }}</td>
                                      <td>{{ $order->customer->address}}</td>
                                      <td>{{ $order->day }}</td>
                                      <td>{{ $order->product->name }}</td>
                                      <td>{{ $order->size }}</td>
                                      <td>{{ $order->count }}</td>
                                      <td>{{ $order->product->price }}</td>
                                      <td>{{ $order->product->price * $order->count }}</td>
                                      <td style="width: 100px; padding: 17px; text-align: center; vertical-align: middle;" class="text-white 
                                            @if ($order->status == 'يتم مراجعة الطلب') bg-secondary 
                                            @elseif($order->status == 'قبول') bg-primary 
                                            @elseif($order->status == 'رفض') bg-danger 
                                            @elseif($order->status == 'اتمام') bg-success 
                                            @endif">
                                            {{ $order->status }}
                                        </td>
                                    </tr>
                              @endforeach
                              @foreach ($clothingorders as $clothingorder)
                                  <?php $i++; ?>
                                  <tr>
                                      <td>{{ $i }}</td>
                                      <td>{{ $clothingorder->customer->name }}</td>
                                      <td>{{ $clothingorder->customer->phone }}</td>
                                      <td>{{ $clothingorder->customer->address}}</td>
                                      <td>{{ $clothingorder->day }}</td>
                                      <td>{{ $clothingorder->product->name }}</td>
                                      <td>{{ $clothingorder->size }}</td>
                                      <td>{{ $clothingorder->count }}</td>
                                      <td>{{ $clothingorder->product->price }}</td>
                                      <td>{{ $clothingorder->product->price * $clothingorder->count }}</td>
                                      <td style="width: 100px; padding: 17px; text-align: center; vertical-align: middle;" class="text-white 
                                      @if ($clothingorder->status == 'يتم مراجعة الطلب') bg-secondary 
                                      @elseif($clothingorder->status == 'قبول') bg-primary 
                                      @elseif($clothingorder->status == 'رفض') bg-danger 
                                      @elseif($clothingorder->status == 'اتمام') bg-success 
                                      @endif">
                                      {{ $clothingorder->status }}
                                  </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
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
              </div>
          </div>
      </div>


  <!-- row closed -->
  </div>
  <!-- Container closed -->
  </div>
    <!-- end logo carousel -->
@endsection

@section('js')
    <script src="{{ URL::asset('assets/js/sticker.js') }}"></script>
@endsection

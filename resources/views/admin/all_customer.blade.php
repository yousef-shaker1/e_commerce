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
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                      <table id="example1" class="table key-buttons text-md-nowrap">
                          <thead>
                              <tr>
                                  <th class="border-bottom-0">#</th>
                                  <th class="border-bottom-0">اسم العميل</th>
                                  <th class="border-bottom-0">ايميل العميل</th>
                                  <th class="border-bottom-0">هاتف العميل</th>
                                  <th class="border-bottom-0">السلة</th>
                                  <th class="border-bottom-0">الاوردرات</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php $i = 0; ?>
                              @foreach ($customers as $customer)
                                  <?php $i++; ?>
                                  <tr>
                                      <td>{{ $i }}</td>
                                      <td>{{ $customer->name }}</td>
                                      <td>{{ $customer->email }}</td>
                                      <td>{{ $customer->phone }}</td>
                                      <td>{{ \App\Models\basket::where('customer_id', $customer->id)->count() + \App\Models\clothesbasket::where('customer_id', $customer->id)->count()}}</td>
                                      <td>{{ \App\Models\order::where('customer_id', $customer->id)->count() + \App\Models\clothingorder::where('customer_id', $customer->id)->count() }}</td>
                                  </tr>
                              @endforeach
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
@endsection
@section('js')

@endsection

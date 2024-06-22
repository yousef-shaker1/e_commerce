@extends('layouts.master_admin')
@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
     اراء العملاء
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
                                          <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                              data-id="{{ $message->id }}" data-message="{{ $message->message }}"
                                              data-toggle="modal" href="#modaldemo9" title="حذف">حذف
                                              <i class="las la-trash"></i>
                                          </a>
                                          @endcan
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                      {{-- @if ($messages->hasPages()) --}}
                      <ul class="pagination justify-content-center">
                          <!-- زر الصفحة السابقة -->
                          @if ($messages->onFirstPage())
                              <li class="page-item disabled"><span class="page-link">السابق</span></li>
                          @else
                              <li class="page-item"><a href="{{ $messages->previousPageUrl() }}" class="page-link" rel="prev">السابق</a></li>
                          @endif
                  
                          <!-- أرقام الصفحات -->
                          @foreach(range(1, $messages->lastPage()) as $page)
                              <li class="page-item {{ $page == $messages->currentPage() ? 'active' : '' }}">
                                  <a href="{{ $messages->url($page) }}" class="page-link">{{ $page }}</a>
                              </li>
                          @endforeach
                  
                          <!-- زر الصفحة التالية -->
                          @if ($messages->hasMorePages())
                              <li class="page-item"><a href="{{ $messages->nextPageUrl() }}" class="page-link" rel="next">التالي</a></li>
                          @else
                              <li class="page-item disabled"><span class="page-link">التالي</span></li>
                          @endif
                      </ul>
                  {{-- @endif --}}
                  </div>
              </div>
            </div>
        </div>


        <!-- End Basic modal -->
    </div>
    <!-- edit -->


    <!-- delete -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('del_massage', $i) }}" method="post">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="message" id="message" type="text" vlaue=""
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




    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
@endsection
@section('js')
    <!-- تأكد من إضافة سكربتات الجافا سكريبت في نهاية البودي -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      
        $(document).ready(function() {
            $('#modaldemo9').on('show.bs.modal', function(event) {
                // الحصول على الزر الذي أطلق الحدث
                var button = $(event.relatedTarget);
                // استخراج المعلومات من سمات البيانات
                var id = button.data('id');
                var message = button.data('message');
                // تحديث محتوى الحقول في النموذج داخل الـ modal
                var modal = $(this);
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #message').val(message);
            });
        });
    </script>
@endsection

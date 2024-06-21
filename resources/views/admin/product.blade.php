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
 المنتجات
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
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        @can('اضافة منتج')
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#exampleModal">اضافة منتج جديد</a>
                        @endcan
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">صورة المنتج</th>
                                    <th class="border-bottom-0">اسم المنتج</th>
                                    <th class="border-bottom-0">وصف المنتج</th>
                                    <th class="border-bottom-0">سعر المنتج</th>
                                    <th class="border-bottom-0">كمية المنتجات المتاحة</th>
                                    <th class="border-bottom-0">تابعة لقسم </th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($products as $product)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td><a href="{{ Storage::url($product->img) }}"><img
                                                    src="{{ Storage::url($product->img) }}"
                                                    style="width: 80px; height: 50px;"></a></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->price }} $</td>
                                        <td>{{ $product->amount }}</td>
                                        <td>{{ $product->section->name }}</td>
                                        <td>
                                            @can('تعديل المنتج')
                                            <a class="modal-effect btn btn-sm btn-info custom-btn"
                                                data-effect="effect-scale" data-id="{{ $product->id }}"
                                                data-name="{{ $product->name }}" data-amount="{{ $product->amount }}" data-description="{{ $product->description }}" data-price="{{ $product->price }}" data-img="{{ $product->img }}" data-section_id="{{ $product->section->id }}"
                                                data-toggle="modal" href="#exampleModal2" title="تعديل">تعديل
                                                <i class="las la-pen"></i>
                                            </a>
                                            @endcan

                                            @can('حذف المنتج')
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                data-toggle="modal" href="#modaldemo9" title="حذف">حذف<i
                                                    class="las la-trash"></i></a>

                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- add -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة قسم</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">اسم المنتج</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="description">وصف المنتج</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                            <div class="form-group">
                                <label for="price">سعر المنتج</label>
                                <input type="text" class="form-control" id="price" name="price">
                            </div>
                            <div class="form-group">
                                <label for="amount">الكمية المتاحة من المنتج</label>
                                <input type="text" class="form-control" id="amount" name="amount">
                            </div>
                            <div class="form-group">
                                <label for="name">القسم التابع لية</label>
                                <select name="section_id" id="section_id" class="form-control" required>
                                    <option value="" selected disabled> -حدد القسم-</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="img">صورة القسم</label>
                                <input type="file" class="form-control" id="img" name="img">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- End Basic modal -->
    </div>
    <!-- edit -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product.update', $i) }}" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="id" name="id">
                                <label for="name">اسم المنتج</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="description">وصف المنتج</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                            <div class="form-group">
                                <label for="price">سعر المنتج</label>
                                <input type="text" class="form-control" id="price" name="price">
                            </div>
                            <div class="form-group">
                                <label for="amount">الكمية المتاحة من المنتج</label>
                                <input type="text" class="form-control" id="amount" name="amount">
                            </div>
                            <div class="form-group">
                                <label for="name">القسم التابع لية</label>
                                <select name="section_id" id="section_id" class="form-control" required>
                                    <option value="" selected disabled> -حدد القسم-</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                                <label for="current_img" class="col-form-label">الصورة الحالية للقسم:</label>
                                <br>
                                <a id="current_img_link" href="#"><img id="current_img" src="#"
                                        style="width: 80px; height: 50px;"></a>
                                <br>
                                <label for="img">صورة القسم</label>
                                <input type="file" class="form-control" id="img" name="img">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">تاكيد</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- delete -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف المنتج</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('product.destroy', $i) }}" method="post">
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
        document.addEventListener('DOMContentLoaded', function() {
            $('#exampleModal2').on('show.bs.modal', function(event) {
                // الحصول على الزر الذي أطلق الحدث
                var button = $(event.relatedTarget);
                // استخراج المعلومات من سمات البيانات
                var id = button.data('id');
                var name = button.data('name');
                var description = button.data('description');
                var price = button.data('price');
                var amount = button.data('amount');
                var section_id = button.data('section_id');
                var img = button.data('img');
                // تحديث محتوى الحقول في النموذج داخل الـ modal
                var modal = $(this);
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #description').val(description);
                modal.find('.modal-body #price').val(price);
                modal.find('.modal-body #amount').val(amount);
                modal.find('.modal-body #section_id').val(section_id);

                // تحديث رابط وsrc الصورة
                var imgUrl = '{{ Storage::url('/') }}' + img;
                modal.find('.modal-body #current_img').attr('src', imgUrl);
                modal.find('.modal-body #current_img_link').attr('href', imgUrl);
            });
        });

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

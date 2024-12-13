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
    منتجات الملابس
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
                        @can('اضافة منتج الملابس')
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
                                    <th class="border-bottom-0">نوع المنتج</th>
                                    <th class="border-bottom-0">المقاس و الكمية</th>
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
                                        <td>{{ $product->type }}</td>
                                        <td><a href='{{ route('show_size_product', $product->id) }}'>مشاهدة مقاسات
                                                المنتج</a></td>
                                        <td>{{ $product->section->name }}</td>
                                        <td>
                                            @can('تعديل منتج الملابس')
                                                <a class="modal-effect btn btn-sm btn-info custom-btn"
                                                    data-effect="effect-scale" data-id="{{ $product->id }}"
                                                    data-name="{{ $product->name }}"
                                                    data-description="{{ $product->description }}"
                                                    data-price="{{ $product->price }}" data-type="{{ $product->type }}"
                                                    data-size="{{ $product->size }}" data-img="{{ $product->img }}"
                                                    data-section_id="{{ $product->section->id }}" data-toggle="modal"
                                                    href="#exampleModal2" title="تعديل">تعديل
                                                    <i class="las la-pen"></i>
                                                </a>
                                            @endcan

                                            @can('حذف منتج الملابس')
                                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                    data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                    data-toggle="modal" data-target="#modaldemo9" title="حذف">حذف<i
                                                        class="las la-trash"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- @if ($products->hasPages()) --}}
                        <ul class="pagination justify-content-center">
                            <!-- زر الصفحة السابقة -->
                            @if ($products->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">السابق</span></li>
                            @else
                                <li class="page-item"><a href="{{ $products->previousPageUrl() }}" class="page-link"
                                        rel="prev">السابق</a></li>
                            @endif

                            <!-- أرقام الصفحات -->
                            @foreach (range(1, $products->lastPage()) as $page)
                                <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                    <a href="{{ $products->url($page) }}" class="page-link">{{ $page }}</a>
                                </li>
                            @endforeach

                            <!-- زر الصفحة التالية -->
                            @if ($products->hasMorePages())
                                <li class="page-item"><a href="{{ $products->nextPageUrl() }}" class="page-link"
                                        rel="next">التالي</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">التالي</span></li>
                            @endif
                        </ul>
                        {{-- @endif --}}
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
                    <form action="{{ route('colthingproduct.store') }}" method="post" enctype="multipart/form-data">
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
                                <label for="type">نوع المنتج</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="" selected disabled> -حدد النوع-</option>
                                    <option value="رجالي">رجالي</option>
                                    <option value="حريمي">حريمي</option>
                                    <option value="اطفالي">اطفالي</option>
                                </select>
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
                    <form action="{{ route('colthingproduct.update', $i) }}" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
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
                                <label for="type">نوع المنتج</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="" selected disabled> -حدد النوع-</option>
                                    <option value="رجالي">رجالي</option>
                                    <option value="حريمي">حريمي</option>
                                    <option value="اطفالي">اطفالي</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">القسم التابع لية</label>
                                <select name="section_id" id="section_id" class="form-control" required>
                                    <option value="" selected disabled> -حدد القسم-</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                <div>
                                    <label for="current_img" class="col-form-label">الصورة الحالية للقسم:</label>
                                    <br>
                                    <a id="current_img_link" href="#" onclick="return false;">
                                        <img id="current_img" src="#" style="width: 80px; height: 50px;">
                                    </a>
                                    <br>
                                </div>
                                <div class="mb-3">
                                    <label>اختر صورة جديدة:</label>
                                    <input type="file" id="img" name="img" class="form-control"
                                        onchange="previewImage(event)">
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
    </div>




        <!-- row closed -->
    </div>


    <!-- delete -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('colthingsection.destroy', $i) }}" method="post">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="name" id="name" type="text" value=""
                            readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Container closed -->
    {{-- </div> --}}
@endsection
@section('js')
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
                var type = button.data('type');
                var section_id = button.data('section_id');
                var img = button.data('img');
                // تحديث محتوى الحقول في النموذج داخل الـ modal
                var modal = $(this);
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #description').val(description);
                modal.find('.modal-body #price').val(price);
                modal.find('.modal-body #type').val(type);
                modal.find('.modal-body #section_id').val(section_id);

                // تحديث رابط وsrc الصورة
                var imgUrl = '{{ Storage::url('/') }}' + img;
                modal.find('.modal-body #current_img').attr('src', imgUrl);
                modal.find('.modal-body #current_img_link').attr('href', imgUrl);
            });
        });

        $(document).ready(function() {
            $('#modaldemo9').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // الزر الذي أطلق الحدث
                var id = button.data('id'); // الحصول على الـ ID من data-id
                var name = button.data('name'); // الحصول على الـ name من data-name
                var modal = $(this);

                // تحديث القيم في المودال
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
            });
        });



        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const imgElement = document.getElementById('current_img');
                imgElement.src = reader.result;

                const linkElement = document.getElementById('current_img_link');
                linkElement.href = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

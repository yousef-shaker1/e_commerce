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
    اقسام منتجات الملابس
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
                        @can('اضافة قسم الملابس')
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#exampleModal">اضافة قسم جديد</a>
                        @endcan
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">صورة القسم</th>
                                    <th class="border-bottom-0">اسم القسم</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($sections as $section)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td><a href="{{ Storage::url($section->img) }}"><img
                                                    src="{{ Storage::url($section->img) }}"
                                                    style="width: 80px; height: 60px;"></a></td>
                                        <td>{{ $section->name }}</td>
                                        <td>
                                            @can('تعديل قسم الملابس')
                                            <a class="modal-effect btn btn-sm btn-info custom-btn"
                                                data-effect="effect-scale" data-id="{{ $section->id }}"
                                                data-section_name="{{ $section->name }}" data-img="{{ $section->img }}"
                                                data-toggle="modal" href="#exampleModal2" title="تعديل">تعديل
                                                <i class="las la-pen"></i>
                                            </a>
                                            @endcan

                                            @can('حذف قسم الملابس')
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $section->id }}" data-section_name="{{ $section->name }}"
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
                    <form action="{{ route('colthingsection.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">اسم القسم</label>
                                <input type="text" class="form-control" id="name" name="name">
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

                    <form action="{{ route('colthingsection.update', $i) }}" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="section_name" class="col-form-label">اسم القسم:</label>
                            <input class="form-control" name="name" id="section_name" type="text">

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
                                <input type="file" id="img" name="img" class="form-control" onchange="previewImage(event)">
                            </div>
                            
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
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('colthingsection.destroy', $i) }}" method="post">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="section_name" id="section_name" type="text" vlaue=""
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#exampleModal2').on('show.bs.modal', function(event) {
                // الحصول على الزر الذي أطلق الحدث
                var button = $(event.relatedTarget);
                // استخراج المعلومات من سمات البيانات
                var id = button.data('id');
                var sectionName = button.data('section_name');
                var img = button.data('img');
                // تحديث محتوى الحقول في النموذج داخل الـ modal
                var modal = $(this);
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #section_name').val(sectionName);

                // تحديث رابط وsrc الصورة
                var imgUrl = '{{ Storage::url('/') }}' + img;
                modal.find('.modal-body #current_img').attr('src', imgUrl);
                modal.find('.modal-body #current_img_link').attr('href', imgUrl);
            });
        });

        $(document).ready(function() {
            $('#modaldemo9').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var section_name = button.data('section_name');
                var modal = $(this);
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #section_name').val(section_name);
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

@extends('layouts.master_admin')
@section('css')
<style>
  .margin-tb {
      margin-bottom: 20px;
  }

  .alert-danger {
      margin-top: 20px;
  }

  .form-group p {
      font-size: 18px;
      font-weight: bold;
  }

  .content-container {
      width: 90%; /* توسيع عرض الصفحة */
      max-width: 1200px; /* تحديد الحد الأقصى للعرض */
      margin: 0 auto; /* توسيط المحتوى */
  }

  #treeview1 {
      list-style-type: none;
      padding: 0;
  }

  #treeview1 li {
      margin-bottom: 10px;
  }

  #treeview1 a {
      text-decoration: none;
      font-weight: bold;
      color: #007bff;
  }

  #treeview1 ul {
      padding-left: 20px;
      margin-top: 10px;
  }

  #treeview1 input[type="checkbox"] {
      margin-right: 10px;
  }

  .btn-main-primary {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
  }

  .btn-main-primary:hover {
      background-color: #0056b3;
  }
</style>
@endsection

@section('title')
تعديل دور
@endsection

@section('content')

<div class="content-container">
    <div class="row margin-tb">
        <div class="col-lg-12">
            <div class="pull-left">
                <h3>تعديل الصلاحية</h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> رجوع</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
      <div class="alert alert-danger">
          <strong>خطأ!</strong> هناك بعض المشاكل في الإدخال.<br><br>
          <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
          </ul>
      </div>
    @endif

    {{ Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) }}

    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="form-group">
                        <p>اسم الصلاحية :</p>
                        {{ Form::text('name', null, array('placeholder' => 'اسم الدور', 'class' => 'form-control')) }}
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <ul id="treeview1">
                                <li>
                                    <a href="#">الصلاحيات</a>
                                    <ul>
                                        @foreach($permission as $value)
                                        <li>
                                            <input type="checkbox" name="permission[]" value="{{ $value->name }}" 
                                                   {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                            {{ $value->name }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-main-primary">تحديث</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ Form::close() }}
</div>

@endsection

@section('js')
@endsection

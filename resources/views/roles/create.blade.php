@extends('layouts.master_admin')
@section('css')
<style>
  .table-container {
      width: 100%;
      overflow-x: auto; /* يسمح بتمرير الجدول أفقيًا إذا تجاوز العرض */
  }

  .table-expanded {
      width: 100%; /* عرض كامل الصفحة */
      max-width: 100%; /* منع تجاوز العرض */
      border-collapse: collapse; /* منع المسافات بين الخلايا */
      font-size: 18px; /* تكبير حجم النص داخل الجدول */
  }

  .table-expanded th, .table-expanded td {
      padding: 15px; /* زيادة المسافة داخل الخلايا */
      text-align: left;
      border: 2px solid #ddd; /* حدود أكثر وضوحًا */
      height: 50px; /* زيادة ارتفاع الصف */
  }

  .table-expanded th {
      background-color: #f4f4f4; /* لون خلفية للرأس */
      font-weight: bold; /* جعل النص غامقًا */
  }

  .table-expanded td {
      background-color: #fcfcfc; /* لون خلفية للخلايا */
  }

  .form-group p {
      font-size: 20px; /* تكبير النص في العناوين */
      font-weight: bold;
  }
</style>
@endsection

@section('title')
إنشاء دور جديد
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Create New Role</h3>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
</div>

@if (count($errors) > 0)
  <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
      </ul>
  </div>
@endif

{{ Form::open(array('route' => 'roles.store','method'=>'POST')) }}

<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    <div class="col-xs-7 col-sm-7 col-md-7">
                        <div class="form-group">
                            <p>اسم الصلاحية :</p>
                            {{ Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- تكبير عرض الجدول -->
                        <div class="table-container">
                            <table class="table-expanded">
                                <thead>
                                    <tr>
                                        <th>الاسم</th>
                                        <th>الصلاحية</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permission as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>
                                            <label>
                                                {{ Form::checkbox('permission[]', $value->name, false, array('class' => 'name')) }}
                                                {{ $value->name }}
                                            </label>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-main-primary">تاكيد</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{ Form::close() }}

<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection

@section('js')
@endsection

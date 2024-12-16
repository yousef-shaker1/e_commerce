@extends('layouts.master_admin')
@section('css')

@endsection

@section('title')
users
@endsection

@section('content')

<div class="row">
  <div class="col-lg-12 margin-tb">
      <div class="pull-left">
          <h3>Users Management</h3>
      </div>
      @can('اضافة مستخدم')
      <div class="pull-right" style="width: 1000px;">
        <a class="btn btn-success" href="{{ route('users.create') }}">Create New User</a>
    </div>
    
      @endcan
  </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
<tr>
 <th>No</th>
 <th>Name</th>
 <th>Email</th>
 <th>Roles</th>
 <th width="280px">Action</th>
</tr>
@foreach ($data as $key => $user)
<tr>
  <td>{{ ++$i }}</td>
  <td>{{ $user->name }}</td>
  <td>{{ $user->email }}</td>
  <td>
    @if(!empty($user->getRoleNames()))
      @foreach($user->getRoleNames() as $v)
         <label class="badge badge-success">{{ $v }}</label>
      @endforeach
    @endif
  </td>
  <td>
    @can('عرض المستخدم')
    <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
    @endcan
    @can('تعديل المستخدم')
    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
    @endcan
    @can('حذف المستخدم')
    {{ Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) }}
    {{ Form::submit('Delete', ['class' => 'btn', 'style' => 'background-color: #dc3545; color: #fff; font-size: 0.8rem;']) }}
    {{ Form::close() }}    
    @endcan
  </td>
</tr>
@endforeach
</table>


{{ $data->render() }}


<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>


@endsection

@section('js')

@endsection
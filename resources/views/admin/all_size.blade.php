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
@livewireStyles
@endsection

@section('title')
    المقاسات 
@endsection

@section('content')
@livewire('ShowSize')
@livewireScripts
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  window.addEventListener('close-modal', event => {
      $('#deleteSizeModal').modal('hide');
      $('#addSizeModal').modal('hide');
  });
</script>
@endsection

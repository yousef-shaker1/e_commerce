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
reviews
@endsection

@section('content')
    @livewire('Customermessage')
    @livewireScripts
@endsection
@section('js')
    <script>
      window.addEventListener('close-modal', event => {
          $('#deleteMassageModal').modal('hide');
      });
  </script>
@endsection

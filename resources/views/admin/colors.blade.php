@extends('layouts.master_admin')
@section('css')
  
@livewireStyles
@endsection

@section('title')
    colors 
@endsection

@section('content')
@livewire('colors')
@livewireScripts
@endsection
@section('js')
<script>
  window.addEventListener('close-modal', event => {
      $('#deleteColorModal').modal('hide');
      $('#addColorModal').modal('hide');
  });
</script>
@endsection

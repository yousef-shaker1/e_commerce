@extends('layouts.master_admin')
@section('css')
  
@livewireStyles
@endsection

@section('title')
    images 
@endsection

@section('content')
@livewire('images-product', ['id' => $id])
@livewireScripts
@endsection
@section('js')
<script>
  window.addEventListener('close-modal', event => {
      $('#deleteImageModal').modal('hide');
      $('#addImageModal').modal('hide');
  });
</script>
@endsection

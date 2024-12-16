@extends('layouts.master_admin')
@section('css')

    @livewireStyles
@endsection

@section('title')
    size product 
@endsection

@section('content')
        @livewire('show-single-size', ['id' => $id])
    </div>
    </div>
    @livewireScripts
@endsection

@section('js')

<script>
  window.addEventListener('close-modal', event => {
      $('#addSizeModal').modal('hide');
      $('#deleteSizeModal').modal('hide');
  });
</script>
@endsection

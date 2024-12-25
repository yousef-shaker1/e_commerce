@extends('layouts.master_admin')
@section('css')

    @livewireStyles
@endsection

@section('title')
    size and price 
@endsection

@section('content')
        @livewire('view-size-and-price', ['id' => $id])
    {{-- </div>
    </div> --}}
    @livewireScripts
@endsection

@section('js')

<script>
  window.addEventListener('close-modal', event => {
      $('#addSizeModal').modal('hide');
      $('#UpdateSizeModal').modal('hide');
      $('#deleteSizeModal').modal('hide');
  });
</script>
@endsection

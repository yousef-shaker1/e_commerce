@extends('layouts.master_admin')
@section('css')

    @livewireStyles
@endsection

@section('title')
    color product 
@endsection

@section('content')
        @livewire('show-single-color', ['id' => $id])
    {{-- </div>
    </div> --}}
    @livewireScripts
@endsection

@section('js')

<script>
  window.addEventListener('close-modal', event => {
      $('#addColorModal').modal('hide');
      $('#EditColorModal').modal('hide');
      $('#deleteColorModal').modal('hide');
  });
</script>
@endsection

@extends('layouts.master_admin')
@section('css')

    @livewireStyles
@endsection

@section('title')
    الاقسام 
@endsection

@section('content')
        @livewire('section-product')
    </div>
    </div>
    @livewireScripts
@endsection

@section('js')

<script>
  window.addEventListener('close-modal', event => {
      $('#addSectionModal').modal('hide');
      $('#updateSectionModal').modal('hide');
      $('#deleteSectionModal').modal('hide');
  });
</script>
@endsection

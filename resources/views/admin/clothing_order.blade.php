@extends('layouts.master_admin')
@section('css')

    @livewireStyles
@endsection

@section('title')
    order 
@endsection

@section('content')
        @livewire('order-clothing-admin')
    {{-- </div>
    </div> --}}
    @livewireScripts
@endsection

@section('js')

<script>
  window.addEventListener('close-modal', event => {
      $('#destroyOrderModal').modal('hide');
  });
</script>
@endsection

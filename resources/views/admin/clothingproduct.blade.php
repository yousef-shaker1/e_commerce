@extends('layouts.master_admin')
@section('css')

    @livewireStyles
@endsection

@section('title')
    Product 
@endsection

@section('content')
        @livewire('clothing-product-admin')
    {{-- </div>
    </div> --}}
    @livewireScripts
@endsection

@section('js')

<script>
  window.addEventListener('close-modal', event => {
      $('#addProductModal').modal('hide');
      $('#updateProductModal').modal('hide');
      $('#deleteProductModal').modal('hide');
  });
</script>
@endsection

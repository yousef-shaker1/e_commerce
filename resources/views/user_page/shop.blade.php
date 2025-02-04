@extends('layouts.empty')

@section('title')
    {{ __('page.Shop') }}
@endsection

@section('css')
<style>
    .breadcrumb-section:after {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        content: "";
        background-image: url("/assets/img/shop11.png"); 
        background-size: cover; 
        background-position: center; 
        z-index: -1;
        opacity: 0.8;
    }

    .breadcrumb-text h1 {
        color: #51495e;
    }
    .custom-margin-top {
    margin-top: -100px; 
    margin-bottom: 30px;
    }
</style>
@livewireStyles
@endsection


@section('content')
<div class="loader">
    <div class="loader-inner">
        <div class="circle"></div>
    </div>
</div>
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>{{ __('page.Premium_and_Organic') }}</p>
                    <h1>{{ __('page.Shop_Section') }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>


  <!-- products -->
<div class="product-section mt-100 mb-150">
	<div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">{{ __('page.our') }}</span> {{ __('page.Section') }}</h3>

                </div>
            </div>
        </div>
			@livewire('shop')
	</div>
</div>

    <!-- end logo carousel -->
    @livewireScripts
@endsection

@section('js')
@endsection

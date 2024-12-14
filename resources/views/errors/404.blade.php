

@extends('layouts.empty')

@section('title')
الصفحة غير موجودة - 404
@endsection

@section('css')
<style>
  body, html {
      height: 100%;
      margin: 0;
      font-family: 'Arial', sans-serif;
  }
  .bg-404 {
      background: linear-gradient(135deg, #f8f9fa, #e9ecef);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      text-align: center;
      color: #343a40;
      padding: 20px;
  }
  .error-title {
      font-size: 6rem;
      font-weight: 700;
      margin-bottom: 1rem;
  }
  .error-subtitle {
      font-size: 1.5rem;
      margin-bottom: 1rem;
  }
  .error-description {
      font-size: 1.2rem;
      margin-bottom: 1.5rem;
  }
  .btn-home {
      font-size: 1rem;
      padding: 0.75rem 1.5rem;
  }
  .breadcrumb-section:after {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        content: "";
        background-image: url("/assets/img/404.png");
        background-size: cover;
        background-position: center;
        z-index: -1;
        opacity: 0.8;
    }
</style>
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
                  <h1>404</h1>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="bg-404">
  <div>
      <div class="error-title">404</div>
      <div class="error-subtitle">الصفحة غير موجودة</div>
      <div class="error-description">عذرًا، الصفحة التي تحاول الوصول إليها غير موجودة.</div>
      <a href="{{ url('/') }}" class="btn btn-primary btn-home">العودة إلى الصفحة الرئيسية</a>
  </div>
</div>
@endsection

@section('js')

@endsection
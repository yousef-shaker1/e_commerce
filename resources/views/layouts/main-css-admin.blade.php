	<!-- favicon -->
	<title>@yield('title')</title>

    <link rel="icon" href="favicon.ico">
  <!-- Simple bar CSS -->
  <!-- Fonts CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Icons CSS -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/simplebar.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/feather.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/select2.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/dropzone.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/uppy.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.steps.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.timepicker.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/quill.snow.css') }}">
  {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}


  <!-- Date Range Picker CSS -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/daterangepicker.css') }}">
  <!-- App CSS -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/app-light.css') }}" id="lightTheme">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/app-dark.css') }}" id="darkTheme" disabled>
  
  
	@yield('css')

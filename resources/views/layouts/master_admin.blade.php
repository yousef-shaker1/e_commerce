<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @include('layouts.main-css-admin')
  
  </head>
  <body class="vertical  light  ">
    <div class="wrapper">
      @include('admin.nav_admin')
    
      <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
          
            @yield('content')
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
      </main> <!-- main -->
    </div> <!-- .wrapper -->
    @include('layouts.main-script-admin')
  </body>
</html>
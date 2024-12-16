{{-- <!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @include('layouts.main-css')
</head>
<body>
  @include('admin.nav_admin')
  @yield('content')
  @include('layouts.main-script')
  </body>
</html>  --}}



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
            {{-- <div class="col-12">
              <div class="row align-items-center mb-2">
                <div class="col">
                  <h2 class="h5 page-title">Welcome!</h2>
                </div>
                <div class="col-auto">
                  <form class="form-inline">
                    <div class="form-group d-none d-lg-inline">
                      <label for="reportrange" class="sr-only">Date Ranges</label>
                      <div id="reportrange" class="px-2 py-2 text-muted">
                        <span class="small"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="button" class="btn btn-sm"><span class="fe fe-refresh-ccw fe-16 text-muted"></span></button>
                      <button type="button" class="btn btn-sm mr-2"><span class="fe fe-filter fe-16 text-muted"></span></button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="row my-4">
                <div class="col-md-4">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted mb-1">Page Views</small>
                          <h3 class="card-title mb-0">1168</h3>
                          <p class="small text-muted mb-0"><span class="fe fe-arrow-down fe-12 text-danger"></span><span>-18.9% Last week</span></p>
                        </div>
                        <div class="col-4 text-right">
                          <span class="sparkline inlineline"></span>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
                <div class="col-md-4">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted mb-1">Conversion</small>
                          <h3 class="card-title mb-0">68</h3>
                          <p class="small text-muted mb-0"><span class="fe fe-arrow-up fe-12 text-warning"></span><span>+1.9% Last week</span></p>
                        </div>
                        <div class="col-4 text-right">
                          <span class="sparkline inlinepie"></span>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
                <div class="col-md-4">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted mb-1">Visitors</small>
                          <h3 class="card-title mb-0">108</h3>
                          <p class="small text-muted mb-0"><span class="fe fe-arrow-up fe-12 text-success"></span><span>37.7% Last week</span></p>
                        </div>
                        <div class="col-4 text-right">
                          <span class="sparkline inlinebar"></span>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
              </div>
              <!-- .row-->
            </div> <!-- .col-12 --> --}}
            @yield('content')
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
      </main> <!-- main -->
    </div> <!-- .wrapper -->
    @include('layouts.main-script-admin')
  </body>
</html>
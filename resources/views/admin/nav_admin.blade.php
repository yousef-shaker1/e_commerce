<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
      <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>

    <form class="form-inline mr-auto searchform text-muted">
      <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
    </form>
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
          <i class="fe fe-sun fe-16"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
          <span class="fe fe-grid fe-16"></span>
        </a>
      </li>
      <li class="nav-item nav-notif">
        <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
          <span class="fe fe-bell fe-16"></span>
          <span class="dot dot-md bg-success"></span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="avatar avatar-sm mt-2">
            <img src="{{ URL::asset('assets/img/download.png') }}" alt="..." class="avatar-img rounded-circle">
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Profile</a>
          <a class="dropdown-item" href="#">Settings</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dropdown-item">Logout</button>
        </form>
                </div>
      </li>
    </ul>
  </nav>


  <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
      <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
      <!-- nav bar -->
      <div class="w-100 mb-4 d-flex">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
          <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
            <g>
              <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
              <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
              <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
            </g>
          </svg>
        </a>
      </div>
      @can('الرئيسية')
      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="fe fe-home fe-16"></i>
            <span class="ml-3 item-text">Dashboard</span>
          </a>
        </li>
      </ul>
      @endcan
      
      <p class="text-muted nav-heading mt-4 mb-1">
        <span>Section</span>
      </p>
      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item dropdown">
          <a href="#ui-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-box fe-16"></i>
            <span class="ml-3 item-text">Section</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements">
            @can('اقسام المنتجات')
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('section.index') }}"><span class="ml-1 item-text">Product</span>
              </a>
            </li>
            @endcan
            @can('اقسام منتجات الملابس')
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('colthingsection.index') }}"><span class="ml-1 item-text">Clothing</span></a>
            </li>
            @endcan
          </ul>
        </li>
        <p class="text-muted nav-heading mt-4 mb-1">
          <span>Product</span>
      </p>
      <li class="nav-item dropdown">
          <a href="#product-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-box fe-16"></i>
              <span class="ml-3 item-text">Product</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="product-elements">
              @can('المنتجات')
              <li class="nav-item">
                  <a class="nav-link pl-3" href="{{ route('product.index') }}">
                      <span class="ml-1 item-text">Product</span>
                  </a>
              </li>
              @endcan
              @can('اقسام المنتجات')
              <li class="nav-item">
                  <a class="nav-link pl-3" href="{{ route('colthingproduct.index') }}">
                      <span class="ml-1 item-text">Clothing_Product</span>
                  </a>
              </li>
              @endcan
          </ul>
      </li>
      <p class="text-muted nav-heading mt-4 mb-1">
        <span>Product Settings</span>
    </p>
    <li class="nav-item dropdown">
      <a href="#size-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-box fe-16"></i>
          <span class="ml-3 item-text">Settings</span>
      </a>
      <ul class="collapse list-unstyled pl-4 w-100" id="size-elements">
          @can('المقاسات')
          <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('show_size') }}">
                  <span class="ml-1 item-text">Sizes</span>
              </a>
          </li>
          @endcan
          @can('الالوان')
          <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('colors') }}">
                  <span class="ml-1 item-text">Colors</span>
              </a>
          </li>
          @endcan
      </ul>
  </li>
  
  <p class="text-muted nav-heading mt-4 mb-1">
      <span>Orders</span>
  </p>
  <li class="nav-item dropdown">
      <a href="#order-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-box fe-16"></i>
          <span class="ml-3 item-text">Order</span>
      </a>
      <ul class="collapse list-unstyled pl-4 w-100" id="order-elements">
          @can('اوردرات')
          <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('order.index') }}">
                  <span class="ml-1 item-text">Orders</span>
              </a>
          </li>
          @endcan
          @can('اوردرات الملابس')
          <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('clothing_order') }}">
                  <span class="ml-1 item-text">Clothing_Order</span>
              </a>
          </li>
          @endcan
      </ul>
  </li>
  
  <p class="text-muted nav-heading mt-4 mb-1">
      <span>Customers</span>
  </p>
  <li class="nav-item dropdown">
      <a href="#customer-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-box fe-16"></i>
          <span class="ml-3 item-text">Customers</span>
      </a>
      <ul class="collapse list-unstyled pl-4 w-100" id="customer-elements">
        @can('اراء العملاء')
          <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('show_message') }}">
                  <span class="ml-1 item-text">reviews</span>
              </a>
          </li>
          @endcan
          @can('العملاء')
          <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('all_customer') }}">
                  <span class="ml-1 item-text">all_customer</span>
              </a>
          </li>
          @endcan
      </ul>
  </li>


  <p class="text-muted nav-heading mt-4 mb-1">
      <span>roles</span>
  </p>
  <li class="nav-item dropdown">
      <a href="#roles-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-box fe-16"></i>
          <span class="ml-3 item-text">roles</span>
      </a>
      <ul class="collapse list-unstyled pl-4 w-100" id="roles-elements">
        @can('المسخدمين')
          <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('users.index') }}">
                  <span class="ml-1 item-text">admins</span>
              </a>
          </li>
          @endcan
          @can('صلاحيات المستخدمين')
          <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('roles.index') }}">
                  <span class="ml-1 item-text">roles</span>
              </a>
          </li>
          @endcan
      </ul>
  </li>
  
      </ul>
    </nav>
  </aside>
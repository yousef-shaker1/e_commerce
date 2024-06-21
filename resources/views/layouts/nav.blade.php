<!-- header -->
<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="index.html">
                            <img src="{{ URL::asset('assets/img/logo3.png') }}" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('shop') }}">shop</a></li>
                            <li><a href="{{ route('bestseller') }}">best seller</a></li>
                            <li><a href="{{ route('importantproducts') }}">important products</a></li>
                            <li><a href="{{ route('Previousorders') }}">Previous orders</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                            <li><a href="{{ route('about') }}">About</a></li>
                            
                            <li>
                                <div class="header-icons">
                                    <a class="shopping-cart" href="{{ route('show_basket') }}"><i class="fas fa-shopping-cart"></i></a>
                                    @if (Auth::user())
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ Auth::user()->name }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        </form>
                                        @else
                                        <a href="{{ route('login') }}" class="nav-btn">Login</a>
                                        <a href="{{ route('register') }}" class="nav-btn">Register</a>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                    <div class="mobile-menu"></div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end header -->

<!-- search area -->
<div class="search-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="close-btn"><i class="fas fa-window-close"></i></span>
                <div class="search-bar">
                    <div class="search-bar-tablecell">
                        <h3>Search For:</h3>
                        <input type="text" placeholder="Keywords">
                        <button type="submit">Search <i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end search area -->

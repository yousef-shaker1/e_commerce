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
                            <li><a href="{{ route('shop') }}">section</a></li>
                            <li><a href="{{ route('bestseller') }}">best seller</a></li>
                            <li><a href="{{ route('importantproducts') }}">important products</a></li>
                            <li><a href="{{ route('Previousorders') }}">Previous orders</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                            <li><a href="{{ route('about') }}">About</a></li>

                            <li>
                                <div class="header-icons">
                                    @if (!empty(Auth::user()->email))

                                
                                    <div class="user_option">
                                        <div class="container mt-5">
                                            <div class="dropdown nav-item main-header-notification">
                                                <a class="new nav-link position-relative" href="#"
                                                    id="notificationDropdown" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <span
                                                        class="notification-badge bg-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
                                                    <i class="fa fa-bell notification-icon" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="notificationDropdown" style="width: 350px;">
                                                    <div class="main-message-list chat-scroll">
                                                        <div class="menu-header-content bg-primary text-right p-3">
                                                            <div class="d-flex">
                                                                <h6
                                                                    class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">
                                                                    الاشعارات</h6>
                                                                <span
                                                                    class="badge badge-pill badge-warning ml-auto my-auto">
                                                                    <a href="{{ route('notification.markall') }}" class="text-white">قراءة
                                                                        الكل</a>
                                                                </span>
                                                            </div>
                                                            <p
                                                                class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12">
                                                                عدد الاشعارات الغير مقروءة:
                                                                {{ Auth::user()->unreadNotifications->count() }}
                                                            </p>
                                                        </div>
                                                        <div class="main-notification-list Notification-scroll p-2">
                                                            @foreach (Auth::user()->unreadNotifications as $not)
                                                                <a class="d-flex p-3 border-bottom align-items-center"
                                                                    href="{{ route('show_single_product', $not->data['pro_id']) }}">
                                                                    <div class="notifyimg bg-pink">
                                                                        <i class="la la-file-alt text-white"></i>
                                                                    </div>
                                                                    <div class="ml-3">
                                                                        <h5 class="notification-label mb-1">منتج
                                                                            جديد {{ $not->data['product'] }}</h5>
                                                                        <div
                                                                            class="notification-subtext text-muted">
                                                                            {{ $not->created_at }}</div>
                                                                    </div>
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                        <div class="dropdown-footer text-center p-2">
                                                            <a href="" class="text-primary">VIEW ALL</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="header-icons" style="margin-top: 2px; text-align: right;">
                                        <a class="shopping-cart" href="{{ route('show_basket') }}">
                                            <i class="fas fa-shopping-cart"></i>
                                            <?php $customer = App\Models\customer::where('email', Auth::user()->email)->first();?>
                                            @if (Auth::user())
                                                <span class="cart-count">{{ App\Models\clothesbasket::where('customer_id', Auth::user()->id)->count() + App\Models\basket::where('customer_id', Auth::user()->id)->count()}}</span>
                                            @endif
                                        </a>
                                        
                                        @endif
                                        
                                        @if (Auth::user())
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                {{ Auth::user()->name }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="nav-btn">Login</a>
                                            <a href="{{ route('register') }}" class="nav-btn">Register</a>
                                        @endif
                                    </div>
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


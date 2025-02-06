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
                            <li><a href="{{ route('home') }}">{{ __('page.Home') }}</a></li>
                            <li><a href="{{ route('shop') }}">{{ __('page.Section') }}</a></li>
                            <li><a href="{{ route('bestseller') }}">{{ __('page.Best Seller') }}</a></li>
                            <li><a href="{{ route('importantproducts') }}">{{ __('page.Important Products') }}</a></li>
                            <li><a href="{{ route('Previousorders') }}">{{ __('page.Previous Orders') }}</a></li>
                            <li><a href="{{ route('contact') }}">{{ __('page.Contact') }}</a></li>
                            <li><a href="{{ route('about') }}">{{ __('page.About') }}</a></li>
                            
                        
                            <li>
                                <div class="header-icons">
                                    @if (Auth::check())
                        
                                        <!-- 🔔 أيقونة الإشعارات -->
                                        <div class="user_option">
                                            <div class="container mt-3">
                                                <div class="dropdown nav-item main-header-notification">
                                                    <a class="new nav-link position-relative d-flex align-items-center" href="#" id="notificationDropdown" data-toggle="dropdown">
                                                        <span class="notification-badge bg-danger text-white rounded-circle px-2 py-1">
                                                            {{ Auth::user()->unreadNotifications->count() }}
                                                        </span>
                                                        <i class="fa fa-bell notification-icon ml-2" aria-hidden="true" style="font-size: 1.5rem;"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow-lg border-0" aria-labelledby="notificationDropdown" style="width: 350px; border-radius: 10px; overflow: hidden;">
                                                        <div class="main-message-list chat-scroll">
                                                            
                                                            <!-- هيدر الإشعارات -->
                                                            <div class="menu-header-content bg-primary text-right p-3">
                                                                <div class="d-flex align-items-center">
                                                                    <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold flex-grow-1">الإشعارات</h6>
                                                                    <a href="{{ route('notification.markall') }}" class="badge badge-warning text-white px-2 py-1">قراءة الكل</a>
                                                                </div>
                                                                <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12">
                                                                    عدد الإشعارات غير المقروءة: {{ Auth::user()->unreadNotifications->count() }}
                                                                </p>
                                                            </div>
                                        
                                                            <!-- قائمة الإشعارات -->
                                                            <div class="main-notification-list Notification-scroll p-2" style="max-height: 300px; overflow-y: auto;">
                                                                @foreach (Auth::user()->unreadNotifications as $not)
                                                                    <a class="d-flex p-3 border-bottom align-items-center notification-item" href="{{ route('show_single_product', $not->data['pro_id']) }}" style="transition: background 0.3s;">
                                                                        <div class="notifyimg bg-pink d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px;">
                                                                            <i class="la la-file-alt text-white" style="font-size: 1.2rem;"></i>
                                                                        </div>
                                                                        <div class="ml-3">
                                                                            <h5 class="notification-label mb-1 font-weight-bold text-dark">منتج جديد: {{ $not->data['product'] }}</h5>
                                                                            <div class="notification-subtext text-muted" style="font-size: 0.85rem;">{{ $not->created_at->diffForHumans() }}</div>
                                                                        </div>
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                        
                                                            <!-- الفوتر -->
                                                            <div class="dropdown-footer text-center p-2 bg-light">
                                                                <a href="#" class="text-primary font-weight-bold">عرض الكل</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                        
                                        <!-- 🛒 أيقونة سلة المشتريات -->
                                        <a class="shopping-cart" href="{{ route('show_basket') }}">
                                            <i class="fas fa-shopping-cart"></i>
                                            <span class="cart-count">
                                                {{ App\Models\clothesbasket::where('customer_id', Auth::user()->id)->count() + App\Models\basket::where('customer_id', Auth::user()->id)->count() }}
                                            </span>
                                        </a>
                        
                                        <!-- 👤 تسجيل الخروج -->
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ Auth::user()->name }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                        
                                    @else
                                        <!-- 🔐 تسجيل الدخول والتسجيل -->
                                        <a href="{{ route('login') }}" class="nav-btn">{{ __('page.Login') }}</a>
                                        <a href="{{ route('register') }}" class="nav-btn">{{ __('page.Register') }}</a>
                                    @endif
                        
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-globe"></i> {{ session()->get('locale') == 'en' ? 'English' : 'Arabic' }}
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="languageDropdown">
                                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                <a class="dropdown-item" href="{{ route('change.locale', $localeCode) }}">
                                                    {{ $properties['native'] }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </li>
                                    
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


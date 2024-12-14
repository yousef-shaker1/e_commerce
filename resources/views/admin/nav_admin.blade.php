<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">متجر إلكتروني</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @can('الرئيسية')
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">الرئيسية</a>
                </li> 
                @endcan
                @can('اقسام المنتجات')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('section.index') }}">اقسام المنتجات</a>
                </li>
                @endcan
                @can('المنتجات')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product.index') }}">المنتجات</a>
                </li>
                @endcan
                @can('اقسام منتجات الملابس')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('colthingsection.index') }}">اقسام منتجات الملابس</a>
                </li> 
                @endcan
                @can('منتجات الملابس')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('colthingproduct.index') }}">منتجات الملابس</a>
                </li>
                @endcan
                @can('المقاسات')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('show_size') }}">المقاسات</a>
                </li>
                @endcan
                @can('اوردرات')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('order.index') }}">اوردرات</a>
                </li>
                @can('اوردرات الملابس')
                @endcan
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clothing_order') }}">اوردرات الملابس</a>
                </li>
                @endcan
                @can('اراء العملاء')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('show_message') }}">اراء العملاء</a>
                </li>
                @endcan
                @can('العملاء')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('all_customer') }}">العملاء</a>
                </li>
                @endcan
                @can('المسخدمين')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">المستخدمين</a>
                </li>
                @endcan
                @can('صلاحيات المستخدمين')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('roles.index') }}">صلاحيات المستخدمين</a>
                </li>
                @endcan
            </ul>
            <form method="POST" action="/logout" class="d-flex">
                @csrf
                <button class="btn btn-outline-light" type="submit">تسجيل الخروج</button>
            </form>
        </div>
    </div>
</nav>
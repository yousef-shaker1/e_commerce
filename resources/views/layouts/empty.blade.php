@include('layouts.header')

@include('layouts.main-css')
</head>

<body>
    @include('layouts.nav')

    @yield('content')
	<!-- product section -->

    @include('layouts.footer')

    <!-- end copyright -->
    @include('layouts.main-script')
</body>

</html>

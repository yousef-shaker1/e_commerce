	<!-- favicon -->
	<title>@yield('title')</title>
	<link rel="shortcut icon" type="image/png" href="{{URL::asset('assets/img/favicon.png')}}">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="{{URL::asset('assets/css/all.min.css')}}">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{URL::asset('assets/bootstrap/css/bootstrap.min.css')}}">
	<!-- owl carousel -->
	<link rel="stylesheet" href="{{URL::asset('assets/css/owl.carousel.css')}}">
	<!-- magnific popup -->
	<link rel="stylesheet" href="{{URL::asset('assets/css/magnific-popup.css')}}">
	<!-- animate css -->
  <link href="{{URL::asset('assets/css/animate.css')}}" rel="stylesheet">
	<!-- mean menu css -->
	<link rel="stylesheet" href="{{URL::asset('assets/css/meanmenu.min.css')}}">
	<!-- main style -->
	<link rel="stylesheet" href="{{URL::asset('assets/css/main.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{URL::asset('assets/css/responsive.css')}}">

	<style>
.nav-btn {
    padding: 10px 20px;
    margin-left: 15px; /* تعديل المسافة هنا */
    border: none;
    border-radius: 5px;
    text-transform: uppercase;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.header-icons {
    display: flex;
    align-items: center;
}

.header-icons .nav-btn {
    margin-left: 20px; /* إضافة مسافة إضافية هنا */
}
        .main-menu ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-around; /* يمكن تغيير هذه القيمة حسب التوزيع المرغوب */
            align-items: center;
        }

        .main-menu li {
            margin: 0 10px; /* المسافة بين العناصر، يمكن تعديلها حسب الحاجة */
        }

        .header-icons {
            display: flex;
            align-items: center;
        }

        .header-icons a {
            margin: 0 5px;
        }
        .site-logo img {
        width: 100px; /* تحديد عرض الشعار */
        height: auto; /* الحفاظ على نسبة العرض إلى الارتفاع */
        }
        .site-logo {
            margin-top: -10px; /* رفع الشعار لأعلى */
        }



	</style>
	@yield('css')
	<!-- favicon -->
	<title>@yield('title')</title>
	<link rel="shortcut icon" type="image/png" href="{{URL::asset('assets/img/favicon.png')}}">
	<!-- google font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    margin-left: 20px; 
}
        .main-menu ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-around; 
            align-items: center;
        }

        .main-menu li {
            margin: 0 10px; 
        }

        .header-icons {
            display: flex;
            align-items: center;
        }

        .header-icons a {
            margin: 0 5px;
        }
        .site-logo img {
        width: 100px; 
        height: auto; 
        }
        .site-logo {
            margin-top: -10px; 
        }

.main-header-notification {
    position: absolute;
    top: 5px; 
    left: -25px; 
}

.notification-badge {
    position: absolute;
    top: -10px;
    right: 0;
    border-radius: 50%;
    padding: 5px 10px;
    font-size: 12px;
}


.dropdown-menu {
    width: 350px;
}

.main-notification-list.Notification-scroll {
    max-height: 300px; 
    overflow-y: auto;
}

	</style>
	@yield('css')
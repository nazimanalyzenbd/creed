
<!DOCTYPE html>
<html lang="xxx" dir="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="KreativDev">
  <meta name="keywords" content="Home">
  <meta name="description" content="Home Descriptions">
  <meta name="csrf-token" content="GRLdOpYtWdLi4DXFShmWnaR5HtOP38JybBzNtjTu" />
  <meta property="og:title" content="">
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  
  <title>Home | Employment Directory</title>
  
  <link rel="shortcut icon" type="image/png" href="{{asset('/frontend/images/logo.png')}}">
  <link rel="apple-touch-icon" href="{{asset('/frontend/images/logo.png')}}">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{asset('/frontend/bootstrap/css/bootstrap.min.css')}}">
<!-- Bootstrap Datepicker CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<!-- Data Tables CSS -->
<link rel="stylesheet" href="{{asset('/frontend/datatables/datatables.min.css')}}">
<!-- Fontawesome Icon CSS -->
<!-- <link rel="stylesheet" href="https://business-directory.evalsoftsolutions.com/assets/front/fonts/fontawesome/css/all.min.css"> -->
<!-- Icomoon Icon CSS -->
<link rel="stylesheet" href="{{asset('/frontend/icomoon/style.css')}}">
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="{{asset('/frontend/css/magnific-popup.min.css')}}">
<!-- Swiper Slider -->
<link rel="stylesheet" href="{{asset('/frontend/css/swiper-bundle.min.css')}}">
<!-- NoUi Range Slider -->
<link rel="stylesheet" href="{{asset('/frontend/css/nouislider.min.css')}}">
<!-- Nice Select -->
<link rel="stylesheet" href="{{asset('/frontend/css/nice-select.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('/frontend/css/select2.min.css')}}">
<!-- AOS Animation CSS -->
<link rel="stylesheet" href="{{asset('/frontend/css/aos.min.css')}}">

<link rel="stylesheet" href="{{asset('/frontend/css/floating-whatsapp.css')}}">

<link rel="stylesheet" href="{{asset('/frontend/css/toastr.min.css')}}">
<!-- Leaflet Map CSS  -->
<link rel="stylesheet" href="{{asset('/frontend/css/leaflet.css')}}" />
<link rel="stylesheet" href="{{asset('/frontend/css/leaflet.fullscreen.css')}}" />
<link rel="stylesheet" href="{{asset('/frontend/css/MarkerCluster.css')}}">
<!-- Tinymce-content CSS  -->
<link rel="stylesheet" href="{{asset('/frontend/css/tinymce-content.css')}}">
<!-- Main Style CSS -->
<link rel="stylesheet" href="https://business-directory.evalsoftsolutions.com/assets/front/css/style.css">
<!-- Responsive CSS -->
<link rel="stylesheet" href="{{asset('/frontend/css/responsive.css')}}">

<link rel="stylesheet" href="{{asset('/frontend/css/style.css')}}">

</head>
<body class=" ">
  <!-- Preloader start -->
      <div id="preLoader">
      <img src="{{asset('/frontend/images/loader.gif')}}" alt="">
    </div>
    <!-- Preloader end -->

  <div class="request-loader">
    <img src="{{asset('/frontend/images/loader.gif')}}" alt="">
  </div>

  <!-- Header-area start -->
      <!-- Header-area start -->
<header class="header-area header-1" data-aos="slide-down">
  <!-- Start mobile menu -->
  <div class="mobile-menu">
    <div class="container">
      <div class="mobile-menu-wrapper"></div>
    </div>
  </div>
  <!-- End mobile menu -->

  <div class="main-responsive-nav">
    <div class="container">
      <!-- Mobile Logo -->
      <div class="logo">
        <a href="#"><img src="{{asset('/frontend/images/logo.png')}}" alt="logo"></a>
      </div>
      <!-- Menu toggle button -->
      <button class="menu-toggler" type="button">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </div>
  @include('frontend.layouts.navigation')
</header>
<!-- Header-area end -->
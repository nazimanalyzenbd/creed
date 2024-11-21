@extends('frontend.layouts.app')
@section('content')
    <!-- Header-area end -->
    <section class="hero-banner hero-banner-1 header-next border-top pb-60 mt-45">
        <div class="container container-lg-fluid px-lg-0">
            <div class="row align-items-center" data-aos="fade-up">
                <div class="col-lg-5">
                    <div class="fluid-left">
                        <div class="content-left">
                            <div class="content">
                                <h2 class="title mb-20" data-aos="fade-up">
                                    Are You Looking For A extrem business?
                                </h2>
                                
                            </div>
                            <div class="banner-filter-form mb-20">
                                <div class="form-wrapper radius-xl">
                                    <form action="#" id="searchForm2" method="GET">
                                        <div class="row align-items-center gx-xl-3">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="input-group border-end">
                                                    <label for="search"><i class="fa-solid fa-store"></i></label>
                                                    <input type="text" name="title" id="title"
                                                        class="form-control input-border-focus"
                                                        placeholder="I’m Looking for">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 mt-20">
                                                <div class="input-group">
                                                    <label for="location"><i class="fa-solid fa-location-pin"></i></label>
                                                    <input type="text" name="location" id="location"
                                                        class="form-control input-border-focus"
                                                        placeholder="Location">
                                                    <span class="input-group-text" id="useCurrentLocation"
                                                        style="cursor: pointer;">
                                                        <i class="fas fa-location"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <div class="form-group mt-40 mb-20">
                                                    <div class="form-check form-check-inline" style="display: block;">
                                                        <input class="form-check-input" type="checkbox" id="muslimOwned"
                                                             name="muslim_owned" value="1">
                                                        <label class="form-check-label" for="muslimOwned"
                                                            style="font-size: 18px !important;">Muslim Owned</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="display: block;">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="muslim_operated" 
                                                            id="muslimOperated" value="1">
                                                        <label class="form-check-label" for="muslimOperated"
                                                            style="font-size: 18px !important;">Muslim Operated</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="display: block;">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="muslim_community" 
                                                            id="muslimServing" value="1">
                                                        <label class="form-check-label" for="muslimServing"
                                                            style="font-size: 18px !important;">Serving the Muslim
                                                            Community</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <button type="button" id="searchBtn2"
                                                    class="btn btn-lg btn-primary icon-start w-300">
                                                    <i class="fa fa-search"></i>
                                                    <span class="">Search Now</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <!-- Page title start-->
                    <div class="listing-map">
                        <div class="container">
                            <div class="main-map">
                                <div id="main-map"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Page title end-->
                    
                </div>
            </div>
        </div>
        <!-- Bg Shape -->
        <div class="shape">
            <img class="shape-1" src="{{asset('frontend/images/shape/shape-1.svg')}}" alt="Shape">
            <img class="shape-2" src="{{asset('frontend/images/shape/shape-2.svg')}}" alt="Shape">
            <img class="shape-3" src="{{asset('frontend/images/shape/shape-3.svg')}}" alt="Shape">
            <img class="shape-4" src="{{asset('frontend/images/shape/shape-4.svg')}}" alt="Shape">
            <img class="shape-5" src="{{asset('frontend/images/shape/shape-5.svg')}}" alt="Shape">
        </div>
    </section>

    <!-- Home-area end -->

    <!-- Product-area start -->
            <section class="product-area pt-100 pb-75 bg-primary-light">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title title-inline mb-30" data-aos="fade-up">
                            <h2 class="title mb-20"><span
                                    class="line">Featured Listings
                                </span></h2>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="forAll">
                                <div class="row">
                                            <div class="col-xl-3 col-lg-4 col-sm-6" data-aos="fade-up">
                                                <div class="product-default border radius-md mb-25">
                                                    <figure class="product-img">
                                                        <a href="#"
                                                            class="lazy-container ratio ratio-2-3">
                                                            <img class="lazyload"
                                                                data-src="{{asset('frontend/images/listing/1727093768.jpg')}}"
                                                                alt="Da Claudio">
                                                        </a>
                                                        <a href="#"
                                                            class="btn-icon "
                                                            data-tooltip="tooltip" data-bs-placement="top"
                                                            title="Save to Wishlist">
                                                            <i class="fas fa-heart"></i>
                                                        </a>
                                                    </figure>

                                                    <div class="product-details">
                                                        <div class="product-top mb-10">
                                                            
                                                            <div class="author">
                                                                <a class="color-medium"
                                                                    href="#"
                                                                    target="_self" title=vendor>                                                                                                                                                                                                                      <img class="blur-up lazyload"
                                                                                data-src="{{asset('/frontend/images/blank-user.jpg')}}"
                                                                                alt="Image">
                                                                                                                                                                                                                <span>By
                                                                        vendor
                                                                    </span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                                <a href="#"
                                                                title="Link"
                                                                class="product-category font-sm icon-start">
                                                                <i
                                                                    class="fas fa-utensils"></i>Restaurant1
                                                            </a>
                                                        </div>
                                                        <h5 class="product-title mb-10"><a href="#">Da Claudio</a>
                                                        </h5>
                                                        <div class="product-ratings mb-10">
                                                            <div class="ratings">
                                                                <div class="rate"
                                                                    style="background-image:url({{asset('/frontend/images/rate-star.png')}})">
                                                                    <div class="rating-icon"
                                                                        style="background-image: url({{asset('/frontend/images/rate-star.png')}}); width: 0%;">
                                                                    </div>
                                                                </div>
                                                                <span
                                                                    class="ratings-total font-sm">(0)</span>
                                                                <span
                                                                    class="ratings-total color-medium ms-1 font-sm">0
                                                                    Reviews</span>
                                                            </div>
                                                        </div>
                                                                                                                <span class="product-location icon-start font-sm"><i
                                                                class="fas fa-map-marker-alt"></i>newyork
                                                                                                                            ,California
                                                                                                                                     ,United States
                                                                                                                        </span>
                                                                                                                    <div class="product-price mt-10 pt-10 border-top">
                                                                <span class="color-medium me-2">From</span>
                                                                <h6 class="price mb-0 lh-1">
                                                                    $77 -
                                                                    $7790
                                                                </h6>
                                                            </div>
                                                                                                            </div>
                                                </div><!-- product-default -->
                                            </div>
                                                                                    <div class="col-xl-3 col-lg-4 col-sm-6" data-aos="fade-up">
                                                <div class="product-default border radius-md mb-25">
                                                    <figure class="product-img">
                                                        <a href="#"
                                                            class="lazy-container ratio ratio-2-3">
                                                            <img class="lazyload"
                                                                data-src="{{asset('frontend/images/listing/1727094327.jpg')}}"
                                                                alt="Arethusa al Tavolo">
                                                        </a>
                                                            <a href="#"
                                                            class="btn-icon "
                                                            data-tooltip="tooltip" data-bs-placement="top"
                                                            title="Save to Wishlist">
                                                            <i class="fas fa-heart"></i>
                                                        </a>
                                                    </figure>

                                                    <div class="product-details">
                                                        <div class="product-top mb-10">
                                                            
                                                            <div class="author">
                                                                <a class="color-medium"
                                                                    href="#"
                                                                    target="_self" title=vendor>
                                                                                                                                    <img class="blur-up lazyload"
                                                                                data-src="{{asset('frontend/images/blank-user.jpg')}}"
                                                                                alt="Image">
                                                                                                                                                                                     <span>By
                                                                        vendor
                                                                    </span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                                <a href="#"
                                                                title="Link"
                                                                class="product-category font-sm icon-start">
                                                                <i
                                                                    class="fas fa-utensils"></i>Restaurant1
                                                            </a>
                                                        </div>
                                                        <h5 class="product-title mb-10"><a
                                                                href="#">Arethusa al Tavolo</a>
                                                        </h5>
                                                        <div class="product-ratings mb-10">
                                                            <div class="ratings">
                                                                <div class="rate"
                                                                    style="background-image:url({{asset('/frontend/images/rate-star.png')}})">
                                                                    <div class="rating-icon"
                                                                        style="background-image: url({{asset('/frontend/images/rate-star.png')}}); width: 0%;">
                                                                    </div>
                                                                </div>
                                                                <span
                                                                    class="ratings-total font-sm">(0)</span>
                                                                <span
                                                                    class="ratings-total color-medium ms-1 font-sm">0
                                                                    Reviews</span>
                                                            </div>
                                                        </div>
                                                                                                                <span class="product-location icon-start font-sm"><i
                                                                class="fas fa-map-marker-alt"></i>Los Angeles
                                                                                                                            ,California
                                                                                                                                     ,United States
                                                                                                                        </span>
                                                                                                                    <div class="product-price mt-10 pt-10 border-top">
                                                                <span class="color-medium me-2">From</span>
                                                                <h6 class="price mb-0 lh-1">
                                                                    $77 -
                                                                    $7790
                                                                </h6>
                                                            </div>
                                                                                                            </div>
                                                </div><!-- product-default -->
                                            </div>
                                                                                    <div class="col-xl-3 col-lg-4 col-sm-6" data-aos="fade-up">
                                                <div class="product-default border radius-md mb-25">
                                                    <figure class="product-img">
                                                        <a href="#"
                                                            class="lazy-container ratio ratio-2-3">
                                                            <img class="lazyload"
                                                                data-src="{{asset('frontend/images/listing/1727094954.webp')}}"
                                                                alt="Marcellino">
                                                        </a>
                                                            <a href="#"
                                                            class="btn-icon "
                                                            data-tooltip="tooltip" data-bs-placement="top"
                                                            title="Save to Wishlist">
                                                            <i class="fas fa-heart"></i>
                                                        </a>
                                                    </figure>

                                                    <div class="product-details">
                                                        <div class="product-top mb-10">
                                                            
                                                            <div class="author">
                                                                <a class="color-medium"
                                                                    href="#"
                                                                    target="_self" title=vendor>

                                                                                                                                                                                                                        <img class="blur-up lazyload"
                                                                                data-src="{{asset('/frontend/images/blank-user.jpg')}}"
                                                                                alt="Image">
                                                                                                                                                                                                                <span>By
                                                                        vendor
                                                                    </span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                                <a href="#"
                                                                title="Link"
                                                                class="product-category font-sm icon-start">
                                                                <i
                                                                    class="fas fa-utensils"></i>Restaurant1
                                                            </a>
                                                        </div>
                                                        <h5 class="product-title mb-10"><a
                                                                href="#">Marcellino</a>
                                                        </h5>
                                                        <div class="product-ratings mb-10">
                                                            <div class="ratings">
                                                                <div class="rate"
                                                                    style="background-image:url({{asset('/frontend/images/rate-star.png')}})">
                                                                    <div class="rating-icon"
                                                                        style="background-image: url({{asset('/frontend/images/rate-star.png')}}); width: 40%;">
                                                                    </div>
                                                                </div>
                                                                <span
                                                                    class="ratings-total font-sm">(2)</span>
                                                                <span
                                                                    class="ratings-total color-medium ms-1 font-sm">1
                                                                    Reviews</span>
                                                            </div>
                                                        </div>
                                                                                                                <span class="product-location icon-start font-sm"><i
                                                                class="fas fa-map-marker-alt"></i>newyork
                                                                                                                            ,California
                                                                                                                                     ,United States
                                                                                                                        </span>
                                                                                                                    <div class="product-price mt-10 pt-10 border-top">
                                                                <span class="color-medium me-2">From</span>
                                                                <h6 class="price mb-0 lh-1">
                                                                    $20 -
                                                                    $7790
                                                                </h6>
                                                            </div>
                                                                                                            </div>
                                                </div><!-- product-default -->
                                            </div>
                                            <div class="col-xl-3 col-lg-4 col-sm-6" data-aos="fade-up">
                                                <div class="product-default border radius-md mb-25">
                                                    <figure class="product-img">
                                                        <a href="#"
                                                            class="lazy-container ratio ratio-2-3">
                                                            <img class="lazyload"
                                                                data-src="{{asset('/frontend/images/listing/1730476747.jpg')}}"
                                                                alt="kfc">
                                                        </a>
                                                            <a href="#"
                                                            class="btn-icon "
                                                            data-tooltip="tooltip" data-bs-placement="top"
                                                            title="Save to Wishlist">
                                                            <i class="fas fa-heart"></i>
                                                        </a>
                                                    </figure>

                                                    <div class="product-details">
                                                        <div class="product-top mb-10">
                                                            
                                                            <div class="author">
                                                                <a class="color-medium"
                                                                    href="#"
                                                                    target="_self" title=google_112361285847059849307>

                                                                                                                                                                                                                        <img class="blur-up lazyload"
                                                                                data-src="{{asset('/frontend/images/blank-user.jpg')}}"
                                                                                alt="Image">
                                                                                                                                                                                                                <span>By
                                                                        google_112361285847059849307
                                                                    </span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            <a href="#"
                                                                title="Link"
                                                                class="product-category font-sm icon-start">
                                                                <i
                                                                    class="fas fa-h-square"></i>Hotel2
                                                            </a>
                                                        </div>
                                                        <h5 class="product-title mb-10"><a
                                                                href="#">kfc</a>
                                                        </h5>
                                                        <div class="product-ratings mb-10">
                                                            <div class="ratings">
                                                                <div class="rate"
                                                                    style="background-image:url('{{asset('/frontend/images/rate-star.png')}}')">
                                                                    <div class="rating-icon"
                                                                        style="background-image: url({{asset('/frontend/images/rate-star.png')}}); width: 0%;">
                                                                    </div>
                                                                </div>
                                                                <span
                                                                    class="ratings-total font-sm">(0)</span>
                                                                <span
                                                                    class="ratings-total color-medium ms-1 font-sm">0
                                                                    Reviews</span>
                                                            </div>
                                                        </div>
                                                                                                                <span class="product-location icon-start font-sm"><i
                                                                class="fas fa-map-marker-alt"></i>newyork
                                                                                                                            ,California
                                                                                                                                     ,United States
                                                                                                                        </span>
                                                                                                                    <div class="product-price mt-10 pt-10 border-top">
                                                                <span class="color-medium me-2">From</span>
                                                                <h6 class="price mb-0 lh-1">
                                                                    $324234 -
                                                                    $7546546546
                                                                </h6>
                                                            </div>
                                                                                                            </div>
                                                </div><!-- product-default -->
                                            </div>
                                                                                    <div class="col-xl-3 col-lg-4 col-sm-6" data-aos="fade-up">
                                                <div class="product-default border radius-md mb-25">
                                                    <figure class="product-img">
                                                        <a href="#"
                                                            class="lazy-container ratio ratio-2-3">
                                                            <img class="lazyload"
                                                                data-src="{{asset('/frontend/images/listing/1730476747.jpg')}}"
                                                                alt="hsjsnan">
                                                        </a>
                                                        <a href="#"
                                                            class="btn-icon "
                                                            data-tooltip="tooltip" data-bs-placement="top"
                                                            title="Save to Wishlist">
                                                            <i class="fas fa-heart"></i>
                                                        </a>
                                                    </figure>

                                                    <div class="product-details">
                                                        <div class="product-top mb-10">
                                                            
                                                            <div class="author">
                                                                <a class="color-medium"
                                                                    href="#"
                                                                    target="_self" title=google_112361285847059849307>

                                                                                                                                                                                                                        <img class="blur-up lazyload"
                                                                                data-src="{{asset('/frontend/images/blank-user.jpg')}}"
                                                                                alt="Image">
                                                                                                                                                                                                                <span>By
                                                                        google_112361285847059849307
                                                                    </span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            <a href="#"
                                                                title="Link"
                                                                class="product-category font-sm icon-start">
                                                                <i
                                                                    class="fas fa-h-square"></i>Hotel2
                                                            </a>
                                                        </div>
                                                        <h5 class="product-title mb-10"><a
                                                                href="#">hsjsnan</a>
                                                        </h5>
                                                        <div class="product-ratings mb-10">
                                                            <div class="ratings">
                                                                <div class="rate"
                                                                    style="background-image:url({{asset('/frontend/images/rate-star.png')}})">
                                                                    <div class="rating-icon"
                                                                        style="background-image: url({{asset('/frontend/images/rate-star.png')}}); width: 0%;">
                                                                    </div>
                                                                </div>
                                                                <span
                                                                    class="ratings-total font-sm">(0)</span>
                                                                <span
                                                                    class="ratings-total color-medium ms-1 font-sm">0
                                                                    Reviews</span>
                                                            </div>
                                                        </div>
                                                                                                                <span class="product-location icon-start font-sm"><i
                                                                class="fas fa-map-marker-alt"></i>newyork
                                                                                                                            ,California
                                                                                                                                     ,United States
                                                                                                                        </span>
                                                                                                                    <div class="product-price mt-10 pt-10 border-top">
                                                                <span class="color-medium me-2">From</span>
                                                                <h6 class="price mb-0 lh-1">
                                                                    $57 -
                                                                    $58624
                                                                </h6>
                                                            </div>
                                                                                                            </div>
                                                </div><!-- product-default -->
                                            </div>
                                                                                    <div class="col-xl-3 col-lg-4 col-sm-6" data-aos="fade-up">
                                                <div class="product-default border radius-md mb-25">
                                                    <figure class="product-img">
                                                        <a href="#"
                                                            class="lazy-container ratio ratio-2-3">
                                                            <img class="lazyload"
                                                                data-src="{{asset('/frontend/images/listing/1730476747.jpg')}}"
                                                                alt="bsnsnan">
                                                        </a>
                                                        <a href="#"
                                                            class="btn-icon "
                                                            data-tooltip="tooltip" data-bs-placement="top"
                                                            title="Save to Wishlist">
                                                            <i class="fas fa-heart"></i>
                                                        </a>
                                                    </figure>

                                                    <div class="product-details">
                                                        <div class="product-top mb-10">
                                                            
                                                            <div class="author">
                                                                <a class="color-medium"
                                                                    href="#"
                                                                    target="_self" title=google_112361285847059849307>

                                                                                                                                                                                                                        <img class="blur-up lazyload"
                                                                                data-src="{{asset('frontend/images/blank-user.jpg')}}"
                                                                                alt="Image">
                                                                                                                                                                                                                <span>By
                                                                        google_112361285847059849307
                                                                    </span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            <a href="#"
                                                                title="Link"
                                                                class="product-category font-sm icon-start">
                                                                <i
                                                                    class="fas fa-h-square"></i>Hotel2
                                                            </a>
                                                        </div>
                                                        <h5 class="product-title mb-10"><a
                                                                href="#">bsnsnan</a>
                                                        </h5>
                                                        <div class="product-ratings mb-10">
                                                            <div class="ratings">
                                                                <div class="rate"
                                                                    style="background-image:url({{asset('/frontend/images/rate-star.png')}})">
                                                                    <div class="rating-icon"
                                                                        style="background-image: url({{asset('/frontend/images/rate-star.png')}}); width: 0%;">
                                                                    </div>
                                                                </div>
                                                                <span
                                                                    class="ratings-total font-sm">(0)</span>
                                                                <span
                                                                    class="ratings-total color-medium ms-1 font-sm">0
                                                                    Reviews</span>
                                                            </div>
                                                        </div>
                                                                                                                <span class="product-location icon-start font-sm"><i
                                                                class="fas fa-map-marker-alt"></i>newyork
                                                                                                                            ,California
                                                                                                                                     ,United States
                                                                                                                        </span>
                                                                                                                    <div class="product-price mt-10 pt-10 border-top">
                                                                <span class="color-medium me-2">From</span>
                                                                <h6 class="price mb-0 lh-1">
                                                                    $576 -
                                                                    $692627
                                                                </h6>
                                                            </div>
                                                                                                            </div>
                                                </div><!-- product-default -->
                                            </div>
                                                                                    <div class="col-xl-3 col-lg-4 col-sm-6" data-aos="fade-up">
                                                <div class="product-default border radius-md mb-25">
                                                    <figure class="product-img">
                                                        <a href="#"
                                                            class="lazy-container ratio ratio-2-3">
                                                            <img class="lazyload"
                                                                data-src="{{asset('/frontend/images/listing/1730476747.jpg')}}"
                                                                alt="fsjahah">
                                                        </a>
                                                        <a href="#"
                                                            class="btn-icon "
                                                            data-tooltip="tooltip" data-bs-placement="top"
                                                            title="Save to Wishlist">
                                                            <i class="fas fa-heart"></i>
                                                        </a>
                                                    </figure>

                                                    <div class="product-details">
                                                        <div class="product-top mb-10">
                                                            
                                                            <div class="author">
                                                                <a class="color-medium"
                                                                    href="#"
                                                                    target="_self" title=google_112361285847059849307>

                                                                                                                                                                                                                        <img class="blur-up lazyload"
                                                                                data-src="{{asset('/frontend/images/blank-user.jpg')}}"
                                                                                alt="Image">
                                                                                                                                                                                                                <span>By
                                                                        google_112361285847059849307
                                                                    </span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            <a href="#"
                                                                title="Link"
                                                                class="product-category font-sm icon-start">
                                                                <i
                                                                    class="fas fa-h-square"></i>Hotel2
                                                            </a>
                                                        </div>
                                                        <h5 class="product-title mb-10"><a
                                                                href="#">fsjahah</a>
                                                        </h5>
                                                        <div class="product-ratings mb-10">
                                                            <div class="ratings">
                                                                <div class="rate"
                                                                    style="background-image:url({{asset('/frontend/images/rate-star.png')}})">
                                                                    <div class="rating-icon"
                                                                        style="background-image: url({{asset('/frontend/images/rate-star.png')}}); width: 0%;">
                                                                    </div>
                                                                </div>
                                                                <span
                                                                    class="ratings-total font-sm">(0)</span>
                                                                <span
                                                                    class="ratings-total color-medium ms-1 font-sm">0
                                                                    Reviews</span>
                                                            </div>
                                                        </div>
                                                                                                                <span class="product-location icon-start font-sm"><i
                                                                class="fas fa-map-marker-alt"></i>Los Angeles
                                                                                                                            ,California
                                                                                                                                     ,United States
                                                                                                                        </span>
                                                                                                                    <div class="product-price mt-10 pt-10 border-top">
                                                                <span class="color-medium me-2">From</span>
                                                                <h6 class="price mb-0 lh-1">
                                                                    $582 -
                                                                    $5278
                                                                </h6>
                                                            </div>
                                                                                                            </div>
                                                </div><!-- product-default -->
                                            </div>
                                                                            
                                </div>
                            </div>
                        </div>
                                            </div>
                </div>
            </div>
        </section>
        <!-- Product-area end -->
        <!-- Category-area start -->
        <section class="category-area category-1 pb-100 pt-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title title-center mb-20" data-aos="fade-up">
                            <h2 class="title"> Most Popular Categories</h2>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="swiper pt-30" id="category-slider-1" data-aos="fade-up" data-aos-delay="100">
                                <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <a
                                                href="#">
                                                <div class="category-item radius-md text-center">
                                                    <div class="category-icon">
                                                        <i class="fas fa-utensils"></i>
                                                    </div>
                                                    <h3 class="category-title mb-20">Restaurant</h3>
                                                    <span
                                                        class="category-qty">23</span>
                                                </div>
                                            </a>
                                        </div>
                                                                            <div class="swiper-slide">
                                            <a
                                                href="#">
                                                <div class="category-item radius-md text-center">
                                                    <div class="category-icon">
                                                        <i class="fas fa-h-square"></i>
                                                    </div>
                                                    <h3 class="category-title mb-20">Hotel</h3>
                                                    <span
                                                        class="category-qty">22</span>
                                                </div>
                                            </a>
                                        </div>
                                                                            <div class="swiper-slide">
                                            <a
                                                href="#">
                                                <div class="category-item radius-md text-center">
                                                    <div class="category-icon">
                                                        <i class="fas fa-shopping-cart iconpicker-component"></i>
                                                    </div>
                                                    <h3 class="category-title mb-20">Medical - Doctor/Dentist/ Surgeon/Mental Health/Medical Services/Health &amp; Well Being Facility</h3>
                                                    <span
                                                        class="category-qty">1</span>
                                                </div>
                                            </a>
                                        </div>
                                                                            <div class="swiper-slide">
                                            <a
                                                href="#">
                                                <div class="category-item radius-md text-center">
                                                    <div class="category-icon">
                                                        <i class="fas fa-balance-scale"></i>
                                                    </div>
                                                    <h3 class="category-title mb-20">Legal - Lawyer/Law-Firm/Legal Expert/Legal Consultant</h3>
                                                    <span
                                                        class="category-qty">2</span>
                                                </div>
                                            </a>
                                        </div>
                                                                            <div class="swiper-slide">
                                            <a
                                                href="#">
                                                <div class="category-item radius-md text-center">
                                                    <div class="category-icon">
                                                        <i class="fas fa-shopping-cart iconpicker-component"></i>
                                                    </div>
                                                    <h3 class="category-title mb-20">Event Planning</h3>
                                                    <span
                                                        class="category-qty">1</span>
                                                </div>
                                            </a>
                                        </div>
                                                                                </div>
                    <!-- Slider Pagination -->
                    <div class="swiper-pagination position-static mt-30" id="category-slider-1-pagination"></div>
                </div>
            </div>
            </div>
            </div>
            <!-- Bg Shape -->
            <div class="shape">
                <img class="shape-1" src="https://business-directory.evalsoftsolutions.com/assets/front/images/shape/shape-4.svg" alt="Shape">
                <img class="shape-2" src="https://business-directory.evalsoftsolutions.com/assets/front/images/shape/shape-3.svg" alt="Shape">
                <img class="shape-3" src="https://business-directory.evalsoftsolutions.com/assets/front/images/shape/shape-1.svg" alt="Shape">
                <img class="shape-4" src="https://business-directory.evalsoftsolutions.com/assets/front/images/shape/shape-7.svg" alt="Shape">
                <img class="shape-5" src="https://business-directory.evalsoftsolutions.com/assets/front/images/shape/shape-2.svg" alt="Shape">
            </div>
        </section>
        <!-- Category-area end -->
    <!-- Work-area start -->
            <section class="work-area work-process-1 pt-100 pb-75">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title title-inline mb-30" data-aos="fade-up">
                            <h2 class="title mb-20">How It Works</h2>
                                                            <a href="#" class="btn btn-lg btn-primary mb-20">
                                    Details</a>
                                                    </div>
                    </div>
                    <div class="col-12">
                        <div class="row gx-xl-5">
                                                            <div class="col-lg-6 col-sm-6" data-aos="fade-up">
                                    <div class="card radius-lg mb-25">
                                        <div class="card-content radius-md">
                                            <div class="card-step h3"><span
                                                    data-hover="01">01</span>
                                            </div>
                                            <div class="card-icon radius-md">
                                                <i class="fas fa-th"></i>
                                            </div>
                                            <h3 class="card-title m-0">Decide if you want to shop Muslim Owned, Muslim Operated, or with any business serving the muslim community (non-musim owned or operated but has a specific offering for the muslim community Ex. Muslim Owned</h3>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-lg-6 col-sm-6" data-aos="fade-up">
                                    <div class="card radius-lg mb-25">
                                        <div class="card-content radius-md">
                                            <div class="card-step h3"><span
                                                    data-hover="02">02</span>
                                            </div>
                                            <div class="card-icon radius-md">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <h3 class="card-title m-0">Pick the location of your search or we will search the world far and wide Ex. Dallas, Texas</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6" data-aos="fade-up">
                                    <div class="card radius-lg mb-25">
                                        <div class="card-content radius-md">
                                            <div class="card-step h3"><span
                                                    data-hover="03">03</span>
                                            </div>
                                            <div class="card-icon radius-md">
                                                <i class="fas fa-suitcase"></i>
                                            </div>
                                            <h3 class="card-title m-0">Search the type of business you are looking for Ex. Mechanic</h3>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-lg-6 col-sm-6" data-aos="fade-up">
                                    <div class="card radius-lg mb-25">
                                        <div class="card-content radius-md">
                                            <div class="card-step h3"><span
                                                    data-hover="04">04</span>
                                            </div>
                                            <div class="card-icon radius-md">
                                                <i class="fas fa-search"></i>
                                            </div>
                                            <h3 class="card-title m-0">Find the perfect business that caters to your needs as a Muslim based on your creed preference Ex. 10 Muslim Owned Mechanics in Dallas Texas</h3>
                                        </div>
                                    </div>
                                </div>
                                                    </div>
                    </div>
                </div>
            </div>
            <!-- Bg Shape -->
            <div class="shape">
                <img class="shape-1" src="https://business-directory.evalsoftsolutions.com/assets/front/images/shape/shape-7.svg" alt="Shape">
                <img class="shape-2" src="https://business-directory.evalsoftsolutions.com/assets/front/images/shape/shape-6.svg" alt="Shape">
                <img class="shape-3" src="https://business-directory.evalsoftsolutions.com/assets/front/images/shape/shape-5.svg" alt="Shape">
                <img class="shape-4" src="https://business-directory.evalsoftsolutions.com/assets/front/images/shape/shape-2.svg" alt="Shape">
                <img class="shape-5" src="https://business-directory.evalsoftsolutions.com/assets/front/images/shape/shape-3.svg" alt="Shape">
            </div>
        </section>
        <!-- Work-area end -->

    <!-- Counter-area start -->
        <!-- Counter-area end -->

    <!-- Pricing-area start -->
        <!-- Pricing-area end -->

    <!-- Action banner start -->
    
    <!-- Action banner end -->
    <!-- Image Content Section Start -->
    <section class="image-content-section pt-100 pb-60" style="position: relative;">
        <!-- Background Image -->
        <div class="bg-img-container"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;">
            <img class="bg-img" src="{{asset('/frontend/images/bg.jpg')}}" alt="Bg-img"
                style="width: 100%; height: 100%; object-fit: cover; opacity: 0.75; transform: scaleX(-1) scaleY(-1);">
            <div class="overlay"
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.75);">
            </div>
        </div>

        <div class="container" style="position: relative; z-index: 1;">
            <h2 class="title text-white text-center mb-40">Benefits Of Signing Up</h2>
            <div class="row align-items-start">
                <div class="col-lg-6">
                    <div class="content-title mb-40">
                        <h3 class="text-white mb-15">INDIVIDUAL USERS</h3>
                        <ul class="text-white list-unstyled">
                            <li style="margin-bottom: 10px;"><i class="fas fa-user-circle mr-2"></i> Create your creed
                                profile</li>
                            <ul class="list-unstyled pl-4">
                                <li style="margin-bottom: 10px;"><i class="fas fa-check-circle mr-2"></i> Select if you
                                    prefer to shop Muslim owned, Muslim operated, or with businesses serving the Muslim
                                    community</li>
                            </ul>
                            <li style="margin-bottom: 10px;"><i class="fas fa-tag mr-2"></i> Unlock special discounts and
                                promotions</li>
                            <li style="margin-bottom: 10px;"><i class="fas fa-save mr-2"></i> Save your search results
                            </li>
                            <li style="margin-bottom: 10px;"><i class="fas fa-star mr-2"></i> Review businesses</li>
                            <li style="margin-bottom: 10px;"><i class="fas fa-bell mr-2"></i> Get notified on the latest
                                promotions based on your preference</li>
                            <li style="margin-bottom: 10px;"><i class="fas fa-hands-helping mr-2"></i> Support the ummah
                            </li>
                            <li style="margin-bottom: 10px;"><i class="fas fa-plus-circle mr-2"></i> More benefits coming
                                soon</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="content-title mb-40">
                        <h3 class="text-white mb-15">BUSINESS OWNERS</h3>
                        <ul class="text-white list-unstyled">
                            <li style="margin-bottom: 10px;"><i class="fas fa-bullhorn mr-2"></i> Promote and Grow your
                                business</li>
                            <li style="margin-bottom: 10px;"><i class="fas fa-users mr-2"></i> Create a following</li>
                            <li style="margin-bottom: 10px;"><i class="fas fa-bullseye mr-2"></i> Targeted marketing
                                campaigns</li>
                            <li style="margin-bottom: 10px;"><i class="fas fa-hand-holding-usd mr-2"></i> Benefit</li>
                        </ul>
                    </div>
                    <div>
                                                    <a href="#" target="_blank"
                                class="btn btn-lg btn-primary">
                                Register Now
                            </a>
                                            </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Image Content Section End -->


    <!-- Blog-area start -->
        <!-- Blog-area end -->

@endsection
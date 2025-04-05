<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from ecommerce12.testsoftwares.site/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Mar 2025 15:58:38 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
@php  $firm_detail=backHelper::get_fimddetails(); @endphp
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="csrf-token" content="ppw6IRBuLBJdSn6XFSNYwPGd47hlBcD8A46RBxKx">

    @include('website.web_font')
    <title>Quick OPD - Book Doctor Appointments & Radiology Services Online</title>
    
    <meta name="description" content="Quick OPD helps you book doctor appointments and radiology services online with ease. Find top specialists, schedule consultations, and access diagnostic services quickly.">
    
    <meta name="keywords" content="Quick OPD, doctor appointment, online booking, radiology services, diagnostic center, medical consultation, healthcare, telemedicine">
    
    <meta name="author" content="Vaishno Codex">
    
    <meta name="robots" content="index, follow">
    
    <meta property="og:title" content="Quick OPD - Book Doctor Appointments & Radiology Services">
    <meta property="og:description" content="Book doctor appointments and radiology services online with Quick OPD. Access top healthcare professionals and diagnostic services easily.">
    <meta property="og:image" content="https://yourwebsite.com/images/quick-opd-banner.jpg">
    <meta property="og:url" content="https://yourwebsite.com">
    <meta property="og:type" content="website">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Quick OPD - Book Doctor Appointments & Radiology Services">
    <meta name="twitter:description" content="Find top doctors and schedule online appointments with Quick OPD. Access radiology and diagnostic services quickly and hassle-free.">
    <meta name="twitter:image" content="https://yourwebsite.com/images/quick-opd-banner.jpg">
    
    <link rel="canonical" href="https://yourwebsite.com">
    @include('website.custom_font_css')

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('website') }}/assets/vendor/core/plugins/bottom-bar-menu/css/menue209.css?v=1.0.0">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('website') }}/assets/vendor/core/plugins/cookie-consent/css/cookie-consent0ff5.css?v=1.0.2">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('website') }}/assets/vendor/core/core/base/libraries/ckeditor/content-styles.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('website') }}/assets/themes/nest/css/vendors/normalize.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('website') }}/assets/themes/nest/plugins/bootstrap/css/bootstrap.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('website') }}/assets/themes/nest/css/vendors/uicons-regular-straight.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('website') }}/assets/themes/nest/css/plugins/animate.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('website') }}/assets/themes/nest/css/plugins/slick.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('website') }}/assets/vendor/core/plugins/ecommerce/css/front-ecommercef1bc.css?v=1.25.2.3">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('website') }}/assets/themes/nest/css/stylef1bc.css?v=1.25.2.3">

</head>

<body id="page-home">

 @include('website.preloader')


    <header class="header-area header-style-1 header-height-2 ">
        <div class="mobile-promotion">
            <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
        </div>
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-6">
                        <div class="header-info">
                            <ul>
                                <li>
                                    <a href="{{route('about.us')}}" title="About Us">
                                        <span>About Us</span>
                                    </a>
                                </li>
                                {{-- <li>
                                    <a href="orders/tracking.html" title="Order Tracking">
                                        <span>Order Tracking</span>
                                    </a>
                                </li> --}}
                            </ul>

                        </div>
                    </div>
                    <div class="col-xl-5 d-none d-xl-block">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul>
                                    <li>
                                        <i class="fi-rs-bell d-inline-block mr-5 d-inline-block mr-5"></i>

                                        <span class="d-inline-block">
                                            <b class="text-success"> Trendy 25</b> silver jewelry, save up 35% off
                                            today
                                        </span>
                                        <a class="active d-inline-block" href="products.html">&nbsp;Shop now</a>
                                    </li>
                                    <li style="display: none">
                                        <i class="fi-rs-asterisk d-inline-block mr-5 d-inline-block mr-5"></i>

                                        <span class="d-inline-block">
                                            <b class="text-danger">Super Value Deals</b> - Save more with coupons
                                        </span>
                                    </li>
                                    <li style="display: none">
                                        <i
                                            class="fi-rs-angle-double-right d-inline-block mr-5 d-inline-block mr-5"></i>

                                        <span class="d-inline-block">
                                            Get great devices up to 50% off
                                        </span>
                                        <a class="active d-inline-block" href="products.html">&nbsp;View details</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="header-info header-info-right">
                            <ul>
                                <li>Need help? Call Us: &nbsp;<strong class="text-brand"> 1900 - 888</strong></li>



                                <li>
                                    <a class="language-dropdown-active" href="javascript:void(0)">INR <i
                                            class="fi-rs-angle-small-down"></i></a>
                                    <ul class="language-dropdown">
                                        <li><a href="{{route('welcome')}}">INR</a></li>
                                       
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block sticky-bar">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="{{route('welcome')}}">
                            <img src="{{ asset('website') }}/logo/logo.svg" data-bb-lazy="false" style="max-height: 55px" loading="lazy"
                            title="MyDoctors24" alt="MyDoctors24">
                        </a>
                    </div>

                    <div class="header-right">
                        <div class="search-style-2">
                            <form action="https://ecommerce12.testsoftwares.site/products" class="form--quick-search"
                                data-ajax-url="https://ecommerce12.testsoftwares.site/ajax/search-products"
                                method="GET">
                                <div class="form-group--icon position-relative">
                                    <div class="product-cat-label">All Categories</div>
                                    <select class="product-category-select" name="categories[]"
                                        aria-label="Select category">
                                        <option value="">Select</option>
                                        <option value="1">Doctor</option>
                                        <option value="2">Hospital</option>
                                        <option value="3">Radiology</option>

                                    </select>
                                </div>
                                <input type="text" class="input-search-product" name="q"
                                    placeholder="Search for items..." value="" autocomplete="off">
                                <button class="btn" type="submit" aria-label="Submit">
                                    <svg class="icon  svg-icon-ti-ti-search" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                        <path d="M21 21l-6 -6" />
                                    </svg> </button>
                                <div class="panel--search-result"></div>
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                             
                                {{-- <div class="header-action-icon-2">
                                    <a href="wishlist.html">
                                        <img class="svgInject" alt="Wishlist"
                                            src="{{ asset('website') }}/assets/themes/nest/imgs/theme/icons/icon-heart.svg" />
                                        <span class="pro-count blue wishlist-count"> 0 </span>
                                    </a>
                                    <a href="wishlist.html"><span class="lable">History</span></a>
                                </div> --}}
                                {{-- <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="cart.html">
                                        <img alt="Cart" src="{{ asset('website') }}/assets/themes/nest/imgs/theme/icons/icon-cart.svg" />
                                        <span class="pro-count blue">0</span>
                                    </a>
                                    <a href="cart.html"><span class="lable">Cart</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 cart-dropdown-panel">
                                        <span>No products in the cart.</span>

                                    </div>
                                </div> --}}
                                @if (Auth::check())
                                @if (Auth::user()->type == 'user')
                                    <!-- Authenticated User (type: user) -->
                                    <div class="header-action-icon-2">
                                        <a href="#">
                                            <img class="svgInject rounded-circle" alt="Account"
                                                src="{{ asset('website/assets/themes/nest/imgs/theme/icons/icon-user.svg') }}" />
                                        </a>
                                        <a href="#"><span class="lable me-1">Account</span></a>
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                            <ul>
                                                <li><a href="{{ route('user.dashboard') }}"><i class="fi fi-rs-user mr-10"></i>Dashboard</a></li>
                                                <li><a href="#"><i class="fi fi-rs-user-add mr-10"></i>Orders</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <!-- Authenticated User (Not type: user) -->
                                    <div class="header-action-icon-2">
                                        <a href="#">
                                            <img class="svgInject rounded-circle" alt="Account"
                                                src="{{ asset('website/assets/themes/nest/imgs/theme/icons/icon-user.svg') }}" />
                                        </a>
                                        <a href="#"><span class="lable me-1">Account</span></a>
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                            <ul>
                                                <li><a href="{{ route('login.user') }}"><i class="fi fi-rs-user mr-10"></i>Login</a></li>
                                                <li><a href="{{ route('register.user') }}"><i class="fi fi-rs-user-add mr-10"></i>Register</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <!-- Guest User (Not Logged In) -->
                                <div class="header-action-icon-2">
                                    <a href="#">
                                        <img class="svgInject rounded-circle" alt="Account"
                                            src="{{ asset('website/assets/themes/nest/imgs/theme/icons/icon-user.svg') }}" />
                                    </a>
                                    <a href="#"><span class="lable me-1">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li><a href="{{ route('login.user') }}"><i class="fi fi-rs-user mr-10"></i>Login</a></li>
                                            <li><a href="{{ route('register.user') }}"><i class="fi fi-rs-user-add mr-10"></i>Register</a></li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">

                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="{{route('welcome')}}">
                            <img src="{{ asset('website') }}/logo/logo.svg" data-bb-lazy="false" style="max-height: 55px" loading="lazy"
                                alt="Quick OPD">
                        </a>
                    </div>

                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categories-wrap d-none d-lg-block">
                            <a class="categories-button-active" href="#">
                                <span class="fi-rs-apps"></span> <span class="et">Browse</span> All Categories
                                <i class="fi-rs-angle-down"></i>
                            </a>
                            <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">

                                <div class="d-flex categories-dropdown-inner">
                                    <ul>
                                        <li>
                                            <a href="product-categories/milks-and-dairies.html">
                                                <img src="{{ asset('website') }}/assets/storage/product-categories/icon-1.png"
                                                    alt="Milks and Dairies" width="30" height="30">
                                                Milks and Dairies
                                            </a>
                                        </li>
                                       
                                    </ul>
                                    <ul class="end">
                                        <li>
                                            <a href="product-categories/wines-drinks.html">
                                                <img src="{{ asset('website') }}/assets/storage/product-categories/icon-6.png"
                                                    alt="Wines &amp; Drinks" width="30" height="30">
                                                Wines &amp; Drinks
                                            </a>
                                        </li>
                                        <li>
                                            <a href="product-categories/fresh-seafood.html">
                                                <img src="{{ asset('website') }}/assets/storage/product-categories/icon-7.png" alt="Fresh Seafood"
                                                    width="30" height="30">
                                                Fresh Seafood
                                            </a>
                                        </li>
                                     
                                    </ul>

                                </div>
                               
                            </div>
                        </div>

                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                            <nav>
                                <ul>
                                    <li><a href="{{route('welcome')}}" class="active" target="_self">
                                            <i class="fi-rs-home me-1"></i> Home </a> </li>
                                        <li><a href="{{route('all.doctor')}}" target="_self">  All Doctor  </a> </li>
                                        <li><a href="{{route('all.hospital')}}" target="_self">  All Hospital  </a> </li>
                                
                                
                                 
                                    <li>
                                        <a href="#" target="_self">
                                            FAQ
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_self">
                                            Contact
                                        </a>
                                    </li>
                                </ul>

                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-flex">
                        <img src="{{ asset('website') }}/assets/themes/nest/imgs/theme/icons/icon-headphone.svg" alt="hotline" />
                        <p>{{$firm_detail->mobile}}<span>24/7 Support Center</span></p>
                    </div>
                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="{{route('welcome')}}">
                        <img src="{{ asset('website') }}/logo/logo.svg" data-bb-lazy="false" style="max-height: 55px" loading="lazy"
                            alt="Quick OPD">
                    </a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="https://ecommerce12.testsoftwares.site/products" class="form--quick-search"
                        data-ajax-url="https://ecommerce12.testsoftwares.site/ajax/search-products" method="get">
                        <input type="text" name="q" class="input-search-product"
                            placeholder="Search for items..." value="" autocomplete="off">
                        <button type="submit"><i class="fi-rs-search"></i></button>
                        <div class="panel--search-result"></div>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li>
                                <span class="menu-expand"></span>
                                <a href="{{route('welcome')}}" target="_self">
                                    <i class="fi-rs-home me-1"></i> Home
                                </a>
                            </li>
                            <li class=" menu-item-has-children  ">
                                <span class="menu-expand"></span>
                                <a href="products.html" target="_self">
                                    Shop
                                </a>
                                <ul class="dropdown">
                                    <li class=" ">
                                        <a href="products.html" target="_self">
                                            Shop Grid - Full Width
                                        </a>
                                    </li>
                                </ul>

                            </li>
                            <li class=" menu-item-has-children  ">
                                <span class="menu-expand"></span>
                                <a href="stores.html" target="_self">
                                    Stores
                                </a>
                                <ul class="dropdown">
                                    <li class=" ">
                                        <a href="stores.html" target="_self">
                                            Stores - Grid
                                        </a>
                                    </li>
                                  
                                </ul>

                            </li>
                            <li>
                                <span class="menu-expand"></span>
                                <a href="{{route('welcome')}}" target="_self">Home </a>
                               

                            </li>
                            <li class=" menu-item-has-children  ">
                                <span class="menu-expand"></span>
                                <a href="blog.html" target="_self">
                                    Blog
                                </a>
                                <ul class="dropdown">
                                  
                                    <li class=" menu-item-has-children  ">
                                        <span class="menu-expand"></span>
                                        <a href="{{route('welcome')}}" target="_self">
                                            Single Post
                                        </a>
                                      
                                    </li>
                                </ul>

                            </li>
                            <li class=" ">
                                <a href="faq.html" target="_self">
                                    FAQ
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{route('contact.us')}}" target="_self">
                                    Contact
                                </a>
                            </li>
                        </ul>

                    </nav>
                    <!-- mobile menu end -->
                </div>

                <div class="mobile-header-info-wrap">

                   

                    <div class="single-mobile-header-info">
                        <a href="compare.html"><i class="fi-rs-refresh"></i> Compare</a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="{{route('login.user')}}"><i class="fi-rs-user"></i> Log In / Sign Up</a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="tel:1900 - 888"><i class="fi-rs-headphones"></i> 1900 - 888</a>
                    </div>
                </div>
                <div class="mobile-social-icon mb-50">
                    <p class="mb-15 font-heading h6 me-2">Follow Us</p>
                    <a href="https://www.facebook.com/" title="Facebook">
                        <img src="{{ asset('website') }}/assets/storage/general/facebook.png" alt="Facebook" />
                    </a>
                    <a href="https://www.twitter.com/" title="Twitter">
                        <img src="{{ asset('website') }}/assets/storage/general/twitter.png" alt="Twitter" />
                    </a>
                    <a href="https://www.instagram.com/" title="Instagram">
                        <img src="{{ asset('website') }}/assets/storage/general/instagram.png" alt="Instagram" />
                    </a>
                    <a href="https://www.pinterest.com/" title="Pinterest">
                        <img src="{{ asset('website') }}/assets/storage/general/pinterest.png" alt="Pinterest" />
                    </a>
                    <a href="https://www.youtube.com/" title="Youtube">
                        <img src="{{ asset('website') }}/assets/storage/general/youtube.png" alt="Youtube" />
                    </a>
                </div>
                <div class="site-copyright">Copyright © 2025 
                </div>
            </div>
        </div>
    </div>
  @yield('content')



        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col">
                        <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0  wow animate__animated animate__fadeInUp"
                            data-wow-delay="0">
                            <div class="logo mb-30">
                                <a href="{{route('welcome')}}" class="mb-15">
                                    <img src="{{ asset('website') }}/logo/logo.svg" data-bb-lazy="false" style="max-height: 55px"
                                        loading="lazy" alt="Quick OPD">
                                </a>

                                <p class="font-lg text-heading">Short content here</p>
                            </div>
                            <ul class="contact-infor">
                                <li>
                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0)">
                                            <path
                                                d="M8.00001 16.7564L7.53334 16.3564C6.89001 15.8178 1.27267 10.9664 1.27267 7.41776C1.27267 5.63356 1.98145 3.92244 3.24306 2.66082C4.50468 1.3992 6.21581 0.69043 8.00001 0.69043C9.78421 0.69043 11.4953 1.3992 12.757 2.66082C14.0186 3.92244 14.7273 5.63356 14.7273 7.41776C14.7273 10.9664 9.11001 15.8178 8.46934 16.3591L8.00001 16.7564ZM8.00001 2.1451C6.6021 2.14668 5.2619 2.70271 4.27342 3.69118C3.28495 4.67965 2.72893 6.01985 2.72734 7.41776C2.72734 9.6471 6.18334 13.2084 8.00001 14.8384C9.81667 13.2078 13.2727 9.64443 13.2727 7.41776C13.2711 6.01985 12.7151 4.67965 11.7266 3.69118C10.7381 2.70271 9.39792 2.14668 8.00001 2.1451Z"
                                                fill="#3BB77E" />
                                            <path
                                                d="M8.00001 10.0843C7.47259 10.0843 6.95702 9.92791 6.51849 9.6349C6.07996 9.34188 5.73817 8.9254 5.53633 8.43813C5.3345 7.95086 5.28169 7.41469 5.38458 6.8974C5.48748 6.38012 5.74145 5.90497 6.11439 5.53203C6.48733 5.15909 6.96249 4.90511 7.47977 4.80222C7.99705 4.69932 8.53323 4.75213 9.0205 4.95397C9.50777 5.1558 9.92425 5.49759 10.2173 5.93612C10.5103 6.37465 10.6667 6.89023 10.6667 7.41764C10.6667 8.12489 10.3857 8.80317 9.88563 9.30326C9.38553 9.80336 8.70726 10.0843 8.00001 10.0843ZM8.00001 6.08431C7.7363 6.08431 7.47852 6.16251 7.25925 6.30902C7.03999 6.45553 6.86909 6.66377 6.76817 6.9074C6.66726 7.15103 6.64085 7.41912 6.6923 7.67776C6.74374 7.93641 6.87073 8.17398 7.0572 8.36045C7.24367 8.54692 7.48125 8.67391 7.73989 8.72536C7.99853 8.77681 8.26662 8.7504 8.51026 8.64948C8.75389 8.54857 8.96213 8.37767 9.10864 8.1584C9.25515 7.93914 9.33335 7.68135 9.33335 7.41764C9.33335 7.06402 9.19287 6.72488 8.94282 6.47484C8.69277 6.22479 8.35363 6.08431 8.00001 6.08431Z"
                                                fill="#3BB77E" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0">
                                                <rect width="16" height="16" fill="white"
                                                    transform="translate(0 0.750977)" />
                                            </clipPath>
                                        </defs>
                                    </svg>&nbsp;
                                    <strong>Address:</strong>&nbsp;<span>Test Address</span>
                                </li>
                                <li>
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0)">
                                            <path
                                                d="M14.3333 8.71789V7.76855C14.3333 6.17726 13.7012 4.65113 12.576 3.52591C11.4508 2.4007 9.92463 1.76855 8.33333 1.76855C6.74203 1.76855 5.21591 2.4007 4.09069 3.52591C2.96547 4.65113 2.33333 6.17726 2.33333 7.76855V8.71789C1.6341 9.02578 1.06186 9.56452 0.712412 10.2439C0.362959 10.9233 0.257505 11.7022 0.413703 12.45C0.5699 13.1979 0.978269 13.8694 1.57044 14.3522C2.16262 14.8349 2.90266 15.0996 3.66666 15.1019H5V8.43522H3.66666V7.76855C3.66666 6.53088 4.15833 5.34389 5.0335 4.46872C5.90867 3.59355 7.09565 3.10189 8.33333 3.10189C9.57101 3.10189 10.758 3.59355 11.6332 4.46872C12.5083 5.34389 13 6.53088 13 7.76855V8.43522H11.6667V13.7686H9V15.1019H13C13.764 15.0996 14.504 14.8349 15.0962 14.3522C15.6884 13.8694 16.0968 13.1979 16.253 12.45C16.4092 11.7022 16.3037 10.9233 15.9542 10.2439C15.6048 9.56452 15.0326 9.02578 14.3333 8.71789ZM3.66666 13.7686C3.13623 13.7686 2.62752 13.5578 2.25245 13.1828C1.87738 12.8077 1.66666 12.299 1.66666 11.7686C1.66666 11.2381 1.87738 10.7294 2.25245 10.3543C2.62752 9.97927 3.13623 9.76855 3.66666 9.76855V13.7686ZM13 13.7686V9.76855C13.5304 9.76855 14.0391 9.97927 14.4142 10.3543C14.7893 10.7294 15 11.2381 15 11.7686C15 12.299 14.7893 12.8077 14.4142 13.1828C14.0391 13.5578 13.5304 13.7686 13 13.7686Z"
                                                fill="#3BB77E" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0">
                                                <rect width="16" height="16" fill="white"
                                                    transform="translate(0.333344 0.435059)" />
                                            </clipPath>
                                        </defs>
                                    </svg>&nbsp;
                                    <strong>Call Us:</strong>&nbsp;<span dir="ltr">(+91) - {{$firm_detail->mobile}}</span>
                                </li>

                                <li>
                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0)">
                                            <path
                                                d="M0.962657 5.08044C0.739429 5.14422 0.536723 5.26518 0.374598 5.43136C0.212473 5.59754 0.0965474 5.80317 0.0382929 6.0279C-0.0199617 6.25264 -0.0185264 6.48869 0.0424566 6.7127C0.10344 6.93671 0.221857 7.14091 0.385991 7.3051L2.66066 9.5771V13.9678H7.05599L9.34599 16.2544C9.46881 16.3785 9.615 16.4771 9.77611 16.5443C9.93722 16.6116 10.1101 16.6463 10.2847 16.6464C10.3994 16.6462 10.5136 16.6314 10.6247 16.6024C10.8493 16.5459 11.0551 16.4311 11.2213 16.2697C11.3874 16.1083 11.5082 15.906 11.5713 15.6831L15.994 0.648438L0.962657 5.08044ZM1.33332 6.36244L12.6853 3.01577L3.99532 11.6918V9.0251L1.33332 6.36244ZM10.2933 15.3118L7.60866 12.6344H4.94199L13.6307 3.9531L10.2933 15.3118Z"
                                                fill="#3BB77E" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0">
                                                <rect width="16" height="16" fill="white"
                                                    transform="translate(0 0.634277)" />
                                            </clipPath>
                                        </defs>
                                    </svg>&nbsp;
                                    <strong>Email:</strong>&nbsp;<span>{{$firm_detail->email}}</span>
                                </li>
                                <li>
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0)">
                                            <path
                                                d="M7.39402 16.8696H0.727356V15.5363H7.39402V16.8696ZM6.06069 12.8696H0.727356V14.203H6.06069V12.8696ZM4.72736 10.203H0.727356V11.5363H4.72736V10.203ZM8.72736 0.869629C6.60633 0.871923 4.57283 1.71551 3.07304 3.21531C1.57324 4.7151 0.72965 6.7486 0.727356 8.86963H2.06069C2.06069 7.55109 2.45168 6.26216 3.18423 5.16583C3.91677 4.0695 4.95796 3.21502 6.17613 2.71043C7.39431 2.20585 8.73475 2.07383 10.028 2.33106C11.3212 2.5883 12.5091 3.22323 13.4414 4.15558C14.3738 5.08793 15.0087 6.27582 15.2659 7.56903C15.5232 8.86223 15.3911 10.2027 14.8866 11.4209C14.382 12.639 13.5275 13.6802 12.4312 14.4128C11.3348 15.1453 10.0459 15.5363 8.72736 15.5363V16.8696C10.8491 16.8696 12.8839 16.0268 14.3842 14.5265C15.8845 13.0262 16.7274 10.9914 16.7274 8.86963C16.7274 6.7479 15.8845 4.71307 14.3842 3.21277C12.8839 1.71248 10.8491 0.869629 8.72736 0.869629V0.869629ZM8.06069 5.5363V9.14563L10.256 11.341L11.1987 10.3983L9.39402 8.59363V5.5363H8.06069Z"
                                                fill="#3BB77E" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0">
                                                <rect width="16" height="16" fill="white"
                                                    transform="translate(0.727356 0.869629)" />
                                            </clipPath>
                                        </defs>
                                    </svg>&nbsp;
                                    <strong>Working Hours:</strong>&nbsp;<span>10:00 - 18:00, Mon - Sat</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp"
                        data-wow-delay=".3s">
                        <h4 class="widget-title">Company</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                                <li class="">
                                    <a href="about-us.html" title="About us">

                                        <span class="menu-title">About us</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#" title="Affiliate">

                                        <span class="menu-title">Affiliate</span>
                                    </a>
                                </li>
                                
                                <li class="">
                                    <a href="contact.html" title="Contact us">

                                        <span class="menu-title">Contact us</span>
                                    </a>
                                </li>
                            </ul>

                        </ul>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp"
                        data-wow-delay=".3s">
                        <h4 class="widget-title">Categories</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                                <li class="">
                                    <a href="product-categories/milks-and-dairies.html" title="Milks and Dairies">

                                        <span class="menu-title">Cat1</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="product-categories/clothing-beauty.html" title="Clothing &amp; beauty">

                                        <span class="menu-title">Cat1</span>
                                    </a>
                                </li>
                               
                            </ul>

                        </ul>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp"
                        data-wow-delay=".3s">
                        <h4 class="widget-title">Information</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                                <li class="">
                                    <a href="contact.html" title="Contact Us">

                                        <span class="menu-title">Contact Us</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="about-us.html" title="About Us">

                                        <span class="menu-title">About Us</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="cookie-policy.html" title="Cookie Policy">

                                        <span class="menu-title">Cookie Policy</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="terms-conditions.html" title="Terms &amp; Conditions">

                                        <span class="menu-title">Terms &amp; Conditions</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="returns-exchanges.html" title="Returns &amp; Exchanges">

                                        <span class="menu-title">Returns &amp; Exchanges</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="shipping-delivery.html" title="Shipping &amp; Delivery">

                                        <span class="menu-title">Shipping &amp; Delivery</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="privacy-policy.html" title="Privacy Policy">

                                        <span class="menu-title">Privacy Policy</span>
                                    </a>
                                </li>
                            </ul>

                        </ul>
                    </div>
                    <div class="footer-link-widget widget-install-app col  wow animate__animated animate__fadeInUp"
                        data-wow-delay=".5s">
                        <h4 class="widget-title ">Install App</h4>
                        <p>From App Store or Google Play</p>
                        <div class="download-app">
                            <a href="#" class="hover-up mb-sm-2 mb-lg-0">
                                <img class="active" src="{{ asset('website') }}/assets/storage/general/app-store.jpg" alt="iOS app" />
                            </a>
                            <a href="#" class="hover-up mb-sm-2">
                                <img src="{{ asset('website') }}/assets/storage/general/google-play.jpg" alt="Android app" />
                            </a>
                        </div>
                      
                    </div>

                </div>
            </div>
        </section>
        <div class="container pb-30  wow animate__animated animate__fadeInUp" data-wow-delay="0">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <p class="font-sm mb-0">Copyright © 2025 QuickOPD all rights reserved.
                    </p>
                </div>
                <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                    <div class="hotline d-lg-inline-flex w-full align-items-center justify-content-center">
                        <img src="{{ asset('website') }}/assets/themes/nest/imgs/theme/icons/phone-call.svg" alt="hotline" />
                        <p>1900 - 888 <span>24/7 Support Center</span></p>
                    </div>
                </div>
                <div class="col-lg-6 text-end d-none d-md-block col-xl-4">
                    <div class="mobile-social-icon">
                        <p class="font-heading h6 me-2">Follow Us</p>
                        <a href="https://www.facebook.com/" title="Facebook">
                            <img src="{{ asset('website') }}/assets/storage/general/facebook.png" data-bb-lazy="true" loading="lazy"
                                alt="Facebook">
                        </a>
                        <a href="https://www.twitter.com/" title="Twitter">
                            <img src="{{ asset('website') }}/assets/storage/general/twitter.png" data-bb-lazy="true" loading="lazy"
                                alt="Twitter">
                        </a>
                        <a href="https://www.instagram.com/" title="Instagram">
                            <img src="{{ asset('website') }}/assets/storage/general/instagram.png" data-bb-lazy="true" loading="lazy"
                                alt="Instagram">
                        </a>
                        <a href="https://www.pinterest.com/" title="Pinterest">
                            <img src="{{ asset('website') }}/assets/storage/general/pinterest.png" data-bb-lazy="true" loading="lazy"
                                alt="Pinterest">
                        </a>
                        <a href="https://www.youtube.com/" title="Youtube">
                            <img src="{{ asset('website') }}/assets/storage/general/youtube.png" data-bb-lazy="true" loading="lazy"
                                alt="Youtube">
                        </a>
                    </div>
                    <p class="font-sm">Up to 15% discount on your first subscribe</p>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade custom-modal" id="quick-view-modal" tabindex="-1"
        aria-labelledby="quick-view-modal-label" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="half-circle-spinner loading-spinner">
                        <div class="circle circle-1"></div>
                        <div class="circle circle-2"></div>
                    </div>
                    <div class="quick-view-content"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.trans = {
            "Views": "Views",
            "Read more": "Read more",
            "days": "days",
            "hours": "hours",
            "mins": "mins",
            "sec": "sec",
            "No reviews!": "No reviews!",
            "Sold By": "Sold By",
            "Quick View": "Quick View",
            "Add To Wishlist": "Add To Wishlist",
            "Add To Compare": "Add To Compare",
            "Out Of Stock": "Out Of Stock",
            "Add To Cart": "Add To Cart",
            "Add": "Add",
        };

        window.siteUrl = "{{route('welcome')}}";

        window.currencies = {
            "display_big_money": false,
            "billion": "billion",
            "million": "million",
            "is_prefix_symbol": true,
            "symbol": "\u20b9",
            "title": "INR",
            "decimal_separator": ".",
            "thousands_separator": ",",
            "number_after_dot": 2,
            "show_symbol_or_title": true
        };
    </script>

    <script data-pagespeed-no-defer="1" src="{{ asset('website') }}/assets/themes/nest/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('website') }}/assets/themes/nest/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('website') }}/assets/themes/nest/js/plugins/slick.js"></script>
    <script src="{{ asset('website') }}/assets/themes/nest/js/plugins/jquery.syotimer.min.js"></script>
    <script src="{{ asset('website') }}/assets/themes/nest/js/plugins/wow.js"></script>
    <script src="{{ asset('website') }}/assets/themes/nest/js/plugins/waypoints.js"></script>
    <script src="{{ asset('website') }}/assets/themes/nest/js/plugins/jquery.countdown.min.js"></script>
    <script src="{{ asset('website') }}/assets/themes/nest/js/plugins/scrollup.js"></script>
    <script src="{{ asset('website') }}/assets/themes/nest/js/plugins/jquery.vticker-min.js"></script>
    <script src="{{ asset('website') }}/assets/themes/nest/js/backendf1bc.js?v=1.25.2.3"></script>
    <script>
        window.currencies = JSON.parse(
            '{\u0022display_big_money\u0022:false,\u0022billion\u0022:\u0022billion\u0022,\u0022million\u0022:\u0022million\u0022,\u0022is_prefix_symbol\u0022:true,\u0022symbol\u0022:\u0022\\u20b9\u0022,\u0022title\u0022:\u0022INR\u0022,\u0022decimal_separator\u0022:\u0022.\u0022,\u0022thousands_separator\u0022:\u0022,\u0022,\u0022number_after_dot\u0022:2,\u0022show_symbol_or_title\u0022:true}'
            );
    </script>
    <script src="{{ asset('website') }}/assets/themes/nest/js/mainf1bc.js?v=1.25.2.3"></script>
    <script src="{{ asset('website') }}/assets/vendor/core/plugins/ecommerce/js/front-ecommercef1bc.js?v=1.25.2.3"></script>
    <script src="{{ asset('website') }}/assets/vendor/core/core/js-validation/js/js-validationf700.js?v=1.0.1"></script>
    <script>
        jQuery(document).ready(function() {
            'use strict';
            $("#botble-newsletter-forms-fronts-newsletter-form").each(function() {
                $(this).validate({
                    errorElement: 'div',
                    errorClass: 'invalid-feedback',

                    errorPlacement: function(error, element) {
                        if (element.closest('[data-bb-toggle="tree-checkboxes"]').length) {
                            error.insertAfter(element.closest(
                                '[data-bb-toggle="tree-checkboxes"]'));
                        } else if (element.parent('.input-group').length || element.prop(
                            'type') === 'checkbox' || element.prop('type') === 'radio') {
                            error.insertAfter(element.parent());
                        } else if ($(element).data('select2')) {
                            error.insertAfter(element.next('span'));
                        } else {
                            error.insertAfter(element);
                        }
                    },

                    highlight: function(element) {
                        $(element).closest('.form-control').removeClass('is-valid').addClass(
                            'is-invalid');
                    },


                    unhighlight: function(element) {
                        $(element).closest('.form-control').removeClass('is-invalid').addClass(
                            'is-valid');
                    },

                    success: function(element) {
                        $(element).closest('.form-control').removeClass('is-invalid').addClass(
                            'is-valid');
                    },

                    focusInvalid: false,

                    rules: JSON.parse(
                        '{\u0022email\u0022:{\u0022laravelValidation\u0022:[[\u0022Required\u0022,[],\u0022The email field is required.\u0022,true],[\u0022Email\u0022,[],\u0022The email must be a valid email address.\u0022,false]],\u0022laravelValidationRemote\u0022:[[\u0022Unique\u0022,[\u0022email\u0022,\u0022eyJpdiI6IjlGQThqeTRNNmpJNUl5d2sveW1EZWc9PSIsInZhbHVlIjoiblZRNFBObzR1a0VNRGh2bUlreFNudC9aa29na1RTaStsS3p0Q0NaTkUzS29SSFVZOUIvcGpTR3VyVmNqTll3b3ZXdFloRkFXMmpSeDRZVHpjUTBDWFE9PSIsIm1hYyI6IjI2NDljMzMwZjU2NDkzY2I4MTljODljNTk0MGI5YWY3NTk1ZDk1MzA0YzEzYWQ3MjViODNmODJmY2MxMTYxYjUiLCJ0YWciOiIifQ==\u0022,false],\u0022The email has already been taken.\u0022,false]]},\u0022status\u0022:{\u0022laravelValidation\u0022:[[\u0022In\u0022,[\u0022subscribed\u0022,\u0022unsubscribed\u0022],\u0022The selected status is invalid.\u0022,false]]}}'
                        )
                });
            });
        });
    </script>
    <script src="{{ asset('website') }}/assets/vendor/core/plugins/bottom-bar-menu/js/menue209.js?v=1.0.0"></script>
    <script src="{{ asset('website') }}/assets/vendor/core/plugins/cookie-consent/js/cookie-consent0ff5.js?v=1.0.2"></script>





    <div class="footer-mobile">
        <ul class="menu--footer" style="--bottom-bar-menu-text-font-size: 12px;">
            <li>
                <a href="{{route('welcome')}}">
                    <i class="fi-rs-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a class="toggle--sidebar" href="products.html">
                    <i class="fi-rs-apps"></i>
                    <span>Shop</span>
                </a>
            </li>
            <li>
                <a class="toggle--sidebar" href="cart.html">
                    <i class="fi-rs-shopping-cart mini-cart-icon">
                        <span class="cart-counter">0</span>
                    </i>
                    <span>Cart</span>
                </a>
            </li>
            <li>
                <a href="#" class="trigger-mobile-menu">
                    <i class="fi-rs-search"></i>
                    <span>Search</span>
                </a>
            </li>
            <li>
                <a href="{{route('login.user')}}">
                    <i class="fi-rs-user"></i>
                    <span>Account</span>
                </a>
            </li>
        </ul>
    </div>
    {{-- <script>
        var lazyLoadShortcodeBlocks = function() {
            document.querySelectorAll('.shortcode-lazy-loading').forEach(function(element) {
                var name = element.getAttribute('data-name');
                var attributes = JSON.parse(element.getAttribute('data-attributes'));

                const url = 'ajax/render-ui-blocks.html';
                const csrfToken = 'ppw6IRBuLBJdSn6XFSNYwPGd47hlBcD8A46RBxKx';

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            name,
                            attributes: {
                                ...attributes
                            }
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(({
                        error,
                        data
                    }) => {
                        if (error) {
                            return;
                        }

                        element.outerHTML = data;

                        document.dispatchEvent(new CustomEvent('shortcode.loaded', {
                            detail: {
                                name,
                                attributes,
                                html: data
                            }
                        }));

                        if (typeof Theme !== 'undefined' && typeof Theme.lazyLoadInstance !== 'undefined') {
                            Theme.lazyLoadInstance.update()
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            });
        };

        window.addEventListener('load', function() {
            lazyLoadShortcodeBlocks();
        });
    </script> --}}
    <div class="js-cookie-consent cookie-consent cookie-consent-full-width"
        style="background-color: #000; color: #fff;">
        <div class="cookie-consent-body" style="max-width: 1170px;">
            <span class="cookie-consent__message">
                Your experience on this site will be improved by allowing cookies
                <a href="cookie-policy.html">Cookie Policy</a>
            </span>

            <button class="js-cookie-consent-agree cookie-consent__agree"
                style="background-color: #000; color: #fff; border: 1px solid #fff;">
                Allow cookies
            </button>
        </div>
    </div>
    <div data-site-cookie-name="cookie_for_consent"></div>
    <div data-site-cookie-lifetime="7300"></div>
    

    <script>
        window.addEventListener('load', function() {
            if (typeof gtag !== 'undefined') {
                gtag('consent', 'default', {
                    'ad_storage': 'denied'
                });

                document.addEventListener('click', function(event) {
                    if (event.target.classList.contains('js-cookie-consent-agree')) {
                        gtag('consent', 'update', {
                            'ad_storage': 'granted'
                        });
                    }
                });
            }
        });
    </script>



    <script src="{{ asset('website') }}/assets/vendor/core/packages/theme/js/toast.js"></script>

</body>

<!-- Mirrored from ecommerce12.testsoftwares.site/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Mar 2025 16:02:33 GMT -->

</html>

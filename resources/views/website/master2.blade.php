<!DOCTYPE html>
<html lang="en">


<head>
    
    <!-- Basic page needs
    ============================================ -->
    <title>Shopzillas</title>
    <meta charset="utf-8">
    
    <base href="/" >
    <meta name="keywords" content="" />
    <meta name="author" content="Grapxcode">
    <meta name="robots" content="index, follow" />
   
    <!-- Mobile specific metas
    ============================================ -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <!-- Favicon
    ============================================ -->
   
    <link rel="shortcut icon" style="width:64px; height:64px;" type="image/png" href="image/iconshop.png"/>
    
   
    <!-- Libs CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('website') }}/css/bootstrap/css/bootstrap.min.css">
    <link href="{{ asset('website') }}/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('website') }}/js/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="{{ asset('website') }}/js/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="{{ asset('website') }}/css/themecss/lib.css" rel="stylesheet">
    <link href="{{ asset('website') }}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <link href="{{ asset('website') }}/js/minicolors/miniColors.css" rel="stylesheet">
    
    <!-- Theme CSS
    ============================================ -->
    <link href="{{ asset('website') }}/css/themecss/so_searchpro.css" rel="stylesheet">
    <link href="{{ asset('website') }}/css/themecss/so_megamenu.css" rel="stylesheet">
    <link href="{{ asset('website') }}/css/themecss/so-categories.css" rel="stylesheet">
    <link href="{{ asset('website') }}/css/themecss/so-listing-tabs.css" rel="stylesheet">
    <link href="{{ asset('website') }}/css/themecss/so-newletter-popup.css" rel="stylesheet">


    <link href="{{ asset('website') }}/css/footer/footer1.css" rel="stylesheet">
    <link href="{{ asset('website') }}/css/header/header1.css" rel="stylesheet">
    <link id="color_scheme" href="{{ asset('website') }}/css/theme.css" rel="stylesheet"> 


    <link href="{{ asset('website') }}/css/footer/footer2.css" rel="stylesheet">
    <link href="{{ asset('website') }}/css/header/header2.css" rel="stylesheet">
    <link id="color_scheme" href="{{ asset('website') }}/css/home2.css" rel="stylesheet"> 
    <link href="{{ asset('website') }}/css/responsive.css" rel="stylesheet">
     <!-- Google web fonts
    ============================================ -->

<link rel="stylesheet" href="css1/style.css"> 
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,500i,700' rel='stylesheet' type='text/css'>
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" defer></script>
     <script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHg6cHGIkqDZpv3u3IBZMW9m4eDPHA_e0&libraries=places"></script>
<script  type="text/javascript" src="{{ asset('website') }}/js/jquery-2.2.4.min.js"></script>
    <meta name="google-signin-client_id" content="141056583072-cr4qd0e2k0o9nj4kfpjsplp6sbvdp748.apps.googleusercontent.com">


<style>
    #cd-cart {
  position: fixed;
  top: 0;
  right: -100%;
  height: 100%;
z-index: 100;
  /* header height */
  padding: 20px;

  overflow-y: auto;
  -webkit-overflow-scrolling: touch;
  
  transition: right 0.3s;
}

#cd-cart.speed-in {
  right: 0;
}


#cd-cart-trigger{display:block; }
#cartmobile {
 display:none;
  }

@media screen and (max-width: 700px) and (min-width: 300px) {
#cd-cart-trigger{display:none; }

#cartmobile {
 display:block !important;
  }

    
    
}

</style>


    <style type="text/css">
    
      
  .goog-te-banner-frame.skiptranslate {
    display: none !important;
    } 
    

         body{ top: 0px !important; 
 font-family:'Roboto', sans-serif;}
         
         .typeheader-2 .header-top {
    font-size: 13px;
    min-height: 40px;
    background-color: #ffffff;
}
         
         .goog-te-gadget-simple {
    
    border:none !important;
    font-size: 10pt;
    height:40px !important;
    
    display: inline-block;
   
    cursor: pointer;
    zoom: 1;
    border-radius: 10px;
  
}
  
  
.goog-te-menu2-item div, .goog-te-menu2-item:link div, .goog-te-menu2-item:visited div, .goog-te-menu2-item:active div {
    color: #009E7F !important;
    background: #ffffff;
}


         
    </style>
    
    
    <style>
    .mfp-bg, .mfp-fade, .mfp-ready{display:none;}
        #login{ display:none; }
       
        
        
          .custom-slider{  height:350px; width:95%; }
        .custom-product{ width:200px; height:250px; }
        .custom-product1{ width:200px; height:250px; }
       
        /* When the width is between 600px and 900px OR above 1100px - change the appearance of <div> */
@media screen and (max-width: 700px) and (min-width: 300px){
 
  
  
  
  #login {
      
    
      display:block;
  }

     .custom-product1{ width:110px; height:160px; }
    .custom-slider{  height:200px; width:100%; }
    .custom-product{ width:100px; height:150px; }
}

    </style>
    
     <style>
    
   
   /*Cookie Consent Begin*/
#cookieConsent {
    background-color:#009E7F;
    min-height: 26px;
    font-size: 14px;
    color: #ffffff;
    line-height: 26px;
    padding: 8px 0 8px 30px;
    font-family: "Trebuchet MS",Helvetica,sans-serif;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    display: none;
    z-index: 9999;
}
#cookieConsent a {
    color: #f30;
    text-decoration: none;
}
#closeCookieConsent {
    float: right;
    display: inline-block;
    cursor: pointer;
    height: 20px;
    width: 20px;
    margin: -15px 0 0 0;
    font-weight: bold;
}
#closeCookieConsent:hover {
    color: #FFF;
}
#cookieConsent a.cookieConsentOK {
    background-color: #55bce7;
    color: #fff;
    display: inline-block;
    border-radius: 5px;
    padding: 0 10px;
    cursor: pointer;
    float: right;
    margin: 0 40px 0 0px;
}
#cookieConsent a.cookieConsentOK:hover {
    background-color: #E0C91F;
}
/*Cookie Consent End*/
    </style>
      
</head>

<body class="common-home res layout-2" >



<div id="cd-shadow-layer"></div>   

<div id="cd-cart">
  <a class="btn" style="background:#009E7F; width:100%; border-radius:20px; color:#fff;" href="Checkout">Checkout</a>
 
<div id="header_cart">
    
</div>  







 
</div> <!-- cd-cart -->

    
<div style="display:none; position:fixed; right:0px; top:10%; width:200px; z-index:1000;" id="cart_alert" class="alert alert-success">
  <strong>Product </strong>Added to Cart
</div> 
    
    
<div style="display:none; position:fixed; right:0px; top:10%; width:200px; z-index:1000;" id="out_alert" class="alert alert-danger">
  <strong>Product </strong>is out of Delivery Area
</div>

<div style="display:none; position:fixed; right:0px; top:10%; width:350px; z-index:1000;" id="shop_alert" class="alert alert-danger">
  <strong>You have already Products from another Shop in your cart </strong>
</div>

<div style="display:none; position:fixed; right:0px; top:10%; width:200px; z-index:1000;" id="pack_alert" class="alert alert-danger">
  <strong>Please</strong> Select package first
</div>

<div style="display:none; position:fixed; right:0px; top:10%; width:200px; z-index:1000;" id="qty_alert" class="alert alert-danger">
  <strong>Please</strong> Check Quantity
</div>
    
    <div id="wrapper" class="wrapper-fluid banners-effect-7">
    

    <!-- Header Container  -->
    <header id="header" class=" typeheader-2">
    <!-- Header Top -->
    <div class="header-top hidden-compact">
        <div class="container">
            <div class="row">
                <div class="header-top-left col-lg-6 col-md-8 col-sm-6 col-xs-4">
                   
                </div>
                <div class="header-top-right collapsed-block col-lg-6 col-md-4 col-sm-6 col-xs-8">
                    <ul class="top-link list-inline lang-curr">
                        
                        
                          
                                               
                      
                     
                        <li style=margin-top:10px; class="currency">
                            <div class="btn-group currencies-block">
                               
                                    <a class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                        
                                      
                                        My Account  <span class="fa fa-angle-down"></span>
                                   
                                    
                                    </a>
                                    <ul class="dropdown-menu btn-xs">
                                        <li><a href="My-Profile"><i class="fa fa-user"></i>&nbsp;My Profile</a></li>
                                        <li><a  href="Change-Password"><i class="fa fa-key"></i>&nbsp;Change Password</a></li>
                                        <li><a  href="Order-History"><i class="fa fa-pencil-square-o"></i>&nbsp; Order History</a></li>
                                
                                 <li><a  href="My-Wishlist"><i class="fa fa-heart"></i>&nbsp;My Wishlist</a></li>
                                 <li><a href="Notifications"><i class="fa fa-bell"></i>&nbsp; Notifications</a></li>
                               
                                    </ul>
                             
                            </div>
                        </li>   
                        
                       
                        
                        <li style="margin-top:5px;" class="language">
                            <div class="btn-group languages-block ">

                                    <a class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                        
                                        <span class="">Select Language</span>
                                        <span class="fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a  href="#googtrans(en|en)" class="lang-en lang-select" data-lang="en">English</a></li>
                                        
                                    </ul>
                               
                            </div>
                            
                        </li>
                        
                    </ul>
                    

                    
                </div>
            </div>
        </div>
    </div>
    <!-- //Header Top -->

    <!-- Header center -->
    <div class="header-middle">
        <div class="container">
            <div class="row">
                <!-- Logo -->
                <div class="navbar-logo col-lg-2 col-md-3 col-sm-12 col-xs-12">
                    <div class="logo"><a href="Home"><img style="width:135px;" src="image/catalog/logo2.png" title="ShopZillas" alt="ShopZillas" /></a></div>
                </div>
                <!-- //end Logo -->
                <!-- Search -->
                <div class="middle2 col-lg-7 col-md-6">
                    <div class="search-header-w">
                        <div class="icon-search hidden-lg hidden-md hidden-sm"><i class="fa fa-search"></i></div> 
                        <div id="sosearchpro" class="sosearchpro-wrapper so-search ">
                            <form method="GET" action="/home.php">
                                <div id="search0" class="search input-group form-group">
                                    <div class="select_category filter_type  icon-select hidden-sm hidden-xs">
                                       
                                        <select class="no-border" name="radius" id="radius">
                                           
                                            <option value="10">10 MILES</option>
                                            <option value="50">50 MILES</option>
                                            <option value="100">100 MILES</option>
                                             <option value="500">500 MILES</option>
                                              <option  value="1000">1000 MILES</option>
                                             
                                             
                                            <option value="100" selected >100 MILES</option>
                                            
                                        </select>
                                    </div>

                                    <input type="text" class="autosearch-input form-control" name="address" onkeypress="getAddressPreferences(this)" value="1" id="address" placeholder="Please type your exact address" />
                                    <input type="hidden" class="form-control" name="lat" id="lat" />
                                    <input type="hidden" class="form-control" name="lng" id="lng" />
                                    <span class="input-group-btn">
                                    <button type="submit" class="button-search btn btn-primary" onclick="searchByLocation()" name="submit_search"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                                <input type="hidden" name="route" value="product/search" />
                            </form>
                        </div>
                    </div>
                </div>
                <!-- //end Search -->
                
                <div class="middle3 col-lg-3 col-md-3">                    
                   
                    <!--cart-->
                    <div id="cd-cart-trigger"  class="shopping_cart">
                        <div id="cart" class="btn-shopping-cart">
                              </div></div>
                        
                        
                       
                          <!--cart-->
                    <div id="cartmobile"  class="shopping_cart">
                        <a href="Cart" > 
                        <div id="cart_mobile" class="btn-shopping-cart">

                            

                           
                        </div>
                        </a>
                        </div>
                        
                    
                    
                    <div id="login" class="shopping_cart">
                        
                        
                        
                        <a href="Login" ><i style="color:#fff; font-size:25px; margin-top:6px;" class="fa fa-user"></i></a>
                      
                            <a href="javascript:void(0);" onclick="signOut()" ><i style="color:#fff; font-size:25px; margin-top:6px;" class="fa fa-power-off"></i></a>
                                      
                           
                            <a href="Logout"  ><i style="color:#fff; font-size:25px; margin-top:6px;" class="fa fa-power-off"></i></a>
                           
                           
                        
                      
                 
                        
                    </div>
                    <!--//cart-->
                    

                    <ul class="wishlist-comp hidden-md hidden-sm hidden-xs">
                      
                        <li class="wishlist hidden-xs"><a href="My-Wishlist" id="wishlist-total" class="top-link-wishlist" title="Wishlist"><i class="fa fa-heart"></i></a>
                        </li>
                   
                     
                        
                       
                    </ul>
                </div>
                
                
            </div>

        </div>
    </div>
    <!-- //Header center -->

    <!-- Header Bottom -->
    <div class="header-bottom hidden-compact">
        <div class="container">
            <div class="row">
                
                <div class="bottom1 menu-vertical col-lg-2 col-md-3">
                    <!-- Secondary menu -->
                    <div class="responsive so-megamenu megamenu-style-dev">
                        <div class="so-vertical-menu ">
                            <nav class="navbar-default">    
                                
                                <div class="container-megamenu vertical">
                                    <div id="menuHeading">
                                        <div class="megamenuToogle-wrapper">
                                            <div class="megamenuToogle-pattern">
                                                <div class="container">
                                                    <div>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                    All Categories                          
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="navbar-header">
                                        <button type="button" id="show-verticalmenu" data-toggle="collapse" class="navbar-toggle">      
                                            <i class="fa fa-bars"></i>
                                            <span>  All Categories     </span>
                                        </button>
                                    </div>
                                    <div class="vertical-wrapper" >
                                        <span id="remove-verticalmenu" class="fa fa-times"></span>
                                        <div class="megamenu-pattern">
                                            <div  class="container-mega">
                                                <ul style="overflow:scroll; height:400px;" class="megamenu">
                                                   
                                                   
                                                    <li class="item-vertical">
                                                        <p class="close-menu"></p>
                                                        <a href="Category/" class="clearfix">                                                            
                                                            <img src="#" class="img-rounded img-responsive" style="width:24px;  height:24px;">
                                                            <span>Test</span>
                                                        </a>
                                                    </li>
                                                    
                                                    
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </nav>
                        </div>
                    </div>
                    <!-- // end Secondary menu -->
                </div>
                <!-- Main menu -->
                <div class="main-menu col-lg-6 col-md-9">
                    <div class="responsive so-megamenu megamenu-style-dev">
                        <nav class="navbar-default">
                            <div class=" container-megamenu  horizontal open ">
                                <div class="navbar-header">
                                    <button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                
                                <div class="megamenu-wrapper">
                                    <span id="remove-megamenu" class="fa fa-times"></span>
                                    <div class="megamenu-pattern">
                                        <div class="container-mega">
                                            <ul class="megamenu" data-transition="slide" data-animationtime="250">
                                               
                                               	
										
                                               
                                               
                                               
                                                <li class="">
                                                    <p class="close-menu"></p>
                                                    <a href="Home" class="clearfix">
                                                        <strong>Home</strong>
                                     
                                                    </a>
                                        
                                                </li>
                                                <li class="">
                                                    <p class="close-menu"></p>
                                                    <a href="About-Us" class="clearfix">
                                                        <strong>About Us</strong>
                                                        <span class="label"></span>
                                                    </a>
                                                </li>
                                                
                                          <li class="">
                                                    <p class="close-menu"></p>
                                                    <a href="Why-Choose-Us" class="clearfix">
                                                        <strong>Why Choose Us ?</strong>
                                                        <span class="label"></span>
                                                    </a>
                                                </li>
                                                
                                                 <li class="">
                                                    <p class="close-menu"></p>
                                                    <a href="Any-Feedback" class="clearfix">
                                                        <strong>Any Feedback ?</strong>
                                                        <span class="label"></span>
                                                    </a>
                                                </li>
                                                
                                                
                                                 <li class="">
                                                    <p class="close-menu"></p>
                                                    <a href="Contact-Us" class="clearfix">
                                                        <strong>Contact Us</strong>
                                                        <span class="label"></span>
                                                    </a>
                                                </li>
                                                
                                                 
                                                 <li class="">
                                                    <p class="close-menu"></p>
                                                    <a href="Shop-Register" class="clearfix">
                                                        <strong>Register your shop</strong>
                                                        <span class="label"></span>
                                                    </a>
                                                </li>
                                              
                                                
                                            </ul>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- //end Main menu -->
                
                
                <div class="bottom2 col-lg-4 hidden-md col-sm-6 col-xs-8">                  
                    <div class="signin-w font-title hidden-sm hidden-xs">
                        <ul style="list-style-type:none;" class="blank">
                 
                  
                        <li class="log login"><i class="fa fa-lock"></i> <a class="link-lg" href="Login">Login </a> or <a href="Register">Register</a></li>
                   
                        <li  class="btn-xs log login dropdown-toggle" data-toggle="dropdown">
                          
                                <a href="javascript:void(0);" style="font-size:16px; font-weight:500;" onclick="signOut()"  >
                                   Logout
                                </a>
                           
                            <a class="title-submenu" onclick="window.location.href='Logout'" style="font-size:16px; font-weight:500;" href="#" >
                               Logout
                            </a>
                            
                        </li>   
                  
                        </ul>                       
                    </div>
                    <div class="telephone hidden-xs hidden-sm hidden-md">
                        <ul class="blank"> <li><a href="tel:(+49) 40 59462762"><i class="fa fa-phone-square"></i> <strong>Hotline (+49) 40 59462762</strong></a></li> </ul>
                    </div>
                                        
                    
                </div>
                
                
            </div>
        </div>

    </div>

    </header>
    @yield('content')


    <!-- Footer Container -->
    <footer class="footer-container typefooter-2">
        <!-- Footer Top Container -->
        <section class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        
                    </div>
                    <div class="col-lg-4 col-md-4 ">
                        
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 hidden-sm hidden-xs">
                        <ul class="socials">
                            <li class="facebook"><a class="_blank" href="https://www.facebook.com/shopzillas.de/?modal=admin_todo_tour" target="_blank"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li class="twitter"><a class="_blank" href="https://twitter.com/Shopzillas" target="_blank"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li class="google_plus"><a class="_blank" href="https://www.pinterest.de/Shopzillas/" target="_blank"><i class="fa fa-pinterest"></i></a>
                            </li>
                            <li class="pinterest"><a class="_blank" href="https://www.instagram.com/shop.zillas/" target="_blank"><i class="fa fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
             </div>
        </section>
        <!-- /Footer Top Container -->
        
        <section class="footer-middle ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-style">
                        <div class="infos-footer box-footer">
                            <div class="module">
                                <h3 class="modtitle">Contact Info</h3>
                                <ul>
                                    <li class="adres">Hamburg, Germany</li>
                                    <li class="phone">(+49) 40 4654 5152</li>
                                    <li class="mail">
                                        <a href="mailto:mohey.romal@gmail.com">info@shopzillas.com</a>
                                    </li>
                                    <li class="time">Open time: 8:00 AM - 6:00 PM</li>
                                </ul>
                            </div>
                        </div>


                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-style">
                        <div class="box-information box-footer">
                            <div class="module clearfix">
                                <h3 class="modtitle">Information</h3>
                                <div class="modcontent">
                                    <ul class="menu">
                                        
                                       
                                       
                                        <li><a href="Disclaimer">Disclaimer</a></li>
                                        <li><a href="Terms-and-Conditions">Terms & Conditions</a></li>
                                        <li><a href="Privacy-Policy-For-Devops">Privacy Policy For Devops</a></li>
                                        <li><a href="Privacy-Policy">Privacy Policy</a></li>
                                        <li><a href="Cookies-Policy">Cookies Policy</a></li>
                                        <li><a href="Refund-Policy">Refund Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-style">
                        <div class="box-account box-footer">
                            <div class="module clearfix">
                                <h3 class="modtitle">My Account</h3>
                                <div class="modcontent">
                                    <ul class="menu">
                                        <?php if(isset($_SESSION['uid']) || isset($_SESSION['social'])) { ?>
                                        
                                        <li><a href="My-Profile"><i class="fa fa-user"></i>&nbsp;My Profile</a></li>
                                        <li><a  href="Change-Password"><i class="fa fa-key"></i>&nbsp;Change Password</a></li>
                                        <li><a  href="Order-History"><i class="fa fa-pencil-square-o"></i>&nbsp; Order History</a></li>
                                
                                 <li><a  href="My-Wishlist"><i class="fa fa-heart"></i>&nbsp;My Wishlist</a></li>
                                 <li><a href="Notifications"><i class="fa fa-bell"></i>&nbsp; Notifications</a></li>
                                        
                                        <?php } else { ?>
                                          <li><a href="Login">Login</a></li>
                                        <li><a href="Register">Register</a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-style">
                        <div class="box-service box-footer">
                            <div class="module clearfix">
                                <h3 class="modtitle">Services</h3>
                                <div class="modcontent">
                                    <ul class="menu">

                                        <li><a href="Contact-Us">Contact Us</a></li>
                                       
                                        <li><a href="Shop-Register">Register Your Shop</a></li>
                                        <li><a href="Shop-Login">Shopkeeper Login</a></li>
                                        <li><a href="Terms-of-Service">Terms Of Service</a></li>
                                        <li><a href="Terms-of-Use">Terms Of Use</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-style">


                        <div class="module box-footer so-instagram-gallery-ltr">

                            <h4 class="modtitle">Facebook Page</h4>


                          

                          
                        </div>
                    </div>

                    
                    
                </div>
                <div class="newsletter-footer1">
                   

                </div>
            </div>
        </section>

        <!-- Footer Bottom Container -->
        <section class="footer-bottom ">
            <div class="container">
                <div class="row">  
                    <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12 copyright-w">
                        <div class="copyright">Shopzillas Market © 2020 ShopZillas Store. All Rights Reserved. 
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12 payment-w">
                        <img src="image/catalog/demo/payment/payment.png" alt="imgpayment">
                    </div>
                </div>
            </div>
        </section>
        <!-- /Footer Bottom Container -->
        
        
            <!--Back To Top-->
        <div class="back-to-top"><i class="fa fa-angle-up"></i></div>
    </footer>
    <!-- //end Footer Container -->

    </div>
   

<!-- End Color Scheme
============================================ -->



<!-- Include Libs & Plugins
============================================ -->
<!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="{{ asset('website') }}/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/owl-carousel/owl.carousel.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/themejs/libs.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/unveil/jquery.unveil.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/countdown/jquery.countdown.min.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/datetimepicker/moment.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/modernizr/modernizr-2.6.2.min.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/minicolors/jquery.miniColors.min.js"></script>

<!-- Theme files
============================================ -->

<script type="text/javascript" src="{{ asset('website') }}/js/themejs/application.js"></script>

<script type="text/javascript" src="{{ asset('website') }}/js/themejs/homepage.js"></script>

<script type="text/javascript" src="{{ asset('website') }}/js/themejs/toppanel.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/themejs/so_megamenu.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/themejs/addtocart.js"></script>

<script src="{{ asset('website') }}/js1/main.js"></script> 

<script src="{{ asset('website') }}/js1/demo.js"></script>


<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>            
    
  <script>
    function printDiv(divName) {
         var printContents = document.getElementById('printablediv').innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
    }    
    </script>


<script>
    function move_navigation( $navigation, $MQ) {
   if ( $(window).width() >= $MQ ) {
      $navigation.detach();
      $navigation.appendTo('header');
   } else {
      $navigation.detach();
      $navigation.insertAfter('header');
   }
}
</script>

</body>


</html>
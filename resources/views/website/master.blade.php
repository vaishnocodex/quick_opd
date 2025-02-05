<!DOCTYPE html>
<html lang="en">


<head>
    
    <!-- Basic page needs
    ============================================ -->
    <title>QuickOPD</title>
    
    
    <base href="/" >
    <meta name="keywords" content="" />
    <meta name="author" content="Grapxcode">
    <meta name="robots" content="index, follow" />
   
    <!-- Mobile specific metas
    ============================================ -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <!-- Favicon
    ============================================ -->
   
    <link rel="shortcut icon" style="width:64px; height:64px;" type="image/png" href="logo.svg"/>
   
    <!-- Libs CSS
    ============================================ -->
    <script src= "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="{{ asset('website') }}/css/bootstrap/css/bootstrap.min.css">
    <link href="{{ asset('website') }}/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('website') }}/js/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="{{ asset('website') }}/js/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="{{ asset('website') }}/css/themecss/lib.css" rel="stylesheet">
    <link href="{{ asset('website') }}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <link href="{{ asset('website') }}/js/minicolors/miniColors.css" rel="stylesheet">
    
    
    <link href="{{ asset('website') }}/css-java/owl.theme.css" rel="stylesheet">
    <link href="{{ asset('website') }}/css-java/owl.carousel.css" rel="stylesheet">
    
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
    <link href="{{ asset('website') }}/css/new_style.css" rel="stylesheet">
     <!-- Google web fonts
     
    ============================================ --> <!-- Fon Hindi CSS     ============================================ -->
 <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,500i,700' rel='stylesheet' type='text/css'>
 <link href="https://fonts.googleapis.com/css2?family=Hind:wght@500&display=swap" rel="stylesheet">
 
<link rel="stylesheet" href="{{ asset('website') }}/css1/style.css"> 
  
<script  type="text/javascript" src="{{ asset('website') }}/js/jquery-2.2.4.min.js"></script>
@include('website.web_css')

  <!-- /Search Condition  -->
 <script>
    $(document).ready(function(){
    	$("#searchkey").keyup(function(){ 
    	    var keyword1= $("#searchkey").val();
    	    var search_type= $("#search_type").val();
    	    //alert(search_type);
    	    
    	if(keyword1=='' || keyword1==' ')  
            {
                
             	$("#suggesstion-box1").fadeOut();  
                
            }
    		else
    		{    
    		$.ajax({
    		type: "POST",
    		url: "get_search.php",
    		data:{keyword1:keyword1,search_type:search_type}, 
    	 
    		success: function(data){
    		    //alert(data);
    			$("#suggesstion-box1").fadeIn();
    			$("#skill-list1").html(data);
    			
    		}
    		});
    		}
    	});   
    });  

    function selectlist1(val,val1) {
    $("#searchkey").val(val);
    
    $("#suggesstion-box1").fadeOut();
    var val1 = val1;
    window.location.href="Doctors/"+val1;
    }
    function selectlist2(val,val1) {
    $("#searchkey").val(val);
    
    $("#suggesstion-box1").fadeOut();
    var val1 = val1;
    window.location.href="Radiology-Service/"+val1;
    }
     function selectlist3(val,val1) {
    $("#searchkey").val(val);
    
    $("#suggesstion-box1").fadeOut();
    var val1 = val1;
    window.location.href="Symptom/"+val1;
    }
</script>
  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
  
</head>

<body class="common-home res layout-2" id="body" >

<div id="cd-shadow-layer"></div>   

<div id="cd-cart">
  <a class="btn" style="background:#009E7F; width:100%; border-radius:20px; color:#fff;" href="Checkout">Checkout</a>
 
<div id="header_cart"></div>  
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
                                        <li><a  href="My-Booking"><i class="fa fa-pencil-square-o"></i>&nbsp; My Booking</a></li>
                                        <li><a  href="Logout"><i class="fa fa-pencil-square-o"></i>&nbsp; Logout</a></li>
                                
                               
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
                    <div class="logo">
                        <a href="Home">
                        <img style="height: 52px;width:130px;" src="{{ asset('website') }}/logo/logo.svg" title="MyDoctors24" alt="MyDoctors24" /></a></div>
                          <center>
                                <ul style="margin-top:25px;" class="demo_btn">


                                    <li class="btn-li"><a href="ALL-Doctor">
                                            <img class="btn-img" src="image/btn02.png" alt="">
                                            <span class="btn-text">DOCTORS</span></a></li>

                                    <li class="btn-li"> <a href="ALL-Hospital">
                                            <img class="btn-img" src="image/btn01.png" alt="">
                                            <span class="btn-text">HOSPITALS</span> </a></li>

                                  

                                    <li class="btn-li" style="margin-top: 18px;"> <a href="All-Radiology">
                                            <img class="btn-img" src="image/btn04.png" alt="">
                                            <span class="btn-text">RADIOLOGY</span>
                                        </a></li>

                                             <li class="btn-li"><a href="#">
                                            <img class="btn-img" src="image/btn03.png" alt="">
                                            <span class="btn-text">M-STORE</span></a></li>

                                    <li class="btn-li" style="margin-top: 18px;"> <a href="All-Symptoms">
                                            <img class="btn-img" src="image/btn06.png" alt="">
                                            <span class="btn-text">SYMPTOMS</span>
                                        </a></li>

                                    <li class="btn-li" style="margin-top: 18px;"> <a href="#">
                                            <img class="btn-img" src="image/btn05.png" alt="">
                                            <span class="btn-text">OFFER</span>
                                        </a></li>


                                </ul>
                                <!--//cart-->
                            </center>
                </div>
                <!-- //end Logo -->
                <!-- Search -->
              <div class="middle2 col-lg-7 col-md-6">
                            <div class="search-header-w ">
                                
                                <div class="sosearchpro-wrapper so-search " >
                                    <form method="GET" action="#">
                                        <div  class="search input-group form-group search002" style="display:flex;">
                                            <div class="select_category filter_type  icon-select hidden-sm hidden-xs " style="width:30%">

                                                <select class="no-border" name="type" id="search_type" style="width: 100%; height: 45px; border-radius: 10px;">
                                                    <option value="HOS">Hospital</option>
                                                    <option value="RAD">Radiology</option>
                                                    <option value="SYM">Symptom</option>  
                                                </select>
                                            </div>

                                            <input type="text" class="autosearch-input form-control search_input" style="border-radius: 10px;height: 45px; border-radius: 10px;"name="attribute1" maxlength="128" id="searchkey" autocomplete="off" placeholder="Please type here for search" />
                                            <div id="suggesstion-box1">
                                                <ul style="z-index:1000 !important;" id="skill-list1">
                                                </ul>

                                            </div>

                                            <!--- <span class="input-group-btn">
                                    <button type="submit" class="button-search btn btn-primary" onclick="searchdata()" name="submit_search">
                                        <i class="fa fa-search"></i>
                                        </button>
                                    </span> ----->
                                        </div>
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
                        <a href="Cart" ><div id="cart_mobile" class="btn-shopping-cart"> </div> </a> </div>
                        
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
    <div class="header-bottom hidden-compact green-h" style="margin-top: 40px;">
        <div class="container">
            <div class="row">
               
                
                  <nav class="navbar mobile_menu_opd navbar-fixed-bottom" style="background-color:whitesmoke">
                        <div class="container-fluid">
                            <center>
                            <ul class="nav navbar-nav " style="display: flex; width:100%" >
                                <li class="active" style="margin:5px auto">
                                    <a href="Home" class="">
                                    <i class="fa fa-home nav-icon mb-2" aria-hidden="true"></i>
                                    Home</a>
                                </li>
                                <li style="margin:5px auto">
                                    <a href="My-Booking"  class="">
                                    <i class="fa fa-bookmark nav-icon mb-2" aria-hidden="true"></i>
                                    Booking</a>
                                </li>
                                <li style="margin:5px auto">
                                    
                                    <a href="#" class="">
                                         <i class="fa fa-bell nav-icon mb-2" aria-hidden="true"></i>
                                         Notificaton</a>
                                </li>
                                <li style="margin:5px auto">
                                    <a href="#" class="">
                                        <i class="fa fa-bars nav-icon mb-2" aria-hidden="true"></i>
                                       
                                        Menu</a></li>
                            </ul>
                            </center>
                        </div>
                    </nav>
                         
                
                <!-- Main menu -->
              <div class="main-menu col-lg-6 col-md-9">
                            <div class="responsive so-megamenu megamenu-style-dev">
                                <nav class="navbar-default">
                                    <div class=" container-megamenu  horizontal open ">
                                        <div class="navbar-header header02">
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
                                                              Home</a>
                                                        </li>
                                                        <li class="">
                                                            <p class="close-menu"></p>
                                                            <a href="ALL-Hospital" class="clearfix">
                                                                <strong>All Hospital</strong>
                                                                <span class="label"></span>
                                                            </a>
                                                        </li>
                                                        <li class="">
                                                            <p class="close-menu"></p>
                                                            <a href="ALL-Doctor" class="clearfix">
                                                                 <strong>All Doctors</strong>
                                                                <span class="label"></span>
                                                            </a>
                                                        </li>

                                                        <li class="">
                                                            <p class="close-menu"></p>
                                                            <a href="Medical" class="clearfix">
                                                                <strong>Medical Store</strong>
                                                                <span class="label"></span>
                                                            </a>
                                                        </li>

                                                        <li class="">
                                                            <p class="close-menu"></p>
                                                            <a href="#" class="clearfix">
                                                                <strong>Blogs</strong>
                                                                <span class="label"></span>
                                                            </a>
                                                        </li>

                                                        <li class="">
                                                            <a href="#" class="">
                                                              <strong>Emergency</strong>
                                                                <span class="label"></span> </a>


                                                        </li>
                                                        <li class="">
                                                            <p class="close-menu"></p>
                                                            <a href="https://play.google.com/store/apps/details?id=org.osn.hshrc" class="clearfix">
                                                                <strong>Govt. Hospital</strong>
                                                                <span class="label"></span>
                                                            </a>
                                                        </li>
                                                       
                                                            <li class="">
                                                                <p class="close-menu"></p>
                                                                <a href="Logout" class="clearfix">
                                                                    <strong>Logout</strong>
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
                    <div class="signin-w font-title hidden-sm hidden-xs loging" style="display:inline-block !important;">
                        <ul style="list-style-type:none;" class="blank">
                         
                        <li class="log login"><i class="fa fa-lock"></i> <a class="link-lg" href="Login">Login </a> or <a href="Register">Register</a></li>
                         
                        <li  class="btn-xs log login dropdown-toggle" data-toggle="dropdown">
                            
                                                           
                            <a class="title-submenu" onclick="window.location.href='Logout'" style="font-size:16px; font-weight:500;" >
                               Logout
                            </a>
                           
                        
                        </li>   
                    
                        </ul>                       
                    </div>
                    <div class="telephone hidden-xs hidden-sm hidden-md">
                        <ul class="blank"> <li><!---<a href="tel:(+91) 94857 67000"><i class="fa fa-phone-square"></i> <strong>Hotline (+91) 94857 67000</strong></a>---></li> </ul>
                    </div>
                                        
                    
                </div>
                
                
            </div>
        </div>

    </div>

    </header>
  
    @yield('content')

   <!-- Modal -->

  <!-- Footer Container -->
  <footer class="footer-container typefooter-2">
      <!-- Footer Top Container -->
      <section class="footer-top">
          <div class="container-fluid">
              <div class="row">
                 
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                          <center>
                          <i style="color:#fff;" class="fa fa-3x fa-user-md"></i>
                          <h3>Doctor partner -</h3>
                          <p style="font-size: 18px;font-weight: bold;">1000</p>
                          </center>
                         </div>
                         
                          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                       <center>
                          <i style="color:#fff;" class="fa fa-3x fa-hospital-o"></i>
                          <h3>Our Hospital partner-</h3>
                          <p style="font-size: 18px;font-weight: bold;">260</p>
                          </center>
                     </div>
                      
                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                          <center>
                          <i style="color:#fff;" class="fa fa-3x fa-bed"></i>
                          <h3>Our Diagnosis partner -</h3>
                          <p style="font-size: 18px;font-weight: bold;">71</p>
                          </center>
                          </div>
                       
                           <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <center>
                          <i style="color:#fff;" class="fa fa-3x fa-user"></i>
                          <h3>Our User partner -</h3>
                          <p style="font-size: 18px;font-weight: bold;">20K</p>
                          </center>
                     </div>
                 
              </div>
           </div>
      </section>
      <!-- /Footer Top Container -->
      
      <section class="footer-middle ">
          <div class="container">
              <div class="row">
                  <!-----<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-style">
                      <div class="infos-footer box-footer">
                          <div class="module">
                              <h3 class="modtitle">Contact Info</h3>
                              <ul>
                               
                                  <li class="adres">Shop no. 23, Panchayat Pocket, Front Red Cross, Zoo Road Bhiwani</li>
                                  <li class="phone">948 57 67 000</li>
                                  
                                  <li class="time">24x7</li>
                              </ul>
                          </div>
                      </div>


                  </div> --->
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-style">
                      <div class="box-information box-footer">
                          <div class="module clearfix">
                              <h3 class="modtitle">Information</h3>
                              <div class="modcontent">
                                  <ul class="menu">
                                      
                                     <!---  <li class="mail">
                                      <a href="mailto:admin@mydoctors24.com">admin@mydoctors24.com</a>
                                  </li>  ---->
                                       <li><a href="Contact-Us">Contact Us</a></li>
                                      <li><a href="About-Us">About-Us</a></li>
                                      <li><a href="Terms-and-Conditions">Terms & Conditions</a></li>
                                      <li><a href="Privacy-Policy-For-Devops">Privacy Policy For Devops</a></li>
                                      <li><a href="Privacy-Policy">Privacy Policy</a></li>
                                      <li><a href="Cookies-Policy">Cookies Policy</a></li>
                                      <li><a href="Refund-Policy">Refund Policy</a></li>
                                        <li><a href="Terms-of-Use">Terms Of Use</a></li>
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
                                      
                                      
                                      <li><a href="My-Profile"><i class="fa fa-user"></i>&nbsp;My Profile</a></li>
                                      <li><a  href="Change-Password"><i class="fa fa-key"></i>&nbsp;Change Password</a></li>
                                      <li><a  href="Order-History"><i class="fa fa-pencil-square-o"></i>&nbsp; Order History</a></li>
                              
                               <li><a  href="My-Wishlist"><i class="fa fa-heart"></i>&nbsp;My Wishlist</a></li>
                               <li><a href="Notifications"><i class="fa fa-bell"></i>&nbsp; Notifications</a></li>
                               <li><a href="Any-Feedback"><i class="fa fa-bell"></i>&nbsp; Feedback</a></li>
                                      
                                     
                                        <li><a href="Login">Login</a></li>
                                      <li><a href="Register">Register</a></li>
                                      <li><a href="Any-Feedback">Feedback</a></li>
                                      
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

                                      <li><a href="https://quickopd.com/hospital-login">Hospital Login</a></li>
                                      <li><a href="https://quickopd.com/radiology">Radiology/Lab Login</a></li>
                                      <li><a href="https://quickopd.com/doctor">Doctor Login</a></li>
                                      <li><a href="Register-Owner">Register Hospital/Radiology/Lab</a></li>
                                       
                                      <li><a href="Terms-of-Service">Terms Of Service</a></li>
                                    
                                  </ul>
                              </div>
                          </div>
                      </div>

                  </div>
                 <!--------- <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-style">


                      <div class="module box-footer so-instagram-gallery-ltr">

                          <h4 class="modtitle">Facebook Page</h4>
 

                        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fm.facebook.com%2F107857837675873%2F&tabs=timeline&width=250&height=250&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="250" height="250" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>

                        
                      </div>
                  </div>  ------------->

                  
                  
              </div>
              <div class="newsletter-footer1">
                  <a herf="#" class="ml-3 mr-3" >
                 <i class="fa fa-2x fa-facebook-square mx-3 iconi"  aria-hidden="true"></i></a>
                  <a herf="#" class="ml-3 mr-3" >
                 <i class="fa fa-2x fa-instagram mx-3 iconi"   aria-hidden="true"></i></a>
                  <a herf="#" class="ml-3 mr-3" >
                 <i class="fa fa-2x fa-youtube mx-3 iconi"   aria-hidden="true"></i></a>

              </div>
          </div>
      </section>

      <!-- Footer Bottom Container -->
      <section class="footer-bottom ">
          <div class="container" style="margin-bottom:70px;">
              <div class="row">  
                  <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12 copyright-w">
                      <div class="copyright">Rightman Home Maintenance © 2021. All Rights Reserved. 
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12 payment-w">
                  
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

<script>
  $(document).ready(function() {
    $("#owl-demo3").owlCarousel({
      autoPlay: 3000,
      items : 2,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3],
      itemsTablet:[768,2], //As above.
      itemsMobile:[479,1],
      responsive:true

    });

  });
  </script>
  
  <script>
  $(document).ready(function() {
    $("#owl-demo4").owlCarousel({
      autoPlay: 3000,
      items : 4,
      itemsDesktop : [1199,4],
      itemsDesktopSmall : [979,4],
      itemsTablet:[768,2], //As above.
      itemsMobile:[479,2],
      responsive:true

    });

  });
  </script>
    <script>
  $(document).ready(function() {
    $("#owl-demo5").owlCarousel({
      autoPlay: 3000,
      items : 4,
      itemsDesktop : [1199,4],
      itemsDesktopSmall : [979,4],
      itemsTablet:[768,2], //As above.
      itemsMobile:[479,2],
      responsive:true

    });

  });
  </script>
  
    <script>
  $(document).ready(function() {
    $("#owl-demo6").owlCarousel({
      autoPlay: 3000,
      items : 4,
      itemsDesktop : [1199,4],
      itemsDesktopSmall : [979,4],
      itemsTablet:[768,2], //As above.
      itemsMobile:[479,2],
      responsive:true

    });

  });
  </script>
  
    <script>
    $(document).ready(function() {
    $("#owl-demo7").owlCarousel({
      autoPlay: 3000,
      items : 6,
      itemsDesktop : [1199,6],
      itemsDesktopSmall : [979,6],
      itemsTablet:[768,4], //As above.
      itemsMobile:[479,4],
      responsive:true

    });

  });
  </script>

<script type="text/javascript">
  (function () {
      var options = {
          whatsapp: "+91(948)576-70-00", // WhatsApp number
          call_to_action: "Message us", // Call to action
          position: "left", // Position may be 'right' or 'left'
      };
      var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
      var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
      s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
      var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
  })();
</script>






</body>


</html>

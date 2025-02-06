@extends('website.master')
@section('content')
	<!-- Main Container  -->
	<div class="main-container container">
		<ul class="breadcrumb">
			<li><a href="{{route('welcome')}}"><i class="fa fa-home"></i></a></li>
			
			<li><a href="#">About Us</a></li>
		</ul>
		
		<div style="padding:20px;" class="row">			
            <div id="content" class="col-sm-12 item-article">
                <div class="row box-1-about">
                    <div class="col-md-9 welcome-about-us">
                        <div class="title-about-us">
                            <h2>Welcome To Our Shop</h2>
                        </div>
                        <div class="content-about-us">
                            <div class="image-about-us">
                                <img src="image/catalog/about/about-us.jpg" alt="Image Client">
                            </div>
                            <div class="des-about-us">Welcome to ShopZillas, your number one source for all things. We are dedicated to giving you the very best service and pruducts, with a focus on best price, timely delivery, 24/7 Customer Support.    <br>
                                <br>Founded in 2019, ShopZillas has come a long way from its beginnings in Hamburg. When we first started out, our passion for Shopzillas e-commerce drove us to quit day job, do tons of research so that we can offer you the world's most advanced e-commerce online shop. We now serve customers all over Hamburg and plan extend our service Euorpe wide, and are thrilled that we're able to turn our passion into our own website.
                                <br>
                                <br>We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions or comments, please don't hesitate to contact us.<br><br>Sincerely,<br>Romal</div>
                        </div>
                    </div>
                    <div class="col-md-3 why-choose-us">
                        <div class="title-about-us">
                            <h2>Why Choose Us</h2>
                        </div>
                        <div class="content-why">
                            <ul class="why-list">
                                <li><a title="Best Price" href="#">Best Price</a>
                                </li>
                                <li><a title="Secure Shopping" href="#">Secure Shopping</a>
                                </li>
                                <li><a title="Timely Delivered" href="#">Timely Delivered</a>
                                </li>
                                <li><a title="24/7 Support" href="#">24/7 Support</a>
                                </li>
                                <li><a title="Big Savings" href="#">Big Savings</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                  
                    <div style="margin-top:20px;" class="col-md-12 happy-about-us">
                        <div id="slider-happy-about-us" class="happy-ab">
                            <div class="title-happy-about">
                                <h2>Happy customers</h2>
                            </div>
                      
                            <div class="yt-content-slider sm_imageslider slider-happy-client" data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                                <div class="item">
                                    <div class="ct-why">
                                        <div class="client-say">Excellent customer service; the order was filled quickly and delivered in a very short amount of time.</div>
                                        <p class="client-info-about"><span class="name">- Mama Duo - </span>Social Media Strategist</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="ct-why">
                                        <div class="client-say">Fantastic site Shozillas. Awesome people to work with if you have a special request. FAST service. I use Shopzillas all the time.</div>
                                        <p class="client-info-about"><span class="name">- Join Doe - </span>Social Media Strategist</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="ct-why">
                                        <div class="client-say">Designed well, fast service and professional, Willing to make their customers happy!</div>
                                        <p class="client-info-about"><span class="name">- Join Doe - </span>Social Media Strategist</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="ct-why">
                                        <div class="client-say">Fantastic customer service. My foods were shipped quickly and they look fantastic. I am buying more food and also grocery. The cost is exactly as they quote with no added set up charges. Great company to work with overall.</div>
                                        <p class="client-info-about"><span class="name">- Join Doe - </span>Social Media Strategist</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<!-- //Main Container -->
	

@endsection
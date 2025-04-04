
@extends('website.master3') 
@section('content')

<main class="main" id="main-section">
    <div class="ck-content">
        <div>
            <section class="home-slider position-relative mb-30 mt-30">
                <div class="container">
                    <div class="home-slide-cover mt-30">
                        <div class="hero-slider-1 dot-style-1 dot-style-1-position-1 style-4">

                            @foreach ($slider as $item)
                            <div class="single-hero-slider single-animation-wrap " style=""
                                data-original-image="{{ asset('storage/slider/').'/'.$item->image }}"
                                data-tablet-image="{{ asset('storage/slider/').'/'.$item->image }}"
                                data-mobile-image="{{ asset('storage/slider/').'/'.$item->image }}">
                              

                            </div>
                            @endforeach
                        </div>
                        <div class="slider-arrow hero-slider-1-arrow"></div>

                    </div>
                </div>
            </section>
        </div>
       
        <div>
            <section class="popular-categories section-padding">
                <div class="container wow animate__animated animate__fadeIn">
                    <div class="section-title">
                        <div class="title">
                            <h3 class="section-title style-1 mb-30">Book Our Specialist By</h3>
                        </div>
                        <div class="slider-arrow slider-arrow-2 flex-right carousel-10-columns-arrow" id="carousel-10-columns-arrows"></div>
                    </div>
                    <div class="carousel-10-columns-cover position-relative">
                        <div class="carousel-slider-wrapper carousel-10-columns" id="carousel-10-columns"
                            title="Top Categories" data-slick="{&quot;autoplay&quot;:false,&quot;infinite&quot;:false,&quot;autoplaySpeed&quot;:3000,&quot;speed&quot;:800}" data-items-xxl="10" data-items-xl="6" data-items-lg="4" data-items-md="3" data-items-sm="2">
                            @foreach ($category as $item)
                        <div style="margin-top:20px;" class="col-md-2 col-lg-2 col-xs-4 col-sm-4">
                            <div class="image-cat">
                                <a  href="{{ route('specialist.all-doctor', ['id'=>Crypt::encrypt($item->id)]) }}" title="{{$item->name}}" target="_self">
                                    <img style="height:75px !important; width:75px !important; border-radius:50%;" class="img-circled"  src="{{ asset('storage/category/').'/'.$item->image }}" title="{{$item->name}}" alt="{{$item->name}}" />
                                </a>
                            </div>
                          <div class="cat-title text-center"> 
                              <a style="font-size:11px;" href="{{ route('specialist.all-doctor', ['id'=>Crypt::encrypt($item->id)]) }}" title="{{$item->name}}" target="_self">{{$item->name}} </a>
                            </div>
                        </div>
                        @endforeach
                           
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div>
            <section class="popular-categories section-padding">
                <div class="container wow animate__animated animate__fadeIn">
                    <div class="section-title">
                        <div class="title">
                            <h3 class="section-title style-1 mb-30">Select Problem</h3>
                        </div>
                        <div class="slider-arrow slider-arrow-2 flex-right carousel-10-columns-arrow" id="carousel-10-columns-arrows1"></div>
                    </div>
                    <div class="carousel-10-columns-cover position-relative">
                        <div class="carousel-slider-wrapper carousel-10-columns" id="carousel-10-columns1"
                            title="Top Categories" data-slick="{&quot;autoplay&quot;:false,&quot;infinite&quot;:false,&quot;autoplaySpeed&quot;:3000,&quot;speed&quot;:800}" data-items-xxl="10" data-items-xl="6" data-items-lg="4" data-items-md="3" data-items-sm="2">
                            @foreach ($symptom as $item)
                        <div style="margin-top:20px;" class="col-md-2 col-lg-2 col-xs-4 col-sm-4">
                            <div class="image-cat">
                                <a  href="{{ route('problem.all-doctor', ['id'=>Crypt::encrypt($item->id)]) }}" title="{{$item->name}}" target="_self">
                                    <img style="height:75px !important; width:75px !important; border-radius:50%;" class="img-circled"  src="{{ asset('storage/category/').'/'.$item->image }}" title="{{$item->name}}" alt="{{$item->name}}" />
                                </a>
                            </div>
                          <div class="cat-title text-center"> 
                              <a style="font-size:11px;" href="{{ route('problem.all-doctor', ['id'=>Crypt::encrypt($item->id)]) }}" title="{{$item->name}}" target="_self">{{$item->name}} </a>
                            </div>
                        </div>
                        @endforeach
                           
                        </div>
                    </div>
                </div>
            </section>
        </div>

        
        <div>
            <section class="popular-categories section-padding">
                <div class="container wow animate__animated animate__fadeIn">
                    <div class="section-title">
                        <div class="title">
                            <h3 class="section-title style-1 mb-30">Book Our Radiology By</h3>
                        </div>
                        <div class="slider-arrow slider-arrow-2 flex-right carousel-10-columns-arrow" id="carousel-10-columns-arrows2"></div>
                    </div>
                    <div class="carousel-10-columns-cover position-relative">
                        <div class="carousel-slider-wrapper carousel-10-columns" id="carousel-10-columns2"
                            title="Top Categories" data-slick="{&quot;autoplay&quot;:false,&quot;infinite&quot;:false,&quot;autoplaySpeed&quot;:3000,&quot;speed&quot;:800}" data-items-xxl="10" data-items-xl="6" data-items-lg="4" data-items-md="3" data-items-sm="2">
                            @foreach ($category as $item)
                        <div style="margin-top:20px;" class="col-md-2 col-lg-2 col-xs-4 col-sm-4">
                            <div class="image-cat">
                                <a  href="#" title="{{$item->name}}" target="_self">
                                    <img style="height:75px !important; width:75px !important; border-radius:50%;" class="img-circled"  src="{{ asset('storage/category/').'/'.$item->image }}" title="{{$item->name}}" alt="{{$item->name}}" />
                                </a>
                            </div>
                          <div class="cat-title text-center"> 
                              <a style="font-size:11px;" href="#" title="{{$item->name}}" target="_self">{{$item->name}} </a>
                            </div>
                        </div>
                        @endforeach
                           
                        </div>
                    </div>
                </div>
            </section>
        </div>
        {{-- specilist category  --}}
       
        <div>
            <section class="banners pt-60">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="banner-img wow animate__animated animate__fadeInUp " data-wow-delay="0.2">
                                <div style="text-align: center;">
                                    <a href="products.html" target="_blank" title="Banner">
                                        <picture>
                                            <source srcset="{{ asset('website') }}/assets/storage/promotion/1.png"
                                                media="(min-width: 1200px)" />
                                            <source srcset="{{ asset('website') }}/assets/storage/promotion/1.png" media="(min-width: 768px)" />
                                            <source srcset="{{ asset('website') }}/assets/storage/promotion/1.png" media="(max-width: 767px)" />

                                            <img src="{{ asset('website') }}/assets/storage/promotion/1.png" data-bb-lazy="true"
                                                style="max-width: 100%" loading="lazy" alt="Everyday Fresh">
                                        </picture>
                                    </a>
                                </div>

                                <div class="banner-text">
                                    <h4>Everyday Fresh &amp; <br>
                                        Clean with Our <br>
                                        Products</h4>
                                    <a href="products.html" target="_blank" class="btn btn-xs">
                                        Book now <i class="fi-rs-arrow-small-right"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="banner-img wow animate__animated animate__fadeInUp " data-wow-delay="0.4">
                                <div style="text-align: center;">
                                    <a href="products.html" target="_blank" title="Banner">
                                        <picture>
                                            <source srcset="{{ asset('website') }}/assets/storage/promotion/2.png"
                                                media="(min-width: 1200px)" />
                                            <source srcset="{{ asset('website') }}/assets/storage/promotion/2.png" media="(min-width: 768px)" />
                                            <source srcset="{{ asset('website') }}/assets/storage/promotion/2.png" media="(max-width: 767px)" />

                                            <img src="{{ asset('website') }}/assets/storage/promotion/2.png" data-bb-lazy="true"
                                                style="max-width: 100%" loading="lazy" alt="Make your Breakfast">
                                        </picture>
                                    </a>
                                </div>

                                <div class="banner-text">
                                    <h4>Make your Breakfast Healthy and Easy</h4>
                                    <a href="products.html" target="_blank" class="btn btn-xs">
                                        Book now <i class="fi-rs-arrow-small-right"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="banner-img wow animate__animated animate__fadeInUp " data-wow-delay="0.6">
                                <div style="text-align: center;">
                                    <a href="products.html" target="_blank" title="Banner">
                                        <picture>
                                            <source srcset="{{ asset('website') }}/assets/storage/promotion/3.png"
                                                media="(min-width: 1200px)" />
                                            <source srcset="{{ asset('website') }}/assets/storage/promotion/3.png" media="(min-width: 768px)" />
                                            <source srcset="{{ asset('website') }}/assets/storage/promotion/3.png" media="(max-width: 767px)" />

                                            <img src="{{ asset('website') }}/assets/storage/promotion/3.png" data-bb-lazy="true"
                                                style="max-width: 100%" loading="lazy" alt="The best Organic">
                                        </picture>
                                    </a>
                                </div>

                                <div class="banner-text">
                                    <h4>The best Organic Products Online</h4>
                                    <a href="products.html" target="_blank" class="btn btn-xs">
                                        Book now <i class="fi-rs-arrow-small-right"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
       
    
       
    </div>

</main>

<footer class="main">
    <section class="newsletter mb-15 wow animate__animated animate__fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="position-relative newsletter-inner"
                        style="background-image: url(storage/general/newsletter-background-image.png) !important;">
                        <div class="newsletter-content">
                            <h2 class="mb-20">
                                Stay home &amp; get your daily <br>needs from our shop
                            </h2>
                            <p class="mb-45">Start Your Daily Shopping with <span>Nest Mart</span></p>
                            <form method="POST"
                                action="https://ecommerce12.testsoftwares.site/newsletter/subscribe"
                                accept-charset="UTF-8" id="botble-newsletter-forms-fronts-newsletter-form"
                                class="newsletter-form dirty-check"><input name="_token" type="hidden"
                                    value="ppw6IRBuLBJdSn6XFSNYwPGd47hlBcD8A46RBxKx">






                                <div class="form-subscribe d-flex">







                                    <input class="form-control" placeholder="Enter Your Email"
                                        id="newsletter-email" required="required" name="email"
                                        type="email">









                                    <button class="btn" type="submit">Subscribe</button>



                                </div>







                                <div class="newsletter-message newsletter-success-message"
                                    style="display: none"></div>
                                <div class="newsletter-message newsletter-error-message" style="display: none">
                                </div>









                                <div class="captcha-render-section">







                                </div>









                            </form>



                        </div>
                        <img src="{{ asset('website') }}/assets/storage/general/newsletter-image.png" alt="newsletter" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="featured section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mt-2">
                    <div class="banner-left-icon d-flex align-items-center  fadeIn  animated"
                        data-wow-delay="0.2s">
                        <div class="banner-icon">
                            <img src="{{ asset('website') }}/assets/storage/general/icon-1.png" alt="icon">
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Search  &amp; Choose a Service </h3>
                            <p>Enter symptoms or required service</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mt-2">
                    <div class="banner-left-icon d-flex align-items-center  fadeIn  animated"
                        data-wow-delay="0.4s">
                        <div class="banner-icon">
                            <img src="{{ asset('website') }}/assets/storage/general/icon-2.png" alt="icon">
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Select Appointment Date</h3>
                            <p>24/7 amazing services</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mt-2">
                    <div class="banner-left-icon d-flex align-items-center  fadeIn  animated"
                        data-wow-delay="0.6s">
                        <div class="banner-icon">
                            <img src="{{ asset('website') }}/assets/storage/general/icon-3.png" alt="icon">
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Enter Patient Details & Confirm Booking</h3>
                            <p>After filling in details, the system shows the total cost</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mt-2">
                    <div class="banner-left-icon d-flex align-items-center  fadeIn  animated"
                        data-wow-delay="0.8s">
                        <div class="banner-icon">
                            <img src="{{ asset('website') }}/assets/storage/general/icon-4.png" alt="icon">
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title"> Make Payment Securely</h3>
                            <p>A secure transaction process ensures safety.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mt-2">
                    <div class="banner-left-icon d-flex align-items-center  fadeIn  animated"
                        data-wow-delay="1s">
                        <div class="banner-icon">
                            <img src="{{ asset('website') }}/assets/storage/general/icon-5.png" alt="icon">
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title"> Attend Your Appointment & Get Reports</h3>
                            <p>Users visit the diagnostic center for the test.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@extends('website.master3') 
@section('content')
<style>
    main{
    background-color: #e8e2eb;
}
</style>
<main class="main" id="main-section">
    <!--<div class="page-header breadcrumb-wrap">-->
    <!--    <div class="container">-->
    <!--        <div class="breadcrumb">-->
    <!--            <div class="breadcrumb-item d-inline-block">-->
    <!--                <a href="{{route('welcome')}}"title="Home">-->
    <!--                    Home-->
    <!--                </a>-->
    <!--            </div>-->
    <!--            {{-- <span></span>-->
    <!--            <div class="breadcrumb-item d-inline-block">-->
    <!--                <a href="#"title="Products">-->
    <!--                    Test-->
    <!--                </a>-->
    <!--            </div>-->
    <!--            <span></span>-->
    <!--            <div class="breadcrumb-item d-inline-block active">-->
    <!--                <div itemprop="item">-->
    <!--                   Test-->
    <!--                </div>-->
    <!--            </div> --}}-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->


    <div class="container mb-30">
        <div class="row">
          

            <div class="mt-4">
                <div class="products-listing position-relative">
                    {{-- <div class="ps-block__header">
                        <h1 class="h3">Clothing &amp; beauty</h1>
                    </div>


                    <div class="list-content-loading">
                        <div class="half-circle-spinner">
                            <div class="circle circle-1"></div>
                            <div class="circle circle-2"></div>
                        </div>
                    </div> --}}

                    <input type="hidden" name="page" data-value="1">
                    <input type="hidden" name="sort-by" value="">
                    <input type="hidden" name="num" value="">
                    <input type="hidden" name="q" value="">

                    <div class="shop-product-filter">
                        {{-- <div class="total-product">
                            <p>We found <strong class="text-brand">7</strong> items for you!</p>
                        </div> --}}

                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10 products_sortby">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> 12 <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown products_ajaxsortby" data-name="num">
                                    <ul>
                                        <li>
                                            <a data-label="12" class="active"
                                                href="clothing-beauty7765.html?categories%5B0%5D=2&amp;num=12">12</a>
                                        </li>
                                        <li>
                                            <a data-label="24" class=""
                                                href="clothing-beautyfb9a.html?categories%5B0%5D=2&amp;num=24">24</a>
                                        </li>
                                        <li>
                                            <a data-label="36" class=""
                                                href="clothing-beautyb601.html?categories%5B0%5D=2&amp;num=36">36</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover products_sortby">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span><span>Default</span> <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown products_ajaxsortby" data-name="sort-by">
                                    <ul>
                                        <li>
                                            <a data-label="Default" class="active"
                                                href="clothing-beauty15b3.html?categories%5B0%5D=2&amp;sort-by=default_sorting">Default</a>
                                        </li>
                                        <li>
                                            <a data-label="Oldest" class=""
                                                href="clothing-beauty991a.html?categories%5B0%5D=2&amp;sort-by=date_asc">Oldest</a>
                                        </li>
                                        <li>
                                            <a data-label="Newest" class=""
                                                href="clothing-beauty6bdf.html?categories%5B0%5D=2&amp;sort-by=date_desc">Newest</a>
                                        </li>
                                        <li>
                                            <a data-label="Price: low to high" class=""
                                                href="clothing-beautyb34f.html?categories%5B0%5D=2&amp;sort-by=price_asc">Price:
                                                low to high</a>
                                        </li>
                                        <li>
                                            <a data-label="Price: high to low" class=""
                                                href="clothing-beauty76b6.html?categories%5B0%5D=2&amp;sort-by=price_desc">Price:
                                                high to low</a>
                                        </li>
                                        <li>
                                            <a data-label="Name: A-Z" class=""
                                                href="clothing-beauty0136.html?categories%5B0%5D=2&amp;sort-by=name_asc">Name:
                                                A-Z</a>
                                        </li>
                                        <li>
                                            <a data-label="Name: Z-A" class=""
                                                href="clothing-beautyf41a.html?categories%5B0%5D=2&amp;sort-by=name_desc">Name:
                                                Z-A</a>
                                        </li>
                                        <li>
                                            <a data-label="Rating: low to high" class=""
                                                href="clothing-beauty2394.html?categories%5B0%5D=2&amp;sort-by=rating_asc">Rating:
                                                low to high</a>
                                        </li>
                                        <li>
                                            <a data-label="Rating: high to low" class=""
                                                href="clothing-beauty175a.html?categories%5B0%5D=2&amp;sort-by=rating_desc">Rating:
                                                high to low</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row product-grid-5">
                        @foreach ($doctor as $item)
                        <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 mb-lg-0 mb-md-5 mb-sm-5 col-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                data-wow-delay="0.3s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ route('doctor.detail', ['id'=>Crypt::encrypt($item->id)]) }}">
                                            <img class="default-img" src="{{ asset('storage/doctor').'/'.$item->image }}" alt="{{$item->name}}" style="height: 200px;">
                                            <img class="hover-img" src="{{ asset('storage/doctor').'/'.$item->image }}" alt="{{$item->name}}" style="height: 200px;">
                                        </a>
                                    </div>
                                 
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span style="background-color: #02856e !important;">New</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    
                                    <h2 class="text-truncate"><a href="{{ route('doctor.detail', ['id'=>Crypt::encrypt($item->id)]) }}" title="{{$item->name}}">{{$item->name}}</a> </h2>
                                    <p class="speciality"> Specilist</p>
                                  
                                        <ul class="available-info">

                                            <li>
        
                                                <i class="fa fa-map-marker-alt"></i> {{$item->city_name }}
                                            </li>
        
                                            <li> <i class="far fa-clock"></i>  {{$item->experience}} Years of Experience
                                            </li>
        
                                            <li>
                                                <i class="fas fa-clinic-medical"></i> {{$item->hospital_name }}
                                            </li>
        
                                        </ul>
                                  
                                    <div class="product-card-bottom d-md-flex d-block">
                                        <div class="product-price">
                                            <span>₹ {{$item->price}} </span>
                                            {{-- <span class="old-price">₦410,148.16</span>  add-to-cart-button--}}
                                        </div>

                                        <div class="add-cart">
                                            <a class="action-btn add mt-md-0 mt-3" href="{{ route('doctor.detail', ['id'=>Crypt::encrypt($item->id)]) }}">
                                                <i class="fi-rs-shopping-cart mr-5"></i> <span class="d-inline-block">Book Now</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

</main>

@endsection


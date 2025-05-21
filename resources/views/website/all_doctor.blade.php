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
                 

                    <div class="row product-grid-5">
                        @foreach ($doctor as $item)
                        <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 mb-lg-0 mb-md-5 mb-sm-5 col-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                data-wow-delay="0.3s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ route('doctor.detail', ['id'=>Crypt::encrypt($item->id)]) }}">
                                            <img class="default-img" src="{{ file_exists(public_path('storage/doctor/' . $item->image)) && $item->image ? asset('storage/doctor/' . $item->image) : asset('storage/no_image.jpeg') }}" alt="{{$item->name}}" style="height: 200px;">
                                            <img class="hover-img" src="{{ file_exists(public_path('storage/doctor/' . $item->image)) && $item->image ? asset('storage/doctor/' . $item->image) : asset('storage/no_image.jpeg') }}" alt="{{$item->name}}" style="height: 200px;">
                                        </a>
                                    </div>
                                     
                                    {{-- <div class="product-badges product-badges-position product-badges-mrg">
                                        <span style="background-color: #02856e !important;">New</span>
                                    </div> --}}
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


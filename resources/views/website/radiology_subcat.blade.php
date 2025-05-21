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
               

                    <div class="row product-grid-5">
                        @foreach ($radiology_category as $item)
                        <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 mb-lg-0 mb-md-5 mb-sm-5 col-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                data-wow-delay="0.3s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="@if(count(backHelper::Check_RadiologySubacategory_Count($item->id))>0)
                                                 {{ route('radiology.subcategory', ['id'=>Crypt::encrypt($item->id)]) }}
                                                @else
                                                 {{ route('radiology.list', ['id'=>Crypt::encrypt($item->id)]) }}
                                                @endif">
                                            <img class="default-img" src="{{ asset('storage/category/').'/'.$item->image }}" alt="{{$item->name}}" style="height: 200px;">
                                            <img class="hover-img" src="{{ asset('storage/category/').'/'.$item->image }}" alt="{{$item->name}}" style="height: 200px;">
                                        </a>
                                    </div>
                                  
                                </div>
                                <div class="product-content-wrap">
                                    <h2 class="text-truncate text-center"><a href="@if(count(backHelper::Check_RadiologySubacategory_Count($item->id))>0)
                                                 {{ route('radiology.subcategory', ['id'=>Crypt::encrypt($item->id)]) }}
                                                @else
                                                 {{ route('radiology.list', ['id'=>Crypt::encrypt($item->id)]) }} @endif" title="{{$item->name}}">{{$item->name}}</a> </h2>
                                        
                                    <div class="product-card-bottom d-md-flex d-block">
                                        <div class="add-cart">
                                            <a class="action-btn add mt-md-0 mt-3" href="@if(count(backHelper::Check_RadiologySubacategory_Count($item->id))>0)
                                                 {{ route('radiology.subcategory', ['id'=>Crypt::encrypt($item->id)]) }}
                                                @else
                                                 {{ route('radiology.list', ['id'=>Crypt::encrypt($item->id)]) }}
                                                @endif">
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


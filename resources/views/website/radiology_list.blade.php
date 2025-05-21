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
                   

                    <input type="hidden" name="page" data-value="1">
                    <input type="hidden" name="sort-by" value="">
                    <input type="hidden" name="num" value="">
                    <input type="hidden" name="q" value="">

                    <div class="shop-product-filter">
                        <div class="total-product">
                            <p><strong class="text-brand">Radiology List</strong> </p>
                        </div>

                       
                    </div>

                    <div class="row product-grid-5">
                        @foreach ($radiology as $item)
                        <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 mb-lg-0 mb-md-5 mb-sm-5 col-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                data-wow-delay="0.3s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ route('radiology.service-list', ['id'=>Crypt::encrypt($item->id)]) }}">
                                            <img class="default-img" src="{{ file_exists(public_path('storage/doctor/' . $item->image)) && $item->image ? asset('storage/doctor/' . $item->image) : asset('storage/no_image.jpeg') }}" alt="{{$item->name}}" style="height: 200px;">
                                            <img class="hover-img" src="{{ file_exists(public_path('storage/doctor/' . $item->image)) && $item->image ? asset('storage/doctor/' . $item->image) : asset('storage/no_image.jpeg') }}" alt="{{$item->name}}" style="height: 200px;">
                      

                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <h2 class="text-truncate text-center"><a href="{{ route('radiology.service-list', ['id'=>Crypt::encrypt($item->id)]) }}" title="{{$item->name}}">{{$item->name}}</a> </h2>

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


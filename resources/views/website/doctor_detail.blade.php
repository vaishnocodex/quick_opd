@extends('website.master3') 
@section('content')
<style>
    .bb-social-sharing {
        display: inline-flex;
        gap: 0.25rem;
        margin-bottom: 0;
    }

    .bb-social-sharing .bb-social-sharing__item {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 38px;
        height: 38px;
        line-height: 36px;
        text-align: center;
        border: 1px solid #e6e7e8;
        border-radius: 50%;
    }

    .bb-social-sharing .bb-social-sharing__item a {
        line-height: 16px;
        color: var(--primary-color);
    }

    .bb-social-sharing .bb-social-sharing__item:last-child {
        margin-inline-end: 0;
    }

    .bb-social-sharing .bb-social-sharing__item:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: #fff;
    }

    .bb-social-sharing .bb-social-sharing__item:hover a,
    .bb-social-sharing .bb-social-sharing__item:hover button {
        color: #fff;
    }

    .bb-social-sharing .bb-social-sharing__item button {
        border: none;
        outline: none;
        background: transparent;
        color: var(--primary-color);
    }

    .bb-social-sharing .bb-social-sharing__item button:hover {
        cursor: pointer;
    }

    .bb-social-sharing .bb-social-sharing__item svg {
        width: 1.25rem;
        height: 1.25rem;
    }

    .bb-social-sharing .bb-social-sharing__item img {
        width: 1.25rem;
        height: 1.25rem;
    }

    .bb-social-sharing .bb-social-sharing-text {
        display: none;
    }
</style>
<main class="main" id="main-section">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <div class="breadcrumb-item d-inline-block">
                    <a href="#"title="Home"> Home </a>
                </div>
                {{-- <span></span>
                <div class="breadcrumb-item d-inline-block">
                    <a href="#"title="Products"> Products
                    </a>
                </div>
                <span></span>
                <div class="breadcrumb-item d-inline-block">
                    <a href="#"title="Pet Foods">  Pet Foods
                    </a>
                </div> --}}
              
            </div>
        </div>
    </div>


    <div class="container mb-30">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50 mt-30">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                    <div class="detail-gallery">
                                       
                                        <div class="product-image-slider">
                                            <figure class="border-radius-10">
                                                <a href="{{ asset('storage/doctor').'/'.$doctor->image }}">
                                                    <img src="{{ asset('storage/doctor').'/'.$doctor->image }}" alt="{{$doctor->name}}">
                                                </a>
                                            </figure>
                                            <figure class="border-radius-10">
                                                <a href="{{ asset('storage/doctor').'/'.$doctor->image }}">
                                                    <img src="{{ asset('storage/doctor').'/'.$doctor->image }}" alt="{{$doctor->name}}">
                                                </a>
                                            </figure>
                                        </div>
                                        <div class="slider-nav-thumbnails">
                                            <div><img src="{{ asset('storage/doctor').'/'.$doctor->image }}" alt="{{$doctor->name}}"></div>
                                            <div><img src="{{ asset('storage/doctor').'/'.$doctor->image }}" alt="{{$doctor->name}}"></div>
                                        </div>
                                    </div>
                                 

                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info pr-30 pl-30">
                                        <h2 class="title-detail">{{$doctor->name}}</h2>
                                        <div class="font-xs">

                                            <ul class="mr-50 float-start">
                                                <li class="mb-5">
                                                    <span class="d-inline-block me-1">Specialist:</span>
                                                    <a href="#">MBBS</a>, 
                                                    <a href="#">MBBS &amp; MBBS</a>,
                                                     <a href="#" >MBBS</a>,
                                                      <a href="#">MBBS</a>
                                                </li>
                                                <li class="mb-5">
                                                    <span class="d-inline-block me-1">Exp.:</span>
                                                    <a href="#" rel="tag">5 Years</a>
                                                </li>

                                                <li class="mb-5">
                                                    <span class="d-inline-block me-1">Exp:</span>
                                                    <a href="#" >5 Years</a>
                                                </li>
                                            </ul>
                                        </div>
                                        {{-- <div class="product-detail-rating">
                                            <a href="#Reviews">
                                                <div class="product-rate-cover text-end">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 62%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted">(10 reviews)</span>
                                                </div>
                                            </a>
                                        </div> --}}
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                <span class="current-price text-brand">200  </span>
                                                
                                            </div>
                                        </div>
     
                                        <div class="short-desc mb-30">
                                            <p>{{$doctor->short_description}}</p>
                                        </div>

                                        <form class="add-to-cart-form" method="POST">
                                           @csrf
                                            <div class="pr_switch_wrap">
                                                <div class="product-attributes"
                                                    data-target="haagen-dazs-caramel-cone-ice-cream.html">
                                                    <div class="text-swatches-wrapper attribute-swatches-wrapper attribute-swatches-wrapper form-group product__attribute product__color"
                                                        data-type="text">
                                                        <label class="attribute-name">Select Date</label>
                                                        <div class="attribute-values">
                                                            <ul class="text-swatch attribute-swatch color-swatch">
                                                                @php
                                                                    use Carbon\Carbon;
                                                                    $today = Carbon::now(); // Current date
                                                                @endphp
                                                            
                                                                @for ($i = 1; $i <= 7; $i++) 
                                                                    @php
                                                                        $date = $today->copy()->addDays($i)->format('Y-m-d'); // Get next dates in Y-m-d format
                                                                        $displayDate = $today->copy()->addDays($i)->format('d M Y'); // Display format (e.g., 03 Mar 2025)
                                                                    @endphp
                                                                    <li data-slug="day{{$i}}" data-id="{{$i}}" class="attribute-swatch-item">
                                                                        <div>
                                                                            <label>
                                                                                <input class="product-filter-item" type="radio" name="attribute_weight_1907920428" value="{{$date}}" {{ $i == 1 ? 'checked' : '' }}>
                                                                                <span>{{ $displayDate }}</span>
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                @endfor
                                                            </ul>
                                                            
                                                        </div>
                                                    </div>
                                                    {{-- another box --}}
                                                    {{-- <div class="text-swatches-wrapper attribute-swatches-wrapper attribute-swatches-wrapper form-group product__attribute product__color"
                                                        data-type="text">
                                                        <label class="attribute-name">Boxes</label>
                                                        <div class="attribute-values">
                                                            <ul class="text-swatch attribute-swatch color-swatch">
                                                                <li data-slug="1-box" data-id="6"
                                                                    class="attribute-swatch-item  pe-none ">
                                                                    <div>
                                                                        <label>
                                                                            <input class="product-filter-item"  type="radio" name="attribute_boxes_1907920428" value="6">
                                                                            <span>1 Box</span>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                                <li data-slug="2-boxes" data-id="7"
                                                                    class="attribute-swatch-item ">
                                                                    <div>
                                                                        <label>
                                                                            <input class="product-filter-item" type="radio" name="attribute_boxes_1907920428" value="7" checked>
                                                                            <span>2 Boxes</span>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                                <li data-slug="5-boxes" data-id="10"
                                                                    class="attribute-swatch-item  pe-none ">
                                                                    <div>
                                                                        <label>
                                                                            <input class="product-filter-item" type="radio" name="attribute_boxes_1907920428" value="10">
                                                                            <span>5 Boxes</span>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div> --}}

                                                    {{-- another box --}}
                                                </div>

                                            </div>

                                            <div class="pr_switch_wrap" id="product-option"></div>

                                            <div style="margin-bottom: 20px;">
                                                <label class="me-1">Availability: </label>
                                                <span class="number-items-available">
                                                    <span class="text-success"> available
                                                    </span>
                                                </span>
                                            </div>

                                            <input type="hidden" name="id" class="hidden-product-id" value="{{$doctor->id}}" />
                                            <div class="detail-extralink mb-30">
                                                <div class="product-extra-link2  has-buy-now-button ">
                                                    <button type="submit" class="button button-add-to-cart "><i class="ri-book-open-line"></i>Book Now</button>
                                                  
                                                </div>
                                            </div>
                                        </form>
                                   
                                    </div>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="tab-style3">
                                    <ul class="nav nav-tabs text-uppercase">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                                href="#Description">Description</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a class="nav-link" id="specification-tab" data-bs-toggle="tab"
                                                href="#tab-specification">Specification</a>
                                        </li> --}}
                                        <li class="nav-item">
                                            <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab"
                                                href="#Reviews">Reviews (10)</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab-vendor">Vendor</a>
                                        </li>

                                      
                                    </ul>
                                    <div class="tab-content shop_info_tab entry-main-content">
                                        <div class="tab-pane fade show active" id="Description">
                                            <div class="ck-content">
                                                <p>{{$doctor->description}}</p>
                                              

                                               

                                            </div>
                                            <div class="facebook-comment">
                                                <div class="fb-comments" data-href="https://ecommerce12.testsoftwares.site/products/haagen-dazs-caramel-cone-ice-cream"
                                                    data-numposts="5" data-width="100%"></div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="tab-specification">
                                           
                                        </div>

                                        <div class="tab-pane fade" id="tab-vendor">
                                            
                                        
                                        </div>
                               
                                    </div>
                                </div>
                            </div>
                            <div class="mt-60">
                                <h3 class="section-title style-1 mb-30">You may also like</h3>

                                <div class="row">
                                    @foreach ($similar_doctor as $item)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                            data-wow-delay="0.1s">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="{{ route('doctor.detail', ['id'=>Crypt::encrypt($item->id)]) }}">
                                                        <img class="default-img" src="{{ asset('storage/doctor').'/'.$item->image }}" alt="{{$item->name}}">
                                                        <img class="hover-img" src="{{ asset('storage/doctor').'/'.$item->image }}" alt="{{$item->name}}">
                                                    </a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="#">Specailist</a>
                                                </div>
                                                <h2 class="text-truncate">
                                                    <a href="{{ route('doctor.detail', ['id'=>Crypt::encrypt($item->id)]) }}" title="{{$item->name}}">{{$item->name}}</a></h2>

                                                {{-- <div class="product-rate-cover">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 70%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted">(10)</span>
                                                </div> --}}
                                                <div class="text-truncate">
                                                    <span class="font-small text-muted">Exp.
                                                       5 years</span>
                                                </div>
                                                <div class="text-truncate">
                                                    <span class="font-small text-muted">Specialist
                                                      MBBS</span>
                                                </div>

                                                <div class="product-card-bottom d-md-flex d-block">
                                                    <div class="product-price">
                                                        <span>200</span>
                                                    </div>
                                                    <div class="add-cart">
                                                        <a aria-label="Add To Cart" class="action-btn add-to-cart-button add mt-md-0 mt-3"
                                                            href="{{ route('doctor.detail', ['id'=>Crypt::encrypt($item->id)]) }}">
                                                            <i class="fi-rs-shopping-cart mr-5"></i> <span
                                                                class="d-inline-block">Book Now</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>


                         {{-- similar docotrs area start --}}
                            <div class="mt-60">
                                <h3 class="section-title style-1 mb-30">Similar Doctors</h3>

                                <div class="row">
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                            data-wow-delay="0.1s">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a
                                                        href="signature-wood-fired-mushroom-and-caramelized-digital.html">
                                                        <img class="default-img"
                                                            src="../storage/products/24-400x400.jpg"
                                                            alt="Signature Wood-Fired Mushroom and Caramelized (Digital)">
                                                        <img class="hover-img"
                                                            src="../storage/products/24-1-400x400.jpg"
                                                            alt="Signature Wood-Fired Mushroom and Caramelized (Digital)">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <div class="product-action-wrap"
                                                        style="max-width: 116px !important;">
                                                        <a aria-label="Quick View" href="#"
                                                            class="action-btn hover-up js-quick-view-button"
                                                            data-url="../index.html">
                                                            <i class="fi-rs-eye"></i>
                                                        </a>
                                                        <a aria-label="Add To Wishlist" href="#"
                                                            class="action-btn hover-up js-add-to-wishlist-button"
                                                            data-url="../wishlist/24.html">
                                                            <i class="fi-rs-heart"></i>
                                                        </a>
                                                        <a aria-label="Add To Compare" href="#"
                                                            class="action-btn hover-up js-add-to-compare-button"
                                                            data-url="../compare/24.html">
                                                            <i class="fi-rs-shuffle"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div
                                                    class="product-badges product-badges-position product-badges-mrg">
                                                    <span style="background-color: #fe9931 !important;">Sale</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="../product-categories/diet-foods.html">Diet Foods</a>
                                                </div>
                                                <h2 class="text-truncate"><a
                                                        href="signature-wood-fired-mushroom-and-caramelized-digital.html"
                                                        title="Signature Wood-Fired Mushroom and Caramelized (Digital)"
                                                        title="Signature Wood-Fired Mushroom and Caramelized (Digital)">Signature
                                                        Wood-Fired Mushroom and Caramelized (Digital)</a></h2>

                                                <div class="product-rate-cover">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 70%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted">(10)</span>
                                                </div>
                                                <div class="text-truncate">
                                                    <span class="font-small text-muted">Sold By <a
                                                            href="../stores/young-shop.html">Young Shop</a></span>
                                                </div>

                                                <div class="product-card-bottom d-md-flex d-block">


                                                    <div class="product-price">
                                                        <span>₦1,184,531.17</span>
                                                        <span class="old-price">₦1,668,353.76</span>
                                                    </div>



                                                    <div class="add-cart">
                                                        <a aria-label="Add To Cart"
                                                            class="action-btn add-to-cart-button add mt-md-0 mt-3"
                                                            data-id="24" data-url="../ajax/cart.html"
                                                            href="#">
                                                            <i class="fi-rs-shopping-cart mr-5"></i> <span
                                                                class="d-inline-block">Add</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                            {{-- similar docotrs area end --}}
                        </div>

                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        function toggleClipboardActionIcon(element) {
            const copiedState = element.querySelector('[data-clipboard-icon="copy"]');
            const copyState = element.querySelector('[data-clipboard-icon="copied"]');

            copiedState.style.display = 'none';
            copyState.style.display = 'inline-block';

            setTimeout(function() {
                copiedState.style.display = 'inline-block';
                copyState.style.display = 'none';
            }, 3000);
        }

        document.querySelectorAll('[data-bb-toggle="social-sharing-clipboard"]').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();

                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(element.dataset.clipboardText).then(
                function() {
                        toggleClipboardActionIcon(element);
                    });
                } else {
                    const input = document.createElement('input');
                    input.value = element.dataset.clipboardText;
                    document.body.appendChild(input);
                    input.select();
                    document.execCommand('copy');
                    document.body.removeChild(input);

                    toggleClipboardActionIcon(element);
                }
            });
        });
    });
</script>
@endsection

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

    .available-info li {
    color: black;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    margin-bottom: 2px;
}
</style>
<main class="main" id="main-section">
    <!--<div class="page-header breadcrumb-wrap">-->
    <!--    <div class="container">-->
    <!--        <div class="breadcrumb">-->
    <!--            <div class="breadcrumb-item d-inline-block">-->
    <!--                <a href="#"title="Home"> Home </a>-->
    <!--            </div>-->
    <!--            {{-- <span></span>-->
    <!--            <div class="breadcrumb-item d-inline-block">-->
    <!--                <a href="#"title="Products"> Products-->
    <!--                </a>-->
    <!--            </div>-->
    <!--            <span></span>-->
    <!--            <div class="breadcrumb-item d-inline-block">-->
    <!--                <a href="#"title="Pet Foods">  Pet Foods-->
    <!--                </a>-->
    <!--            </div> --}}-->
              
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->


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
                                            {{-- <figure class="border-radius-10">
                                                <a href="{{ asset('storage/doctor').'/'.$doctor->image }}">
                                                    <img src="{{ asset('storage/doctor').'/'.$doctor->image }}" alt="{{$doctor->name}}">
                                                </a>
                                            </figure> --}}
                                        </div>
                                        {{-- <div class="slider-nav-thumbnails">
                                            <div><img src="{{ asset('storage/doctor').'/'.$doctor->image }}" alt="{{$doctor->name}}"></div>
                                            <div><img src="{{ asset('storage/doctor').'/'.$doctor->image }}" alt="{{$doctor->name}}"></div>
                                        </div> --}}
                                    </div>
                                    <div class="short-desc mb-30">
                                        <p>{{$doctor->short_description}}</p>
                                    </div>
                                 

                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info pr-30 pl-30">
                                        <h2 class="title-detail" style="margin-bottom: 10px;color: #198754;">{{$doctor->name}}</h2>
                                       
                                        <ul class="available-info">
                                            <li>
        
                                                Specialist: {{backHelper::Get_SpecilastName($doctor->category_id )}} 
                                            </li>
                                            <li>
        
                                                <i class="fa fa-map-marker-alt"></i> {{$doctor->city_name }}
                                            </li>
        
                                            <li> <i class="far fa-clock"></i>  {{$doctor->experience}} Years of Experience
                                            </li>
        
                                            <li>
                                                <i class="fas fa-clinic-medical"></i> {{$doctor->hospital_name }}
                                            </li>
        
                                        </ul>
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                <span class="current-price text-brand">₹ {{$doctor->price}}  </span>
                                                
                                            </div>
                                        </div>
     
                                       

                                        <form  action="{{ route('booking.submit') }}" method="POST">
                                            @csrf
                                            <div class="pr_switch_wrap">
                                                <div class="product-attributes" data-target="haagen-dazs-caramel-cone-ice-cream.html">
                                                    <div class="text-swatches-wrapper attribute-swatches-wrapper attribute-swatches-wrapper form-group product__attribute product__color" data-type="text">
                                                        <label class="attribute-name">Select Date</label>
                                                        <div class="attribute-values">
                                                            <ul class="text-swatch attribute-swatch color-swatch">
                                                                 <input type="hidden" name="doctor_id" class="hidden-product-id" value="{{$doctor->id}}" />
                                                                 @foreach ($slots as $item)
                                                                   
                                                                    <li data-slug="day{{$item->id}}" data-id="{{$item->id}}" class="attribute-swatch-item">
                                                                        <div>
                                                                            <label>
                                                                                <input class="product-filter-item" type="radio" name="attribute_weight_1907920428" value="{{ $item->date }}">
                                                                                <span>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="pr_switch_wrap" id="product-option"></div>
                                          @if(count($slots)>0)
                                            <div style="margin-bottom: 20px;">
                                                <label class="me-1">Availability: </label>
                                                <span class="number-items-available">
                                                    <span class="text-success" id="availability-status"> 
                                                    </span>
                                                </span>
                                            </div>
                                            @else
                                            <div style="margin-bottom: 20px;">
                                                <label class="me-1">Availability: </label>
                                                <span class="number-items-available">
                                                    <span class="text-success" id="notavail">Not Available
                                                    </span>
                                                </span>
                                            </div>
                                            @endif
                                            <input type="hidden" name="doctor_id" class="hidden-product-id" value="{{$doctor->id}}" />
                                        
                                            <div class="detail-extralink mb-30">
                                                <div class="product-extra-link2  has-buy-now-button ">
                                                    {{-- Button is initially hidden --}}
                                                    <button type="submit" class="button" id="book-now-btn" style="display:none;">
                                                        <i class="ri-book-open-line"></i> Book Appointment
                                                    </button>
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

                                        {{-- <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab-vendor">Vendor</a>
                                        </li> --}}

                                      
                                    </ul>
                                    <div class="tab-content shop_info_tab entry-main-content">
                                        <div class="tab-pane fade show active" id="Description">
                                            <div class="ck-content">
                                                <p>{{$doctor->description}}</p>
                                              

                                               

                                            </div>
                                            <div class="facebook-comment">
                                                <div class="fb-comments" data-href="#" data-numposts="5" data-width="100%"></div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="tab-specification">
                                           
                                        </div>

                                        <div class="tab-pane fade" id="tab-vendor">
                                            
                                        
                                        </div>
                               
                                    </div>
                                </div>
                            </div>
                              {{-- similar docotrs area start --}}
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
                                                        <img class="default-img" src="{{ asset('storage/doctor').'/'.$item->image }}" alt="{{$item->name}}" style="height: 200px;">
                                                        <img class="hover-img" src="{{ asset('storage/doctor').'/'.$item->image }}" alt="{{$item->name}}" style="height: 200px;">
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
                                                         {{$item->price}} years</span>
                                                </div>
                                                <div class="text-truncate">
                                                    <span class="font-small text-muted">Specialist
                                                      MBBS</span>
                                                </div>

                                                <div class="product-card-bottom d-md-flex d-block">
                                                    <div class="product-price">
                                                        <span>₹ {{$item->price}}</span>
                                                    </div>
                                                    <div class="add-cart">
                                                        <a aria-label="Add To Cart" class="action-btn   add mt-md-0 mt-3"
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


                       
                          
                            {{-- similar docotrs area end --}}
                        </div>

                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Include jQuery (make sure this is before your custom scripts) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Handle date selection change
    $('input[name="attribute_weight_1907920428"]').on('change', function() {
        var selectedDate = $(this).val();  // Get the selected date
        var doctorId = '{{ $doctor->id }}';  // Doctor's ID

        // AJAX request to check availability
        $.ajax({
            url: '{{ route("check.availability") }}',  // Route to check availability
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                doctor_id: doctorId,
                selected_date: selectedDate
            },
            success: function(response) {
                if (response.isAvailable) {
                    $('#availability-status').text('Available');
                    $('#book-now-btn').show();  // Show the Book Now button
                } else {
                    $('#availability-status').text('Not Available');
                    $('#book-now-btn').hide();  // Hide the Book Now button
                }
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    });
</script>

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

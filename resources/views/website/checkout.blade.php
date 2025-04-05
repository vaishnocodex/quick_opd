@extends('website.master3') 
@section('content')
<style>
footer .hotline {
    min-width: 200px;
}

select.form-control {
    -webkit-appearance: inherit;
    -moz-appearance: inherit;
    appearance: auto;
    height: 60px;
}
    </style>

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('welcome')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                
                <span></span> Checkout
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h2 class="heading-2 mb-10">Payment Page</h2>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">Please fill detail and pay amount either online or offline</h6>
                </div>
            </div>
        </div>
        <form method="POST" action="#">
            @csrf
            <div class="row">
                <!-- Billing Details -->
                <div class="col-lg-7">
                    <h4 class="mb-30">Billing Details</h4>
        
                    <div class="form-group col-lg-12">
                        <input type="text" name="full_name" required placeholder="Full Name *" value="{{ old('full_name') }}">
                    </div>
        
                    <div class="form-group col-lg-12">
                        <input type="text" name="father_name" required placeholder="Father Name *" value="{{ old('father_name') }}">
                    </div>
        
                    <div class="form-group col-lg-6">
                        <select class="form-control select-active" name="gender" required>
                            <option value="">Gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
        
                    <div class="form-group col-lg-6">
                        <input type="number" name="age" required placeholder="Age" value="{{ old('age') }}">
                    </div>
        
                    <div class="form-group col-lg-12">
                        <input type="number" name="mobile" required placeholder="Contact Number *" value="{{ old('mobile') }}">
                    </div>
        
                    <div class="form-group col-lg-12">
                        <input type="email" name="email" required placeholder="Email Address *" value="{{ old('email') }}">
                    </div>
                </div>
        
                <!-- Booking and Payment -->
                <div class="col-lg-5">
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <h4>Your Booking Detail</h4>
                        <div class="divider-2 mb-30"></div>
        
                        <div class="table-responsive order_table checkout">
                            <table class="table no-border">
                                <tbody>
                                    <tr>
                                        <td class="image product-thumbnail">
                                            <img src="{{ asset('assets/imgs/shop/product-1-1.jpg') }}" alt="#">
                                        </td>
                                        <td>
                                            <h6 class="w-160 mb-5">
                                                <a href="#" class="text-heading">Dr. John Doe</a>
                                            </h6>
                                            <p class="text-muted">Specialist: Cardiology</p>
                                        </td>
                                        <td>
                                            <h4 class="text-brand">$150</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
        
                    <div class="payment ml-30">
                        <h4 class="mb-30">Payment</h4>
                        <div class="payment_option">
                            <div class="custome-radio">
                                <input class="form-check-input" type="radio" name="payment_option" value="cash" id="cash" required>
                                <label class="form-check-label" for="cash">Cash on Counter</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" type="radio" name="payment_option" value="online" id="online" required>
                                <label class="form-check-label" for="online">Online Pay</label>
                            </div>
                        </div>
                        <div class="payment-logo d-flex mt-2">
                            <img class="mr-15" src="{{ asset('assets/imgs/theme/icons/payment-paypal.svg') }}" alt="">
                            <img class="mr-15" src="{{ asset('assets/imgs/theme/icons/payment-visa.svg') }}" alt="">
                            <img class="mr-15" src="{{ asset('assets/imgs/theme/icons/payment-master.svg') }}" alt="">
                            <img src="{{ asset('assets/imgs/theme/icons/payment-zapper.svg') }}" alt="">
                        </div>
        
                        <button type="submit" class="btn btn-fill-out btn-block mt-30">
                            Place an Order <i class="fi-rs-sign-out ml-15"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</main>


@endsection
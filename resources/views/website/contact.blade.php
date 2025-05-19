@extends('website.master3')
@section('content')
@php  $firm_detail=backHelper::get_fimddetails(); @endphp
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Contact Us
            </div>
        </div>
    </div>

    <div class="page-content pt-50">
        <div class="container">
            <div class="row mb-50">
                <div class="col-lg-6">
                    <h4 class="text-brand mb-20">Get in Touch</h4>
                    <p>If you have any questions or would like to book an appointment manually, contact us using the form below or through our contact details.</p>
                    <ul class="contact-infos">
                        <li><strong>Address:</strong>{{$firm_detail->address}}</li>
                        <li><strong>Phone:</strong> +91 {{$firm_detail->mobile}}</li>
                        <li><strong>Email:</strong> {{$firm_detail->email}}</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="telephone" class="form-control" placeholder="Your Phone" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="message" class="form-control" rows="4" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
           <section class="container mb-50 d-none d-md-block">
                <div class="border-radius-15 overflow-hidden">
                  <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3496.103654863342!2d76.14162991440112!3d28.805984782349647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391266d010a00e29%3A0x5d0345140b733055!2sZoo%20Rd%2C%20Bhiwani%2C%20Haryana%20127021!5e0!3m2!1sen!2sin!4v1626352423401!5m2!1sen!2sin"
                            width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </section>
         
        </div>
    </div>
</main>

@endsection

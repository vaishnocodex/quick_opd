@extends('website.master3')
@section('content')
@php  $firm_detail=backHelper::get_fimddetails(); @endphp

<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('welcome')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span>FAQ
            </div>
        </div>
    </div>
    <div class="page-content pt-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="single-page pr-30 mb-lg-0 mb-sm-5">
                                <div class="single-header style-2">
                                    <h2>Frequently Asked Questions (FAQ)</h2>
                                </div>
                                <div class="single-content mb-50">
                                    <h4>General Questions</h4>
                                    <ol>
                                        <li>
                                            <strong>What is QuipOPD?</strong><br>
                                            QuipOPD is a platform that helps patients book appointments with doctors and radiology services (lab tests) either online or offline.
                                        </li>
                                        <li>
                                            <strong>Do you provide medical treatment?</strong><br>
                                            No. We provide appointment booking services only. The consultation and treatment are handled directly by the hospital or doctor.
                                        </li>
                                        <li>
                                            <strong>How do I book an appointment?</strong><br>
                                            You can book an appointment via our website by selecting your preferred doctor or lab test and choosing your preferred time slot.
                                        </li>
                                    </ol>

                                    <h4>Doctor Appointments</h4>
                                    <ol>
                                        <li>
                                            <strong>Can I book an offline doctor appointment?</strong><br>
                                            Yes, you can book an offline appointment and pay in cash at the hospital counter.
                                        </li>
                                        <li>
                                            <strong>Do you offer online consultations?</strong><br>
                                            Yes, if the doctor offers online consultation, you will see that option when booking.
                                        </li>
                                        <li>
                                            <strong>Are appointments confirmed instantly?</strong><br>
                                            Appointment confirmation depends on doctor availability. You will receive a confirmation message or call shortly after booking.
                                        </li>
                                    </ol>

                                    <h4>Lab / Radiology Services</h4>
                                    <ol>
                                        <li>
                                            <strong>What types of tests can I book?</strong><br>
                                            You can book common lab tests, radiology scans, and diagnostics depending on available hospital services.
                                        </li>
                                        <li>
                                            <strong>Do I need a doctor’s prescription for tests?</strong><br>
                                            Some tests may require a prescription. The requirement will be shown on the test booking page.
                                        </li>
                                        <li>
                                            <strong>Can I book tests for home sample collection?</strong><br>
                                            This depends on the hospital’s facility. If home sample collection is available, it will be mentioned during booking.
                                        </li>
                                    </ol>

                                    <h4>Payments & Support</h4>
                                    <ol>
                                        <li>
                                            <strong>What payment methods are accepted?</strong><br>
                                            We support digital payments for online bookings. Cash is accepted for offline appointments at the hospital counter.
                                        </li>
                                        <li>
                                            <strong>How can I contact support?</strong><br>
                                            You can reach our support team at <strong class="text-blue-600">{{ $firm_detail->phone ?? 'N/A' }}</strong> for any questions or issues.
                                        </li>
                                        <li>
                                            <strong>Can I cancel or reschedule my appointment?</strong><br>
                                            Yes. Please contact us or the respective hospital at least 24 hours in advance to request rescheduling or cancellation.
                                        </li>
                                    </ol>

                                    <p class="text-gray-700 leading-relaxed mt-6">
                                        Still have questions? Contact us at <strong class="text-blue-600">{{ $firm_detail->phone ?? 'N/A' }}</strong> and we'll be happy to help.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

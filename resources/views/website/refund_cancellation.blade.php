@extends('website.master3')
@section('content')
    @php $firm_detail = backHelper::get_fimddetails(); @endphp
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Terms and Conditions
                </div>
            </div>
        </div>

        <div class="page-content pt-50">
            <div class="container">
                <div class="row mb-50">
                    <div class="col-lg-12">
                        <h4 class="text-brand mb-20">Cancellation and Refund Policy</h4>
                        <p>At <strong>QuickOPD Pvt Ltd Hospital</strong>, we are committed to delivering high-quality
                            healthcare services. To maintain transparency and integrity in our financial dealings, we have
                            established the following Cancellation and Refund Policy.</p>

                        <h3>1. Appointment Cancellation</h3>
                        <h5>Video/Online Consultations</h5>
                        <ul>
                            <li>Patients may book, reschedule, or cancel online consultations free of charge any time before
                                the scheduled consultation time.</li>
                            <li>Rescheduling is also allowed after the consultation time, subject to doctor availability.
                            </li>
                            <li><em>(Legal Basis: HIPAA - Article 4)</em></li>
                        </ul>

                        <h5>Clinic-Visit/Physical Consultations</h5>
                        <ul>
                            <li>Patients may book, reschedule, or cancel physical consultations free of charge any time
                                before the scheduled consultation time.</li>
                            <li>Rescheduling is also allowed after the appointment time, subject to clinic availability.
                            </li>
                        </ul>

                        <h3>2. Refund Policy for Online Consultations</h3>
                        <p>Payments for online consultations are processed via secure third-party providers such as
                            Razorpay. 'Pay at clinic' is not applicable for online consultations.</p>

                        <h5>Refund Eligibility</h5>
                        <ul>
                            <li>Refunds are granted if the consultation did not take place due to any of the following
                                reasons:</li>
                            <ul>
                                <li><strong>Patient No-Show:</strong> The patient did not join the scheduled consultation.
                                </li>
                                <li><strong>Doctor No-Show:</strong> The doctor was unavailable for the scheduled
                                    consultation.</li>
                                <li><strong>Technical Issues:</strong> Either party was unable to join due to technical
                                    problems.</li>
                            </ul>
                            <li><em>(Legal Basis: Consumer Protection Act - Article 12)</em></li>
                        </ul>

                        <h5>Refund Process</h5>
                        <ul>
                            <li>Refunds will be processed using the original mode of payment.</li>
                            <li><em>(Legal Basis: Consumer Protection Act - Article 6)</em></li>
                        </ul>

                        <h5>Refund Timelines</h5>
                        <ul>
                            <li>Refunds will be initiated within 7–10 working days from the receipt of a valid request.</li>
                            <li>Timelines may vary depending on banking processes and regulatory guidelines. Business days
                                exclude Saturdays, Sundays, and public holidays.</li>
                            <li><em>(Legal Basis: Consumer Protection Act - Article 15)</em></li>
                        </ul>

                        <h3>3. Refund Policy for Clinic Visits</h3>
                        <ul>
                            <li>Payments made at the clinic will be refunded directly at the clinic counter.</li>
                            <li><em>(Legal Basis: Payment and Settlement Systems Act - Article 8)</em></li>
                        </ul>

                        <h3>4. Modifications in Pricing</h3>
                        <ul>
                            <li>QuickOPD Pvt Ltd reserves the right to revise pricing at any time before billing, including
                                for initial and subsequent payments.</li>
                            <li><em>(Legal Basis: Consumer Protection Act - Article 21)</em></li>
                        </ul>

                        <h3>5. Contact Information for Refund Requests</h3>
                        <p>For any refund-related queries, please contact us through one of the following official channels:
                        </p>
                        <ul>
                            <li>Email: <a href="mailto:iaushdhalya@gmail.com">iaushdhalya@gmail.com</a></li>
                            <li>Email: <a href="mailto:info@iaushdhalya.com">info@iaushdhalya.com</a></li>
                            <li>Phone: <strong>9992223039</strong></li>
                        </ul>

                        <h3>6. Disclaimer</h3>
                        <p>QuickOPD Pvt Ltd shall not be held liable for any delay in refunds caused by third-party payment
                            processors, technical failures, or other circumstances beyond its control.</p>

                        <h3>7. Agreement and Revisions</h3>
                        <ul>
                            <li>By availing our services, patients agree to abide by the terms of this Cancellation and
                                Refund Policy.</li>
                            <li>QuickOPD Pvt Ltd reserves the right to update or revise this policy at any time. Any changes
                                will be communicated as required by law.</li>
                        </ul>
                    </div>
                </div>

            </div>


        </div>
        </div>
    </main>

@endsection
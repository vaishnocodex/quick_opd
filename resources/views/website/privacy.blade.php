@extends('website.master3')
@section('content')
@php  $firm_detail=backHelper::get_fimddetails(); @endphp

<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('welcome')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span>Privacy Policy
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
                                    <h2>Privacy Policy</h2>
                                </div>
                                <div class="single-content mb-50">
                                    <h4>Welcome to Our Privacy Policy</h4>
                                    <ol start="1">
                                        <li>This Privacy Policy outlines how <strong>QuipOPD</strong> collects, uses, protects, and shares your personal information.</li>
                                        <li>By using our services, you agree to the practices described in this policy.</li>
                                    </ol>

                                    <h4>1. Information We Collect</h4>
                                    <ol>
                                        <li>Personal identification information (name, contact details, date of birth, etc.).</li>
                                        <li>Medical records and history provided by you or authorized sources.</li>
                                        <li>Usage data (browser type, pages visited, session duration).</li>
                                    </ol>

                                    <h4>2. How We Use Your Information</h4>
                                    <ol>
                                        <li>To provide medical consultation and services.</li>
                                        <li>To improve service quality and patient experience.</li>
                                        <li>To contact you regarding appointments, updates, or support.</li>
                                    </ol>

                                    <h4>3. Sharing Your Information</h4>
                                    <ol>
                                        <li>We do not sell your personal data.</li>
                                        <li>We may share information with:
                                            <ul>
                                                <li>Licensed medical professionals involved in your care.</li>
                                                <li>Authorized partners under confidentiality agreements.</li>
                                                <li>Legal authorities if required by law.</li>
                                            </ul>
                                        </li>
                                    </ol>

                                    <h4>4. Data Security</h4>
                                    <ol>
                                        <li>We implement technical and organizational measures to protect your information from unauthorized access, alteration, disclosure, or destruction.</li>
                                    </ol>

                                    <h4>5. Data Retention</h4>
                                    <ol>
                                        <li>We retain your data only as long as necessary to fulfill the purposes outlined in this policy, or as required by law.</li>
                                    </ol>

                                    <h4>6. Your Rights</h4>
                                    <ol>
                                        <li>You have the right to access, update, or delete your personal information.</li>
                                        <li>You may request to restrict or object to certain data uses.</li>
                                    </ol>

                                    <h4>7. Cookies and Tracking</h4>
                                    <ol>
                                        <li>We may use cookies to enhance your user experience and track usage statistics.</li>
                                    </ol>

                                    <h4>8. Contact Information</h4>
                                    <ol>
                                        <li>If you have questions or concerns about this Privacy Policy, please contact us at:
                                            <strong class="text-blue-600">{{ $firm_detail->phone ?? 'N/A' }}</strong>
                                        </li>
                                    </ol>

                                    <p class="text-gray-700 leading-relaxed mt-6">
                                        By continuing to use our services, you acknowledge that you have read, understood, and agreed to this Privacy Policy.
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

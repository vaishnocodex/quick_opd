@extends('website.master3')
@section('content')
@php  $firm_detail=backHelper::get_fimddetails(); @endphp

  <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('welcome')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span>Terms and Conditions
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
                                        <h2>Terms and Conditions</h2>
                                        
                                    </div>
                                    <div class="single-content mb-50">
                                        <h4>Welcome to Terms and Conditions</h4>
                                        <ol start="1">
                                            <li>   By using <strong>QuipOPD</strong>, you agree to abide by the following terms and conditions. These terms are 
                                                    designed to ensure safety, transparency, and accountability for both patients and our medical team.</li>
                                            <li>Whenrgfgjjkhj</li>
                                            
                                        </ol>
                                        <h4>Medical Reports & Responsibility </h4>
                                        <ol start="1">
                                            <li>If a patient does not submit their diagnostic test reports to QuipOPD or the attending doctor and proceeds with treatment, the patient shall bear full responsibility for any resulting risks or complications.</li>
                                            <li>The company is committed to resolving issues within its capacity and scope of service.</li>
                                        </ol>
                                        <h4>Disclosure of Medical History </h4>
                                         <ol start="1">   <li>Patients are required to provide a complete and accurate medical history before starting treatment.</li>
                                            
                                        </ol>
                                        <h4>Treatment Satisfaction </h4>
                                        <ol>
                                             <li>Patients have the right to consult with our medical team until they feel fully satisfied with the treatment guidance.</li>
                                        </ol>
                                        <h4>Medicine Usage & Compliance </h4>
                                         <ol start="1">    
                                             <li>Patients must use all prescribed medicines and follow medical advice exactly as directed by the QuipOPD doctors.</li>
                                        </ol>
                                        <h4> Payment Policy </h4>
                                         <ol start="1">
                                            
                                           <li>Only digital payment methods are accepted for all services offered by QuipOPD.</li>
                                            
                                        </ol>
                                         <h4>Support and Queries</h4>
                                        <ol start="1">
                                                <li>For any questions, concerns, or support requests, patients may contact us at: <strong class="text-blue-600">{phone number}</strong>.</li>
                                        </ol>

                                            <h4> Disciplinary Conduct</h4>
                                            <ol start="1">
                                                <li>We expect all patients to follow these terms and guidelines strictly for an effective and respectful consultation experience.</li>
                                            </ol>
                                       <p class="text-gray-700 leading-relaxed mt-6">
                        By continuing to use our services, you acknowledge that you have read, understood, and agreed to these terms and conditions.
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

@extends('admin.master')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css">
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .profile-header {
        background-color: #f8f9fa;
        border-radius: 0.25rem;
        padding: 20px;
        margin-bottom: 20px;
    }

    .profile-img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .vital-stats-card {
        border-left: 4px solid #17a2b8;
    }

    .medication-card {
        border-left: 4px solid #28a745;
    }

    .allergies-card {
        border-left: 4px solid #dc3545;
    }

    .nav-pills .nav-link.active {
        background-color: #17a2b8;
    }

    .nav-pills .nav-link {
        color: #495057;
    }

    .section-title {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 10px;
        margin-bottom: 20px;
        color: #17a2b8;
    }
</style>
<style>
    .timeline-item {
        border-left: 4px solid #007bff;
        margin-left: 10px;
        padding-left: 15px;
        margin-bottom: 20px;
    }

    .timeline-date {
        font-weight: bold;
        color: #007bff;
        margin-bottom: 5px;
    }

    .timeline-content {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 6px;
    }
</style>


<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->


        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-12 px-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Patient Profile</h1>
                <div class="btn-toolbar mb-2 mb-md-0" hidden>
                    <button class="btn btn-sm btn-outline-secondary mr-2">
                        <i class="fas fa-print"></i> Print
                    </button>
                    <button class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-edit"></i> Edit Profile
                    </button>
                </div>
            </div>

            <!-- Patient Header -->
            <div class="profile-header">
                <div class="row">
                    <div class="col-md-2 text-center">
                        <img src="https://via.placeholder.com/150" alt="Patient Photo"
                            class="profile-img rounded-circle mb-2">
                        <div class="status-badge">
                            <span class="badge badge-success">Active</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>{{ $patient->pa_name }}</h3>
                        {{-- <p class="text-muted"><i class="fas fa-id-card mr-2"></i> MR-0054879</p> --}}
                        <p><i class="fas fa-birthday-cake mr-2"></i> {{ $patient->age }}, {{ $patient->gender }}<span
                                class="mx-2">|</span> <i class="fas fa-phone mr-2"></i>{{ $patient->contact_no }}</p>
                        <p><i class="fas fa-envelope mr-2"></i>{{ $patient->email }}</p>
                        <p><i class="fas fa-map-marker-alt mr-2"></i> {{ $patient->email }}</p>
                    </div>
                    <div class="col-md-4" hidden>
                        <div class="card vital-stats-card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Vital Stats</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="mb-1"><small>Blood Type</small></p>
                                        <h6>O+</h6>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-1"><small>Height</small></p>
                                        <h6>5'9"</h6>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <p class="mb-1"><small>Weight</small></p>
                                        <h6>172 lbs</h6>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-1"><small>BMI</small></p>
                                        <h6>25.4</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <ul class="nav nav-pills mb-4" id="patientTab" role="tablist">
                {{-- <li class="nav-item">
                    <a class="nav-link active" id="overview-tab" data-toggle="pill" href="#overview"
                        role="tab">Overview</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link active" id="medical-tab" data-toggle="pill" href="#medical" role="tab">Medical
                        History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="appointments-tab" data-toggle="pill" href="#appointments"
                        role="tab">Appointments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="documents-tab" data-toggle="pill" href="#documents" role="tab">Documents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="billing-tab" data-toggle="pill" href="#billing" role="tab">Billing</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="patientTabContent">
                <!-- Overview Tab -->
                {{-- <div class="tab-pane fade" id="overview" role="tabpanel">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <!-- Current Medications -->
                            <div class="card medication-card mb-4">
                                <div class="card-body">
                                    <h5 class="section-title"><i class="fas fa-pills mr-2"></i>Current Medications</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Lipitor (Atorvastatin)
                                            <span class="badge badge-primary badge-pill">20mg</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Metformin
                                            <span class="badge badge-primary badge-pill">500mg</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Lisinopril
                                            <span class="badge badge-primary badge-pill">10mg</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Allergies -->
                            <div class="card allergies-card mb-4">
                                <div class="card-body">
                                    <h5 class="section-title"><i class="fas fa-allergies mr-2"></i>Allergies</h5>
                                    <div class="alert alert-warning">
                                        <strong>Penicillin</strong> - Rash, difficulty breathing
                                    </div>
                                    <div class="alert alert-warning">
                                        <strong>Sulfa drugs</strong> - Hives
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <!-- Recent Visits -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="section-title"><i class="fas fa-calendar-check mr-2"></i>Recent Visits
                                    </h5>
                                    <div class="list-group">
                                        <a href="#"
                                            class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">Annual Checkup</h6>
                                                <small>3 days ago</small>
                                            </div>
                                            <p class="mb-1">Dr. Sarah Johnson</p>
                                            <small>Diagnosis: Routine examination, all normal</small>
                                        </a>
                                        <a href="#"
                                            class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">Follow-up Visit</h6>
                                                <small>2 weeks ago</small>
                                            </div>
                                            <p class="mb-1">Dr. Michael Chen</p>
                                            <small>Diagnosis: Hypertension management</small>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Upcoming Appointments -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="section-title"><i class="fas fa-calendar-alt mr-2"></i>Upcoming
                                        Appointments</h5>
                                    <div class="list-group">
                                        <a href="#"
                                            class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">Cardiology Consultation</h6>
                                                <small class="text-success">Tomorrow, 10:00 AM</small>
                                            </div>
                                            <p class="mb-1">Dr. Robert Wilson</p>
                                            <small>Main Hospital, Cardiology Dept.</small>
                                        </a>
                                        <a href="#"
                                            class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">Blood Work</h6>
                                                <small class="text-info">Next Monday, 8:30 AM</small>
                                            </div>
                                            <p class="mb-1">Lab Services</p>
                                            <small>Diagnostic Center, 2nd Floor</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Medical History Tab -->
                <div class="tab-pane fade show active" id="medical" role="tabpanel">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-12">
                                <div class="card-body">
                                    <h5 class="section-title"><i class="fas fa-history mr-2"></i>Medical History</h5>
                                    <div class="">
                                        @if($reports->count())
                                        @foreach ($reports as $value)
                                        <div class="timeline-item">
                                            <div class="timeline-date">{{
                                                \Carbon\Carbon::parse($value->created_at)->format('d-m-Y') }}</div>
                                            <div class="timeline-content">

                                                <ul>
                                                    <li><strong>Remarks:</strong> {{ $value->remarks ?? 'No additional
                                                        notes.' }}</li>
                                                    <li>
                                                        @if($value->report)
                                                        <a href="{{ asset('storage/reports/' . $value->report) }}"
                                                            target="_blank" class="text-primary">
                                                            View Report
                                                        </a>
                                                        @else
                                                        <span class="text-muted">No file available</span>
                                                        @endif
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <p class="text-muted">No reports available.</p>
                                        @endif

                                        {{-- <div class="timeline-item">
                                            <div class="timeline-date">2020</div>
                                            <div class="timeline-content">
                                                <h6>Hypertension Diagnosis</h6>
                                                <p>Blood pressure consistently elevated. Started on Lisinopril.</p>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="timeline-item">
                                            <div class="timeline-date">2018</div>
                                            <div class="timeline-content">
                                                <h6>Appendectomy</h6>
                                                <p>Emergency surgery for acute appendicitis at Boston General.</p>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="section-title"><i class="fas fa-dna mr-2"></i>Family History</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <strong>Father:</strong> Deceased at 68 - Heart Disease
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Mother:</strong> Alive, 72 - Type 2 Diabetes
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Sibling:</strong> Brother, 48 - Hypertension
                                        </li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <!-- Other tabs would go here with similar structure -->
            </div>
        </main>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"></script>
@endsection

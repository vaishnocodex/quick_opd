@extends('hospital.master')
@section('content')

@if(!empty($staff_id))
@php
$staff=backHelper::get_staff($staff_id);
@endphp
@endif
<!-- Bootstrap Select CSS -->

<div class="main-container">
    <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">All Appointment</li>
        </ol>
        <!-- Breadcrumb end -->
    </div>
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.message')
                   
                       <div class="table-container">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                   <form method="GET" action="{{ url()->current() }}" id="filterForm">
                                    <div class="row mb-3">

                                        <div class="col-md-4">
                                            <label for="doctorFilter">Filter by Doctor:</label>
                                            <select name="doctor" id="doctorFilter" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}" {{ request('doctor')==$doctor->id ?
                                                    'selected' : '' }}>
                                                    {{ $doctor->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-md-4">
                                            <label for="dateFilter">Filter by Booking Date:</label>
                                            <input type="date" name="date" id="dateFilter" class="form-control"
                                                value="{{ request('date') }}">
                                        </div>


                                        <div class="col-md-4 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-container">
                                <div class="t-header" style="text-align: center; font-size: 18px;">All Appointment</div>
                                <div class="table-responsive">
                                    <div id="copy-print-csv_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">


                                        <table id="copy-print-csv" class="table custom-table dataTable no-footer"
                                            role="grid" aria-describedby="copy-print-csv_info">
                                            <thead>
                                                <tr>
                                                    <th>Appointment No</th>
                                                    <th>Booking Date</th>
                                                    {{-- <th>Type</th> --}}
                                                    <th>Status</th>
                                                    <th>Total Amount</th>
                                                    {{-- <th>Discount</th> --}}
                                                    <th>Payment Type</th>
                                                    <th>Payment Status</th>
                                                    {{-- <th>Appointment For</th> --}}
                                                    <th>Patient Name</th>
                                                    <th>Father Name</th>
                                                    <th>Gender</th>
                                                    <th>Age</th>
                                                    <th>Contact No</th>
                                                    <th>Email</th>
                                                    <th>Hospital Name</th>
                                                    {{-- <th>Hospital Mobile</th>
                                                    <th>Hospital Address</th> --}}
                                                    <th>Doctor Name</th>
                                                    {{-- <th>Doctor Mobile</th>
                                                    <th>Doctor Address</th> --}}
                                                    {{-- <th>Created At</th>
                                                    <th>Updated At</th> --}}
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $val)
                                                <tr>
                                                    <td>{{ $val->order_id }}</td>
                                                    <td>{{ $val->booking_date }}</td>
                                                    {{-- <td>{{ ucfirst($val->type) }}</td> --}}
                                                    <td>
                                                        @if ($val->status == 0)
                                                        <span class="badge bg-warning">Processing</span>
                                                        @elseif ($val->status == 1)
                                                        <span class="badge bg-success">Confirmed</span>
                                                        @elseif ($val->status == 2)
                                                        <span class="badge bg-danger">Cancelled</span>
                                                        @else
                                                        <span class="badge bg-secondary">Unknown</span>
                                                        @endif
                                                    </td>
                                                    <td>₹{{ $val->total_amount }}</td>
                                                    {{-- <td>${{ $val->discount }}</td> --}}
                                                    <td>{{ ucfirst($val->payment_type) }}</td>
                                                    <td>{{ ucfirst($val->payment_status) }}</td>
                                                    {{-- <td>{{ ucfirst($val->appointment_for) }}</td> --}}
                                                    <td>{{ $val->pa_name }}</td>
                                                    <td>{{ $val->father_name }}</td>
                                                    <td>{{ $val->gender }}</td>
                                                    <td>{{ $val->age }}</td>
                                                    <td>{{ $val->contact_no }}</td>
                                                    <td>{{ $val->email }}</td>
                                                    <td>{{ $val->hospital_name }}</td>
                                                    {{-- <td>{{ $val->hospital_mobile }}</td>
                                                    <td>{{ $val->hospital_address }}</td> --}}
                                                    <td>{{ $val->doctor_name }}</td>
                                                    {{-- <td>{{ $val->doctor_mobile }}</td>
                                                    <td>
                                                        <pre
                                                            style="white-space: pre-wrap;">{{ $val->doctor_address }}</pre>
                                                    </td> --}}
                                                    {{-- <td>{{ $val->created_at }}</td>
                                                    <td>{{ $val->updated_at }}</td> --}}
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-primary">View</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                  
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

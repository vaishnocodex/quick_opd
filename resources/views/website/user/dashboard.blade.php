@extends('website.master3')
@section('content')
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('welcome')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        @include('website.user.sidebar')
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade {{ $status ? '' : 'active show' }}" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Hello {{Auth::user()->name}}!</h3>
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                From your account dashboard. you can easily check &amp; view your <a
                                                    href="#">recent Bookings</a>,<br />
                                                manage your and <a href="#">edit your password and account details.</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Your Appointment</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table">

                                                @if(!empty($orders))
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Appointment No</th>
                                                            <th>Booking Date</th>
                                                            <th>Status</th>
                                                            <th>Total Amount</th>
                                                            <th>Payment Type</th>
                                                            <th>Payment Status</th>
                                                            <th>Patient Name</th>
                                                            <th>Hospital Name</th>
                                                            <th>Doctor Name</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orders as $val)
                                                        <tr>
                                                            <td>{{ $val->order_id }}</td>
                                                            <td>{{ $val->booking_date }}</td>
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
                                                            <td>${{ $val->total_amount }}</td>
                                                            {{-- <td>${{ $val->discount }}</td> --}}
                                                            <td>{{ ucfirst($val->payment_type) }}</td>
                                                            <td>{{ ucfirst($val->payment_status) }}</td>
                                                            <td>{{ $val->patient_name }}</td>
                                                            {{-- <td>{{ $val->father_name }}</td>
                                                            <td>{{ $val->gender }}</td>
                                                            <td>{{ $val->age }}</td>
                                                            <td>{{ $val->contact_no }}</td>
                                                            <td>{{ $val->email }}</td> --}}
                                                            <td>{{ $val->hospital_name }}</td>

                                                            <td>{{ $val->doctor_name }}</td>


                                                            <td>
                                                                <a href="{{ route('user.dashboard',['id'=>encrypt($val->id)]) }}"
                                                                    class="btn btn-sm btn-primary">View</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade {{$status}}" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Your Reports</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Report File</th>
                                                            <th>Report Type</th>
                                                            <th>Status</th>
                                                            <th>Remarks</th>
                                                            <th>Uploaded At</th>
                                                            {{-- <th>Actions</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($reports as $report)
                                                        <tr>
                                                            <td>{{ $report->id }}</td>
                                                            <td>
                                                                @if($report->report)
                                                                <a href="{{ asset('storage/reports/' . $report->report) }}"
                                                                    target="_blank">View Report</a>
                                                                @else
                                                                N/A
                                                                @endif
                                                            </td>
                                                            <td>{{ $report->report_type ?? 'N/A' }}</td>
                                                            <td>
                                                                @if ($report->status == 1)
                                                                <span class="badge bg-success">Active</span>
                                                                @else
                                                                <span class="badge bg-secondary">Inactive</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $report->remarks ?? '-' }}</td>
                                                            <td>{{ $report->created_at }}</td>
                                                            {{-- <td>
                                                                <a href="{{ route('upload.report.edit', $report->id) }}"
                                                                    class="btn btn-sm btn-primary">Edit</a>
                                                                <form
                                                                    action="{{ route('upload.report.delete', $report->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-sm btn-danger"
                                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                                </form>
                                                            </td>
                                                        </tr> --}}
                                                        @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center">No reports found.</td>
                                                        </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="track-orders" role="tabpanel"
                                    aria-labelledby="track-orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Orders tracking</h3>
                                        </div>
                                        <div class="card-body contact-from-area">
                                            <p>To track your order please enter your OrderID in the box below and press
                                                "Track" button. This was given to you on your receipt and in the
                                                confirmation email you should have received.</p>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <form class="contact-form-style mt-30 mb-50" action="#"
                                                        method="post">
                                                        <div class="input-style mb-20">
                                                            <label>Order ID</label>
                                                            <input name="order-id"
                                                                placeholder="Found in your order confirmation email"
                                                                type="text" />
                                                        </div>
                                                        <div class="input-style mb-20">
                                                            <label>Billing email</label>
                                                            <input name="billing-email"
                                                                placeholder="Email you used during checkout"
                                                                type="email" />
                                                        </div>
                                                        <button class="submit submit-auto-width"
                                                            type="submit">Track</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="password-change" role="tabpanel"
                                    aria-labelledby="password-change">
                                    <div class="row">
                                        <div class="card-body">

                                            @if(session('success'))
                                            <div class="alert alert-success">{{ session('success') }}</div>
                                            @endif

                                            @if(session('error'))
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                            @endif

                                            <form method="POST" action="{{ route('user.update-password') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Current Password <span class="required">*</span></label>
                                                        <input required class="form-control" name="password"
                                                            type="password" />
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>New Password <span class="required">*</span></label>
                                                        <input required class="form-control" name="npassword"
                                                            type="password" />
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Confirm Password <span class="required">*</span></label>
                                                        <input required class="form-control" name="cpassword"
                                                            type="password" />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit"
                                                            class="btn btn-fill-out submit font-weight-bold">Update
                                                            Password</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-detail" role="tabpanel"
                                    aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">

                                            <form method="post" action="{{ route('user.updateProfile') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Full Name <span class="required"></span></label>
                                                        <input required class="form-control"
                                                            value="{{ Auth::user()->name }}" name="name" type="text" />
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Email Address <span class="required"></span></label>
                                                        <input required class="form-control"
                                                            value="{{ Auth::user()->email }}" name="email"
                                                            type="email" />
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>Phone Number <span class="required"></span></label>
                                                        <input class="form-control"
                                                            value="{{ Auth::user()->mobile_no }}" type="text"
                                                            readonly />
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>State <span class="required"></span></label>
                                                        <input required class="form-control"
                                                            value="{{ Auth::user()->state ?? '' }}" name="state"
                                                            type="text" />
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>District <span class="required"></span></label>
                                                        <input required class="form-control"
                                                            value="{{ Auth::user()->district ?? '' }}" name="district"
                                                            type="text" />
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>Pincode <span class="required"></span></label>
                                                        <input required class="form-control"
                                                            value="{{ Auth::user()->pincode ?? '' }}" name="pincode"
                                                            type="text" />
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Address <span class="required"></span></label>
                                                        <textarea class="form-control"
                                                            name="address">{{ Auth::user()->address ?? '' }}</textarea>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <button type="submit"
                                                            class="btn btn-fill-out submit font-weight-bold">Update
                                                            Detail</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
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

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

                    <hr>
                    <div class="row gutters mt-4">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-container">
                                <div class="t-header" style="text-align: center; font-size: 18px;">All Appointment</div>
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


                                        <div class="col-md-4 d-flex align-items-end p-0">
                                            <button type="submit" class="btn btn-primary m-0 rounded-0">Filter</button>
                                        </div>

                                        <div class="col-md-4 d-flex align-items-end p-0">
                                            <button type="button" class="btn btn-primary m-3" onclick="Add_slot()">
                                                <i class="icon-add"></i> &nbsp;Add Appointment
                                            </button>
                                        </div>

                                        <div class="col-md-4 d-flex align-items-end p-0">
                                            <button type="button" class="btn btn-primary m-3" onclick="Add_Patient()">
                                                <i class="icon-add"></i> &nbsp;Add Patient
                                            </button>
                                        </div>

                                    </div>
                                </form>


                                <div class="table-responsive">
                                    <div id="copy-print-csv_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <table id="copy-print-csv" class="table custom-table dataTable no-footer"
                                            role="grid" aria-describedby="copy-print-csv_info">
                                            <thead>
                                                <tr>
                                                    <th>Actions</th>
                                                    <th>Appointment No</th>
                                                    <th>Booking Date</th>
                                                    <th>Paitent Details</th>
                                                    <th>Payment Detail</th>
                                                    <th>Status</th>
                                                    <th>Doctor Name</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $val)
                                                <tr>
                                                    <td>  <a href="#" class="btn btn-sm btn-primary" onclick="edit_appointment(
        '{{ $val->id }}',
        '{{ $val->user_id }}',
        '{{ $val->hospital_id }}',
        '{{ $val->doctor_id }}',
        '{{ $val->order_id }}',
        '{{ $val->type }}',
        '{{ $val->booking_date }}',
        '{{ $val->time_slot }}',
        '{{ $val->total_amount }}',
        '{{ $val->discount }}',
        '{{ $val->status }}',
        '{{ $val->payment_type }}',
        '{{ $val->payment_status }}',
        '{{ $val->appointment_for }}',
        '{{ $val->pa_name }}',
        '{{ $val->father_name }}',
        '{{ $val->gender }}',
        '{{ $val->age }}',
        '{{ $val->contact_no }}',
        '{{ $val->email }}'
   )" data-toggle="modal" data-target="#slotModal">Edit</a></td>
                                                    <td>{{ $val->order_id }}</td>
                                                    <td>{{ $val->booking_date }}</td>

                                                    <td>
                                                        <strong>Name:</strong> {{ $val->pa_name }}<br>
                                                        <strong>Father's Name:</strong> {{ $val->father_name }}<br>
                                                        <strong>Gender:</strong> {{ $val->gender }}<br>
                                                        <strong>Age:</strong> {{ $val->age }}<br>
                                                        <strong>Contact:</strong> {{ $val->contact_no }}<br>
                                                        <strong>Email:</strong> {{ $val->email }}
                                                    </td>

                                                    <td>
                                                        <strong>Total Amount:</strong> ₹{{ $val->total_amount }}<br>
                                                        <strong>Payment Type:</strong> {{ ucfirst($val->payment_type)
                                                        }}<br>
                                                        <strong>Payment Status:</strong> {{
                                                        ucfirst($val->payment_status) }}
                                                    </td>
                                                    <td>
                                                        @if ($val->status == 0)
                                                        <span class="badge bg-warning">Pending</span>
                                                        @elseif ($val->status == 1)
                                                        <span class="badge bg-success">Approved</span>
                                                        @elseif ($val->status == 2)
                                                        <span class="badge bg-danger">Cancelled</span>
                                                        @else
                                                        <span class="badge bg-secondary">Completed</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $val->doctor_name }}</td>

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
</div>







<div class="modal fade" id="slotModal" tabindex="-1">
    <div class="modal-dialog modal-lg">

        <form id="appointmentForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Appointment - <span id="selectedDate"></span></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="row gutters">
                        <input type="hidden" id="id_value" name="id">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Patient">Select Patient:</label>
                                <select name="patient" id="patient" class="form-control" required>
                                    <option value="">-- Select Patient --</option>
                                    @foreach($patient as $patient_val)
                                    <option value="{{ $patient_val->id }}">{{ $patient_val->name }} - {{
                                        $patient_val->mobile_no }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="doctor_id">Select Doctor:</label>
                                <select name="doctor_id" id="doctor_id" class="form-control" required>
                                    <option value="">-- Select Doctor --</option>
                                    @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Booking Date -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Booking Date:</label>
                                <select name="booking_date" id="booking_date" class="form-control" required>
                                    <option value="">-- Select Booking Date --</option>
                                </select>

                            </div>
                        </div>



                        <!-- Total Amount -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Total Amount:</label>
                                <input type="number" id="total_amount" name="total_amount" class="form-control"
                                    step="0.01" min="0">
                            </div>
                        </div>

                        <!-- Discount -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Discount (%):</label>
                                <input type="number" name="discount" value="0" class="form-control" step="0.01" min="0"
                                    max="100">
                            </div>
                        </div>

                        <!-- Payment Type -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Payment Type:</label>
                                <select name="payment_type" class="form-control" required>
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                </select>
                            </div>
                        </div>

                        <!-- Payment Status -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Payment Status:</label>
                                <select name="payment_status" class="form-control" required>
                                    <option value="pending">Pending</option>
                                    <option value="accepted">Accepted</option>
                                </select>
                            </div>
                        </div>

                        <!-- Appointment For -->
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label>Appointment For:</label>
                                <select name="appointment_for" class="form-control" required>
                                    <option value="self">Self</option>
                                    <option value="someone">Someone</option>
                                </select>
                            </div>
                        </div> --}}

                        <!-- Patient Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Patient Name:</label>
                                <input type="text" name="pa_name" class="form-control" required>
                            </div>
                        </div>

                        <!-- Father's Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Father's Name:</label>
                                <input type="text" name="father_name" class="form-control" required>
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Gender:</label>
                                <select name="gender" class="form-control" required>
                                    <option value="">-- Select Gender --</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>


                        <!-- Age -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Age:</label>
                                <input type="number" name="age" class="form-control" min="0" required>
                            </div>
                        </div>

                        <!-- Contact No -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contact No:</label>
                                <input type="tel" name="contact_no" class="form-control" pattern="[0-9]{10,15}"
                                    required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Appointment </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="PatientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="PatientForm">
            <!-- Corrected ID spelling -->
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row gutters">
                        <!-- Patient Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Patient Name:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>

                        <!-- Mobile Number -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile Number:</label>
                                <input type="tel" name="mobile_no" class="form-control" pattern="[0-9]{10,15}" required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Patient</button>
                </div>
            </div>
        </form>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    function Add_slot(){
    $('#id_value').val('');
    $('#max_slot').val(0);
        $('#appointmentForm')[0].reset();
        $('#slotModal').modal('show');
    }

    function Add_Patient(){
        $('#PatientForm')[0].reset();
        $('#PatientModal').modal('show');
    }

      $('#doctor_id').on('change', function() {
        let doctorId = $(this).val();
        if (doctorId) {
            $.ajax({
                url: '/get-doctor-data/' + doctorId,
                type: 'GET',
                success: function(data) {
                    $('#total_amount').val(data.data.price);
                      let options = '<option value="">-- Select Booking Date --</option>';
                    data.slots.forEach(date => {
                        options += `<option value="${date}">${date}</option>`;
                    });
                    $('#booking_date').html(options);
                },
                error: function() {
                    $('#total_amount').val('0');
                }
            });
        } else {
            $('#doctor_price').val('');
        }
    });

</script>

<script>
    $(document).ready(function () {
        $('#appointmentForm').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: '{{ route("hospital.appointment.create") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {

                },
                success: function(response) {
                    alert(response.message);
                        location.reload();
                    $('#appointmentForm')[0].reset();
                     $('#slotModal').modal('hide');
                     toastr.success("Appointment Create successfully!");

                },
                error: function(xhr) {
                    // Handle error
                    alert("Something went wrong!");
                    console.log(xhr.responseText);
                }
            });
        });
    });

$(document).ready(function () {
    $('#PatientForm').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: '{{ route("patient.store") }}',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#PatientForm')[0].reset();
                $('#PatientModal').modal('hide');
                alert(response.message);
                toastr.success(response.message);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error("Something went wrong.");
                }
            }
        });
    });
});



function edit_appointment(
    id, user_id, hospital_id, doctor_id, order_id, type,
    booking_date, time_slot, total_amount, discount, status,
    payment_type, payment_status, appointment_for, pa_name,
    father_name, gender, age, contact_no, email
) {

let options = `<option value="${booking_date}">${booking_date}</option>`;
$('#slotModal select[name="booking_date"]').html(options);
$('#slotModal select[name="booking_date"]').val(booking_date);
    $('#slotModal').modal('show');
      $('#doctor_id').val(doctor_id).trigger('change');
    $('#slotModal input[name="id"]').val(id);
    $('#slotModal select[name="patient"]').val(user_id);
    $('#slotModal select[name="hospital_id"]').val(hospital_id);
    $('#slotModal input[name="order_id"]').val(order_id);
    $('#slotModal select[name="type"]').val(type);
    $('#slotModal input[name="total_amount"]').val(total_amount);
    $('#slotModal input[name="discount"]').val(discount);
    $('#slotModal select[name="status"]').val(status);
    $('#slotModal select[name="payment_type"]').val(payment_type);
    $('#slotModal select[name="payment_status"]').val(payment_status);
    $('#slotModal select[name="appointment_for"]').val(appointment_for);
    $('#slotModal input[name="pa_name"]').val(pa_name);
    $('#slotModal input[name="father_name"]').val(father_name);
    $('#slotModal select[name="gender"]').val(gender);
    $('#slotModal input[name="age"]').val(age);
    $('#slotModal input[name="contact_no"]').val(contact_no);
    $('#slotModal input[name="email"]').val(email);




}


</script>



@endsection

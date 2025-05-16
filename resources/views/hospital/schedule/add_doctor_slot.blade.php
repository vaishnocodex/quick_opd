@extends('hospital.master')
@section('content')

<!-- Bootstrap Select CSS -->

<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
    #calendar {
        max-width: 900px;
        margin: 40px auto;
    }
</style>
<div class="main-container">
    <div class="page-header">
        <ol class="breadcrumb">

            <li class="breadcrumb-item">
                <button type="button" class="btn btn-primary m-3" onclick="Add_slot()">
                    <i class="icon-add"></i> &nbsp;Add Doctor Slot
                </button>
            </li>
        </ol>
    </div>

    <div class="row gutters mt-4">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="table-container">
                <div class="t-header" style="text-align: center; font-size: 18px;">Doctor Slots</div>

                <div class="table-responsive">
                    <div id="copy-print-csv_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table id="copy-print-csv" class="table custom-table dataTable no-footer" role="grid"
                            aria-describedby="copy-print-csv_info">
                            <thead>
                                <tr role="row">
                                    <th>Doctor Name </th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Max Booking</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{$doctor_data->name}} </td>
                                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->start_time)->format('h:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->end_time)->format('h:i A') }}</td>

                                    <td>{{$item->max_slot}} </td>
                                    <td>{{$item->status}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                &#x22EE;
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" onclick="edit_slot(
                       {{ $item->id }},
                       '{{ $item->doctor_id }}',
                       '{{ $item->date }}',
                       '{{ $item->start_time }}',
                       '{{ $item->end_time }}',
                       '{{ $item->slot_duration }}',
                       '{{ $item->max_slot }}',
                       '{{ $item->shift }}',
                       '{{ $item->status }}'
                   )" href="#">Edit</a></li>
                                                <li>
                                                    <form action="delete-url" method="POST"
                                                        onsubmit="return confirm('Are you sure?');">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit"
                                                            class="dropdown-item text-danger">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
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

    <!-- Modal -->
    <div class="modal fade" id="slotModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form id="slotForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Doctor Slot - <span id="selectedDate"></span></h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="row gutters">
                            <input type="hidden" id="id_value" name="id">
                            <input type="hidden" name="doctor_id" value="{{$decrypted}}">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date:</label>
                                    <input type="date" id="dateInput" name="date" class="form-control"
                                        min="{{ date('Y-m-d') }}" onfocus="this.showPicker()">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Duty Start Time:</label>
                                    <input type="time" name="start_time" value="{{$last_slot->start_time ?? ""}}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Duty End Time:</label>
                                    <input type="time" name="end_time" value="{{$last_slot->end_time ?? ""}}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Max Bookings:</label>
                                    <input type="number" name="max_slot" value="{{ $last_slot->max_slot ?? ""}}"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status:</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="available">Available</option>
                                        <option value="unavailable">Unavailable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Slot</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    function Add_slot(){

        $('#slotForm')[0].reset();
        $('#slotModal').modal('show');
    }

    function edit_slot(id, doctor_id, date, start_time, end_time, slot_duration, max_slot, shift, status) {
    $('#slotForm')[0].reset();
    $('#slotModal').modal('show');
    $('#id_value').val(id);
    $('#dateInput').val(date);
    $('#start_time').val(start_time);
    $('#end_time').val(end_time);
    $('#max_slot').val(max_slot);
    $('#status').val(status);
}



  $('#slotForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      url: '{{ route('hospital-doctor-slots.generate') }}',
      method: 'POST',
      data: $(this).serialize(),
      success: function (response) {
        $('#slotModal').modal('hide');

        toastr.success("Slot added successfully!");
        location.reload();
      },
      error: function (xhr) {
        let msg = "Error saving slot!";
        if (xhr.responseJSON && xhr.responseJSON.message) {
          msg = xhr.responseJSON.message;
        }
        toastr.error(msg);
      }
    });
  });



  const disabledDates = @json($future_dates);

document.addEventListener('DOMContentLoaded', function() {
  const dateInput = document.getElementById('dateInput');

  dateInput.addEventListener('input', function() {
    if (disabledDates.includes(this.value)) {
      // Immediately clear the selection without alert
      this.value = '';

      // Optional: Re-open the picker to force new selection
      setTimeout(() => this.showPicker(), 100);
    }
  });

  dateInput.addEventListener('input', function() {
    const selectedDate = this.value;
    if (disabledDates.includes(selectedDate)) {
      toastr.error('This date schedule already added. Please choose another date.');

      this.value = '';
    }
  });
});




</script>


@endsection

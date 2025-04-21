@extends('admin.master')
@section('content')

<!-- Bootstrap Select CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<style>#calendar { max-width: 900px; margin: 40px auto; }</style>
<div class="main-container">
  <div class="page-header">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Add Doctor Slot</li>
      <li class="breadcrumb-item">
        <button type="button" class="btn btn-primary m-3" onclick="Add_slot()">
        <i class="icon-add"></i>  &nbsp;Add Slot
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
                    <table id="copy-print-csv" class="table custom-table dataTable no-footer" role="grid" aria-describedby="copy-print-csv_info">
                        <thead>
                            <tr role="row">
                                <th>Action</th>
                                <th>Image</th>
                                <th>Doctor Detail</th>
                                <th>Hospital Detail</th>
                                <th>Login Detail</th>
                                 <th>Address</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                           
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
              <div class="col-md-4">
                <div class="form-group">
                  <label>Doctor: <span class="text-danger">*</span></label>
                  <select class="form-control" name="doctor_id" required>
                    <option value="">Select</option>
                    @foreach ($doctor_data as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Date:</label>
                  <input type="date" name="date" class="form-control">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Duty Start Time:</label>
                  <input type="time" name="start_time" class="form-control">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Duty End Time:</label>
                  <input type="time" name="end_time" class="form-control">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Max Bookings:</label>
                  <input type="number" name="max_slot" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Status:</label>
                  <select name="status" class="form-control" required>
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

    function Add_slot(){

        $('#slotForm')[0].reset();
        $('#slotModal').modal('show');
    }


  $('#slotForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      url: '{{ route('admin-doctor-slots.generate') }}',
      method: 'POST',
      data: $(this).serialize(),
      success: function (response) {
        $('#slotModal').modal('hide');
        calendar.refetchEvents();
        toastr.success("Slot added successfully!");
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

</script>
@endsection

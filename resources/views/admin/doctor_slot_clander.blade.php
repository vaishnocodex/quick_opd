@extends('admin.master') 
@section('content')

<!-- Bootstrap Select CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<style>#calendar { max-width: 900px; margin: 40px auto; }</style>
    <div class="main-container">
      <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Add Doctor</li>
        </ol>
        <!-- Breadcrumb end -->
    </div>

    <div class="container">
        <h2 class="text-center mt-4">Doctor Slot Calendar</h2>
        <div id="calendar"></div>
      </div>
   
   
   
      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.message')
                    
                    <form method="POST" action="{{ route('admin-doctor-slots.generate') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row gutters">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Doctor: <span style="color:red">*</span></label>
                                    <select  class="form-control" id="doctor_id" name="doctor_id" required>
                                        <option value="">Select</option>
                                        @foreach ($doctor_data as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Date:<span style="color:red">*</span></label>
                                    <input type="date" required  class="form-control" name="date" id="date" />
                                   
                                </div>
                            </div>
                           
                            
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="start_time">Duty Start Time: </label>
                                    <input type="time" class="form-control" name="start_time" id="start_time" />
                                   
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="start_time">Duty End Time: </label>
                                    <input type="time" class="form-control" name="end_time" id="end_time" />
                                   
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="start_time">Slot Duration (minutes): </label>
                                    <input type="number" name="slot_duration" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <button type="submit" class="btn btn-primary"> Create Slots  </button>
                            </div>
                        </div>
                    </form>
                 
                </div>
            </div>
        </div>

    </div>







    <!-- Modal -->
<div class="modal fade" id="slotModal" tabindex="-1">
    <div class="modal-dialog">
      <form id="slotForm">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Doctor Slot - <span id="selectedDate"></span></h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="date" id="formDate">
            <div class="form-group">
              <label>Start Time</label>
              <input type="time" name="start_time" class="form-control" required>
            </div>
            <div class="form-group">
              <label>End Time</label>
              <input type="time" name="end_time" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Max Bookings</label>
              <input type="number" name="max_slot" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Shift</label>
              <select name="shift" class="form-control">
                <option value="Morning">Morning</option>
                <option value="Evening">Evening</option>
                <option value="Night">Night</option>
              </select>
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

  
  <script>  
    // Set minimum date to today  
    document.addEventListener('DOMContentLoaded', (event) => {  
        const today = new Date();  
        const dd = String(today.getDate()).padStart(2, '0');  
        const mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0  
        const yyyy = today.getFullYear();  
        
        const formattedDate = yyyy + '-' + mm + '-' + dd;  
        document.getElementById('date').setAttribute('min', formattedDate);  
    });  
</script> 

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  let calendarEl = document.getElementById('calendar');

  let calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    selectable: true,
    dateClick: function (info) {
      $('#selectedDate').text(info.dateStr);
      $('#formDate').val(info.dateStr);
      $('#slotForm')[0].reset();
      $('#slotModal').modal('show');
    },
    events: '/doctor-slots/fetch',
  });

  calendar.render();

  $('#slotForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/doctor-slots/store',
      method: 'POST',
      data: $(this).serialize(),
      success: function () {
        $('#slotModal').modal('hide');
        calendar.refetchEvents();
      },
      error: function () {
        alert("Error saving slot!");
      }
    });
  });
});
</script>
@endsection

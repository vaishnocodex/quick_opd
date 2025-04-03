@extends('admin.master') 
@section('content')

<!-- Bootstrap Select CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css">

    <div class="main-container">
      <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Add Doctor</li>
        </ol>
        <!-- Breadcrumb end -->
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


@endsection

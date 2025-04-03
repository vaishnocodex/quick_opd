@extends('admin.master') 
@section('content')

<!-- Bootstrap Select CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css">

    <div class="main-container">
      <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Doctor Slot View</li>
        </ol>
        <!-- Breadcrumb end -->
    </div>
    <div class="row gutters">
       
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <form method="post" action="{{ route('admin.doctor-slot-display-filter') }}">
                    @csrf 
                    <div class="row" style="display: flex;">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="name">Doctor </label>
                                <select  class="form-control" id="doctor_id" name="doctor_id">
                                    <option value="">Select</option>
                                    @foreach ($doctor_data as $item)
                                    <option value="{{$item->id}}" @if($doctor_id==$item->id) Selected @endif>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="fdate">Date </label>
                                <input type="date" required value="{{ $fdate }}" class="form-control" id="fdate" name="fdate" placeholder="Enter date" />
                            </div>
                        </div>
                        <input type="hidden" value="2" name="filter">
        
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6" style="margin-top: 22px;">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                @if(!empty($filter))
                                    <a href="{{ route('admin.doctor-slot-display') }}" class="btn btn-warning">Clear Filter</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        
    </div>
    <div class="row gutters">
        
            <!-- Slot 1 -->
         @foreach ($slots as $item)
            <div class="col-md-3 mb-3">
              <div class="card border-primary">
                <div class="card-body text-center">
                  <h5 class="card-title text-primary"> {{$item->start_time}} - {{$item->end_time}}</h5>
                  <h5 class="card-title text-primary">Duration: {{$item->slot_duration}} Min</h5>
                  <h5 class="card-title @if($item->status=='unavailable') text-danger @else text-primary @endif">{{$item->status}} </h5>
                  {{-- <button class="btn btn-outline-primary btn-block">{{$item->slot_duration}} </button> --}}
                </div>
              </div>
            </div>
            @endforeach
           

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

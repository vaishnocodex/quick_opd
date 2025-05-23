@extends('admin.master') 
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css">

    <div class="main-container">
      <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Hospital</li>
        </ol>
        <!-- Breadcrumb end -->
    </div>
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.message')
                     @if(!empty($staff_id))@endif
                   
                     <form method="POST" action="{{ route('admin.hospital.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row gutters">
                            <input type="hidden" name="hospital_type" value="hospital">
                            
                            <!-- Hospital Name -->
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Hospital Name <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter Hospital Name" required>
                                   
                                </div>
                            </div>
                    
                            <!-- Image (cannot retain old value for file input) -->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="image">Image <span style="color: red">*</span></label>
                                    <input type="file" class="form-control" name="image" id="image" required>
                                </div>
                            </div>
                    
                            <!-- Mobile -->
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="mobile">Mobile <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') }}" pattern="[0-9]{10}" maxlength="11" placeholder="Enter Mobile" required>
                                   
                                </div>
                            </div>
                    
                            <!-- Email -->
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email <span style="color:red">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Enter Email" autocomplete="off" required>
                                   
                                </div>
                            </div>
                    
                            <!-- State -->
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="state">State <span style="color:red">*</span></label>
                                    <select class="form-control" id="state" name="state" onchange="getCity(this.value)" required>
                                        <option value="">Select</option>
                                        @foreach ($state_data as $item)
                                            <option value="{{ $item->id }}" {{ old('state') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    
                            <!-- City -->
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="getcity">City <span style="color:red">*</span></label>
                                    <select class="form-control" id="getcity" name="city" required>
                                        <option value="">Select</option>
                                        {{-- Populate city dropdown dynamically --}}
                                    </select>
                                </div>
                            </div>
                    
                            <!-- Password -->
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">Password <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="Enter Password" required>
                                   
                                </div>
                            </div>
                    
                            <!-- Category -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="category_id">Category <span style="color:red">*</span></label>
                                    <select class="selectpicker11 form-control" name="category_id[]" multiple data-live-search="true">
                                        @foreach ($category_data as $item)
                                            <option value="{{ $item->id }}" {{ collect(old('category_id'))->contains($item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    
                            <!-- Address -->
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="address">Address <span style="color:red">*</span></label>
                                    <textarea class="form-control" name="address" id="address" placeholder="Enter Address">{{ old('address') }}</textarea>
                                   
                                </div>
                            </div>
                    
                            <!-- Map -->
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="location">Select Hospital Location <span style="color:red">*</span></label>
                                    <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}" placeholder="Latitude" readonly>
                                    <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}" placeholder="Longitude" readonly>
                                    <div id="map"></div>
                                </div>
                            </div>
                    
                            <!-- Submit Button -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <button type="submit" class="btn btn-primary">Add Hospital</button>
                            </div>
                        </div>
                    </form>
                    
                    <hr>
                    <div class="row gutters mt-4">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-container">
                                <div class="t-header" style="text-align: center; font-size: 18px;">All Hospital</div>

                                <div class="table-responsive">
                                    <div id="copy-print-csv_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <table id="copy-print-csv" class="table custom-table dataTable no-footer" role="grid" aria-describedby="copy-print-csv_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>Action</th>
                                                    <th>Hospital Detail</th>
                                                    <th>Login Detail</th>
                                                     <th>Address</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=0; @endphp @foreach ($All_staff as $item)
                                                <tr>
                                                  
                                                    <td ><span>{{ ++$i }})</span>&nbsp;&nbsp; 
                                                        <a href="{{ route('admin.hospital', ['id'=>Crypt::encrypt($item->id)]) }}" ><span class="icon-border_color" style="font-size: 20px;color:#178e94"></span> </a>
                                                        <a href="{{ route('admin.hospital-map-location', ['id'=>Crypt::encrypt($item->id)]) }}" class="btn btn-primary">Add Map Location </a>
                                                        
                                                      
                                                    </td>
                                                    <td>Hospital Name : <b> {{ $item->name }} </b> <br>
                                                        Mobile : <b>{{ $item->mobile_no }} </b> </td>
                                                    <td>Email: <b>{{ $item->email }}</b> <br>
                                                       Password: <b>{{ $item->pass_hint }}</b></td>

                                                       <td>State: <b>{{ $item->state_name }}</b> <br>
                                                        City: <b>{{ $item->city_name }}</b><br>
                                                        address: <b>{{ $item->address }}</b> 
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }} </td> 
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
<script>
    function deleteConfirm(link)
    {
       var cs=confirm("Do you want to delete this Staff ?");
       if(cs==true)
       {
        document.location.href=link;
       }
    }


function getCity($classid) {
   $.ajax({
    url     : '{{ route('getStateCity') }}',
    method  : 'post',
    data    : {
    city : $classid,
    _token: "{{ csrf_token() }}"
  },success : function(res){
   $("#getcity").empty();
  var dd = jQuery.parseJSON(res);
   $("#getcity").html(dd.code);
   $("#selectcity").append("<option >"+"--Select District --"+"</option>");

}
});
}


</script>

<script>
    function initMap() {
        var defaultLocation = { lat: 28.6139, lng: 77.2090 }; // Default: New Delhi
        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 10,
            center: defaultLocation
        });

        var marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            draggable: true // Allow marker dragging
        });

        // Update coordinates when marker is dragged
        google.maps.event.addListener(marker, 'dragend', function (event) {
            document.getElementById("latitude").value = event.latLng.lat();
            document.getElementById("longitude").value = event.latLng.lng();
        });
    }
</script>

<!-- Google Maps API: Replace YOUR_API_KEY with your actual key -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>

  
@endsection

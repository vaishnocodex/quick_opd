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
                     @if(!empty($staff_id))@endif
                   
                     <form method="POST" action="{{ route('admin.doctor.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row gutters">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="hospital">Hospital <span style="color:red">*</span></label>
                                    <select class="form-control" id="hospital" name="hospital" required>
                                        <option value="">Select</option>
                                        @foreach ($hospital_data as $item)
                                            <option value="{{ $item->id }}" {{ old('hospital') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Doctor Name <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter Doctor Name" required />
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="image">Image <span style="color: red">*</span></label>
                                    <input type="file" class="form-control" name="image" id="image" placeholder="Upload Image" required />
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="mobile">Mobile <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') }}" pattern="[0-9]{10}" maxlength="11" placeholder="Enter Mobile" required />
                                </div>
                            </div>
                    
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email <span style="color:red">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Enter Email" autocomplete="off" required />
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="experience">Experience</label>
                                    <input type="text" class="form-control" name="experience" id="experience" value="{{ old('experience') }}" maxlength="11" placeholder="Enter Experience" />
                                </div>
                            </div>
                    
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="qualification">Qualification</label>
                                    <input type="text" class="form-control" name="qualification" id="qualification" value="{{ old('qualification') }}" placeholder="Enter Qualification" />
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="state">State <span style="color:red">*</span></label>
                                    <select class="form-control" id="state" name="state" onchange="getCity(this.value)" required>
                                        <option value="">Select</option>
                                        @foreach ($state_data as $item)
                                            <option value="{{ $item->id }}" {{ old('state') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="city">City <span style="color:red">*</span></label>
                                    <select class="form-control" id="getcity" name="city" required>
                                        <option value="">Select</option>
                                        <!-- Add logic here to preselect city if cities are loaded dynamically -->
                                    </select>
                                </div>
                            </div>
                    
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">Password <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="Enter Password" required />
                                </div>
                            </div>
                    
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="category">Category <span style="color:red">*</span></label>
                                    <select class="selectpicker11 form-control" name="category_id[]" multiple data-live-search="true">
                                        @foreach ($category_data as $item)
                                            <option value="{{ $item->id }}" {{ (collect(old('category_id'))->contains($item->id)) ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="symptom">Symptom <span style="color:red">*</span></label>
                                    <select class="selectpicker11 form-control" name="symptom_id[]" multiple data-live-search="true">
                                        @foreach ($symptom_data as $item)
                                            <option value="{{ $item->id }}" {{ (collect(old('symptom_id'))->contains($item->id)) ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" name="address" id="address" placeholder="Enter Address">{{ old('address') }}</textarea>
                                </div>
                            </div>
                    
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Enter Description">{{ old('description') }}</textarea>
                                </div>
                            </div>
                    
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="map">Select Hospital Location <span style="color:red">*</span></label>
                                    <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}" readonly />
                                    <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}" readonly />
                                    <div id="map"></div>
                                </div>
                            </div>
                    
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <button type="submit" class="btn btn-primary">Add Doctor</button>
                            </div>
                        </div>
                    </form>
                    
                 
                </div>
            </div>
        </div>

    </div>
</div>
<script>
  


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

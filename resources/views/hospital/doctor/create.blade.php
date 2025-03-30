@extends('hospital.master') 
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
                    @include('hospital.message')
                     @if(!empty($staff_id))@endif
                   
                     <form method="POST" action="{{ route('doctor.store') }}" enctype="multipart/form-data">
                        @csrf   
                        <div class="row gutters">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Doctor Name <span style="color:red">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter Dr Name" value="{{ old('name') }}" />
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="image">Image <span style="color: red">*</span></label>                      
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" />
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="mobile">Mobile <span style="color:red">*</span></label>
                                    <input type="text" pattern="[0-9]{10}" maxlength="11" class="form-control @error('mobile') is-invalid @enderror" name="mobile" id="mobile" placeholder="Enter Mobile" value="{{ old('mobile') }}" />
                                    @error('mobile')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email <span style="color:red">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter Email" autocomplete="off" value="{{ old('email') }}" />
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="state">State <span style="color:red">*</span></label>
                                    <select class="form-control @error('state') is-invalid @enderror" id="state" name="state" onchange="getCity(this.value)">
                                        <option value="">Select</option>
                                        @foreach ($state_data as $item)
                                            <option value="{{$item->id}}" {{ old('state') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="city">City <span style="color:red">*</span></label>
                                    <select class="form-control @error('city') is-invalid @enderror" id="getcity" name="city">
                                        <option value="">Select</option>
                                    </select>
                                    @error('city')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">Password <span style="color:red">*</span></label>
                                    <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter Password" />
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="category_id">Category <span style="color:red">*</span></label>
                                    <select class="selectpicker11 form-control @error('category_id') is-invalid @enderror" name="category_id[]" multiple data-live-search="true">
                                        @foreach ($category_data as $item)
                                            <option value="{{$item->id}}" {{ in_array($item->id, old('category_id', [])) ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach 
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="symptom_id">Symptom <span style="color:red">*</span></label>
                                    <select class="selectpicker11 form-control @error('symptom_id') is-invalid @enderror" name="symptom_id[]" multiple data-live-search="true">
                                        @foreach ($symptom_data as $item)
                                            <option value="{{$item->id}}" {{ in_array($item->id, old('symptom_id', [])) ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('symptom_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="address">Address <span style="color:red">*</span></label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Enter Address">{{ old('address') }}</textarea>
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="address">Select Hospital Location <span style="color:red">*</span></label>
                                    <input type="hidden" id="latitude" placeholder="Latitude" readonly>
                                    <input type="hidden" id="longitude" placeholder="Longitude" readonly>
                                    <div id="map"></div>
                                </div>
                            </div>
                    
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <button type="submit" class="btn btn-primary"> Add Doctor  </button>
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

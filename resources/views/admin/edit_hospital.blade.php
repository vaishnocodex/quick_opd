@extends('admin.master') 
@section('content')

@if(!empty($staff_id))
    @php
     $staff=backHelper::get_staff($staff_id);
      @endphp
    @endif
    <!-- Bootstrap Select CSS -->
<!-- Bootstrap 4.5 CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<!-- Bootstrap Select CSS -->
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
                   
                    <form method="POST" action="{{ route('admin.hospital.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row gutters">
                            <input type="hidden" value="" name="update_id" id="update_id"/>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Hospital Name <span style="color:red">*</span></label>
                                    <input type="text" required value="{{!empty($staff)?$staff[0]->name:'' }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter Hospital Name" />
                                    
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="mobile">Mobile <span style="color:red">*</span></label>
                                    <input type="text " required value="{{!empty($staff)?$staff[0]->mobile:'' }}" pattern="[0-9]{10}" maxlength="11" class="idm form-control @error('mobile') is-invalid @enderror" name="mobile" id="mobile" placeholder="Enter Mobile" />
                                    
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email <span style="color:red">*</span></label>
                                    <input type="email" required value="{{!empty($staff)?$staff[0]->email:'' }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter Email" autocomplete="off" />
                                    
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">State <span style="color:red">*</span></label>
                                    <select  class="form-control" id="state" name="state" onchange="getCity(this.value)" required>
                                        <option value="">Select</option>
                                        @foreach ($state_data as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="city">City <span style="color:red">*</span></label>
                                    <select  class="form-control" id="getcity" name="city" required>
                                        <option value="">Select</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">Password <span style="color:red">*</span></label>
                                    <input type="text" required value="{{!empty($staff)?$staff[0]->password:'' }}" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter Password" />
                                    
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="city">Category <span style="color:red">*</span></label>
                                        <select class="selectpicker11 form-control" name="category_id[]" multiple data-live-search="true">
                                          @foreach ($category_data as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach 
                                        </select>
                                </div>
                            </div>
                            
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="address">Address <span style="color:red">*</span></label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Enter Address"></textarea>
                                    
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
                                <button type="submit" class="btn btn-primary"> Edit Hospital</button>
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

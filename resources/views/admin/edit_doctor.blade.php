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
                   
                    <form method="POST" action="{{ route('admin.doctor.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$data->id}}" name="update_id" id="update_id"/>
                        <div class="row gutters">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Hospital <span style="color:red">*</span></label>
                                    <select  class="form-control" id="hospital" name="hospital" required>
                                        <option value="">Select</option>
                                        @foreach ($hospital_data as $item)
                                        <option value="{{$item->id}}" @if($data->user_id==$item->id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Doctor Name <span style="color:red">*</span></label>
                                    <input type="text" required  class="form-control" value="{{$data->name}}" name="name" id="name" placeholder="Enter Hospital Name" />
                                   
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="mobile">Mobile <span style="color:red">*</span></label>
                                    <input type="text " required value="{{$data->mobile_no}}" pattern="[0-9]{10}" maxlength="11" class="idm form-control" name="mobile" id="mobile" placeholder="Enter Mobile" />
                                    
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="image">Image<span style="color: red">*</span></label>
                                     <input type="file" class="form-control" name="image" id="image" placeholder="Enter" @if(!$data->image) required @endif />
                                     @if($data->image) <img src="{{ asset('storage/doctor/').'/'.$data->image}}" style="height: 70px;width:70px;"> @endif
                                </div>
                            </div>
                           

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email <span style="color:red">*</span></label>
                                    <input type="email" required value="{{$data->email}}" class="form-control" name="email" id="email" placeholder="Enter Email" autocomplete="off" />
                                    
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">State <span style="color:red">*</span></label>
                                    <select  class="form-control" id="state" name="state" onchange="getCity(this.value)" required>
                                        <option value="">Select</option>
                                        @foreach ($state_data as $item)
                                        <option value="{{$item->id}}" @if($data->state==$item->id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="city">City <span style="color:red">*</span></label>
                                    <select  class="form-control" id="getcity" name="city" required>
                                        <option value="">Select</option>
                                        @foreach ($city_data as $item)
                                        <option value="{{$item->id}}" @if($data->city==$item->id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">Password <span style="color:red">*</span></label>
                                    <input type="text" required value="{{$data->pass_hint}}" class="form-control" name="password" id="password" placeholder="Enter Password" />
                                    
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="city">Category <span style="color:red">*</span></label>
                                        <select class="selectpicker11 form-control" name="category_id[]" multiple data-live-search="true">
                                            @foreach ($category_data as $item)
                                            <option value="{{ $item->id }}" @if(in_array($item->id, explode(',', $data->category_id))) selected @endif>
                                                {{ $item->name }}
                                            </option>
                                           @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="city">Symptom <span style="color:red">*</span></label>
                                        <select class="selectpicker11 form-control" name="symptom_id[]" multiple data-live-search="true">
                                           
                                            @foreach ($symptom_data as $item)
                                            <option value="{{ $item->id }}" @if(in_array($item->id, explode(',', $data->symptom_id))) selected @endif>
                                                {{ $item->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="address">Address <span style="color:red">*</span></label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Enter Address">{{$data->address}}</textarea>
                                   
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

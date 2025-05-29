@extends('hospital.master')
@section('content')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css">

<div class="main-container">

    <!-- Page header start -->
    <div class="page-header">

        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Account Settings</li>
        </ol>
        <!-- Breadcrumb end -->

        <!-- App actions start -->
        {{-- <div class="app-actions">
            <button type="button" class="btn">Today</button>
            <button type="button" class="btn">Yesterday</button>
            <button type="button" class="btn">7 days</button>
            <button type="button" class="btn">15 days</button>
            <button type="button" class="btn active">30 days</button>
        </div> --}}
        <!-- App actions end -->

    </div>
    <!-- Page header end -->

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="user-profile">
                            <div class="user-avatar">
                                <img src="{{ asset('storage/doctor/' . $data->image) }}" alt="Tycoon Admin" />
                            </div>
                            <h5 class="user-name">{{ $data->name }}</h5>
                            <h6 class="user-email">{{ $data->email }}</h6>
                        </div>
                        {{-- <div class="about">
                            <h5>About</h5>
                            <p>{{ $data->description }}</p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.doctor.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$data->id}}" name="update_id" id="update_id" />

                        <div class="row gutters">
                            <div class="col-12">
                                {{-- <h6 class="mb-2 text-primary">Hospital Details</h6> --}}
                            </div>



                            {{-- Doctor Name --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Hospital Name <span class="text-danger">*</span></label>
                                    <input type="text" required class="form-control" value="{{ $data->name }}"
                                        name="name" id="name" placeholder="Enter Hospital Name" />
                                </div>
                            </div>

                            {{-- Mobile --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mobile">Mobile <span class="text-danger">*</span></label>
                                    <input type="text" required pattern="[0-9]{10}" maxlength="11"
                                        value="{{ $data->mobile_no }}" class="form-control" name="mobile" id="mobile"
                                        placeholder="Enter Mobile" />
                                </div>
                            </div>

                            {{-- Image --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="image">Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="image" id="image" @if(!$data->image)
                                    required @endif />
                                    @if($data->image)
                                    <img src="{{ asset('storage/doctor/' . $data->image) }}"
                                        style="height:70px;width:70px;" alt="Hospital Image">
                                    @endif
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" required value="{{ $data->email }}" class="form-control"
                                        name="email" id="email" placeholder="Enter Email" />
                                </div>
                            </div>

                            {{-- Experience --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="experience">Experience</label>
                                    <input type="text" maxlength="11" class="form-control"
                                        value="{{ $data->experience }}" name="experience" id="experience"
                                        placeholder="Enter Experience" />
                                </div>
                            </div>

                            {{-- Qualification --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qualification">Qualification</label>
                                    <input type="text" class="form-control" name="qualification"
                                        value="{{ $data->qualification }}" id="qualification"
                                        placeholder="Enter Qualification" />
                                </div>
                            </div>

                            {{-- State --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">State <span class="text-danger">*</span></label>
                                    <select class="form-control" id="state" name="state" onchange="getCity(this.value)"
                                        required>
                                        <option value="">Select</option>
                                        @foreach ($state_data as $item)
                                        <option value="{{ $item->id }}" @if($data->state == $item->id) selected
                                            @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- City --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="getcity">City <span class="text-danger">*</span></label>
                                    <select class="form-control" id="getcity" name="city" required>
                                        <option value="">Select</option>
                                        @foreach ($city_data as $item)
                                        <option value="{{ $item->id }}" @if($data->city == $item->id) selected @endif>{{
                                            $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            {{-- Password --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="text" required value="{{ $data->pass_hint }}" class="form-control"
                                        name="password" id="password" placeholder="Enter Password" />
                                </div>
                            </div>

                                                        @if(Auth::guard('hospital')->user()->hospital_type =='hospital')


                            {{-- Category --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="category">Category <span class="text-danger">*</span></label>
                                    <select class="form-control selectpicker11" name="category_id[]" multiple
                                        data-live-search="true">
                                        @foreach ($category_data as $item)
                                        <option value="{{ $item->id }}" @if(in_array($item->id, explode(',',
                                            $data->category_id))) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Symptom --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="symptom">Symptom <span class="text-danger">*</span></label>
                                    <select class="form-control selectpicker11" name="symptom_id[]" multiple
                                        data-live-search="true">
                                        @foreach ($symptom_data as $item)
                                        <option value="{{ $item->id }}" @if(in_array($item->id, explode(',',
                                            $data->symptom_id))) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @endif

                            {{-- Address --}}
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="address">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="address" id="address"
                                        placeholder="Enter Address">{{ $data->address }}</textarea>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description"
                                        placeholder="Enter Description">{{ $data->description }}</textarea>
                                </div>
                            </div>

                            {{-- Map --}}
                            {{-- <div class="col-md-8">
                                <div class="form-group">
                                    <label>Select Hospital Location <span class="text-danger">*</span></label>
                                    <input type="hidden" id="latitude" name="latitude" value="{{ $data->latitude }}">
                                    <input type="hidden" id="longitude" name="longitude" value="{{ $data->longitude }}">
                                    <div id="map" style="height: 250px;"></div>
                                </div>
                            </div> --}}

                            {{-- Buttons --}}
                            <div class="col-12 text-right mt-3">
                                {{-- <a href="{{ route('admin.doctor.index') }}" class="btn btn-secondary">Cancel</a>
                                --}}
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>




    </div>
    <!-- Row end -->

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
<!-- Main container end -->
@endsection

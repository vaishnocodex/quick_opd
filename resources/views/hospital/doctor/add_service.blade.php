@extends('hospital.master')
@section('content')

<!-- Bootstrap Select CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css">

    <div class="main-container">
      <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Add Service</li>
        </ol>
        <!-- Breadcrumb end -->
    </div>
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.message')
                     @if(!empty($staff_id))@endif

                     <form method="POST" action="{{ route('radiology.service.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row gutters">

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Service Name <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter Service Name" required />
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Service Price <span style="color:red">*</span></label>
                                    <input type="text" class="form-control idm" name="price" id="price" value="{{ old('name') }}" placeholder="Enter price Name" required />
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="image">Image <span style="color: red">*</span></label>
                                    <input type="file" class="form-control" name="image" id="image" placeholder="Upload Image" required />
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

                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Enter Description">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <button type="submit" class="btn btn-primary">Add Service</button>
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

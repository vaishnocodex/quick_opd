@extends('vendor.master') 
@section('content')

<div class="main-container">
    <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Store</li>
        </ol>
        <!-- Breadcrumb end -->
    </div>
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    @include('vendor.message')
                    
                    <form method="POST" action="{{ route('admin.store.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row gutters">
                            <input type="hidden" value="{{$staff_id}}" name="id" id="id"/>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Store Name <span style="color:red">*</span></label>
                                    <input type="text" required  value="{{$data->name}}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter Store Name" />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="mobile">Mobile <span style="color:red">*</span></label>
                                    <input type="text" required  value="{{$data->mobile}}" pattern="[0-9]{10}" maxlength="11" class="idm form-control @error('mobile') is-invalid @enderror" name="mobile" id="mobile" placeholder="Enter Mobile" />
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email <span style="color:red">*</span></label>
                                    <input type="email" required  value="{{$data->email}}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter Email" autocomplete="off" />
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">State <span style="color:red">*</span></label>
                                    <input type="text" required class="form-control" value="{{$data->state}}" name="state" id="state" placeholder="Enter State" />
                                   
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="city">City <span style="color:red">*</span></label>
                                    <input type="text" required class="form-control" value="{{$data->city}}" name="city" id="city" placeholder="Enter City" />
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">Password <span style="color:red">*</span></label>
                                    <input type="text" required value="{{$data->pw}}" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter Password" />
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="address">Address <span style="color:red">*</span></label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Enter Address">{{$data->address}}</textarea>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                          

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <button type="submit" class="btn btn-primary">
                                   Update Detail
                                </button>
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


},
success : function(res){
 $("#getcity").empty();
//  var obj=JSON.parse(res);
  var dd = jQuery.parseJSON(res);
// alert(dd.code);
   $("#getcity").html(dd.code);
 $("#selectcity").append("<option >"+"--Select District --"+"</option>");

 

}
});
}

</script>

@endsection

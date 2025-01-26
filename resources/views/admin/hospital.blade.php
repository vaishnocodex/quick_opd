@extends('admin.master') 
@section('content')

@if(!empty($staff_id))
    @php
     $staff=backHelper::get_staff($staff_id);
      @endphp
    @endif
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
                   
                    <form method="POST" action="{{ route('admin.store.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row gutters">
                            <input type="hidden"  @if(!empty($staff_id)) value="{{$staff_id}}" @else value="" @endif  name="id" id="id"/>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Store Name <span style="color:red">*</span></label>
                                    <input type="text" required value="{{!empty($staff)?$staff[0]->name:'' }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter Store Name" />
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
                                    <input type="text " required value="{{!empty($staff)?$staff[0]->mobile:'' }}" pattern="[0-9]{10}" maxlength="11" class="idm form-control @error('mobile') is-invalid @enderror" name="mobile" id="mobile" placeholder="Enter Mobile" />
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
                                    <input type="email" required value="{{!empty($staff)?$staff[0]->email:'' }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter Email" autocomplete="off" />
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
                                    <input type="text" required class="form-control" name="state" id="state" placeholder="Enter State" />
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="city">City <span style="color:red">*</span></label>
                                    <input type="text" required class="form-control" name="city" id="city" placeholder="Enter City" />
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">Password <span style="color:red">*</span></label>
                                    <input type="text" required value="{{!empty($staff)?$staff[0]->password:'' }}" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter Password" />
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
                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Enter Address"></textarea>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                          

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <button type="submit" class="btn btn-primary">
                                    @if(!empty($staff_id))
                                        Edit Hospital
                                    @else
                                    Add Hospital
                                    @endif


                                </button>
                            </div>
                        </div>
                    </form>
                    @if(!empty($staff_id))
                    @else
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
                                                    <th>Store Detail</th>
                                                    <th>Login Detail</th>
                                                     <th>Address</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=0; @endphp @foreach ($All_staff as $item)
                                                <tr>
                                                  
                                                    <td ><span>{{ ++$i }})</span>&nbsp;&nbsp; <a href="{{ route('admin.store', ['id'=>Crypt::encrypt($item->id)]) }}" ><span class="icon-border_color" style="font-size: 20px;color:#178e94"></span> </a>
                                                        
                                                        @if($item->dflt=='1')  
                                                        <a  class="btn btn-success m-1 btn-sm">Default Store</a>

                                                       @else 
                                                       <a href="{{ route('admin.default.store',['id'=>Crypt::encrypt($item->id)]) }}"  class="btn btn-primary m-1 btn-sm">Set As Default Store </a>

                                                        @endif
                                                    </td>
                                                    <td>Store Name : <b> {{ $item->name }} </b> <br>
                                                        Mobile : <b>{{ $item->mobile }} </b> </td>
                                                    <td>Email: <b>{{ $item->email }}</b> <br>
                                                       Password: <b>{{ $item->pw }}</b></td>

                                                       <td>State: <b>{{ $item->state }}</b> <br>
                                                        City: <b>{{ $item->city }}</b><br>
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
                    @endif
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

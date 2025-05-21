@extends('hospital.master')
@section('content')

@if(!empty($staff_id))
    @php
     $staff=backHelper::get_staff($staff_id);
      @endphp
    @endif
    <!-- Bootstrap Select CSS -->

    <div class="main-container">
      <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">All Service </li>
        </ol>
        <!-- Breadcrumb end -->
    </div>
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.message')
                    <div class="row gutters mt-4">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-container">
                                <div class="t-header" style="text-align: center; font-size: 18px;">All Service</div>

                                <div class="table-responsive">
                                    <div id="copy-print-csv_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <table id="copy-print-csv" class="table custom-table dataTable no-footer" role="grid" aria-describedby="copy-print-csv_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>Action</th>
                                                    <th>Image</th>
                                                    <th>Service</th>
                                                    <th>Price</th>
                                                    <th>Category</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=0; @endphp @foreach ($All_staff as $item)
                                                <tr>

                                                    <td > <a href="{{ route('hospital.edit.doctor', ['id'=>Crypt::encrypt($item->id)]) }}" ><span class="icon-border_color" style="font-size: 20px;color:#178e94"></span> </a>
                                                    </td>
                                                    <td> @if($item->image) <img src="{{ asset('storage/doctor/').'/'.$item->image}}" style="height: 70px;width:70px;"> @endif</td>
                                                    <td>{{ $item->name }} </td>
                                                    <td>{{ $item->price }} </td>
                                                    <td>{{ backHelper::get_radiology_name($item->category_id) }} </td>
                                                
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


@endsection

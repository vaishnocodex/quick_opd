@extends('admin.master')
@section('content')
<style>
.slimScrollDiv{
    height: 100% !important;
}
.customScroll5{
    height: 100% !important;
}
.resize_fit_center {
    max-width: 100%;
    max-height: 96%;
    vertical-align: middle;
}
.center-cropped {
    //width: 100%;
    height: 115px;
    line-height: 111px;
    border-right: 1px solid #ccc;
    width: 28%;

}
</style>
<div class="main-container">
    <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{$heading_title}}</li>
        </ol>
        <!-- Breadcrumb end -->


    </div>
    @if(!empty($category_id))
    @php
     $Cate=backHelper::get_category($category_id);
      @endphp
    @endif

    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">

                    @include('admin.message')
                    <form method="POST" action="{{ route('admin.category.add') }}" enctype="multipart/form-data">
                      @csrf
                      
                       <div class="row gutters">
                        <input type="hidden" class="getodr" @if(!empty($category_id)) value="{{$category_id}}" @else value="" @endif  name="id" id="id"/>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="name">Name<span style="color: red">*</span></label>
                                <input type="text" value="{{!empty($Cate)?$Cate->name:'' }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        @if($cat_type!="symptom")
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="parent">Parent</label>
                                <select name="parent"  class="form-control selUser @error('parent') is-invalid @enderror"  id="parent" >
                                    <option value="">Select Parent Category</option>
                                    @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" @if (!empty($Cate) && $Cate->parent==$item->id) selected @endif >{{  $item->name  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        @endif
                        <input type="hidden" name="type" value="{{$cat_type}}">
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="image">Image<span style="color: red">*</span></label>
                                @if(!empty($Cate))
                                <img src="{{ asset('storage/category/').'/'.$Cate->image }}" style="width:100px;height:100px;" alt="">
                                <input type="file" class="form-control  @error('image') is-invalid @enderror" name="image" id="image" placeholder="Enter" />
                                 @else                                
                                 <input type="file" class="form-control  @error('image') is-invalid @enderror" name="image" id="image" placeholder="Enter" required/>
                                @endif
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <button type="submit" class="btn btn-primary">
                                @if(!empty($category_id))
                                Edit {{$heading_title}}
                                @else
                                Add {{$heading_title}}
                                @endif

                            </button>
                        </div>


                    </div>
                    </form>
                    @if(!empty($category_id))
                    @else
                    <hr>
                    <div class="row gutters mt-4">

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-container">
                                <div class="t-header" style="text-align: center;font-size: 18px;">All {{$heading_title}}</div>
    
                                <div class="table-responsive" style="overflow-x: unset;">
                                    <div id="copy-print-csv_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
    
                                        <table id="copy-print-csv" class="table custom-table dataTable no-footer" role="grid" aria-describedby="copy-print-csv_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>Sr.</th>
                                                    <th>Action</th>
                                                    <th>Image</th>
                                                    <th>Category</th>
                                                    <th>Parent Category</th>
                                                    
                                                 </tr>
                                            </thead>
                                            <tbody>
    
                                                @php
                                                    $i=0;
                                                @endphp
                                               @foreach ($catall as $item)
                                                <tr>
                                                  <td> {{ ++$i }}</td>
                                                  <td> <a href="javascript:void(0);" onclick="showPrompt('{{ route('admin.category.delete',['id'=>Crypt::encrypt($item->id)]) }}')" ><span class="icon-delete" style="font-size: 20px;color:#ff0000"></span> </a>
                                                  </td>
                                                  <td> <img class="" src="{{ asset('storage/category/').'/'.$item->image }}" style="width: 80px;
                                                        height: 80px;object-fit: cover;"/></td>
                                                   {{-- <td>{{ $item->type }}</td> --}}
                                                   <td>{{ $item->name }} </td>
                                                   <td>@if($item->parent!='0'){{ backHelper::Get_parent_Category_name($item->parent)->name  }} @else -  @endif</td>
                                                  
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
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
</script>
<!-- Bootstrap Select CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
<!-- Bootstrap Select JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    
    function showPrompt(url)
    {
        var choice=confirm('Are you sure to delete this category ?');
        if(choice==true)
        {

            document.location.href=url;
        }
        else
        {
            alert('Category Not deleted');
        }
    }



    </script>

@endsection

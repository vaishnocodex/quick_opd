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
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="parent">Type</label>
                                <select name="type"  class="form-control selUser"  id="type" required>
                                    <option value="">Select</option>
                                    <option value="radiology" @if (!empty($Cate) && $Cate->type=='category') selected @endif >radiology</option>
                                    <option value="category" @if (!empty($Cate) && $Cate->type=='category') selected @endif >category</option>
                                    
                                </select>
                            </div>
                        </div> 

                        @else

                        <input type="hidden" name="type" value="{{$cat_type}}">
                        @endif
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
                            <!-- Card start -->
                            <div class="card">
                                <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="card-header">
                                    <div class="card-title">All {{$heading_title}}</div>
                                </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <form method="get" action="{{ route("admin.category.all") }}">
                                   <div class="form-group row">
                                    <label for="search" class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12 col-form-label">Search</label>
                                     <div class="col-xl-10 col-lg-10 col-md-10 col-sm-6 col-12">
                                    <input type="text" name="keyword"  autocomplete="off" class="form-control @error('search') is-invalid @enderror"   placeholder="Search Here">
                                     <button type="submit" class="btn btn-info" style="margin-top: -33px;
                                     float: right;height: 32px;border-top-left-radius: 0px;border-bottom-left-radius: 0px;"><i class="icon-search1"></i></button>
                                </div>
                                </div>
                               </div>
                                <div class="card-body">
                                    <div class="slimScrollDiv">
                                        <div class="customScroll5" >
                                            <div class="products-sold-container">
                                                @php
                                                $i=0;
                                                $count=0;
                                                $j=0;

                                            @endphp

                                            @foreach ($catall as $item)

                                            @if(count(backHelper::Sub_Categories($item->id))>0)
                                            @php
                                                $count=count(backHelper::Sub_Categories($item->id));
                                            @endphp

                                                <div class="product" style="border: 1px solid #cc2626;">
                                                    <div class="product-details">
                                                        <div class="">
                                                        <img class="" src="{{ asset('storage/category/').'/'.$item->image }}" style="width: 100px;
                                                        height: 142px;object-fit: cover;"/>
                                                        </div>
                                                        <div class="product-title" style="padding-left: 16px;">
                                                            <div style="display: flex">
                                                                <div class="title"><strong>Name :</strong></div>&nbsp;
                                                            <div class="price" style="font-size: 14px;color:black">{{ $item->name }}</div>
                                                            </div>
                                                            <div style="display: flex">
                                                                <div class="title">Action :</div>&nbsp;
                                                                <div class="price">  
                                                                    <a href="{{ route('admin.'.$item->type, ['id'=>($item->id)]) }}" >
                                                                        <span class="icon-border_color" style="font-size: 20px;color:#178e94"></span>
                                                                     </a>
                                                                <a href="javascript:void(0);" onclick="showPrompt('{{ route('admin.category.delete',['id'=>Crypt::encrypt($item->id)]) }}')" ><span class="icon-delete" style="font-size: 20px;color:#ff0000"></span> </a>
                                                                @if ($item->status=='0')
                                                               
                                                                <a href="{{ route('admin.category.status', ['id'=>Crypt::encrypt($item->id)]) }}" class="btn btn-primary">Activate Category</a>
                                                                            <span class="badge badge-danger" style="font-size: 13px;">Category Inactive</span>
                                                            @else

                                                            <a href="{{ route('admin.category.status', ['id'=>Crypt::encrypt($item->id)]) }}" class="btn btn-danger">Deactivate Category</a>
                                                            <span class="badge badge-success" style="font-size: 13px;">Category Active</span>
                                                            @endif
                                                            </div>
                                                            </div>
                                                             <div class="title"><span class="badge badge-info " onclick="plus_row(this,'{{ $item->id }}')"><i class="icon-subdirectory_arrow_left" style="font-size: 13px;"></i></span></div>
                                                            {{--<div class="price">{{ $item->description }}</div> --}}
                                                        </div>
                                                    </div>
                                                    {{-- <div class="product-sold" style="border-left: 1px solid #ccc;padding: 3px;display: block;">
                                                        <div class="sold text-info" style="font-size: 16px;font-weight: 500;">Tagline</div>
                                                        <div class="sold-title">{{ $item->tegline }}</div>

                                                    </div> --}}
                                                </div>
                                                @foreach(backHelper::Sub_Categories($item->id) as $sub_cat)
                                                <div style="border: 1px solid #cc2626;display:none" class="product add_data{{ $item->id }}" id="{{ $item->id }}" >
                                                    <div class="product-details">
                                                        <div class="">
                                                         <img class="" style="width: 100px;
                                                         height: 142px;object-fit: cover;" src="{{ asset('storage/category/').'/'.$sub_cat->image }}" alt="Apple iPhone 11" />
                                                        </div>
                                                         <div class="product-title" style="padding-left: 16px;">
                                                            <div style="display: flex">
                                                            <div class="title">Name :</div>&nbsp;
                                                            <div class="price" style="font-size: 14px;color:black">{{ $sub_cat->name }}</div>
                                                            </div>
                                                            <div style="display: flex">
                                                                <div class="title">Action :</div>&nbsp;
                                                                <div class="price">  <a href="{{ route('admin.'.$item->type, ['id'=>($sub_cat->id)]) }}" ><span class="icon-border_color" style="font-size: 20px;color:#178e94"></span> </a>
                                                                <a href="javascript:void(0);" onclick="showPrompt('{{ route('admin.category.delete',['id'=>Crypt::encrypt($sub_cat->id)]) }}')" ><span class="icon-delete" style="font-size: 20px;color:#ff0000"></span> </a>
                                                                @if ($sub_cat->status==0)

                                                                <a href="{{ route('admin.category.status', ['id'=>Crypt::encrypt($sub_cat->id)]) }}" class="btn btn-primary">Activate Category</a>
                                                                            <span class="badge badge-danger" style="font-size: 13px;">Category Inactive</span>
                                                            @else

                                                            <a href="{{ route('admin.category.status', ['id'=>Crypt::encrypt($sub_cat->id)]) }}" class="btn btn-danger">Deactivate Category</a>
                                                            <span class="badge badge-success" style="font-size: 13px;">Category Active</span>
                                                            @endif
                                                            </div>
                                                            </div>
                                                            {{-- <div class="title">Description</div>
                                                            <div class="price">{{ $item->description }}</div> --}}
                                                        </div>
                                                    </div>
                                                    {{-- <div class="product-sold" style="border-left: 1px solid #ccc;padding: 3px;display: block;">
                                                        <div class="sold text-info" style="font-size: 16px;font-weight: 500;">Tagline</div>
                                                        <div class="sold-title">{{ $item->tegline }}</div>

                                                    </div> --}}
                                                </div>
                                                @endforeach
                                                @else
                                                <div class="product" style="border: 1px solid #cc2626;">
                                                    <div class="product-details">
                                                        <div class="">
                                                        <img class="" src="{{ asset('storage/category/').'/'.$item->image }}" alt="Apple iPhone 11" style="width: 100px;
                                                        height: 142px;"/>
                                                        </div>
                                                        <div class="product-title" style="padding-left: 16px;">
                                                            <div style="display: flex">
                                                            <div class="title">Name :</div>&nbsp;
                                                            <div class="price" style="font-size: 14px;">{{ $item->name }}</div>
                                                            </div>
                                                            <div style="display: flex">
                                                                <div class="title">Action :</div>&nbsp;
                                                                <div class="price"><a href="{{ route('admin.'.$item->type, ['id'=>($item->id)]) }}" ><span class="icon-border_color" style="font-size: 20px;color:#178e94"></span> </a>
                                                                <a href="javascript:void(0);" onclick="showPrompt('{{ route('admin.category.delete',['id'=>Crypt::encrypt($item->id)]) }}')" ><span class="icon-delete" style="font-size: 20px;color:#ff0000"></span> </a>
                                                                @if ($item->status==0)

                                                                <a href="{{ route('admin.category.status', ['id'=>Crypt::encrypt($item->id)]) }}" class="btn btn-primary">Activate Category</a>
                                                                            <span class="badge badge-danger" style="font-size: 13px;">Category Inactive</span>
                                                            @else

                                                            <a href="{{ route('admin.category.status', ['id'=>Crypt::encrypt($item->id)]) }}" class="btn btn-danger">Deactivate Category</a>
                                                            <span class="badge badge-success" style="font-size: 13px;">Category Active</span>
                                                            @endif
                                                            </div>
                                                            </div>
                                                             {{-- <div class="title"><span class="badge badge-info " onclick="plus_row(this,'{{ $item->id }}')"><i class="icon-subdirectory_arrow_left" style="font-size: 13px;"></i></span></div> --}}
                                                            {{--<div class="price">{{ $item->description }}</div> --}}
                                                        </div>
                                                    </div>
                                                    {{-- <div class="product-sold" style="border-left: 1px solid #ccc;padding: 3px;display: block;">
                                                        <div class="sold text-info" style="font-size: 16px;font-weight: 500;">Tagline</div>
                                                        <div class="sold-title">{{ $item->tegline }}</div>

                                                    </div> --}}
                                                </div>
                                                @endif
                                                @endforeach

                                            </div>
                                        </div>
                                     </div>
                                </div>
                            </div>
                            <!-- Card end -->
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

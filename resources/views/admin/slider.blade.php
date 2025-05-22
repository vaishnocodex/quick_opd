@extends('admin.master')
@section('content')
<style>
    .note-editor.note-frame .note-editing-area .note-editable {
        height: 20px;
    }
</style>
<div class="main-container">
    <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Slider</li>
        </ol>
        <!-- Breadcrumb end -->


    </div>
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">

                    @include('admin.message')
                    <form method="POST" action="{{ route('admin.add.slider') }}" enctype="multipart/form-data">
                      @csrf
                    <div class="row gutters">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="name">Image</label>
                                <input type="file" class="form-control" name="img" id="image" placeholder="Enter" required />
                               
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="name">Type</label>
                                <select onchange="setbanner_Categories(this.value)" required class="form-control form-control-lg" id="type_slider" name="type_slider">
                                      <option value="home">For Website Home</option>    
                                      <option value="app">For app</option>
                                    
                                </select>
                               
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="name">Heading</label>
                                 <input type="text" class="form-control" name="heading" id="heading" placeholder="Enter Heading IF" />
                           </div>
                        </div>
                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="name">URL</label>
                                 <input type="text" class="form-control" name="web_link" id="web_link" placeholder="Enter URL IF" />
                           </div>
                        </div>
                        

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-4">
                            <button type="submit" class="btn btn-primary">Add Slider</button>
                        </div>


                    </div>
                    </form>
                    <hr>
                    <div class="row gutters mt-4">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="table-container">
                            <div class="t-header" style="text-align: center;font-size: 18px;">All Slider</div>

                            <div class="table-responsive" style="overflow-x: unset;">
                                <div id="copy-print-csv_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                                    <table id="copy-print-csv" class="table custom-table dataTable no-footer" role="grid" aria-describedby="copy-print-csv_info">
                                        <thead>
                                            <tr role="row">
                                                <th>Sr.</th>
                                                 <th>Action</th>
                                                <th>Image</th>
                                                <th>Type</th>
                                               
                                                <th>Heading IF</th>
                                                 <th>URL</th>
                                               
                                             </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                                $i=0;
                                            @endphp
                                            @foreach ($slider as $item)
                                            <tr>
                                              <td> {{ ++$i }}</td>
                                              <td> <a onclick="deleteConfirm('{{ route('admin.delete.slider', ['id'=>Crypt::encrypt($item->id)]) }}')" > <span class="icon-delete" style="font-size: 20px;color:#ff0000"></span></a>
                                              </td>
                                              <td> <img src="{{ asset('storage/slider/').'/'.$item->image }}" width="100px;height:100px;" alt=""></td>
                                              
                                               <td>{{ $item->type }}</td>
                                               <td>@if($item->title){{ $item->title }} @endif</td>
                                               <td> {{ $item->url }}</td>
                                              
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
       var cs=confirm("Do you want to delete this image ?");
       if(cs==true)
       {
        document.location.href=link;
       }
    }
    function setbanner_Categories(val)
   {
    if(val==0)
    {
        $("#category_sliderblock").css("display","none");
        $("input #slider_category").removeAttr("require");
    }
    else
    {
        $("#category_sliderblock").css("display","block");
        $("input #slider_category").attr("required", "true");
    }
   }
    </script>


@endsection

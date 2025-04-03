@extends('website.master')
@section('content')
	<!-- Main Container  -->
	<div style="padding:10px;" class="main-container container">
		<ul class="breadcrumb">
			<li><a href="{{route('welcome')}}"><i class="fa fa-home"></i></a></li>
			<li>All Hospital</li>
				
		</ul>
		
		<div class="row">
			   
			<!--Middle Part Start-->
            <div id="content" class="col-md-12 col-sm-12">
                <div class="products-category">
                  
                    
             
              <div style="margin-top:20px;" class="so-categories module custom-slidercates">  
                <h3 class="modtitle"><span>All Hospital</span></h3>
                <div class="container-fluid">
                        <div class="row">
                           <center> 
                           
                               @foreach ($hospital as $item)
                             <div style=" border-radius:10px; padding:5px; margin:5px;  box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" class="col-md-6 col-sm-12 col-xs-12">
                             <div class="row">
                              <div  class="col-md-6 col-lg-6 col-xs-6 col-sm-6 para02" style="overflow:hidden;">
                                <a  href="#" target="_self"> <br>
                                        <img class="img_hos" src="{{ asset('storage/hospital/').'/'.$item->image }}" style="height:150px; width:65%; margin-top: -20px; border-radius:15px;" title="{{$item->name}}" alt="{{$item->name}}" />
                                    </a>
                            </div>
                             
                               <div  class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
                             
                                  <a style="font-weight:600; float:left; font-size:12px;" href="#" target="_self">{{$item->name}}</a>
                                    <Br> <p   style=" float:left; font-size:10px;"><i class="fa fa-map-marker "></i>&nbsp;{{substr($item->address, 0, 25)}}</p> <br>
                                 
                                  
                                    <br><p  style="float:left; font-size:10px;"><i class="fa fa-clock"></i>&nbsp;{{$item->name}}</p>
                             
                              
                            </div> 
                            </div>
                            </div>
                            
                            @endforeach
                           
                         </center>
                        </div>
                    
                </div>
            
            
            </div>
                           
                           
                           
          
          
          
          
         </div>  
      </div>
  </div>
                    <!--// End Changed listings-->
                   
                    
                </div>
      </div>
@endsection
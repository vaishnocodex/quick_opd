@extends('website.master')
@section('content')
      
	<!-- Main Container  -->
	<div style="padding:20px;" class="main-container container">
		<ul class="breadcrumb">
			<li><a href="{{route('welcome')}}"><i class="fa fa-home"></i></a></li>
		
				<li>All Doctors </li>
				
		</ul>
			
		<div class="row" style="margin-top: 11px;">
			
			<!--Middle Part Start-->
            <div id="content" class="col-md-12 col-sm-12 ">
                <div class="products-category">
                  
                    <div class="col-md-12"> <!-- Filters -->
                   
                    
                    <!-- //end Filters -->
                         <!--changed listings-->
                         <div class="row">
                              
						 <div class="col-md-12">
						 </br>
                           <div class="row" style="padding:20px;"> 
                            @foreach ($doctor as $item)
                           <!------------------------------------Doctor-------------------------------------->
						      <div style=" border-radius:10px; padding:5px; margin:5px;  box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" class="col-md-6 col-sm-12 col-xs-12">
                               <div class="row">
                                <div  class="col-md-6 col-lg-6 col-xs-6 col-sm-6 para02">
                                  <a href="#">
                             
                                        <img class="img-responsive imagee" style="width:150px; height:150px; border-radius:20px;" src="{{ asset('storage/doctor').'/'.$item->image }}"  alt="{{$item->name}}">
                                     
                                     <center><h4 class="name01" style="font-weight:600"> {{$item->name}}</h4> </center>
                                    </a>
                            </div>
                             
                               <div  class="col-md-6 col-lg-6 col-xs-6 col-sm-6 doctor-id">
                                    <h4><a href="#" title="{{$item->name}}" target="_self" style="font-size: 20px; font-weight: 800;">{{$item->name}}</a></h4>
                                       <div class="price"><span style="color:black;">Exp. </span> 5 years </div>   
                                          <div class="price"> MBBS</div>
                                            <div class="price"><span style="color:black;">Specialist</span> {{$item->name}}</div> 
                                          
                                             
                                             <div class="price"><span style="color:black;">Fee </span><i class="fa fa-rupee"></i>200 </div>
                                               <div style="margin-top:5px;" >
                                                <a href="#" type="button" class="btn btn-success" title="Book Now"> 
                                                 <i class="fa fa-shopping-basket"></i> <span>Visit A Book</span> </a> 
                                            </div>
                                    </div>
                                    </div>   <!------------------------------------Doctor-------------------------------------->
                                 
                                </div> 
                                
                            @endforeach
                             </div>   
                          </div>  			
                         
                          </div>
                         </div>
                        </div> <!---rk -Middle Part End-->
                      
                      
                     
		            </div> <!--Middle Part End-->
@endsection

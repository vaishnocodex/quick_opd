@extends('website.master')
@section('content')

<!-- Main Container  -->
 <div class="main-container" >
   <div id="content">
        <div style="margin-top:10px;" class="module sohomepage-slider ">
            <div class="yt-content-slider"  data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="3" data-speed="0.4" data-margin="0" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="no" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
               <!------------city Slider Start----------------------->
                @foreach ($slider as $item)
                <div class="yt-content-slide">
                    <a href="#">
                        <img style="border-radius:20px;" src="{{ asset('storage/slider/').'/'.$item->image }}" alt="{{$item->title}}" class="img-responsive custom-slider"></a>
                </div>
                @endforeach
              
            </div>
            
        
        </div>

        <div class="container">
                             <center>
            <div class="block-policy2">

                <ul>
                   <!------
                    <li class="item-1">
                        <div class="item-inner">
                            <div class="icon icon1"></div>
                            <div class="content"> <a href="javascript:void(0);">Delivery all over india</a>
                                <p>Shipping all over india</p>
                            </div>
                        </div>
                    </li> --------->
                    <li class="item-2">
                        <div class="item-inner">
                            <div class="icon icon2"></div>
                            <div class="content"> <a href="javascript:void(0);">Support 24/7</a>
                                <p>Online 24 hours</p>
                            </div>
                        </div>
                    </li>
                   
                    <li class="item-4">
                        <div class="item-inner">
                            <div class="icon icon4"></div>
                            <div class="content"> <a href="javascript:void(0);">Payment Method</a>
                                <p>Secure payment</p>
                            </div>
                        </div>
                    </li>
                    <li class="item-5">
                        <div class="item-inner">
                            <div class="icon icon5"></div>
                            <div class="content"> <a href="javascript:void(0);">Big Saving</a>
                                <p>Exciting Offers</p>
                            </div>
                        </div>
                    </li>
                    
                  </ul>
                
               </div>
            </center>
            
               <div style="margin-top:20px;" class="so-categories module custom-slidercates">
                <h3 class="modtitle"><span>Book Our Specialist By</span></h3>
                <div class="modcontent">
                    <div class="cat-wrap theme3 font-title">
                        <div class="row">
                            <center>
                             @foreach ($category as $item)
                            <div style="margin-top:20px;" class="col-md-2 col-lg-2 col-xs-4 col-sm-4">
                                <div class="image-cat">
                                    <a  href="#" title="{{$item->name}}" target="_self">
                                        <img style="height:75px !important; width:75px !important; border-radius:50%;" class="img-circled"  src="{{ asset('storage/category/').'/'.$item->image }}" title="{{$item->name}}" alt="{{$item->name}}" />
                                    </a>
                                </div>
                              <div class="cat-title"> 
                                  <a style="font-size:11px;" href="#" title="{{$item->name}}" target="_self">{{$item->name}}
                                  <br>
                                  {{$item->name}}
                                  </a>
                                </div>
                            </div>
                            @endforeach
                             <div style="margin-top:20px; width: 100%; " class="col-md-2 col-lg-2 col-xs-4 col-sm-4"> 
                              <div class="cat-title">
                               <a href="#" class="btn btn-primary lg-btnn" style="width: 10%; font-size:14px; width:85;  margin-top:10px !important; font-weight:700; line-height:2; color:white; border-radius: 16px;" target="_self" >See All</a> 
                             </div> 
                            </div>
                           </center>

                        </div>
                    </div>
                </div>
            </div>
             <!-------------------===============Symptom===================--------------------------------->
                <div style="margin-top:20px;" class="so-categories module custom-slidercates">
                <h3 class="modtitle"><span>Select Problem</span></h3>
                <div class="modcontent">
                    <div class="cat-wrap theme3 font-title">
                         <div class="row">
                     <div class="col-md-12 col-xs-12 col-sm-12">
                           <div id="owl-demo7">    
                            
                               @foreach ($symptom as $item)
                            <div style="margin-top:20px;" class="item" >
                                <div class="image-cat">
                                    <a  href="#" title="{{$item->name}}" target="_self">
                                        <img style="height:75px !i
                                        mportant; width:75px !important; border-radius:50%;" class="img-circled"  src="{{ asset('storage/category/').'/'.$item->image }}" title="{{$item->name}}" alt="{{$item->name}}" />
                                    </a>
                               </div>
                              <div class="cat-title"> 
                                  <a style="font-size:11px;" href="#" title="{{$item->name}}" target="_self">{{$item->name}}
                                  <br>
                                  {{$item->name}}
                                  </a>
                                </div>
                          </div>
                          @endforeach
                           
                           </div>  
                           </div>
                           
                             <div style="margin-top:20px; width: 100%; " class="col-md-2 col-lg-2 col-xs-4 col-sm-4"> 
                              <div class="cat-title">
                                  <center>
                               <a href="#" class="btn btn-primary lg-btnn" style="width: 10%; font-size:14px; width:85;  margin-top:10px !important; font-weight:700; line-height:2; color:white; border-radius: 16px;" target="_self" >See All</a> 
                             </center>
                             </div> 
                            </div>
                           

                        </div>
                        
                        
                        
                    </div>
                </div>
            </div>
               <!-------------------================Symtom==================--------------------------------->
    <!-------------------===============Radiology category===================--------------------------------->
                <div style="margin-top:20px;" class="so-categories module custom-slidercates">
                <h3 class="modtitle"><span>Book Our Radiology By </span></h3>
                <div class="modcontent">
                    <div class="cat-wrap theme3 font-title">
                        <div class="row">
                            <center>
                            
                             @foreach ($category as $item)
                            <div style="margin-top:20px;" class="col-md-2 col-lg-2 col-xs-4 col-sm-4">
                                <div class="image-cat">
                                    <a  href="#" title="{{$item->name}}" target="_self">
                                        <img style="height:75px !important; width:75px !important; border-radius:50%;" class="img-circled"  src="{{ asset('storage/category/').'/'.$item->image }}" title="{{$item->name}}" alt="{{$item->name}}" />
                                    </a>
                                </div>
                              <div class="cat-title"> 
                                  <a style="font-size:11px;" href="#" title="{{$item->name}}" target="_self">{{$item->name}}
                                  <br>
                                  {{$item->name}}
                                  </a>
                                </div>
                            </div>
                            @endforeach
                             <div style="margin-top:20px; width: 100%; " class="col-md-2 col-lg-2 col-xs-4 col-sm-4"> 
                              <div class="cat-title">
                               <a href="#" class="btn btn-primary lg-btnn" style="width: 10%; font-size:14px; width:85;  margin-top:10px !important; font-weight:700; line-height:2; color:white; border-radius: 16px;" target="_self" >See All</a> 
                             </div> 
                            </div>
                           </center>

                        </div>
                    </div>
                </div>
            </div>
               <!-------------------================Radiology Category==================--------------------------------->

         
            </div>
        </div>
    </div>
        </div>
    </div>
<!-- //Main Container -->
@endsection


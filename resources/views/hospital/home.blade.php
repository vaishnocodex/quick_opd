@extends('hospital.master')
@section('content')
<div class="main-container">
  <style>
      .customheight{
          height: 107px;
      }
      .fnt{
          font: 400 0.656rem 'Open Sans', sans-serif!important;
      }
      
  </style>
    <!-- Page header start -->
    <div class="page-header">

        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
        
       
            <li class="breadcrumb-item">Welcome to, Hospital Panel</li> 
            
        </ol>
       
    </div>
    
    <!-- Page header end -->
    @php
        //$dashboard=webhelper::getDashboardStats();

    @endphp
    <!-- Row start -->
    <div class="row gutters ">
       
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
           
            <div class="info-stats2 customheight">
                <div class="info-icon warning">
                    <i class="icon-user"></i>
                </div>
                <div class="sale-num">
                    <h3>6554</h3>
                    <p class="fnt">Total Category</p>
                </div>
            </div>
           
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
           
            <div class="info-stats2 customheight">
                <div class="info-icon warning">
                    <i class="icon-user"></i>
                </div>
                <div class="sale-num">
                    <h3>{{$doctors->count()}}</h3>
                    <p class="fnt">Total Doctor</p>
                </div>
            </div>
           
        </div>
        
         @php if(Auth::user()->role=='1'){ @endphp 
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            
            <div class="info-stats2 customheight">
                <div class="info-icon info">
                    <i class="icon-shopping-bag1"></i>
                </div>
                <div class="sale-num">
                    <h3>1234</h3>
                    <p class="fnt">Total Products</p>
                </div>
            </div> 
        </div>
       
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
          
            <div class="info-stats2 customheight">
                <div class="info-icon warning">
                    <i class="icon-user"></i>
                </div>
                <div class="sale-num">
                    <h3>200</h3>
                    <p class="fnt">Total Customers</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            
            <div class="info-stats2 customheight">
                <div class="info-icon success">
                    <i class="icon-shopping-cart1"></i>
                </div>
                <div class="sale-num">
                    <h3>00</h3>
                    <p class="fnt">Today Orders</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12" >
          
            <div class="info-stats2 customheight">
                <div class="info-icon info">
                    <i class="icon-shopping-bag1"></i>
                </div>
                <div class="sale-num">
                    <h3>₹ 443</h3>
                    <p class="fnt">Total Wallet Added Balance Today</p>
                </div>
            </div>
        </div>
        @php } @endphp
        
    </div>
   
  


</div>



@endsection

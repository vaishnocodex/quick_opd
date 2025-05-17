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


            <li class="breadcrumb-item">Welcome to, Admin Panel</li>

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
                    <p class="fnt">Total Today Appointment </p>
                </div>
            </div>

        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="info-stats2 customheight">
                <div class="info-icon warning">
                    <i class="icon-calendar"></i>
                </div>
                <div class="sale-num">
                    <h3>34</h3>
                    <p class="fnt">Today's Appointments</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="info-stats2 customheight">
                <div class="info-icon warning">
                    <i class="icon-users"></i>
                </div>
                <div class="sale-num">
                    <h3>1250</h3>
                    <p class="fnt">Total Patients</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="info-stats2 customheight">
                <div class="info-icon warning">
                    <i class="icon-close"></i>
                </div>
                <div class="sale-num">
                    <h3>5</h3>
                    <p class="fnt">Cancelled Appointments</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="info-stats2 customheight">
                <div class="info-icon warning">
                    <i class="icon-clock"></i>
                </div>
                <div class="sale-num">
                    <h3>12</h3>
                    <p class="fnt">Pending Appointments</p>
                </div>
            </div>
        </div>

    </div>
    <!-- Row end -->
</div>



@endsection

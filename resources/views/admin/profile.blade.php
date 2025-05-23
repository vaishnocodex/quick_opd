@extends('admin.master') 
@section('content')

	<div class="main-container">

					<!-- Page header start -->
					<div class="page-header">
						
						<!-- Breadcrumb start -->
						<ol class="breadcrumb">
							<li class="breadcrumb-item">Account Settings</li>
						</ol>
						<!-- Breadcrumb end -->

						<!-- App actions start -->
					
						<!-- App actions end -->

					</div>
					<!-- Page header end -->

					<!-- Row start -->
                   <form method="POST" action="{{ route('admin.profile-update') }}" enctype="multipart/form-data">
                        @csrf

					<div class="row gutters">
					
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="card h-100">
								<div class="card-body">
                                     @include('admin.message')
									<div class="row gutters">
										
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="fullName">Full Name</label>
												<input type="text" class="form-control" id="fullName" name="name" value="{{Auth::guard('admin')->user()->name}}" placeholder="Enter full name" required>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="eMail">Login Email</label>
												<input type="email" class="form-control" id="eMail"  name="email" value="{{Auth::guard('admin')->user()->email}}" placeholder="Enter email ID" required>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="phone">Phone</label>
												<input type="text" class="form-control" id="phone" name="phone" value="{{Auth::guard('admin')->user()->mobile_no}}" placeholder="Enter phone number" required>
											</div>
										</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="zIp">Password</label>
												<input type="text" class="form-control" id="password" id="password" placeholder="New Password">
											</div>
										</div>
									</div>
									
									<div class="row gutters">
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<div class="text-right">    
												
												<button type="submit" id="submit" name="submit" class="btn btn-primary">Update</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    </form>
					<!-- Row end -->

				</div>
				<!-- Main container end -->
@endsection
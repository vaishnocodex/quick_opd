@extends('admin.master')
@section('content')
<style>
    .note-editor.note-frame .note-editing-area .note-editable {
        height: 20px;
    }
    @media only screen and (max-width: 600px) {
    .cusotm_top{
        padding-top: 0px !important;
    }
    }
    .cusotm_top{
        padding-top: 32px;
    }
</style>
<div class="main-container">
    <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Update firm Details</li>

        </ol>
        <!-- Breadcrumb end -->
    </div>
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.message')
                    <form method="POST" action="{{ route('admin.firmdetails.update') }}" enctype="multipart/form-data">
                      @csrf
                    <div class="row gutters">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" value="{{$firm->name}}" class="form-control  @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter full name" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text " value="{{$firm->mobile}}" maxlength="11" class="form-control @error('mobile') is-invalid @enderror" name="mobile" id="mobile"  placeholder="Enter Mobile" />
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="mobile">Email</label>
                                <input type="email " value="{{$firm->email}}" class="form-control @error('email') is-invalid @enderror" name="email" id="email"  placeholder="Enter Email Address" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                       <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="pmode">Payment Mode </label>
                                <select  class="form-control  form-control-lg @error('pmode') is-invalid @enderror"  name="pmode" >

                                    <option value="0" @if($firm->pmethod==0) selected @endif>COD </option>
                                    <option value="1" @if($firm->pmethod==1) selected @endif>Online </option>
                                    <option value="2" @if($firm->pmethod==2) selected @endif>Both </option>


                                </select>
                                @error('pmode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="text" value="{{$firm->facebook}}" class="form-control  @error('facebook') is-invalid @enderror" name="facebook" id="facebook" />
                                @error('facebook')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="instagram">Instagram</label>
                                <input type="text" value="{{$firm->instagram}}" class="form-control @error('instagram') is-invalid @enderror" name="instagram" id="instagram" />
                                @error('instagram')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="youtube">YouTube</label>
                                <input type="text" value="{{$firm->youtube}}" class="form-control @error('youtube') is-invalid @enderror" name="youtube" id="youtube"  />
                                @error('youtube')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                      
                         
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <button type="submit" class="btn btn-primary">Update Firms</button>
                        </div>


                    </div>
                    </form>
                </div>
            </div>
        </div>






    </div>



</div>


@endsection

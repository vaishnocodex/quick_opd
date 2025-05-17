@extends('layouts.app')

@section('content')
@php
$firm=webhelper::getFirm();

@endphp
<div class="container">

                    <form method="POST" action="{{ route('login.hospital') }}">
                        @csrf
                        <div class="row justify-content-md-center">
                            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                                <div class="login-screen" style="border-radius: 11px;">
                                    <div class="login-box">
                                        <div style="text-align: center" >
                                           {{--  <img alt="" src="{{ asset('backend') }}/img/logo5.png"  style="width: 70px;">  --}}

                                            <img alt="" src="{{ asset('storage/firms/').'/'.$firm->logo}}"  style="width: 70px;">
                                            <h2><a href="javascript:void(0)" class="login-logo">{{ $firm->name }}</a></h2>
                                            </div>
                                        @if(session('error'))
                                        <h5 class="alert alert-danger"> {{ session('error') }}</h5>
                                       @else
                                        <h5>Welcome back,<br />Please Login to your Account.</h5>
                                        @endif
                                        <div class="form-group">
                                           <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required  placeholder="Email Address" />

                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="password" class="form-control" name="password" required placeholder="Password" />

                                        </div>
                                        <div class="actions mb-4">
                                            <div class="custom-control custom-checkbox">

                                                <input type="checkbox" class="form-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-control-label" for="remember">Remember me</label>
                                            </div>
                                            <button type="submit" class="btn btn-success">Login</button>
                                        </div>
                                        {{-- <div class="forgot-pwd">
                                            <a class="link" href="forgot-pwd.html">Forgot password?</a>
                                        </div> --}}
                                        {{-- <hr>
                                        <div class="actions align-left">
                                            <a href="{{ route('register') }}" class="btn btn-info ml-0">Create an Account</a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

</div>
@endsection

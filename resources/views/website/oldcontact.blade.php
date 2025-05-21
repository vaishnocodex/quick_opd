@extends('website.master3')
@section('content')
<main class="main" id="main-section">

    <div style="padding:20px;" class="main-container container">
        <ul class="breadcrumb">
            <li><a href="{{ route('welcome') }}"><i class="fa fa-home"></i></a></li>

            <li><a href="#">Contact Us</a></li>
        </ul>

        <div class="row">
            <div id="content" class="col-sm-12">
                <div class="page-title">
                    <h2>Contact Us</h2>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3496.103654863342!2d76.14162991440112!3d28.805984782349647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391266d010a00e29%3A0x5d0345140b733055!2sZoo%20Rd%2C%20Bhiwani%2C%20Haryana%20127021!5e0!3m2!1sen!2sin!4v1626352423401!5m2!1sen!2sin"
                            width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-12 info-store">
                        <div class="row">
                            <div class="name-store">
                                <h3>Rightman Home Maintenance</h3>
                            </div>
                            <address>
                                <div class="address clearfix form-group">
                                    <div class="icon">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="text">Shop no. 23, Panchayat Pocket, Front Red Cross, Zoo Road Bhiwani
                                    </div>
                                </div>
                                <div class="phone form-group">
                                    <div class="icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="text">Phone : 948 57 67 000</div>
                                </div>

                                <div class="phone form-group">
                                    <div class="icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="text">info@rightmanhome.com</div>
                                </div>

                            </address>

                        </div>
                        <div class="col-lg-8 col-sm-8 col-xs-12 contact-form">
                            <form action="Contact_Enquiry" method="post" enctype="multipart/form-data" class="form-horizontal">
								<div class="row">
                                <fieldset>
                                    <legend>Contact Form</legend>
                                    <div class="form-group required">
                                        <label class="col-sm-2 control-label" for="input-name">Your Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nnam" value="" id="input-name"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group required">
                                        <label class="col-sm-2 control-label" for="input-email">E-Mail Address</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="cemail" value="" id="input-email"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group required">
                                        <label class="col-sm-2 control-label" for="input-enquiry">Enquiry</label>
                                        <div class="col-sm-10">
                                            <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="buttons">
                                    <div class="pull-right">

                                        <button class="btn btn-default buttonGray" name="contactsubmit" type="submit">
                                            <span>Submit</span>
                                        </button>
                                    </div>
                                </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</main>
        <!-- //Main Container -->
    @endsection

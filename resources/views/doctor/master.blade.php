<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @php
    $firm=backHelper::get_fimddetails();
    @endphp
    <!-- Meta -->
    <meta name="description" content="Admin dashboard">
    <meta name="author" content="ParkerThemes">
    <link rel="shortcut icon" href="{{ asset('storage/firms/').'/'.$firm->logo}}" />

    <!-- Title -->
    <title>Welcome to {{ $firm->name }}</title>


    <!-- *************
			************ Common Css Files *************
		************ -->
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/css/bootstrap.min.css">
    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/fonts/style.css">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/css/main.css">
    <!-- Chat css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/css/chat.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/datatables/dataTables.bs4.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/datatables/dataTables.bs4-custom.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/datatables/buttons.bs.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.css"
        integrity="sha512-7uSoC3grlnRktCWoO4LjHMjotq8gf9XDFQerPuaph+cqR7JC9XKGdvN+UwZMC14aAaBDItdRj3DcSDs4kMWUgg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/css/bootstrap-multiselect.min.css"
        integrity="sha512-wHTuOcR1pyFeyXVkwg3fhfK46QulKXkLq1kxcEEpjnAPv63B/R49bBqkJHLvoGFq6lvAEKlln2rE1JfIPeQ+iw=="
        crossorigin="anonymous" />

    <style>
        .multiselect-container.dropdown-menu.show {
            position: absolute;
            /* will-change: transform; */
            top: 0px;
            height: 300px;
            overflow-y: auto;
            left: 0px;
            /* display: flex; */
            width: 254px;
            transform: translate3d(0px, -168px, 0px);
        }
    </style>
    <!-- *************
			************ Vendor Css Files *************
		************ -->
</head>

<body>
    <style>
        @media only screen and (max-width: 600px) {
            .page-wrapper .sidebar-wrapper .sidebar-content {
                position: relative;
                height: calc(100% - 187px) !important;
            }

            .page-wrapper .sidebar-wrapper {
                height: 116vh !important;
            }
        }

        .page-wrapper .sidebar-wrapper {
            height: 100vh;
        }
    </style>

    <!-- Loading starts -->
    <div id="loading-wrapper">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Loading ends -->

    <!-- Page wrapper start -->
    <div class="page-wrapper">

        <!-- Sidebar wrapper start -->
        <nav id="sidebar" class="sidebar-wrapper">

            <!-- Sidebar brand start  -->
            <div class="sidebar-brand" style="display: flex;border-bottom: 1px solid #ccc;">

                <!-- <a href="javasript:void(0)" class="logo">
						<img src="{{ asset('backend') }}/img/logo.png" alt="Logo" />
					</a> -->
                <!--<a href="javasript:void(0)" class="logo">{{--- config('app.name') ---}}</a>-->
                <a href="javasript:void(0)" class="logo">{{$firm->name}}</a>

                <div class="profile-actions" style="padding-top: 23px;">
                    <a href="javascript:void(0)" onClick="logoutfrm()" class="red" data-toggle="tooltip"
                        data-placement="top" title="" data-original-title="Logout">
                        <i class="icon-power1" style="color: red;font-size: 21px;"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>

            <!-- Sidebar brand end  -->

            <!-- Sidebar content start -->
            <div class="sidebar-content">

                <!-- sidebar menu start -->
                <div class="sidebar-menu">
                    <ul>
                        <li class="{{ Route::currentRouteName()==" admin.home"?"active":"" }}">
                            <a href="{{route('doctor.home')}}">
                                <i class="icon-home2"></i>
                                <span class="menu-text">Dashboard</span>
                            </a>

                        </li>



                        <li class="sidebar-dropdown{{ Route::currentRouteName()==" javascript:void(0)"?"active":"" }}">
                            <a href="javascript:void(0)">
                                <i class="icon-users"></i>
                                <span class="menu-text">Manage Schedule </span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="{{ route('doctor-schedule') }}" class="{{ Route::currentRouteName()=="
                                            admin.category"?"current-page":"" }}">List </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="sidebar-dropdown{{ Route::currentRouteName()==" javascript:void(0)"?"active":"" }}">
                            <a href="javascript:void(0)">
                                <i class="icon-users"></i>
                                <span class="menu-text">Appointment </span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="{{ route('doctor.appointment', ['type' => 'Pending']) }}"
                                            class="{{ Route::currentRouteName()==" doctor.appointment"?"current-page":""
                                            }}">List</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('doctor.appointment', ['type' => 'Completed']) }}"
                                            class="{{ Route::currentRouteName() == 'doctor.appointment' ? 'current-page' : '' }}">
                                            Completed
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                           <li class="sidebar-dropdown{{ Route::currentRouteName()==" javascript:void(0)"?"active":"" }}">
                            <a href="javascript:void(0)">
                                <i class="icon-users"></i>
                                <span class="menu-text">Profile </span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="{{ route('doctor.profile') }}"
                                            class="{{ Route::currentRouteName()==" doctor.appointment"?"current-page":""
                                            }}">Profile Update</a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
                <!-- sidebar menu end -->

            </div>
            <!-- Sidebar content end -->

        </nav>
        <!-- Sidebar wrapper end -->

        <!-- Page content start  -->
        <div class="page-content">

            <!-- Header start -->
            <header class="header">
                <div class="toggle-btns">
                    <a id="toggle-sidebar" href="javascript:void(0)">
                        <i class="icon-menu"></i>
                    </a>
                    <a id="pin-sidebar" href="javascript:void(0)">
                        <i class="icon-menu"></i>
                    </a>
                </div>
                <div>
                    <h4>Doctor </h4>
                </div>
                <div class="header-items">
                    <!-- Custom search start -->

                    <!-- Custom search end -->

                    <!-- Header actions start -->
                    <ul class="header-actions">

                        <li class="dropdown user-settings">
                            <a href="javascript:void(0)" id="userSettings" aria-haspopup="true">
                                <img src="{{ asset('storage/firms/').'/'.$firm->logo }}" style="width: 50px;"
                                    class="d-none profile-thumb" alt="User Thumb">
                            </a>

                        </li>
                    </ul>
                    <!-- Header actions end -->
                </div>
            </header>
            <!-- Header end -->

            <!-- Main container start -->
            @yield('content')
            <!-- Main container end -->

            <!-- Container fluid start -->
            <div class="container-fluid">
                <!-- Row start -->
                <div class="row gutters">
                    <div class="col-12">
                        <!-- Footer start -->
                        <div class="footer" style="font-size: 13px;">
                            Developed by Vaishnocodex.com
                        </div>
                        <!-- Footer end -->
                    </div>
                </div>
                <!-- Row end -->
            </div>
            <!-- Container fluid end -->


        </div>
        <!-- Page content end -->

    </div>
    <!-- Page wrapper end -->

    <script src="{{ asset('backend') }}/js/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('backend') }}/js/moment.js"></script>
    {{-- <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/js/bootstrap-multiselect.min.js"
        integrity="sha512-ljeReA8Eplz6P7m1hwWa+XdPmhawNmo9I0/qyZANCCFvZ845anQE+35TuZl9+velym0TKanM2DXVLxSJLLpQWw=="
        crossorigin="anonymous"></script> --}}

    <!-- *************
			************ Vendor Js Files *************
		************* -->
    <!-- Slimscroll JS -->
    <script src="{{ asset('backend') }}/vendor/slimscroll/slimscroll.min.js"></script>
    <script src="{{ asset('backend') }}/vendor/slimscroll/custom-scrollbar.js"></script>

    <!-- Polyfill JS -->
    <script src="{{ asset('backend') }}/vendor/polyfill/polyfill.min.js"></script>
    <script src="{{ asset('backend') }}/vendor/polyfill/class-list.min.js"></script>

    <!-- Apex Charts -->
    {{---
    <script src="{{ asset('backend') }}/vendor/apex/apexcharts.min.js"></script>
    <script src="{{ asset('backend') }}/vendor/apex/custom/home/lineRevenueGradientGraph.js"></script>
    <script src="{{ asset('backend') }}/vendor/apex/custom/home/radialTasks.js"></script>
    <script src="{{ asset('backend') }}/vendor/apex/custom/home/lineNewCustomersGradientGraph.js"></script>
    ---}}

    <!-- Peity Charts -->
    <script src="{{ asset('backend') }}/vendor/peity/peity.min.js"></script>
    <script src="{{ asset('backend') }}/vendor/peity/custom-peity.js"></script>

    <!-- Circleful Charts -->
    <script src="{{ asset('backend') }}/vendor/circliful/circliful.min.js"></script>
    <script src="{{ asset('backend') }}/vendor/circliful/circliful.custom.js"></script>
    <script src="{{ asset('backend') }}/vendor/summernote/summernote-bs4.js"></script>
    <script src="{{ asset('backend') }}/vendor/datatables/dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/vendor/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('backend') }}/vendor/datatables/custom/custom-datatables.js"></script>
    <script src="{{ asset('backend') }}/vendor/datatables/custom/fixedHeader.js"></script>
    <script src="{{ asset('backend') }}/vendor/datatables/buttons.min.js"></script>
    <script src="{{ asset('backend') }}/vendor/datatables/jszip.min.js"></script>
    <script src="{{ asset('backend') }}/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="{{ asset('backend') }}/vendor/datatables/html5.min.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}

    <!-- Bootstrap Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function(){
      $('.selectpicker11').selectpicker();
    });
    </script>
    <script src="{{ asset('backend') }}/vendor/datatables/buttons.print.min.js"></script>


    <!-- Main JS -->
    <script src="{{ asset('backend') }}/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.js"
        integrity="sha512-4p9OjnfBk18Aavg91853yEZCA7ywJYcZpFt+YB+p+gLNPFIAlt2zMBGzTxREYh+sHFsttK0CTYephWaY7I3Wbw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        //Dropzone Configuration
      Dropzone.autoDiscover = false;
    </script>
    <script>
        $(function(){
    $('.idm').keypress(function(e) {

if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
})
.on("cut copy paste",function(e){
e.preventDefault();
});

});
        function logoutfrm(){
            if(confirm("Are You Sure to Want Logout  ")){
            document.getElementById('logout-form').submit();
            }

        }
        $(document).ready(function() {
            $('.summernote').summernote({
                height: '300px',
                tabsize: 2
            });





        });
    </script>


    @include('admin.custom')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/js/bootstrap-multiselect.js"
        integrity="sha512-5EvDL79fM8WJcOk77QpsZ8DawGlSfbOZ/ycRPz0bxRgtiOFEMj8taAoqmm7AR4p2N+A6VBLg/Ar30L8qbPw1pQ=="
        crossorigin="anonymous"></script>
</body>

<!-- Mirrored from bootstrap.gallery/tycoon/design-light-version/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Jun 2021 06:08:54 GMT -->

</html>

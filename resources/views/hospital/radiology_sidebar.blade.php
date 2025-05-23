               <div class="sidebar-menu">
                    <ul>
                        <li class="{{ Route::currentRouteName()==" admin.home"?"active":"" }}">
                            <a href="{{route('admin.home')}}">
                                <i class="icon-home2"></i>
                                <span class="menu-text">Dashboard</span>
                            </a>

                        </li>
                       
                      
                        <li class="sidebar-dropdown{{ Route::currentRouteName()==" javascript:void(0)"?"active":"" }}">
                            <a href="javascript:void(0)">
                                <i class="icon-users"></i>
                                <span class="menu-text">Manage Services </span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="{{ route('radiology.service') }}" class="{{ Route::currentRouteName()=="
                                            radiology.service"?"current-page":"" }}">All Services</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('radiology.new-service') }}"
                                            class="{{ Route::currentRouteName()==" radiology.new-service"?"current-page":""
                                            }}">Add Service</a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="sidebar-dropdown {{ Route::currentRouteName() == 'admin.doctor' ? 'active' : '' }}">
                            <a href="javascript:void(0)">
                                <i class="icon-users"></i>
                                <span class="menu-text">Online Appointment</span>
                            </a>
                            <div class="sidebar-submenu"
                                style="{{ Route::currentRouteName() == 'admin.doctor' ? 'display: block;' : '' }}">
                                <ul>
                                    <li>
                                        <a href="{{ route('hospital.appointment.list') }}"
                                            class="{{ Route::currentRouteName() == 'hospital.appointment.list' ? 'current-page' : '' }}">
                                            List
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown {{ Route::currentRouteName() == 'admin.doctor' ? 'active' : '' }}">
                            <a href="javascript:void(0)">
                                <i class="icon-users"></i>
                                <span class="menu-text">Offline Appointment</span>
                            </a>
                            <div class="sidebar-submenu"
                                style="{{ Route::currentRouteName() == 'admin.doctor' ? 'display: block;' : '' }}">
                                <ul>
                                    <li>
                                        <a href="{{ route('hospital.appointment.list') }}" class="{{ Route::currentRouteName() == 'hospital.appointment.list' ? 'current-page' : '' }}">
                                            Pending Appointment
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('hospital.appointment.list') }}" class="{{ Route::currentRouteName() == 'hospital.appointment.list' ? 'current-page' : '' }}">
                                            Approved 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('hospital.appointment.list') }}" class="{{ Route::currentRouteName() == 'hospital.appointment.list' ? 'current-page' : '' }}">
                                            Cancelled 
                                        </a>
                                    </li>

                                        
                                </ul>
                            </div>
                        </li>
                        <li class="{{ Route::currentRouteName()=="radiology.service-schedule"?"active":"" }}">
                                            <a href="{{route('radiology.service-schedule')}}">
                                                <i class="icon-home2"></i>
                                                <span class="menu-text">Add Schedule</span>
                                            </a>

                                        </li>

                    </ul>
                </div>
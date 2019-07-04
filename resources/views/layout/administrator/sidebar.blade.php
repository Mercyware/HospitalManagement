<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            @if (Auth::check())
                @can('view_dashboard')
                    <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                        <a href="{{route('dashboard')}}">
                            <i class="fa fa-dashboard fa-fw"></i> Dashboard
                        </a>
                    </li>
                @endcan


                @can('view_patients')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-gears"></i> <span>Patients</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('add_patients')
                                <li>
                                    <a href="{{route('patients.create')}}">New Patient</a>
                                </li>
                            @endcan

                            @can('view_patients')
                                <li>
                                    <a href="{{route('patients.index')}}">All Patients</a>
                                </li>
                            @endcan


                        </ul>
                    </li>
                @endcan

                @can('view_staff')
                <!-- The Doctor Menu -->
                    <li class="treeview">

                        <a href="#">
                            <i class="fa fa-user-md fa-fw"></i> <span>Human Resources</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>

                        <ul class="treeview-menu">
                            @can('add_staff')
                                <li>
                                    <a href="/user/create">New Staff</a>

                                </li>
                            @endcan

                            @can('view_staff')
                                <li>
                                    <a href="/user">All Staff</a>
                                </li>
                            @endcan
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>


                @endcan


                @can('view_appointment')
                    <li class="treeview">

                        <a href="#">
                            <i class="fa fa-hospital-o fa-fw"></i> <span>Appointment</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>


                        <ul class="treeview-menu">

                            <li>
                                <a href="/appointments/all">All Appointment</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                @endcan


                @can('manage_stock')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-truck fa-fw"></i> <span>Inventory</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>

                        <ul class="treeview-menu">
                            <li>
                                <a href="/store">View Inventory</a>
                            </li>

                        </ul>
                    </li>
                @endcan


                @can('view_tests')
                    <li class="treeview">

                        <a href="#">
                            <i class="fa fa-medkit fa-fw"></i> <span>Laboratory</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>


                        <ul class="treeview-menu">

                            @can('view_tests')
                                <li>
                                    <a href="/tests">View all Test</a>
                                </li>
                            @endcan
                            @can('view_results')
                                {{--<li>--}}
                                {{--<a href="/laboratory">All Laboratory Investigations</a>--}}
                                {{--</li>--}}
                            @endcan
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                @endcan


                @can('view_diagnostic')
                    <li class="treeview">

                        <a href="#">
                            <i class="fa fa-stethoscope fa-fw"></i> <span>Diagnostic</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>


                        <ul class="treeview-menu">
                            @can('view_diagnostic')
                                <li>
                                    <a href="{{route('diagnostics')}}">View all Diagnostic Test</a>
                                </li>


                                {{--<li>--}}
                                {{--<a href="/laboratory">All Laboratory Investigations</a>--}}
                                {{--</li>--}}
                            @endcan
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                @endcan


                @can('view_blood_bank')
                    <li class="treeview">

                        <a href="#">
                            <i class="fa fa-ambulance fa-fw"></i> <span>Blood Bank</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>


                        <ul class="treeview-menu">
                            <li>
                                <a href="{{route('blood.bank')}}">Blood Bank</a>
                            </li>

                            <li>
                                <a href="{{route('blood.bank.donors')}}">Blood Donations</a>
                            </li>
                            <li>
                                <a href="{{route('blood.bank.history')}}">Blood Request</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                @endcan


                @can('view_income')
                    <li class="treeview">

                        <a href="#">
                            <i class="fa fa-money fa-fw"></i> <span>Income & Expenses</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>


                        <ul class="treeview-menu">
                            @can('view_expenses')
                                <li>
                                    <a href="/expense">Expenses</a>
                                </li>
                            @endcan



                            @can('view_income')
                                <li>
                                    <a href="/account">Income Book</a>
                                </li>
                            @endcan


                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                @endcan


                <li class="treeview">

                    <a href="#">
                        <i class="fa fa-money fa-fw"></i> <span>Pricing</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>


                    <ul class="treeview-menu">

                        <li>
                            <a href="{{route('pricing.diagnosis.price')}}">Medical Care Prices</a>
                        </li>

                        {{--<li>--}}
                        {{--<a href="">New Branch</a>--}}
                        {{--</li>--}}


                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                <li class="treeview">

                    <a href="#">
                        <i class="fa fa-cogs fa-fw"></i> <span>Settings</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>


                    <ul class="treeview-menu">
                        @can('manage_branches')
                            <li>
                                <a href="{{route('contact.create')}}">Manage Company</a>
                            </li>
                        @endcan
                        @can('manage_branches')
                            <li>
                                <a href="/branch/create">New Branch</a>
                            </li>
                        @endcan
                        @can('manage_roles')
                            <li>
                                <a href="{{ route('roles.index') }}">Roles</a>
                            </li>
                        @endcan

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            @endif


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
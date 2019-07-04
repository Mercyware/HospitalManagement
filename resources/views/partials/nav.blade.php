<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0px;background:green">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand"><h4 class="text-white">MedCrux Integrated Health Services</h4></a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">


        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#F0AD4E;">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                {{--<li><a href="{{route('password.show')}}"><i class="fa fa-sign-out fa-fw"></i> Change Password</a>--}}
                {{--<li class="divider"></li>--}}
                <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                @if (Auth::check())
                    @can('view_dashboard')
                        <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                            <a href="/patients">
                                <i class="fa fa-dashboard fa-fw"></i> Dashboard
                            </a>
                        </li>
                    @endcan
                    {{--<li>--}}
                    {{--<a href="index.php"> Dashboard</a>--}}
                    {{--</li>--}}
                <!-- Real Menu Starts Here --->

                    @can('view_patients')

                        <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                            <!-- The Patient Menu -->
                            <a href="#"><i class="fa fa-group fa-fw"></i> Patients<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <!-- <li>
                                     <a href="Add_Patient.php">Add Patient</a>
                                 </li> -->

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
                            <!-- /.nav-second-level -->
                        </li>



                    @endcan



                    @can('view_staff')
                    <!-- The Doctor Menu -->
                        <li>
                            <a href="#"><i class="fa fa-user-md fa-fw"></i> Human Resources<span
                                        class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
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
                        <li>
                            <a href="#"><i class="fa fa-hospital-o fa-fw"></i> Appointment<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="/appointments/all">All Appointment</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    @endcan


                @endif



                @can('view_invoice')
                <!-- The Invoices Menu -->
                    {{--<li>--}}
                    {{--<a href="#"><i class="fa fa-file-text-o fa-fw"></i> Invoice<span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-second-level">--}}
                    {{--<li>--}}
                    {{--<a href="/invoice">All Invoice</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--<!-- /.nav-second-level -->--}}
                    {{--</li>--}}
                @endcan



                @can('view_drugs')
                    {{--<li>--}}
                    {{--<a href="#"><i class="fa fa-eraser fa-fw"></i>Pharmacy<span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-second-level">--}}

                    {{--@can('administer_drug')--}}
                    {{--<li>--}}
                    {{--<a href="/drugs/medication">Pending Medications</a>--}}
                    {{--</li>--}}
                    {{--@endcan--}}

                    {{--@can('view_drugs')--}}
                    {{--<li>--}}
                    {{--<a href="/drugs">All Drugs</a>--}}
                    {{--</li>--}}
                    {{--@endcan--}}

                    {{--<li>--}}
                    {{--<a href="/drugs/history">View Drugs History</a>--}}
                    {{--</li>--}}

                    {{--<li>--}}
                    {{--<a href="/drugs/report">Drugs Sales Report</a>--}}
                    {{--</li>--}}

                    {{--</ul>--}}
                    {{--<!-- /.nav-second-level -->--}}
                    {{--</li>--}}
                @endcan
            <!-- The Medicine Menu -->

                @can('manage_stock')
                    <li>
                        <a href="#"><i class="fa fa-home fa-fw"></i>Inventory<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/store">View Inventory</a>
                            </li>

                        </ul>
                    </li>
                @endcan
            <!-- The Test Menu -->

                @can('view_tests')
                    <li>
                        <a href="#"><i class="fa fa-user-md fa-fw"></i> Laboratory<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
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
                    <li>
                        <a href="#"><i class="fa fa-user-md fa-fw"></i> Diagnostic<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
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
                    <li>
                        <a href="#"><i class="fa fa-ambulance fa-fw"></i> Blood Bank<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            <li>
                                <a href="{{route('blood.bank')}}">Blood Bank</a>
                            </li>

                            <li>
                                <a href="{{route('blood.bank.donations')}}">Blood Donations</a>
                            </li>
                            <li>
                                <a href="{{route('blood.bank.history')}}">Blood Request</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                @endcan






                @can('view_income')
                    <li>
                        <a href="#"><i class="fa fa-money fa-fw"></i> Income & Expenses<span
                                    class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
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
            <!-- The Test Menu -->





                <!-- The Notice Board Menu -->


                <!-- The Message Menu -->


            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
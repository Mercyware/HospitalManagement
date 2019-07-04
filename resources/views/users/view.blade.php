@extends('partials.master')
@section('page_title')
    {{$user->name}}
@endsection
@section('page_buttons')

@endsection
@section('content')




    <form action="/user/update/{{$user->id}}" method="post" enctype="multipart/form-data"
          id="Register_User_Form">

        @include('partials.errors')
        @if($user->status == 0)
            <div class="alert alert-danger">Staff Account Deactivated
            </div>
        @endif
        @if($user->status == 1)
            <div class="alert alert-info">Staff Account Active</div>

        @endif

        <div class="col-sm-6">


            <div class="form-group">
                <label>Name : {{$user->name}}</label>


            </div>
            <div class="form-group">
                <label>Phone Number : {{$user->phone}}</label>

            </div>

            <div class="form-group">
                <label>Email : {{$user->email}}</label>

            </div>

            <div class="form-group">
                <label>Designated Branch : {{$user->branch->name}}</label>

            </div>


            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                <div class="form-group">

                    <label>Sex : @if($user->sex == 1 )
                            Male
                        @endif
                        @if($user->sex == 2 )
                            Female
                        @endif

                    </label>
                </div>
            </div>

            <?php
            $DateofBirth = "";
            if ($user->dob != NULL) {
                $DateofBirth = \Carbon\Carbon::createFromFormat('Y-m-d', $user->dob)->format('d/m/Y');
            }
            ?>
            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                <div class="form-group">
                    <label>Date of Birth : {{$DateofBirth}}</label>
                </div>
            </div>

            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                <div class="form-group">

                    <label>Position :{{$user->position}}</label>

                </div>
            </div>

            <?php
            $AppointmentDate = "";
            if ($user->appointment_date != NULL) {
                $AppointmentDate = \Carbon\Carbon::createFromFormat('Y-m-d', $user->appointment_date)->format('d/m/Y');

            }

            ?>

            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                <div class="form-group">

                    <label>Date of Appointment : {{$AppointmentDate}}</label>

                </div>
            </div>


            <div class="form-group">
                <label>Address : {{$user->address}}</label>

            </div>


        </div>
        <!-- /.col-lg-6 (nested) -->
        <div class="col-sm-6">

            <?php
            $Picture = $user->photo;
            if ($Picture == "") {
                $Picture = "Picture.png";
            }
            ?>

            <div class="col-sm-6 col-md-offset-3">
                <a href="#" class="thumbnail">
                    <img src="/Images/UsersPhoto/{{$Picture}}" alt="{{$user->name}}" data-src="holder.js/100%x180"
                         class="Profile_Picture" id="previewing">
                </a>
            </div>


            <!-- /.col-lg-6 (nested) -->
        </div>
        <div class="col-sm-12 ">
            @can('edit_staff')
                <a href="/user/update/{{$user->id}}" class="btn btn-primary"><span
                            class="fa fa-edit"></span> Edit</a>


                @if($user->status == 0)
                    <a href="/user/activate/{{$user->id}}/1" class="btn btn-primary"><span
                                class="fa fa-unlock"></span> Activate</a>
                @endif
                @if($user->status == 1)
                    <a href="/user/activate/{{$user->id}}/0" class="btn btn-danger"><span
                                class="fa fa-lock"></span> Deactivate</a>
                @endif
            @endcan


        </div>
    </form>



    <!-- /#page-wrapper -->


    <!-- /#wrapper -->




@endsection
@section('jsfiles')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>


    <script language="javascript" type="text/javascript" src="/css/dist/validator/validator.min.js"></script>
    <script language="javascript" type="text/javascript" src="/css/dist/validator/validator.js"></script>



    <script>
        //datepicker
        $(function () {


            $.fn.datepicker.defaults.format = "dd/mm/yyyy";
            $('.DatePicker').datepicker({
                autoclose: true,
                clearBtn: true,
                todayHighlight: true
            });


        });


    </script>




    {{--<script language="javascript" type="text/javascript" src="public/js/validator.min.js"></script>--}}
    {{--<script language="javascript" type="text/javascript" src="public/js/validator.js"></script>--}}
    <script>
        $(document).ready(function () {
            $('#Register_User_Form')
                .formValidation({
                    framework: 'bootstrap',
                    icon: {
//                    valid: 'glyphicon glyphicon-ok',
//                    invalid: 'glyphicon glyphicon-remove',
//                    validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {


                        dob: {
                            validators: {
                                notEmpty: {},

                                date: {
                                    format: 'DD/MM/YYYY',

                                },
                            }
                        },
                        name: {
                            validators: {
                                notEmpty: {},
                            }
                        },
                        phone: {
                            validators: {
                                notEmpty: {},
                                integer: {},
                            }
                        }


                    }
                })
        });
    </script>

@endsection


    

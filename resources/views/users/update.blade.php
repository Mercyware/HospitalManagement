@extends('partials.master')
@section('page_title')
    Update Staff Information
@endsection
@section('page_buttons')

@endsection
@section('content')


    <form action="/user/update/{{$user->id}}" method="post" enctype="multipart/form-data"
          id="Register_User_Form">

        @include('partials.errors')
        {{csrf_field()}}
        {{ method_field('PATCH') }}
        <div class="col-sm-6">


            <div class="form-group">
                <label>Name</label>
                <input class="form-control" placeholder=" Name"
                       name="name" value="{{$user->name}}">

            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input class="form-control"
                       placeholder=" Phone Number" name="phone" value="{{$user->phone}}">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input class="form-control" placeholder=" Email"
                       name="email" value="{{$user->email}}">
            </div>

            <div class="form-group">
                <label>Designated Branch</label>
                <select class="form-control" name="branch_id">
                    @foreach($branches as $branch)
                        <option value="{{$branch->id}}" @if($user->branch_id == $branch->id )
                        selected="selected"
                                @endif>{{$branch->name}}</option>

                    @endforeach
                </select>
            </div>


            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                <div class="form-group">

                    <label>Sex</label>
                    <select class="form-control" name="sex">
                        <option value="1" @if($user->sex == 1 )
                        selected="selected"
                                @endif>Male
                        </option>
                        <option value="2" @if($user->sex == 2 )
                        selected="selected"
                                @endif>Female
                        </option>
                    </select>
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
                    <label>Date of Birth</label>
                    <input class="form-control DatePicker" type="text" placeholder="Date of Birth"
                           name="dob" id="datepicker"
                           value="{{$DateofBirth}}"/>

                </div>
            </div>

            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                <div class="form-group">

                    <label>Position</label>
                    <input class="form-control" type="text" placeholder="Position"
                           name="position" value="{{$user->position}}"/>
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

                    <label>Date of Appointment </label>
                    <input class="form-control DatePicker" type="text" placeholder="Date of Appointment"
                           name="appointment_date" value="{{$AppointmentDate}}"/>
                </div>
            </div>


            <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" rows="3" name="address">{{$user->address}}</textarea>
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
                    <img src="/Images/UsersPhoto/{{$Picture}}" alt="..." data-src="holder.js/100%x180"
                         class="Profile_Picture" id="previewing">
                </a>
            </div>


            <div class="col-sm-6 col-md-offset-3">
                <div class="form-group">
                    <label>Patient Picture</label>
                    <label for="Picture"></label>
                    <input type="file" name="Picture" id="Picture">
                </div>
            </div>


            <!-- /.col-lg-6 (nested) -->
        </div>
        <div class="col-sm-12 ">

            <input type="submit" class="btn btn-primary btn-lg pull-right" value="Update  Staff">

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

//                                date: {
//                                    format: 'DD/MM/YYYY',
//
//                                },
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


    

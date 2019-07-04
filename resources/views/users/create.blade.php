@extends('partials.master')
@section('page_title')
    New Staff Registration
@endsection
@section('page_buttons')
 {{--//   @include('buttons.patientshome')--}}

    {{--<a href="{{route('dental.show', [str_singular($patient->id) => $patient->id])}}"--}}
       {{--class="btn btn-primary"><span class="fa fa-smile-o"></span>--}}
        {{--Dental Diagnosis </a>--}}

    {{--<a href="/patient/dental/history/{{$patient->id}}" class="btn btn-primary"><span--}}
                {{--class="fa fa-history"></span> Patient Dental History </a>--}}
@endsection
@section('content')


    <form action="/user/create" method="post" enctype="multipart/form-data" id="Register_User_Form">

        @include('partials.errors')
        {{csrf_field()}}
        <div class="col-sm-6">


            <div class="form-group">
                <label>Name</label>
                <input class="form-control" placeholder=" Name"
                       name="name">

            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input class="form-control"
                       placeholder=" Phone Number" name="phone">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input class="form-control" placeholder=" Email"
                       name="email">
            </div>

            <div class="form-group">
                <label>Designated Branch</label>
                <select class="form-control" name="branch_id">
                    @foreach($branches as $branch)
                        <option value="{{$branch->id}}">{{$branch->name}}</option>

                    @endforeach
                </select>
            </div>


            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                <div class="form-group">

                    <label>Sex</label>
                    <select class="form-control" name="sex">
                        <option value="1">Male</option>
                        <option value="2">Female</option>

                    </select>
                </div>
            </div>


            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input class="form-control DatePicker" type="text" placeholder="Date of Birth"
                           name="dob" id="datepicker"
                           value="<?php echo date('m/d/Y'); ?>"/>

                </div>
            </div>


            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                <div class="form-group">

                    <label>Position</label>
                    <input class="form-control" type="text" placeholder="Position"
                           name="position" value=""/>
                </div>
            </div>

            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                <div class="form-group">

                    <label>Date of Appointment </label>
                    <input class="form-control DatePicker" type="text" placeholder="Date of Appointment"
                           name="appointment_date" value=""/>
                </div>
            </div>

            <div class="form-group @if ($errors->has('roles')) has-error @endif">
                {!! Form::label('roles[]', 'Roles') !!}
                {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null,  ['class' => 'multiselect-ui form-control', 'multiple']) !!}
                @if ($errors->has('roles')) <p
                        class="help-block">{{ $errors->first('roles') }}</p> @endif
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" rows="3" name="address"></textarea>
            </div>


        </div>
        <!-- /.col-lg-6 (nested) -->
        <div class="col-sm-6">


            <div class="col-sm-6 col-md-offset-3">
                <a href="#" class="thumbnail">
                    <img src="/Images/UsersPhoto/Picture.png" alt="user Photo"
                         data-src="holder.js/100%x180"
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

            <input type="submit" class="btn btn-primary btn-lg pull-right" value="Register New Staff">

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
//                                    format: 'dd/mm/yyyy',
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

    <script language="javascript" type="text/javascript" src="/js/multiselect.js"></script>

    <script type="text/javascript">
        $(function () {
            $('.multiselect-ui').multiselect({
                includeSelectAllOption: true
            });
        });
    </script>

@endsection


    

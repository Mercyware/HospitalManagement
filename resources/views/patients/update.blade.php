@extends('partials.master')
@section('page_title')
    Update Patient Record
@endsection
@section('page_buttons')
    @include('buttons.diagmenu')
@endsection
@section('content')

    {!! Form::model($patient, ['method' => 'PATCH', 'route' => ['patients.update',  $patient->id , 'files' => true,'id'=>"Register_Patient_Form"] ]) !!}
    {{--<form action="/patients/update/{{$patient->id}}" method="post" enctype="multipart/form-data"--}}
    {{--id="Register_Patient_Form">--}}


    {{--{{csrf_field()}}--}}
    {{--{{ method_field('PATCH') }}--}}
    <div class="col-sm-6">

        <div class="form-group">
            <label>Hospital Branch</label>
            <select class="form-control" name="branch_id">
                @foreach($branches as $branch)


                    <option value="{{$branch->id}}" @if($patient->branch_id == $branch->id )
                    selected="selected"
                            @endif>{{$branch->name}}</option>

                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Name</label><input class="form-control" placeholder="Patient Name"
                                      name="name" value="{{$patient->name}}">

        </div>
        <div class="form-group">
            <label>Phone Number</label><input class="form-control"
                                              placeholder="Patient Phone Number" name="phone"
                                              value="{{$patient->phone}}">
        </div>

        <div class="form-group">
            <label>Email</label><input class="form-control" placeholder="Patient Email"
                                       name="email" value="{{$patient->email}}">
        </div>


        <div class="col-sm-12" style="margin-left:0px; padding-left:0px;">
            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                <div class="form-group">

                    <label>Sex</label>
                    <select class="form-control" name="sex">
                        <option value="1" @if($patient->sex == 1 )
                        selected="selected"
                                @endif>Male
                        </option>
                        <option value="2" @if($patient->sex == 2 )
                        selected="selected"
                                @endif>Female
                        </option>

                    </select>
                </div>
            </div>

            <?php
            $DateofBirth = "";
            if ($patient->date_of_birth != NULL) {
                $DateofBirth = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $patient->date_of_birth)->format('d/m/Y');
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
        </div>


        <div class="col-sm-12" style="margin-left:0px; padding-left:0px;">


            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                <div class="form-group">

                    <label>Blood Group </label>
                    <select class="form-control" name="blood_group">
                        <option value="Unknown" @if($patient->blood_group == "Unknown" )
                        selected="selected"
                                @endif>Unknown
                        </option>
                        @foreach($bloodgroups as $bloodgroup)
                            <option value="{{$bloodgroup->name}}{{$bloodgroup->rh_factor}}"
                                    @if($patient->blood_group ==$bloodgroup->name . $bloodgroup->rh_factor)  selected="selected" @endif>{{$bloodgroup->name . $bloodgroup->rh_factor}}
                            </option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                <div class="form-group">

                    <label>Genotype</label>
                    <select class="form-control" name="genotype">
                        <option value="Unknown" @if($patient->genotype == "Unknown" )
                        selected="selected"
                                @endif>Unknown
                        </option>
                        <option value="AA" @if($patient->genotype == "AA" )
                        selected="selected"
                                @endif>AA
                        </option>
                        <option value="AS" @if($patient->genotype == "AS" )
                        selected="selected"
                                @endif>AS
                        </option>
                        <option value="AC" @if($patient->genotype == "AC" )
                        selected="selected"
                                @endif>AC
                        </option> <option value="CC" @if($patient->genotype == "CC" )
                        selected="selected"
                                @endif>CC
                        </option> <option value="SC" @if($patient->genotype == "SC" )
                        selected="selected"
                                @endif>SC
                        </option>
                        <option value="SS" @if($patient->genotype == "SS" )
                        selected="selected"
                                @endif>SS
                        </option>
                    </select>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" rows="3" name="address"
                      placeholder="Patient Address">{{$patient->address}}</textarea>
        </div>


    </div>
    <!-- /.col-lg-6 (nested) -->
    <div class="col-sm-6">

        <?php
        $Picture = $patient->photo;
        if ($Picture == "") {
            $Picture = "patient.jpg";
        }
        ?>

        <div class="col-sm-6 col-md-offset-3">
            <a href="#" class="thumbnail">
                <img src="/Images/PatientPhoto/{{$Picture}}" alt="..." data-src="holder.js/100%x180"
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

        <input type="submit" class="btn btn-success btn-md pull-right" value="Update Patient">

    </div>
    {!! Form::close() !!}
    <!-- /.row (nested) -->



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
            $('#Register_Patient_Form')
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


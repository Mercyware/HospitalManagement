@extends('partials.master')
@section('page_title')
    New Patient Registration
@endsection
@section('page_buttons')

@endsection
@section('content')





                    {{Form::open(['route' => ['patients.store'], 'files' => true,'id'=>"Register_Patient_Form"])}}
                    {{--@include('partials.errors')--}}
                    {{--{{csrf_field()}}--}}
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label>Hospital Branch</label>
                            <select class="form-control" name="branch_id">
                                @foreach($branches as $branch)
                                    <option value="{{$branch->id}}">{{$branch->name}}</option>

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name',"autocomplete"=>"off"]) !!}
                            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                        </div>


                        <div class="form-group @if ($errors->has('phone')) has-error @endif">
                            {!! Form::label('phone', 'Phone Number') !!}
                            {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Phone Number']) !!}
                            @if ($errors->has('phone')) <p
                                    class="help-block">{{ $errors->first('phone') }}</p> @endif
                        </div>


                        <div class="form-group @if ($errors->has('email')) has-error @endif">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                            @if ($errors->has('email')) <p
                                    class="help-block">{{ $errors->first('email') }}</p> @endif
                        </div>


                        <div class="col-sm-12" style="margin-left:0px; padding-left:0px;">
                            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                                <div class="form-group @if ($errors->has('sex')) has-error @endif">

                                    {!! Form::label('sex', 'Sex') !!}
                                    {!! Form::select('sex', ['1'=>'Male','2'=>'Female'],'1',   ['class' => 'form-control']) !!}
                                    @if ($errors->has('sex')) <p
                                            class="help-block">{{ $errors->first('sex') }}</p> @endif

                                </div>

                            </div>


                            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">

                                <div class="form-group @if ($errors->has('name')) has-error @endif">
                                    {!! Form::label('dob', 'Date Of Birth') !!}
                                    {!! Form::text('dob', null, ['class' => 'form-control DatePicker', 'placeholder' => 'Date Of Birth',   ]) !!}
                                    @if ($errors->has('dob')) <p
                                            class="help-block">{{ $errors->first('dob') }}</p> @endif
                                </div>


                            </div>
                        </div>


                        <div class="col-sm-12" style="margin-left:0px; padding-left:0px;">
                            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                                <div class="form-group">

                                    <label>Blood Group</label>
                                    <select class="form-control" name="blood_group">

                                        <option value="Unknown"
                                                selected="selected"
                                        >Unknown
                                        </option>
                                        @foreach($bloodgroups as $bloodgroup)
                                            <option value="{{$bloodgroup->name}}{{$bloodgroup->rh_factor}}"
                                                    selected="selected"
                                            >{{$bloodgroup->name}}{{$bloodgroup->rh_factor}}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6" style="margin-left:0px;  padding-left:0px;">
                                <div class="form-group">

                                    <div class="form-group @if ($errors->has('genotype')) has-error @endif">

                                        {!! Form::label('genotype', 'Genotype') !!}
                                        {!! Form::select('genotype', ['Unknown'=>'Unknown','AA'=>'AA','AS'=>'AS','AC'=>'AC','CC'=>'CC','SC'=>'SC','SS'=>'SS'],'Unknown',   ['class' => 'form-control']) !!}
                                        @if ($errors->has('genotype')) <p
                                                class="help-block">{{ $errors->first('genotype') }}</p> @endif

                                    </div>


                                </div>
                            </div>
                        </div>


                        <div class="form-group">

                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                {!! Form::label('address', 'Address') !!}
                                {!! Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'Address' , 'rows' => 3]) !!}
                                @if ($errors->has('address')) <p
                                        class="help-block">{{ $errors->first('address') }}</p> @endif
                            </div>


                        </div>


                    </div>
                    <!-- /.col-lg-6 (nested) -->
                    <div class="col-sm-6">


                        <div class="col-sm-6 col-md-offset-3">
                            <a href="#" class="thumbnail">
                                <img src="/Images/PatientPhoto/patient.jpg" alt="..." data-src="holder.js/100%x180"
                                     class="Profile_Picture" id="previewing">
                            </a>
                        </div>


                        <div class="col-sm-6 col-md-offset-3">
                            <div class="form-group">
                                <div class="form-group @if ($errors->has('Picture')) has-error @endif">
                                    {!! Form::label('Picture', 'Patient Picture') !!}
                                    {!! Form::file('Picture',null,['class' => 'form-control DatePicker'   ]) !!}
                                    @if ($errors->has('Picture')) <p
                                            class="help-block">{{ $errors->first('Picture') }}</p> @endif
                                </div>


                            </div>
                        </div>


                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <div class="col-sm-12 ">

                        <input type="submit" class="btn btn-success btn-md pull-right" value="Register Patient">

                    </div>

                {!! Form::close() !!}



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
                                // notEmpty: {},

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
                                // integer: {},
                            }
                        }


                    }
                })
        });
    </script>






@endsection
    
